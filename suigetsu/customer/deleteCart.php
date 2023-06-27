<?php
include("../connect.php");
session_start();
if(isset ($_SESSION['id'])){
    /*execute SQL statement */
    $customerId = $_SESSION['id'];
    $sql = "SELECT * FROM customers WHERE customerId = '$customerId'";
    $query = mysqli_query($con, $sql) or die("Error : " . mysqli_error($con));
    $row = mysqli_num_rows($query);
    if ($row == 0) {
        echo "No record found";
    } else {
        $r = mysqli_fetch_assoc($query);
        $customerId = $r['customerId'];

        if (isset($_POST['Delete'])) {
            $clothesId = $_POST['clothesId'];

            $sql2 = "DELETE FROM cart WHERE clothesId = '$clothesId' AND customerId = '$customerId'";

            mysqli_query($con, $sql2) or die("Error: " . mysqli_error($con));

        } elseif (isset($_POST['DeleteAll'])) {

            $sql2 = "DELETE FROM cart WHERE customerId = '$customerId'";

            mysqli_query($con, $sql2) or die("Error: " . mysqli_error($con));

        } else {

        }

        // Close the database connection
        mysqli_close($con);
        header("Location: ./cart.php");

    }
}

else {
    header("location: ../index.html");
    die();
  }
?>