<?php
session_start();
include('../connect.php');

?>
<?php
//store session data
if (isset($_SESSION['id'])) {

  $id = $_SESSION['id'];

  //read the selected row from database table
  $sql = "SELECT ad_name, ad_username, ad_password, ad_phone_num, admin_id 
  FROM `admin` WHERE admin_id= $id";
  $result_query = mysqli_query($con, $sql);

  // true if there is data in $result_query
  // if (mysqli_num_rows($result_query) > 0) { 

  // output data of each row
  $row = mysqli_fetch_assoc($result_query);
  $an = $row["ad_name"];
  $au = $row["ad_username"];
  $ap = $row["ad_password"];
  $apn = $row["ad_phone_num"];

  // else {
  // header("location: index.html"); //go to homepage
  // exit;
  // }
  ?>

  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Suigetsu</title>
    <link rel="apple-touch-icon" sizes="180x180" href="../favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../favicon/favicon-16x16.png">
    <link rel="manifest" href="../favicon/site.webmanifest">

    <!-- Unicons -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />
    <!-- bootstrap css link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous" />
    <!-- bootstrap js link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
      crossorigin="anonymous"></script>
    <!-- font awesome link-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
      integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
      crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- css file -->
    <link rel="stylesheet" href="admin_dashboard.css" />
  </head>

  <body>
    <!-- Header -->
    <header class="header">
      <nav class="nav">
        <a href="#home" class="nav_logo"> SUIGETSU </a>
      </nav>
    </header>


    <!-- third child -->
    <div class="admin_image">
      <img src="admin-icon.png" alt="Image description" />
    </div>
    <a href="">
      <h2 class="text-center p-4" style="color: black;">Administrator Dashboard</h2>
    </a>
    <div class="container">
      <div class="button text-center">
        <div class="row">
          <div class="col-md-4">
            <button class="btn btn-fixed-width">
              <a href="insert_clothes.php" class="nav-link text-dark my-2">Insert Product</a>
            </button>
          </div>
          <div class="col-md-4">
            <button class="btn btn-fixed-width">
              <a href="admin_update.php" class="nav-link text-dark my-2">View Product</a>
            </button>
          </div>
          <div class="col-md-4">
            <button class="btn btn-fixed-width">
              <a href="admin_payment.php" class="nav-link text-dark my-2">View Payments</a>
            </button>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4">
            <button class="btn btn-fixed-width">
              <a href="./viewOrder.php" class="nav-link text-dark my-2">View Orders</a>
            </button>
          </div>
          <div class="col-md-4">
            <button class="btn btn-fixed-width">
              <a href="./viewCustomerData.php" class="nav-link text-dark my-2">View Customer</a>
            </button>
          </div>
          <div class="col-md-4">
            <button class="btn btn-fixed-width" style="background-color: red">
              <a href="../logout.php" class="nav-link text-dark my-2">Logout</a>
            </button>
          </div>
        </div>
      </div>
    </div>
    <!-- last child -->
    <footer class="footer">
      <a href="../group_members/groupMember.html" target="_blank" style="color: red; font-family:cursive;">Team
        Members</a>
      <p>@2023 Suigetsu Project</p>
    </footer>
  </body>

  </html>
<?php } else {
  echo 'hello';
} ?>