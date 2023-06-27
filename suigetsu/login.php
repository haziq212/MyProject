<?php

session_start();
// Create connection 
include('connect.php');

if (isset($_POST['submit_login'])) {
    /* capture values from HTML form */
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM admin WHERE ad_username= '$username' AND ad_password = '$password'";
    $query = mysqli_query($con, $sql) or die("Error: " . mysqli_error($con));
    $row = mysqli_num_rows($query);
    if ($row > 0) {
        $row = mysqli_fetch_assoc($query);
        $_SESSION['id'] = $row['admin_id'];
        echo '<script>
                                window.location.href = "./admin/admin_dashboard.php";
                                alert("Welcome Admin")
                            </script>';
    } else {
        /* execute SQL command */
        $sql = "SELECT * FROM customers WHERE customer_username= '$username' /*AND customer_password= '$password'*/";
        $query = mysqli_query($con, $sql) or die("Error: " . mysqli_error($con));
        $row = mysqli_num_rows($query);

        if ($row > 0) {
            while ($row = mysqli_fetch_assoc($query)) {
                if (password_verify($password, $row['customer_password'])) {
                    $_SESSION['id'] = $row['customerId'];

                    echo '<script>
                                window.location.href = "./customer/customer_homepage.php";
                                alert("Login successful")
                            </script>';
                }
                else {
                    echo '<script>
                        window.location.href = "./index.html";
                        alert("Invalid Username/Password")
                    </script>';
        }
            }
        } else {
                    echo '<script>
                        window.location.href = "./index.html";
                        alert("Invalid Username/Password")
                    </script>';
        }

    }
}

mysqli_close($con);
?>