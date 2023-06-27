<?php
session_start();
if (isset($_SESSION['id']) == false) {
  header("Location: ../../index.html");
  die();
}

$customerID = 0;
$totalPrice = 0.00;
$totalPriceFormat = 0.00;

$customerID = $_SESSION['id'];
$totalPrice = $_SESSION['totalPrice'];
$totalPriceFormat = $_SESSION['totalPriceFormat'];
?>

<!DOCTYPE html>

<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Suigetsu</title>
  <link rel="apple-touch-icon" sizes="180x180" href="../../favicon/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="../../favicon/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="../../favicon/favicon-16x16.png">
  <link rel="manifest" href="../../favicon/site.webmanifest">

  <!-- Fontawesome CDN Link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" />
  <!-- Unicons -->
  <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />
  <!-- css file -->
  <link rel="stylesheet" href="customer_payment.css" />
  <link rel="stylesheet" href="../../style.css" />
  <!-- js script -->
  <script src="customer_payment.js"></script>
</head>

<header class="header">
  <nav class="nav">
    <a href="#" class="nav_logo"> SUIGETSU</a>

    <li class="nav-item">
      <a class="nav-link active" aria-current="page" href="../customer_homepage.php"
        style="color: white; font-weight: bold;">HOME</a>
    </li>

  </nav>
</header>

<body style="background-image: none">
  <div class="basic-2">
    <section>
      <div class="container-payment">
        <div class="content">
          <div class="text-payment">
            <h2> Total Price: RM
              <?php echo $totalPriceFormat ?>
            </h2><br>
            <h2>PAYMENT</h2>
            <h3>PROVE OF PAYMENT</h3>
            <hr style="width: 100%" />
            <h4>TRANSFER TO :</h4>
            <h4>SUIGETSU STORE</h4>
            <h4>12112011343002 BANK ISLAM</h4>
            <br /><br />
            <!--<p>Click on the "Choose File" button to upload a file:</p>-->
            <p>Size file must no more than 1MB</p>
            <p>Upload receipt in pdf form:</p>

            <form action="uploadPayment.php" method="post" enctype="multipart/form-data">
              <input type="file" id="myFile" name="fileUpload" required />
              <!-- <input type="submit" /> -->
              <button class="button" type="submit" name="upload" value="Upload">
                Upload
              </button>

              <button class="button" style="bottom: 9px" name="back" onclick="history.back(-1)">
                Back
              </button>
            </form>

          </div>
        </div>
      </div>
    </section>
  </div>
</body>

</html>