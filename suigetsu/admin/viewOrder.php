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
        <link rel="stylesheet" href="./view.css" />
        <link rel="apple-touch-icon" sizes="180x180" href="../favicon/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="../favicon/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="../favicon/favicon-16x16.png">
        <link rel="manifest" href="../favicon/site.webmanifest">
        <script src="https://kit.fontawesome.com/92d70a2fd8.js" crossorigin="anonymous"></script>
        <!-- Unicons -->
        <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />

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
            <h1> Customer Order </h1>
            <div class="container">
                <table border="1" class="tableCustomerData">
                    <tr>
                        <th> Order ID </th>
                        <th> Customer ID </th>
                        <th> Order Date </th>
                        <th> Order Status </th>
                    </tr>
                    <?php
                    include('../connect.php');
                    // Fetch the user records from the database
                    $customerID = $_SESSION['id'];
                    $query = "SELECT * FROM orders";
                    $result = mysqli_query($con, $query);

                    //Iterate over the records and generate table columns dynamically
                    while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <tr>
                            <td>
                                <?php echo $row['ordersId']; ?>
                            </td>
                            <td>
                                <?php echo $row['customerId']; ?>
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
?>