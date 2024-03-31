<?php
class Eloquent
{
    public $connection;

    public function __construct()
    {
        $this->connection = new PDO('mysql:host=' . $GLOBALS['DBHOST'] . ';dbname=' . $GLOBALS['DBNAME'] . ';charset=utf8', $GLOBALS['DBUSER'], $GLOBALS['DBPASS']);
        //$this->connection = new PDO('mysql:host='.DBHOST.';dbname='.DBNAME.';charset=utf8', DBUSER, DBPASS);
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->connection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    }

    // INSERT FUNCTION => tra ve id cua phan tu vua duoc them vao
    function insertData($tableName, $data)
    {
        try {
            $sql = "INSERT INTO $tableName (";
            foreach ($data as $key => $value) {
                $sql .= $key . ", ";
            }
            $sql = rtrim($sql, ", ");
            $sql .= ") VALUES (";
            foreach ($data as $key => $value) {
                $sql .= ":" . $key . ", ";
            }
            $sql = rtrim($sql, ", ");
            $sql .= ")";
            $stmt = $this->connection->prepare($sql);
            foreach ($data as $key => $value) {
                $stmt->bindValue(':' . $key, $value); //gan gia tri cho cac bien dinh danh
            }
            $stmt->execute();
            return $this->connection->lastInsertId();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    // UPDATE FUNCTION
    function updateData($tableName, $data, $whereValue = [])
    {
        try {
            $sql = "UPDATE $tableName SET ";
            foreach ($data as $key => $value) {
                $sql .= $key . " = :" . $key . ", ";
            }
            $sql = rtrim($sql, ", ");
            if ($whereValue != []) {
                $sql .= " WHERE ";
                foreach ($whereValue as $key => $value) {
                    $sql .= $key . " = :" . $key . " AND ";
                }
                $sql = rtrim($sql, " AND ");
            }
            $stmt = $this->connection->prepare($sql);
            foreach ($data as $key => $value) {
                $stmt->bindValue(':' . $key, $value);
            }
            if ($whereValue != []) {
                foreach ($whereValue as $key => $value) {
                    $stmt->bindValue(':' . $key, $value);
                }
            }
            $stmt->execute();
            $dataAdded = $stmt->rowCount();
            return $dataAdded;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    // DELETE FUNCTION
    function deleteData($tableName, $whereValue = [])
    {
        try {
            $sql = "DELETE FROM $tableName";
            if ($whereValue != []) {
                $sql .= " WHERE ";
                foreach ($whereValue as $key => $value) {
                    $sql .= $key . " = :" . $key . " AND ";
                }
                $sql = rtrim($sql, " AND ");
            }
            $stmt = $this->connection->prepare($sql);
            if ($whereValue != []) {
                foreach ($whereValue as $key => $value) {
                    $stmt->bindValue(':' . $key, $value);
                }
            }
            $stmt->execute();
            $dataAdded = $stmt->rowCount();
            return $dataAdded;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }


    // SELECT FUNCTION
    public function selectData(
        $columnName,
        $tableName,
        $whereValue = [],
        $inColumn = [],
        $inValue = [],
        $formatByGroup = [],
        $formatByOrder = 0,
        $paginate = [],
        $price = ['MIN' => 0, 'MAX' => 0]
    ) {
        try {
            // select ? form table
            if ($columnName == "*")
                $sql1 = "SELECT * FROM ";
            else {
                $sql1 = "SELECT ";
                foreach ($columnName as $eachColumn) { // lay ra cac cot trong mang $columnName
                    $sql1 .= $eachColumn . ", ";
                }
                $sql1 = rtrim($sql1, ", ");
                $sql1 .= " FROM $tableName";
            }

            //where column = value
            if ($whereValue != []) {
                $sql1 .= " WHERE ";
                if (array_key_exists('operator', $whereValue)) {
                    $operator = $whereValue['operator'] == '=' ? ' = ' : ' <> ';
                } else $operator = ' = ';
                foreach ($whereValue as $eachColumn => $eachValue) {
                    if ($eachColumn == 'operator') continue;
                    $sql1 .= $eachColumn . $operator . '\'' . $eachValue . '\'' . " AND ";
                }
                $sql1 = rtrim($sql1, "AND ");
            }

            // where column in ()
            if ($inColumn != []) {
                $sql1 .= " WHERE ";
                $i = $j = 0;
                foreach ($inColumn as $eachColumn) {
                    $sql1 .= $eachColumn . " IN (";
                    foreach ($inValue as $eachValue) {
                        if ($i == $j) {
                            $sql1 .= $eachValue . ", ";
                            break;
                        }
                        $j++;
                    }
                    $sql1 = rtrim($sql1, ", ");
                    $sql1 .= ") AND ";
                    $i++;
                }
                $sql1 = rtrim($sql1, "AND ");
            }

            // where product_price between 1000 and 2000
            if ($price['MAX'] != 0)
                $sql1 .= " WHERE product_price BETWEEN " . $price['MIN'] . " AND " . $price['MAX'];

            //group by
            if ($formatByGroup != []) {
                $sql1 .= " GROUP BY ";
                foreach ($formatByGroup as $eachGroup) {
                    $sql1 .= $eachGroup . ", ";
                }
                $sql1 = rtrim($sql1, ", ");
            }

            // order by
            if (@$formatByOrder['ASC'])
                $sql1 .= " ORDER BY " . $formatByOrder['ASC'] . " ASC";
            else if (@$formatByOrder['DESC'])
                $sql1 .= " ORDER BY " . $formatByOrder['DESC'] . " DESC";

            //paginate
            if ($paginate != []) {
                $sql1 .= " LIMIT " . $paginate['START'] . ", " . $paginate['END'];
            }

            $query = $this->connection->prepare($sql1);
            $query->execute();
            $dataSelected = $query->fetchAll(PDO::FETCH_ASSOC);

            return $dataSelected; //array
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    // SELECT CART INFO
    public function loadCartInfo($customerId)
    {
        try {
            $sql = "SELECT `products`.`id`, `products_sc`.`id` as `idProductSC`, `shopcarts`.`id` as `idShopCarts`, `quantity`, `product_color`, `product_size`, `product_name`, `product_master_image`, `product_price`, `product_quantity`  from `shopcarts` LEFT JOIN `products_sc` ON `shopcarts`.`product_sc_id` = `products_sc`.`id` LEFT JOIN `products` ON `products_sc`.`product_id` = `products`.`id` WHERE `customer_id` = " . $customerId;
            $query = $this->connection->prepare($sql);
            $query->execute();
            $dataSelected = $query->fetchAll(PDO::FETCH_ASSOC);
            return $dataSelected; //array
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    // SELECT ORDER ITEMS
    public function selectOrderItems($customerId, $orderId)
    {
        try {
            $sql = "SELECT `products_sc`.`id` as `idProductSC`, `products`.`id` as `idProduct`, `product_name`, `product_size`, `product_color`, `order_items`.`product_quantity`, `order_items`.`product_price`, (`order_items`.`product_quantity` * `order_items`.`product_price`) as `sub_price`, `product_master_image` from `order_items` LEFT JOIN `orders` ON `order_items`.`order_id` = `orders`.`id` LEFT JOIN `products_sc` ON `order_items`.`product_sc_id` = `products_sc`.`id` LEFT JOIN `products` ON `products_sc`.`product_id` = `products`.`id` WHERE `order_items`.`customer_id` = " . $customerId . " AND `order_items`.`order_id` = " . $orderId;
            $query = $this->connection->prepare($sql);
            $query->execute();
            $dataSelected = $query->fetchAll(PDO::FETCH_ASSOC);
            return $dataSelected; //array
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    //SELECT PRODUCT COlOR
    public function selectProductColor($colorName, $paginate = ["START" => 0, "END" => 1000])
    {
        try {
            $sql = "SELECT `products`.`id`, `product_name`, `product_master_image`, `product_price`, `virtual_price` FROM `products` 
            LEFT JOIN `products_sc` ON `products`.`id` = `products_sc`.`product_id`
            WHERE `product_type` = 'Active' AND `product_color` = '" . $colorName . "' AND `products`.`is_delete` = '0' GROUP BY `products`.`id`, `product_name`, `product_master_image`, `product_price` LIMIT " . $paginate['START'] . ", " . $paginate['END'];
            $query = $this->connection->prepare($sql);
            $query->execute();
            $dataSelected = $query->fetchAll(PDO::FETCH_ASSOC);
            return $dataSelected; //array
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    //SELECT PRODUCT price
    public function selectProductPrice($price, $paginate = ["START" => 0, "END" => 1000])
    {
        try {
            $sql = "SELECT * FROM `products` 
            WHERE `is_delete` = '0' AND `product_type` = 'Active' 
            AND `product_price` BETWEEN " . $price['MIN'] . " AND " . $price['MAX'] . "
            LIMIT " . $paginate['START'] . ", " . $paginate['END'];
            $query = $this->connection->prepare($sql);
            $query->execute();
            $dataSelected = $query->fetchAll(PDO::FETCH_ASSOC);
            return $dataSelected; //array
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    //SELECT PRODUCT PRICE && COLOR
    public function selectProductPriceAndColor($price, $colorName, $paginate = ["START" => 0, "END" => 1000])
    {
        try {
            $sql = "SELECT `products`.`id`, `product_name`, `product_master_image`, `product_price`, `virtual_price` FROM `products` 
            LEFT JOIN `products_sc` ON `products`.`id` = `products_sc`.`product_id`
            WHERE `products`.`is_delete`='0' AND `product_type` = 'Active' AND `product_color` = '" . $colorName . "' AND `product_price` BETWEEN " . $price['MIN'] . " AND " . $price['MAX'] . " GROUP BY `products`.`id`, `product_name`, `product_master_image`, `product_price` LIMIT " . $paginate['START'] . ", " . $paginate['END'];
            $query = $this->connection->prepare($sql);
            $query->execute();
            $dataSelected = $query->fetchAll(PDO::FETCH_ASSOC);
            return $dataSelected; //array
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    //SELECT REVIEW PRODUCT
    public function selectReviewProduct($idProduct)
    {
        try {
            $sql = "SELECT `products`.`id`, `customer_name`, `customer_image`, `review_details`, `rating`, `reviews`.`created_at`, `reviews`.`updated_at`
            from `products`
            LEFT JOIN `products_sc` ON `products`.`id` = `products_sc`.`product_id`
            LEFT JOIN `reviews` ON `products_sc`.`id` = `reviews`.`product_sc_id`
            LEFT JOIN `customers` ON `reviews`.`customer_id` = `customers`.`id`
            WHERE `customer_name` IS NOT NULL AND `review_status` = 'Active' AND `products`.`id` = " . $idProduct;
            $query = $this->connection->prepare($sql);
            $query->execute();
            $dataSelected = $query->fetchAll(PDO::FETCH_ASSOC);
            return $dataSelected; //array
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    //SELECT PRODUCT POPULAR
    public function selectProductPopular()
    {
        try {
            $sql = "SELECT `products`.`id`, `product_name`, `products`.`product_price`, `virtual_price`, `product_master_image`, `product_image_one`, 
            COUNT(`order_items`.`id`) AS `qty` 
            FROM `products`
            LEFT JOIN `products_sc` ON `products_sc`.`product_id` = `products`.`id`
            LEFT JOIN `order_items` ON `order_items`.`product_sc_id` = `products_sc`.`id`
            GROUP BY `products`.`id`, `product_name`, `products`.`product_price`, `virtual_price`, `product_master_image`, `product_image_one` 
            ORDER BY `qty` DESC
            LIMIT 0, 8";
            $query = $this->connection->prepare($sql);
            $query->execute();
            $dataSelected = $query->fetchAll(PDO::FETCH_ASSOC);
            return $dataSelected; //array
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    //SELECT COUPONS
    public function selectCoupons()
    {
        try {
            $sql = "SELECT * FROM `discounts`
            WHERE `is_delete` = '0' AND `discount_status` = 'Active'";
            $query = $this->connection->prepare($sql);
            $query->execute();
            $dataSelected = $query->fetchAll(PDO::FETCH_ASSOC);
            return $dataSelected; //array
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    //SELECT COUPONS save
    public function selectCouponsSave($id)
    {
        try {
            $sql = "SELECT `discount_id` FROM `coupons` 
            WHERE `discount_id` = '" . $id . "'";
            $query = $this->connection->prepare($sql);
            $query->execute();
            $dataSelected = $query->fetchAll(PDO::FETCH_ASSOC);
            return count($dataSelected);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    //check save coupons
    public function checkSaveCoupons($customerId, $discountId)
    {
        try {
            $sql = "SELECT * FROM `coupons` WHERE `customer_id` = " . $customerId . " AND `discount_id` = " . $discountId;
            $query = $this->connection->prepare($sql);
            $query->execute();
            $dataSelected = $query->fetch(PDO::FETCH_ASSOC);
            return $dataSelected; //array
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
