<!-- THIS IS FEATURE THAT LET CUSTOMER UPDATE THIER PROFILE-->
<?php
//if there is no session id go to page before
session_start();
if (isset($_SESSION['id']) == FALSE) {
    header("location: ../../index.html");
    die();
}
//if exist proceed
include('../../connect.php');

$id = "";
$cn = "";
$cp = "";
$cg = "";
$ca = "";
$cpc = "";
$cc = "";
$cs = "";
$cu = "";
$errorMessage = "";
$successMessage = "";

$id = $_SESSION['id'];

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // GET method: show the data pf the client
    if (isset($_GET[$_SESSION['id']])) {
        header("location: ./profile.php"); //go to homepage
        exit;
    }

    //read the selected row from database table
    $sql = "SELECT * FROM customers WHERE customerID = $id";
    $result = mysqli_query($con, $sql);

    // true if there is data in $result
    if (mysqli_num_rows($result) > 0) {

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
        header("location: ./profile.php"); //go to homepage
        exit;
    }
} else {
    // POST method: Update the data of the customer
    $id = $_POST["customerID"];
    $cn = $_POST["customer_name"];
    $cp = $_POST["customer_phoneNo"];
    $cg = $_POST["customer_gender"];
    $ca = $_POST["customer_address"];
    $cpc = $_POST["customer_postcode"];
    $cc = $_POST["customer_city"];
    $cs = $_POST["customer_state"];
    $cu = $_POST["customer_username"];

    do {
        if (empty($id) || empty($cn) || empty($cp) || empty($cg) || empty($ca) || empty($cpc) || empty($cc) || empty($cs) || empty($cu)) {
            $errorMessage = "All the fields are required";
            break;
        }

        $sql = "UPDATE customers
                    SET customer_name = '$cn', customer_phoneNo = '$cp', customer_gender = '$cg', customer_address = '$ca',
                     customer_postcode = '$cpc', customer_city ='$cc', customer_state = '$cs', customer_username = '$cu'
                    WHERE customerID = $id";

        $result = mysqli_query($con, $sql);

        echo '<script> window.location.href = "./profile.php";
                            alert("Done Update!") 
                        </script>';
        exit;
    }
    while (false);
}
mysqli_close($con);
?>
<!-- end connectDB -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suigetsu</title>
    <link rel="stylesheet" href="profileUpdate.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="view-account">
            <section class="module">   
                    <div class="side-bar">
                        <nav class="side-menu">
                            <ul class="nav">
                                <li class="active"><a href=""><span class="fa fa-user fa-user-secret"></span> Profile
                                        Update</a></li>
                                <li><a href="./changepass.php"><span class="fa fa-key fa-key-secret"></span>
                                        Change Password</a></li>
                                <li><a href="./profile.php"><span class="fa fa-home"></span> Profile</a></li>
                            </ul>
                        </nav>
                    </div>
                    <div class="content-panel">
                        <div class="row">
                            <div class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 col-sm-12 col-xs-12">
                                <?php
                                if (!empty($errorMessage)) {
                                    echo "
                                                <div class='alert alert warning alert-dismissible fade show' role='alert'>
                                                <strong>$errorMessage</strong>
                                                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                                </div>
                                                ";
                                }
                                ?>

                                <form method="post">
                                    <input type="hidden" name="customerID" value="<?php echo $id; ?>">
                                    <h3 class="text-center">Edit Personal Information</h3>
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                            <div class="form-group">
                                                <label class="profile_details_text">Username:</label>
                                                <input type="text" name="customer_username" class="form-control"
                                                    value="<?php echo $cu; ?>" placeholder="e.g. user098312" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                            <div class="form-group">
                                                <label class="profile_details_text">Name: </label>
                                                <input type="text" name="customer_name" class="form-control"
                                                    value="<?php echo $cn; ?> " placeholder="e.g. Ali Bin Abu" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label class="mdl-textfield__input">Phone Number:</label>
                                                <input type="text" name="customer_phoneNo" class="form-control"
                                                    value="<?php echo $cp; ?>" placeholder="e.g.+60123456789"
                                                    pattern="(\+?6?01)[0-46-9]-*[0-9]{7,8}">

                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label class="profile_details_text">Gender:</label>
                                                <select name="customer_gender" class="form-control"
                                                    value="<?php echo $cg; ?>" required>
                                                    <option value="Male">Male</option>
                                                    <option value="Female">Female</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label class="profile_details_text">Postal Code:</label>
                                                <input type="text" name="customer_postcode" class="form-control"
                                                    value="<?php echo $cpc; ?>" placeholder="e.g. 41000"
                                                    pattern="\d{5}$" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label class="profile_details_text">City:</label>
                                                <input type="text" name="customer_city" class="form-control"
                                                    value="<?php echo $cc; ?>" placeholder="e.g. Shah Alam" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label class="profile_details_text">State:</label>
                                                <select name="customer_state" class="form-control"
                                                    value="<?php echo $cs; ?>" placeholder="e.g. Selangor" required>
                                                    <option value="Johor">Johor</option>
                                                    <option value="Kedah">Kedah</option>
                                                    <option value="Kelantan">Kelantan</option>
                                                    <option value="Melaka">Melaka</option>
                                                    <option value="Negeri Sembilan">Negeri Sembilan</option>
                                                    <option value="Pahang">Pahang</option>
                                                    <option value="Penang">Penang</option>
                                                    <option value="Perak">Perak</option>
                                                    <option value="Perlis">Perlis</option>
                                                    <option value="Sabah">Sabah</option>
                                                    <option value="Sarawak">Sarawak</option>
                                                    <option value="Selangor">Selangor</option>
                                                    <option value="Terenganu">Terenganu</option>
                                                    <option value="Wilayah Persekutuan">Wilayah Persekutuan</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label class="profile_details_text">House Number, Building, Street
                                                    Name:</label>
                                                <input type="text" name="customer_address" class="form-control"
                                                    value="<?php echo $ca; ?>" placeholder="e.g. Jalan Ampang" required>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                            </div>
                        </div><br>
                        <input class="col-xs-12 btn btn-primary btn-load btn-lg" type="submit" name="submit"
                            data-loading-text="Changing Password..." value="Update Profile">
                    </form>
                </div>                
                </div>
        </div>
    </div>
    </section>
    </div>
</body>

</html>