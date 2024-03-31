<?php
class SearchController extends Controller
{
    public function searchProduct($htmlKeywords, $start, $end)
    {
        // $arrayKeywords = explode(" ", $htmlKeywords);

        // $sql1 = $sql2 = null;
        // $sql1 = "
		// 	SELECT * 
		// 	FROM products 
		// 	WHERE (";
        // foreach ($arrayKeywords as $eachKey) {
        //     $sql2 .= "`product_tags` LIKE '%" . $eachKey . "%' OR ";
        // }
        // $sql2 = rtrim($sql2, " OR");
        // $sql2 .= ") AND `product_type` = 'Active' AND `is_delete` = '0'";
        // $sql3 = " ORDER BY id DESC LIMIT {$start}, {$end}";

        // $sql_code = $sql1 . $sql2 . $sql3;
        $sql = "SELECT * FROM `products` WHERE `product_tags` LIKE '%". $htmlKeywords ."%' AND `product_type` = 'Active' AND `is_delete` = '0' ORDER BY id DESC LIMIT {$start}, {$end}";
        $query = $this->connection->prepare($sql);

        $query->execute();

        $dataList = $query->fetchAll(PDO::FETCH_ASSOC);
        return $dataList;
    }
}
