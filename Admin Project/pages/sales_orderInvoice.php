<?php
require_once("./../includes/db_connection.php");
if (isset($_GET['sales_order_id'])) {
    $salesOrderId = $_GET['sales_order_id'];
    //Retriving Sales order information
    $sql = "SELECT * FROM sales_order_information WHERE sales_order_id = $salesOrderId";
    $query = $con->query($sql);
    if ($query) {
        $salesOrderInformation = $query->fetch_assoc();
    }

    //Retving s_order_product data
    $salesOrderId = $salesOrderInformation['sales_order_id'];
    $sql = "SELECT * FROM s_order_product_information WHERE sales_order_id = $salesOrderId";
    $query = $con->query($sql);
    if ($query) {
        while ($s_order_product_data = $query->fetch_assoc()) {
            $s_order_product_information[] = $s_order_product_data;
        }
    }
    $formatter = new NumberFormatter('en_IN', NumberFormatter::CURRENCY);

    //Date and Time speration 
    $timestamp = $salesOrderInformation['time_stamp'];
    $dateObj = new DateTime($timestamp);
    $timezone = new DateTimeZone('+12');
    $dateObj->setTimezone($timezone);
    $date = $dateObj->format('jS M Y');
    $time = $dateObj->format('h:i A');
}

?>

<div class="container">
    <div class="invoice-container">
        <div class="row mt-5">
            <div class="col-md-6">
                <h4>Store Management Project:</h4>
                <p>IDB Bhaban, Agargaon <br> Mobile: 01957244070<br>Email: skmirajbn@gmail.com<br> Salesman:
                    <?= $salesOrderInformation['user_name'] ?>
                </p>
            </div>
            <div class="col-md-6 text-end">
                <h4>Customer Information:</h4>
                <p>
                    <?= $salesOrderInformation['customer_name'] ?>
                    <?= $salesOrderInformation['customer_address'] ?><br>Phone:
                    <?= $salesOrderInformation['customer_phone'] ?><br> Email:
                    <?= $salesOrderInformation['customer_email'] ?>
                </p>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-xl-12">
                <h2 class="text-center">Invoice</h2>
                <p class="text-center">Invoice Number:
                    #
                    <?= $salesOrderInformation['sales_order_id'] ?>
                </p>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-xl-12">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="text-center" scope="col">Product Name</th>
                            <th class="text-center" scope="col">Product Image</th>
                            <th class="text-center" scope="col">SKU</th>
                            <th class="text-end" scope="col">Price</th>
                            <th class="text-center" scope="col">Quantity</th>
                            <th class="text-end" scope="col">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $subTotal = 0;
                        foreach ($s_order_product_information as $product) {
                            //Calculate the Total
                            $total = $product['quantity'] * $product['selling_price'];
                            $subTotal += $total;
                            $total = $formatter->formatCurrency($total, 'BDT');

                            ?>

                            <tr>
                                <td class="text-center">
                                    <?= $product['product_name'] ?>
                                </td>
                                <td class="text-center"><img src="uploads/images/<?= $product['product_image'] ?>"
                                        alt="Product Image" width="50">
                                </td>
                                <td class="text-center">
                                    <?= $product['sku'] ?>
                                </td>
                                <td class="text-end">
                                    <?= $product['selling_price'] ?>
                                </td>
                                <td class="text-center">
                                    <?= $product['quantity'] ?>
                                </td>
                                <td class="text-end">
                                    <?= $total ?>
                                </td>
                            </tr>
                        <?php }

                        $subTotal = $formatter->formatCurrency($subTotal, 'BDT');






                        ?>

                        <!-- Add more product rows here -->
                    </tbody>
                </table>
            </div>
        </div>

        <!-- <div class="row mt-2">
            <div class="col-xl-8 offset-xl-4">
                <ul class="list-unstyled">
                    <li><span class="float-start me-3">Total Amount:</span>$1,100.00</li>
                    <li><span class="float-start me-5">Discount:</span>$100.00</li>
                    <li><span class="float-start me-5">Shipping:</span>$50.00</li>
                </ul>
            </div>
        </div> -->

        <div class="row mt-2">
            <div class="col-xl-8 offset-xl-4">
                <h4 class="float-end">Sub Total:
                    <?= $subTotal ?>
                </h4>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-xl-12">
                <p class="fw-bold">Date: <span class="text-muted">
                        <?= $date ?>
                    </span></p>
                <p class="fw-bold">Time: <span class="text-muted">
                        <?= $time ?>
                    </span></p>
                <p class="fw-bold mt-3">Signature:</p>
            </div>
        </div>


    </div>
    <div class="row mt-4">
        <div class="col-xl-12 text-center">
            <button class="btn btn-primary" onclick="window.print()">Print</button>
        </div>
    </div>
</div>