<?php
include("../connect.php");
session_start();
if (isset($_SESSION['id'])) {
  /* execute SQL statement */
  $customerID = $_SESSION['id'];

  ?>
  <?php
  include('../connect.php');

  // Fetch the item records from the database
  $query = "SELECT * FROM cart WHERE customerId = '$customerID'";
  $result = mysqli_query($con, $query);

  $quantityItem = 0;
  $totalPrice = 0.00;

  // Iterate over the records and generate table columns dynamically
  while ($row = mysqli_fetch_assoc($result)) {
    $clothesId = $row['clothesId'];
    $quantity = $row['QUANTITY'];

    $query2 = "SELECT * FROM clothes WHERE clothesId = '$clothesId'";
    $result2 = mysqli_query($con, $query2);

    while ($row2 = mysqli_fetch_assoc($result2)) {
      $clothes_price = $row2['clothes_price'];

      $quantityItem += $quantity;

      $total = $clothes_price * $quantity;
      $totalPrice += $total;
      $totalPriceFormat = number_format($totalPrice, 2);
      $_SESSION['totalPrice'] = $totalPrice;
      $_SESSION['totalPriceFormat'] = $totalPriceFormat;
    }
  }

  //Check if items exist in the cart table
  $cartQuery = "SELECT * FROM cart WHERE customerId = '$customerID'";
  $cartResult = mysqli_query($con, $cartQuery);
  $numItemsInCart = mysqli_num_rows($cartResult);

  if ($numItemsInCart == 0) {
    $totalPriceFormat = number_format($totalPrice, 2);
  }

  ?>



  <!DOCTYPE html>
  <html>

  <head>
    <title>Suigetsu</title>
  </head>

  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SUIGETSU</title>
    <link rel="stylesheet" href="addtocartcss.css" />
    <link rel="apple-touch-icon" sizes="180x180" href="../favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../favicon/favicon-16x16.png">
    <link rel="manifest" href="../favicon/site.webmanifest">
    <script src="https://kit.fontawesome.com/92d70a2fd8.js" crossorigin="anonymous"></script>
    <!-- Unicons -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />
  </head>

  <body>
    <!-- Header -->
    <header class="header">
      <nav class="nav">
        <a href="#home" class="nav_logo"> SUIGETSU</a>

        <ul class="nav_items">
          <li class="nav_item">
            <a href="customer_homepage.php" class="nav_link">HOME</a>
            <div class="cart"><i class="fa-solid fa-cart-shopping"></i>
              <p id="count">
                <?php echo $quantityItem; ?>
              </p>
            </div>
          </li>
        </ul>
      </nav>
    </header>
    <div class="container">
      <?php
      include('../connect.php');

      //Retrieve the item records from the database
      $query = "SELECT * FROM cart WHERE customerId = '$customerID'";
      $result = mysqli_query($con, $query);

      $quantityItem = 0;
      $totalPrice = 0.00;

      //Iterate over the records and generate table columns dynamically
      while ($row = mysqli_fetch_assoc($result)) {
        $clothesId = $row['clothesId'];
        $QUANTITY = $row['QUANTITY'];

        $query2 = "SELECT * FROM clothes WHERE clothesId = '$clothesId'";
        $result2 = mysqli_query($con, $query2);

        while ($row2 = mysqli_fetch_assoc($result2)) {
          $clothesTitle = $row2['clothes_title'];
          $clothesDesc = $row2['clothes_description'];
          $clothesPrice = $row2['clothes_price'];
          $clothesImage = $row2['clothes_image1'];
          //make calculation of total price for each clothes id
          $total = $clothesPrice * $QUANTITY;
          $_SESSION['totalPrice_clothesOrders'] = $total;
          $totalFormat = number_format($total, 2);
          ?>
          <table border="0" width="90%" class="tableCart">
            <td class="td1">
              <img src="../admin/clothes_images/<?php echo $clothesImage; ?>" class="imgItem">
            </td>

            <td class="td2">
              <p class="font">
                <?php echo $clothesTitle; ?>
              </p>
              <br>
              <p class="greyFont">Description :
                <?php echo $clothesDesc; ?>
              </p>
              <br>
              <p class="greyFont">Quantity :
                <?php echo $QUANTITY; ?>
              </p>
            </td>

            <td>
              <p class="greyFont1">Price</p>
              <br>
              <p class="price">RM
                <?php echo $totalFormat; ?>
              </p>
            </td>

            <td class="td1">
              <form action="deleteCart.php" method="post">
                <input type="hidden" name="clothesId" value="<?php echo $clothesId; ?>">
                <button type="submit" name="Delete" class="remove" style="border: none; background: none; padding: 0;">
                  <i class='fa-solid fa-trash' alt="Delete" class="remove"></i>
                </button>
              </form>

            </td>
          </table>
          <?php
        }
      }
      ?>
    </div>

    <div class="foot">
      <td>
        <p class="text6">Total Price</p>
      </td>
      <td>
        <p class="text7">RM
          <?php echo $totalPriceFormat; ?>
        </p>
      </td>

      <a href="customer_homepage.php">
        <button class="button2">CONTINUE SHOPPING</button>
      </a>
      <a href="./customer_payment/customerPayment.php">
        <button class="buy-btn">
          CHECK OUT
        </button>
      </a>

      <!-- <form action="deleteCart.php" method="post">
        <button class="button3" type="submit" name="DeleteAll">REMOVE ALL</button> -->
    </div>

    <!--          <div class = "container">
            <div id = "root"></div>
            <div class="sidebar">
            <div class="head"><p>My Cart</p></div>
            <div id="cartItem">Your cart is empty</div>
            <div class="foot">
                <h3>Total</h3>
                <h2 id="total">RM 0.00</h2>
            </div>
              <div class = "total">
                <button class = "buy-btn">BUY NOW</button>
              </div>
            </div>
          </div>-->

    <script src="addtocart.js"></script>
  </body>

  </html>
  <?php
}

else {
  header("location: ../index.html");
  die();
}
?>