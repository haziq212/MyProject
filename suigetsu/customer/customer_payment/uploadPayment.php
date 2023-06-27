<?php
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['totalPrice']) == FALSE) {
    echo 'There Is No Item In The Cart!';
    header("location: ../../index.html");
    die();
}

$customerID = 0;
$totalPrice = 0.00;
$totalPriceFormat = 0.00;

$customerID = $_SESSION['id'];
$totalPrice = $_SESSION['totalPrice'];
$totalPriceFormat = $_SESSION['totalPriceFormat'];
$total = $_SESSION['totalPrice_clothesOrders']

    ?>

<?php

if (isset($_POST['upload']) && isset($_FILES['fileUpload'])) {
    // Create connection 
    $conn = mysqli_connect("localhost", "root", "", "suigetsu");


    $img_name = $_FILES['fileUpload']['name'];
    $img_size = $_FILES['fileUpload']['size'];
    $tmp_name = $_FILES['fileUpload']['tmp_name'];
    $error = $_FILES['fileUpload']['error'];

    //

    $cartItemsQuery = "SELECT * FROM cart WHERE customerId = '$customerID'";
    $cartItemsResult = mysqli_query($conn, $cartItemsQuery);

    if (!$cartItemsResult) {
        die("Error: " . mysqli_error($conn));
    }

    function generatePaymentID($length)
    {
        $characters = '0123456789';
        $charactersLength = strlen($characters);
        $result = '';

        for ($i = 0; $i < $length; $i++) {
            $result .= $characters[rand(0, $charactersLength - 1)];
        }

        return $result;
    }
    function generateOrderID($length)
    {
        $characters = '0123456789';
        $charactersLength = strlen($characters);
        $result = '';

        for ($i = 0; $i < $length; $i++) {
            $result .= $characters[rand(0, $charactersLength - 1)];
        }

        return $result;
    }


    $orderid = generateOrderID(10);
    $orderdate = date('Y-m-d H:i:s');
    $orderstatus = 'Pending';

    $paymentId = generatePaymentID(10);

    // Begin transaction
    mysqli_begin_transaction($conn);

    if ($error === 0) {
        if ($img_size > 1048576) {
            echo '<script>
            alert("File is too large")
            window.location.href = "customerPayment.php"
            </script>';
        } else {
            $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
            $img_ex_lc = strtolower($img_ex);

            $allowed_exs = array("pdf");

            if (in_array($img_ex_lc, $allowed_exs)) {
                $new_img_name = uniqid("PDF-", true) . '.' . $img_ex_lc;
                $img_upload_path = 'upload/' . $new_img_name;
                move_uploaded_file($tmp_name, $img_upload_path);

                try {
                    // Insert the order details
                    $insertOrderQuery = "INSERT INTO `orders` (ordersId, ordersDate, orderStatus, customerId) 
                     VALUES ('$orderid', '$orderdate', '$orderstatus', '$customerID')";
                    $insertOrderResult = mysqli_query($conn, $insertOrderQuery);

                    if (!$insertOrderResult) {
                        throw new Exception("Error: " . mysqli_error($conn));
                    }

                    $insertPayment = "INSERT INTO payment(receipt, payment_amount, customerId, ordersId)
                    VALUES('$new_img_name', '$totalPrice', '$customerID', '$orderid')";


                    // Insert the cart items into the clothes order
                    while ($cartItem = mysqli_fetch_assoc($cartItemsResult)) {
                        $clothesId = $cartItem['clothesId'];
                        $quantity = $cartItem['QUANTITY'];

                        $clothesQuery = "SELECT * FROM clothes WHERE clothesId = '$clothesId'";
                        $clothesResult = mysqli_query($conn, $clothesQuery);
                        $clothesData = mysqli_fetch_assoc($clothesResult);
                        $clothesPrice = $clothesData['clothes_price'];
                        $totalclothesPrice = $clothesPrice * $quantity;


                        $insertClothesOrdersQuery = "INSERT INTO `clothes_orders` (ordersId, clothesId, clothes_orderQty, clothes_orderTotalPrice) 
                        VALUES ('$orderid', '$clothesId', $quantity, $totalclothesPrice)";
                        $insertCLothesOrderResult = mysqli_query($conn, $insertClothesOrdersQuery);

                        if (!$insertCLothesOrderResult) {
                            throw new Exception("Error: " . mysqli_error($conn));
                        }
                    }

                    // Commit the transaction
                    mysqli_commit($conn);

                    // Clear the cart for the specific customer
                    $clearCartQuery = "DELETE FROM cart WHERE customerId = '$customerID'";
                    $clearCartResult = mysqli_query($conn, $clearCartQuery);

                    if (!$clearCartResult) {
                        throw new Exception("Error: " . mysqli_error($conn));
                    }


                } catch (Exception $e) {
                    // Rollback the transaction if an error occurred
                    mysqli_rollback($conn);
                    die($e->getMessage());
                }

                mysqli_query($conn, $insertPayment);
                echo '<script>
                        window.location.href = "../customer_homepage.php";
                        alert("Upload successful")
                        </script>';
            } else {
                echo '<script>
                    window.location.href = "customerPayment.php"
                    alert("You cant upload files of this type")
                    </script>';
            }
        }
    } else {
        echo '<script>
                window.location.href = "customerPayment.php"
                alert("unknown error occurred!")
                </script>';
    }

} else {
    header("Location: customerPayment.php");
}
?>