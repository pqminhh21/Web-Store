<?php
$eloquent = new Eloquent;

//get total order items
$allOrderItems = $eloquent->selectData(['*'], 'order_items');
$totalOrderItems = count($allOrderItems);

//get total customers
$allCustomers = $eloquent->selectData(['*'], 'customers');
$totalCustomers = count($allCustomers);

//get total money in invoice
$allInvoices = $eloquent->selectData(['*'], 'invoices');
$totalMoney = 0;
foreach ($allInvoices as $invoice) {
    $totalMoney += $invoice['transaction_amount'];
}

//get total products
$allProducts = $eloquent->selectData(['*'], 'products', ['product_type' => 'Active']);
$totalProducts = count($allProducts);

//get data for pie chart
$productTopSell = $eloquent->getDataProductForPieChart();
$arrPieChart = array();
foreach ($productTopSell as $product) {
    $arrPieChart[] = array("label" => $product['product_name'], "y" => $product['total']);
}
$dataPointsPie = $arrPieChart;

//get data for column chart
$customerTopBuy = $eloquent->getDataProductForColumnChart();
$arrColumnChart = array();
foreach ($customerTopBuy as $customer) {
    $arrColumnChart[] = array("label" => $customer['customer_name'], "y" => $customer['total']);
}
$dataPointsColumn = $arrColumnChart;

//get data for column chart order status
$orderStatus = $eloquent->getAllStatusOrder();
$arrColumnChartOrderStatus = array();
foreach ($orderStatus as $status) {
    $arrColumnChartOrderStatus[] = array("label" => $status['order_item_status'], "y" => $status['total']);
}
$dataPointsColumnOrderStatus = $arrColumnChartOrderStatus;

?>
<script>
    window.onload = function() {
        //pie chart
        var chart = new CanvasJS.Chart("chartContainerPie", {
            animationEnabled: true,
            theme: "light2",
            title: {
                text: "Top 10 Product Sell"
            },
            subtitles: [{
                text: ""
            }],
            data: [{
                type: "pie",
                legendText: "{label}",
                indexLabelFontSize: 16,
                indexLabel: "{label}(#percent%)",
                dataPoints: <?php echo json_encode($dataPointsPie, JSON_NUMERIC_CHECK); ?>
            }]
        });
        chart.render();

        //column chart order status
        var chart = new CanvasJS.Chart("chartContainerColumnOrder", {
            animationEnabled: true,
            theme: "light2", // "light1", "light2", "dark1", "dark2"
            title: {
                text: "Status Order"
            },
            axisY: {
                title: "Quantity"
            },
            axisX: {
                title: "Status"
            },
            data: [{
                type: "column",
                dataPoints: <?php echo json_encode($dataPointsColumnOrderStatus, JSON_NUMERIC_CHECK); ?>
            }]
        });
        chart.render();

        //column chart customer
        var chart = new CanvasJS.Chart("chartContainerColumnCustomer", {
            animationEnabled: true,
            theme: "light2", // "light1", "light2", "dark1", "dark2"
            title: {
                text: "Top Customer Buy Most"
            },
            axisY: {
                title: "VND"
            },
            axisX: {
                title: "Customer Name"
            },
            data: [{
                type: "column",
                dataPoints: <?php echo json_encode($dataPointsColumn, JSON_NUMERIC_CHECK); ?>
            }]
        });
        chart.render();
    }
</script>
<!--**********************************
    Content body start
***********************************-->
<div class="content-body">

    <div class="container-fluid mt-3">
        <div class="row">
            <div class="col-lg-3 col-sm-6">
                <div class="card gradient-1">
                    <div class="card-body">
                        <span class="float-right display-5 opacity-5"><i class="fa fa-shopping-cart"></i></span>
                        <h3 class="card-title text-white">Products Sold</h3>
                        <div class="d-inline-block">
                            <h2 class="text-white"><?= $totalOrderItems ?></h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="card gradient-2">
                    <div class="card-body">
                        <span class="float-right display-5 opacity-5"><i class="fa fa-money"></i></span>
                        <h3 class="card-title text-white">Revenue</h3>
                        <div class="d-inline-block">
                            <h2 class="text-white"><?= number_format($totalMoney, 0, ',', '.') . $GLOBALS['CURRENCY'] ?></h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="card gradient-3">
                    <div class="card-body">
                        <span class="float-right display-5 opacity-5"><i class="fa fa-users"></i></span>
                        <h3 class="card-title text-white">Total Customers</h3>
                        <div class="d-inline-block">
                            <h2 class="text-white"><?= $totalCustomers ?></h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="card gradient-4">
                    <div class="card-body">
                        <span class="float-right display-5 opacity-5"><i class="fa fa-shopping-bag"></i></span>
                        <h3 class="card-title text-white">Product Acitve</h3>
                        <div class="d-inline-block">
                            <h2 class="text-white"><?= $totalProducts ?></h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <div id="chartContainerPie" style="height: 380px; width: 100%;"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <div id="chartContainerColumnOrder" style="height: 380px; width: 100%;"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div id="chartContainerColumnCustomer" style="height: 380px; width: 100%;"></div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- #/ container -->
</div>
<!--**********************************
    Content body end
***********************************-->