<?php
include("../connect.php");
session_start();

$totalprice = $_GET['totalprice'];

if (isset($_SESSION['id'])) {
    $customerId = $_SESSION['id'];

    // Step 1: Retrieve cart items for the specific customer
    $cartItemsQuery = "SELECT * FROM cart WHERE customerId = '$customerId'";
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

    $staffIds = ['S001', 'S003'];
    $randomIndex = array_rand($staffIds);

    $orderid = generateOrderID(10);
    $orderdate = date('Y-m-d H:i:s');
    $orderstatus = 'Pending';

    $paymentId = generatePaymentID(10);

    // Begin transaction
    mysqli_begin_transaction($conn);

    try {
        // Insert the order details
        $insertOrderQuery = "INSERT INTO `orders` (ordersId, ordersDate, orderStatus, customerId) 
        VALUES ('$orderid', '$orderdate', '$orderstatus', '$customerId')";
        $insertOrderResult = mysqli_query($conn, $insertOrderQuery);

        if (!$insertOrderResult) {
            throw new Exception("Error: " . mysqli_error($conn));
        }

        $insertPayment = "INSERT INTO payment (payment_id, payment_amount, payment_date, ordersId, customerId) 
        VALUES ('$paymentId', '$totalprice', '$orderdate', '$orderid', '$customerId')";
        $insertPaymentResult = mysqli_query($conn, $insertPayment);

        if (!$insertPaymentResult) {
            die("Error: " . mysqli_error($conn));
        }

        // Insert the cart items into the clothes order
        while ($cartItem = mysqli_fetch_assoc($cartItemsResult)) {
            $clothesId = $cartItem['clothesId'];
            $quantity = $cartItem['QUANTITY'];

            $insertClothesOrdersQuery = "INSERT INTO `clothes_orders` (ordersId, clothesId, QUANTITY) 
            VALUES ('$orderid', '$clothesId', $quantity)";
            $insertCLothesOrderResult = mysqli_query($conn, $insertClothesOrdersQuery);

            if (!$insertCLothesOrderResult) {
                throw new Exception("Error: " . mysqli_error($conn));
            }
        }

        // Commit the transaction
        mysqli_commit($conn);

        // Clear the cart for the specific customer
        $clearCartQuery = "DELETE FROM cart WHERE customerId = '$customerId'";
        $clearCartResult = mysqli_query($conn, $clearCartQuery);

        if (!$clearCartResult) {
            throw new Exception("Error: " . mysqli_error($conn));
        }

        echo "<div id='donepay'>
        <h1>Congratulation!</h1>
        <p>Payment Successful!</p>
        <p class='small'>You can check your<br> Order in your Profile</p>
        <a href='mainPage1.php'>
            <button>Back To Home</button>
        </a>
    </div>
    <div id='cover' style='display:block'></div>";

    } catch (Exception $e) {
        // Rollback the transaction if an error occurred
        mysqli_rollback($conn);
        die($e->getMessage());
    }
} else {
    // Redirect to the login page if the user is not logged in
    header("Location: index.html");
}
?>