<!-- THIS IS PAGE WHERE CUSTOMER VIEW THIER PROFILE-->
<?php
session_start();
include('../../connect.php');
$id = $_SESSION['id'];

?>
<?php
//get sessionID, if there is no session id go to login page 
if (isset($id)) {
    //if exist proceed conection with database
    //read the selected row from database table
    $query = "SELECT * FROM customers WHERE customerID= $id";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) > 0) { // true if there is data in $result
        // output data of each row
        while ($record = mysqli_fetch_assoc($result)) { // $record originally $row
            $cn = $record["customer_name"];
            $cp = $record["customer_phoneNo"];
            $cg = $record["customer_gender"];
            $ca = $record["customer_address"];
            $cpc = $record["customer_postcode"];
            $cc = $record["customer_city"];
            $cs = $record["customer_state"];
            $cu = $record["customer_username"];
        }
    } else {
        header("location: ../../index.html"); //go to homepage
        exit;
    }
    mysqli_close($con);
} else {
    header('Location: ../../index.html'); //path to where your login form is located. Headers need to be above any output or they will produce an error and thus not work as intended (or at all even!)
    exit;
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suigetsu</title>
    <!-- Custom Css -->
    <link rel="stylesheet" href="profile.css">
    <!-- FontAwesome 5 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
    <!-- icon -->
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <script src='../customer.js'></script>
</head>

<body>
    <!-- Navbar top -->
    <div class="navbar-top">
        <div class="title">
            <i class='fas fa-address-card' style='font-size:26px'> User Profile </i>
        </div>
        <!-- Navbar -->
        <ul>
            <li>
                <a href="../customer_homepage.php" onclick="navigateToPage(event, '../customer_homepage.php')">
                    <i class="fa fa-sign-out-alt fa-2x" style="color: rgb(255, 255, 255);"></i>
                </a>
            </li>
        </ul>
        <!-- End -->
    </div>
    <!-- End -->
    <!-- Sidenav -->
    <div class="sidenav">
        <div class="profile">
            <img src="profileimg.png" width="100" height="100">

            <div class="username">
                <?php echo $cu; ?>
            </div>
        </div>

        <div class="sidenav-url">
            <div class="url">
                <i class="fa fa-pen fa-xs edit"></i>
                <a href="./update.php" class="btn btn-outline-primary btn-lg">Update Profile</a>
                <hr align="center">
            </div>
        </div>
    </div>
    <!-- End -->

    <!-- Main -->
    <div class="main">
        <div class="card">
            <div class="card-body">
                <table>
                    <tbody>
                        <tr>
                            <td><strong>Name</strong></td>
                            <td>
                                :
                                <?php echo $cn; ?>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Phone Number</strong></td>
                            <td>
                                :
                                <?php echo $cp; ?>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Gender</strong></td>
                            <td>
                                :
                                <?php echo $cg; ?>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Address</strong></td>
                            <td>
                                :
                                <?php echo $ca; ?>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Postcode</strong></td>
                            <td>
                                :
                                <?php echo $cpc; ?>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>City</strong></td>
                            <td>
                                :
                                <?php echo $cc; ?>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>State</strong></td>
                            <td>
                                :
                                <?php echo $cs; ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>

</html>