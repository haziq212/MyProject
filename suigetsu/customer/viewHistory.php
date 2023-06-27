<?php
include("../connect.php");
session_start();
if (isset($_SESSION['id'])) {
    /* execute SQL statement */
    $customerID = $_SESSION['id'];
    ?>

    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>SUIGETSU</title>
        <link rel="stylesheet" href="../admin/view.css" />
        <link rel="apple-touch-icon" sizes="180x180" href="../favicon/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="../favicon/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="../favicon/favicon-16x16.png">
        <link rel="manifest" href="../favicon/site.webmanifest">
        <script src="https://kit.fontawesome.com/92d70a2fd8.js" crossorigin="anonymous"></script>
        <!-- Unicons -->
        <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />

        <style>
            .imgItem {
                width: 100px;
                height: 100px;
                padding: 10px;
                display: inline-block;
                border: white;
                border-radius: 10px;
                animation: transitionIn 1s;
            }
        </style>
    </head>

    <!--header-->
    <header class="header">
        <nav class="nav">
            <a href="#" class="nav_logo"> SUIGETSU</a>
            <ul class="nav_items">
                <!--<li style="margin-left: -850%;" class="nav_item">
          <a href="#home" class="nav_link">Home</a>
        </li>-->
            </ul>

            <a class="button" style="color: inherit; text-decoration: none;" onclick="history.back(-1)">BACK</a>
        </nav>
        <div class="customerdata">
            <h1> Order History </h1>
            <div class="container">
                <table border="1" class="tableCustomerData">
                    <tr>
                        <th> Order ID </th>
                        <th> Order Image </th>
                        <th> Clothes Name</th>
                        <th> Quantity</th>
                        <th> Price</th>
                        <th> Total Price</th>
                        <th> Order Date </th>
                        <th> Order Status </th>
                    </tr>
                    <?php
                    include('../connect.php');
                    // Fetch the user records from the database
                    $customerID = $_SESSION['id'];
                    $query = "SELECT * FROM orders WHERE customerId = '$customerID'";
                    $result = mysqli_query($con, $query);
                    while ($row = mysqli_fetch_assoc($result)) {

                        $query = "SELECT o.ordersId, o.ordersDate, o.orderStatus, p.clothesId, p.clothes_orderQty, p.clothes_orderTotalPrice, c.clothes_price, c.clothes_title, c.clothes_image1, o.customerId
                                    FROM orders o
                                    INNER JOIN clothes_orders p ON o.ordersId = p.ordersId
                                    INNER JOIN clothes c ON c.clothesId = p.clothesId
                                    WHERE o.customerId = '$customerID'";

                        $result = mysqli_query($con, $query);

                        //Iterate over the records and generate table columns dynamically
                        while ($row = mysqli_fetch_assoc($result)) {
                            $clothesImage = $row['clothes_image1'];
                            ?>
                            <tr>
                                <td>
                                    <?php echo $row['ordersId']; ?>
                                </td>
                                <td>
                                    <img src="../admin/clothes_images/<?php echo $clothesImage; ?>" class="imgItem">
                                </td>
                                <td>
                                    <?php echo $row['clothes_title']; ?>
                                </td>
                                <td>
                                    <?php echo $row['clothes_orderQty']; ?>
                                </td>
                                <td>
                                    RM
                                    <?php echo $row['clothes_price']; ?>
                                </td>
                                <td>
                                    RM
                                    <?php echo $row['clothes_orderTotalPrice']; ?>.00
                                </td>
                                <td>
                                    <?php echo $row['ordersDate']; ?>
                                </td>
                                <td>
                                    <?php echo $row['orderStatus']; ?>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                    </table>
                </div>
            </div>
        </header>

        </html>
        <?php
                    }
}
else {
    header("location: ../index.html");
    die();
  }
?>