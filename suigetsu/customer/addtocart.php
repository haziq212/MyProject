<?php
include('../connect.php');
session_start();

if (isset($_SESSION['id'])) {
    $customerId = $_SESSION['id'];
    $clothesId = $_POST['clothesId'];
    $quantity = $_POST['quantity'];

    // Check if the item already exists in the cart for the customer
    $checkQuery = "SELECT * FROM cart WHERE clothesId = '$clothesId' AND customerId = '$customerId'";
    $checkResult = mysqli_query($con, $checkQuery);

    if (mysqli_num_rows($checkResult) > 0) {
        // Item already exists in the cart, update the quantity
        $updateQuery = "UPDATE cart SET quantity = quantity + $quantity WHERE clothesId = '$clothesId' AND customerId = '$customerId'";
        mysqli_query($con, $updateQuery);
    } else {
        // Generate a random numeric Cart ID
        function generateCartID($length)
        {
            $characters = '0123456789';
            $charactersLength = strlen($characters);
            $result = '';

            for ($i = 0; $i < $length; $i++) {
                $result .= $characters[rand(0, $charactersLength - 1)];
            }

            return $result;
        }

        // Generate a new Cart ID
        $cartID = generateCartID(10);

        // Item does not exist in the cart, insert a new entry
        $insertQuery = "INSERT INTO cart (CART_ID, clothesId, QUANTITY, customerId) VALUES ('$cartID', '$clothesId', $quantity, '$customerId')";
        mysqli_query($con, $insertQuery);
    }

    mysqli_close($con);
    header("Location: ./customer_homepage.php");
} else {
    header("Location: ../index.html");
}
?>