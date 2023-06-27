<?php

// Create connection */
include("connect.php");


if (isset($_POST['submit_signup'])) {
    /* capture values from HTML form */
    $name = $_POST['name'];
    $username = $_POST['username'];
    $phoneNumber = $_POST['phoneNumber'];
    $street = $_POST['street'];
    $city = $_POST['city'];
    $poscode = $_POST['poscode'];
    $state = $_POST['state'];
    $gender = $_POST['customer_gender'];
    $password = password_hash($_POST['passwordSignUp'], PASSWORD_DEFAULT);
    $password2 = $_POST['password2'];

    /* capture values from HTML form */
    $sql0 = "SELECT customer_username FROM customers WHERE customer_username = '$username' ";
    $query0 = mysqli_query($con, $sql0) or die("Error: " . mysqli_error($con));
    $row0 = mysqli_num_rows($query0);
    if ($row0 != 0) {
        echo '<script>
                        window.location.href = "index.html";
                        alert("Record is existed")
                    </script>';
    } else {
        /* execute SQL INSERT command */
        $sql2 = "INSERT INTO customers (customer_name, customer_phoneNo, customer_gender, customer_address, customer_postcode, customer_city, customer_state, customer_username, customer_password)
        values('$name', '$phoneNumber', '$gender', '$street', '$poscode', '$city', '$state', '$username', '$password')";
        mysqli_query($con, $sql2) or die("Error: " . mysqli_error($con));
        /* display a message */
        echo '<script>
                        window.location.href = "index.html";
                        alert("Singup successful. Please login")
                    </script>';
    }
}
// close if isset()
/* close db connection */
mysqli_close($con);
?>