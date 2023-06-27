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
        <title>SUIGETSU</title>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="apple-touch-icon" sizes="180x180" href="../favicon/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="../favicon/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="../favicon/favicon-16x16.png">
        <link rel="manifest" href="../favicon/site.webmanifest">
        <!-- css file -->
        <link rel="stylesheet" href="view.css" />
        <!-- script -->
        <script src="https://kit.fontawesome.com/92d70a2fd8.js" crossorigin="anonymous"></script>
        <!-- Unicons -->
        <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />

        <style>
            .button {
                padding: 6px 24px;
                border: 2px solid #fff;
                background: transparent;
                border-radius: 6px;
                cursor: pointer;
            }
        </style>
    </head>

    <body>
        <!--header-->
        <header class="header">
            <nav class="nav">
                <a class="nav_logo"> SUIGETSU</a>
                <form method="POST">
                    <input type="text" name="search">
                    <input type="submit" name="submit" value="Search">
                    <input type="reset" value="Reset" onclick="window.location.href='viewCustomerData.php'">
                </form>
                <a class="button" style="color: inherit; text-decoration: none;" href="./admin_dashboard.php">BACK</a>
            </nav>
        </header>

        <div class="customerdata">
            <h1> CUSTOMER DATA </h1>
            <div class="container">
                <table class="tableCustomerData">
                    <tr>
                        <th> Customer Username </th>
                        <th> Customer Name </th>
                        <th> Customer Phone Number </th>
                        <th> Customer Gender </th>
                        <th> Customer Address </th>
                        <th> City </th>
                        <th> Poscode </th>
                        <th> State </th>
                    </tr>

                    <?php

                    // Fetch the user records from the database
                    $query = "SELECT * FROM customers";

                    // Check if the search form is submitted
                    if (isset($_POST["submit"])) {
                        $str = $_POST["search"];
                        $query = "SELECT * FROM customers WHERE customer_name LIKE '%$str%'";
                    }

                    $result = mysqli_query($con, $query);

                    // Iterate over the records and generate table columns dynamically
                    while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <tr>
                            <td>
                                <?php echo $row['customer_username']; ?>
                            </td>
                            <td>
                                <?php echo $row['customer_name']; ?>
                            </td>
                            <td>
                                <?php echo $row['customer_phoneNo']; ?>
                            </td>
                            <td>
                                <?php echo $row['customer_gender']; ?>
                            </td>
                            <td>
                                <?php echo $row['customer_address']; ?>
                            </td>
                            <td>
                                <?php echo $row['customer_city']; ?>
                            </td>
                            <td>
                                <?php echo $row['customer_postcode']; ?>
                            </td>
                            <td>
                                <?php echo $row['customer_state']; ?>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>

                </table>
            </div>
        </div>
    </body>

    </html>

    <?php
}
?>