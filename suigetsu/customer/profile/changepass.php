<!-- THIS IS FEATURE THAT LET CUSTOMER CHANGE THIER PASSWORD-->
<?php
session_start();
include('../../connect.php');
$id = $_SESSION['id'];

//check whether there is session or not.
//get sessionID, if there is no session id go to login page
if (isset($id)) {
    $message = '';
    $id = '';
    $id = $_SESSION['id'];
    //check data to be send if exist.
    if (count($_POST) > 0) {
        $sql = "SELECT * FROM customers WHERE customerID = $id";
        $query = mysqli_query($con, $sql) or die("Error: " . mysqli_error($con));
        $row = mysqli_fetch_array($query);

        //check data in database exist or not
        if (!empty($row)) {
            //encrpyt password to be update in database.
            $hashedPassword = $row["customer_password"];
            $newPassword = PASSWORD_HASH($_POST["newPassword"], PASSWORD_DEFAULT);
            $pattern = '/^(?=.*[0-9])(?=.*[A-Z]).{8,20}$/';

            if (preg_match($pattern, $_POST["newPassword"])) {

                //check whether currentPass = newPass.
                if (password_verify($_POST["currentPassword"], $hashedPassword)) {
                    $sql = "UPDATE customers SET customer_password = '$newPassword' WHERE customerID = $id";
                    $query = mysqli_query($con, $sql);

                    echo '<script> window.location.href = "./profile.php";
                            alert("Password Changed") 
                        </script>';
                }

                echo '<script> window.location.href = "";
                        alert("Current password is not correct!") 
                    </script>';
            } else {
                echo '<script type="text/javascript">
                    alert("Password is not strong enough! Please ensure meet all requirements");
                </script>';
            }

        }
    }
    mysqli_close($con);
} else {
    print "access denied";
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
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" href="profileUpdate.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="changepass.js"></script>
</head>

<body>
    <div class="container">
        <div class="view-account">
            <section class="module">
                <div class="module-inner">
                    <div class="side-bar">
                        <nav class="side-menu">
                            <ul class="nav">
                                <li><a href="./update.php"><span class="fa fa-user fa-user-secret"></span>
                                        Profile Update</a></li>
                                <li class="active"><a href=""><span class="fa fa-key fa-key-secret"></span> Change
                                        Password</a></li>
                                <li><a href="./profile.php"><span class="fa fa-home"></span> Profile</a></li>
                            </ul>
                        </nav>
                    </div>
                    <div class="content-panel">
                        <div class="row">
                            <div class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 col-sm-12 col-xs-12">

                                <!-- create new pass-->
                                <form method="post" name="passwordForm" id="passwordForm">
                                    <!-- check current pass in db-->
                                    <label>Current Password</label>
                                    <div class="form-group pass_show">
                                        <input type="password" value="" class="input-lg form-control"
                                            name="currentPassword" id="currentPassword" placeholder="Current Password"
                                            autocomplete="off" required>
                                        <span id="currentPasswordError"
                                            class="error"></span><!-- Error message element -->
                                    </div>
                                    <label>New Password</label>
                                    <input type="password" class="input-lg form-control" name="newPassword"
                                        id="newPassword" placeholder="New Password" autocomplete="off" required>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <span id="8char" class="glyphicon glyphicon-remove"
                                                style="color:#FF0004;"></span> 8 Characters Long<br>
                                            <span id="ucase" class="glyphicon glyphicon-remove"
                                                style="color:#FF0004;"></span> One Uppercase Letter
                                        </div>
                                        <div class="col-sm-6">
                                            <span id="lcase" class="glyphicon glyphicon-remove"
                                                style="color:#FF0004;"></span> One Lowercase Letter<br>
                                            <span id="num" class="glyphicon glyphicon-remove"
                                                style="color:#FF0004;"></span> One Number
                                        </div>
                                    </div><br>
                                    <label>Confirm Password</label>
                                    <input type="password" class="input-lg form-control" name="confirmPassword"
                                        id="confirmPassword" placeholder="Confirm Password" autocomplete="off" required>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <span id="pwmatch" class="glyphicon glyphicon-remove"
                                                style="color:#FF0004;"></span> Passwords Match
                                        </div>
                                    </div><br>
                                    <input type="submit" class="col-xs-12 btn btn-primary btn-load btn-lg"
                                        data-loading-text="Changing Password..." value="Change Password">
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</body>

</html>