<!-- connect file -->
<?php
session_start();
include('../connect.php');
$customerID = $_SESSION['id'];

?>

<?php
if (isset($customerID)) {
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

    }
  }

  //Check if items exist in the cart table
  $cartQuery = "SELECT * FROM cart WHERE customerId = '$customerID'";
  $cartResult = mysqli_query($con, $cartQuery);
  $numItemsInCart = mysqli_num_rows($cartResult);

  if ($numItemsInCart == 0) {
    $totalPriceFormat = number_format($totalPrice, 2);
  }
} else {
  header('Location: ../index.html'); //path to where your login form is located. Headers need to be above any output or they will produce an error and thus not work as intended (or at all even!)
   exit;
}

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
  <!--bootstrap css link -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <!--bootstrap js link -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
    crossorigin="anonymous"></script>
  <!--css js link -->
  <script src="customer.js"></script>
  <!-- font -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- css file -->
  <link rel="stylesheet" href="style.css" />

</head>

<body>

  <nav class="navbar navbar-expand-lg navbar-light" style="height: 60px; background-color: rgb(226, 43, 43);">
    <div class="container-fluid">
      <div class="collapse navbar-collapse" id="navbarScroll">
        <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="" style="color: white; font-weight: bold;">HOME</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="./profile/profile.php"
              style="color: white; font-weight: bold;">PROFILE</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="./viewHistory.php"
              style="color: white; font-weight: bold;">HISTORY</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="cart.php" style="color: white; font-weight: bold;">
              <i class="fa-solid fa-cart-shopping"></i><sup>
                <?php echo $quantityItem; ?>
              </sup>
            </a>
          </li>
        </ul>
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="btn btn-outline-danger btn-light" href="../logout.php" style="color: black; font-weight: bold; "
              onclick="alert('You are successfully logout!')">LOGOUT</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- calling cart function -->
  <!-- second child -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <ul class="navbar-nav me-auto ms-3 justify-content-center">
      <li class="nav-item">
        <input type="text" id="searchBar" placeholder="Search clothes..." onkeyup="searchMenu()">
      </li>
    </ul>
  </nav>

  <!-- third child -->
  <div class=" bg-white">
    <h3 style="text-align: center; margin: auto; font-weight: bold;">WELCOME TO SUIGETSU STORE</h3>
  </div>

  <!-- product -->
  <div class="row">
    <!-- fetching clothes -->
    <?php
    $select_query = "SELECT * FROM `clothes` ORDER BY clothe_status";
    $result_query = mysqli_query($con, $select_query);

    while ($row = mysqli_fetch_assoc($result_query)) {
      if (isset($row['clothesId'])) {
        $clothesId = $row['clothesId'];
        $clothes_title = $row['clothes_title'];
        $clothes_description = $row['clothes_description'];
        $clothes_image1 = $row['clothes_image1'];
        $clothes_price = $row['clothes_price'];
        $clothes_stock = $row['clothes_stock'];
        $clothe_status = $row['clothe_status'];
        $availability = ($clothe_status == 'available') ? '<span class="badge bg-success">Available</span>' : '<span class="badge bg-danger">Unavailable</span>';
        $imageClass = ($clothe_status == 'available') ? '' : 'grayscale'; // CSS class for grayscale effect
    
        echo '<div class="col-md-15 mb-10">
                    <div class="card">
                      <img src="../admin/clothes_images/' . $clothes_image1 . '" class="card-img-top ' . $imageClass . '" alt="' . $clothes_title . '">
                      <div class="card-body">
                        <h5 class="card-title">' . $clothes_title . '</h5>
                        <p class="card-text">' . $clothes_description . '</p>
                        <h5 class="card-price">RM ' . $clothes_price . '</h5>
                        <p class="card-stock"> Stock: ' . $clothes_stock . '</p>
                        <p class="card-status">' . $availability . '</p>';

        if ($clothe_status == 'available') {
          echo '<form method="post" action="addtocart.php">
              <input type="hidden" name="clothesId" value="' . $clothesId . '">
              <div class="input-group mb-3">
                  <input type="number" class="form-control" name="quantity" value="1" min="1">
                  <button class="btn btn-info" type="submit" onclick="success()" name="add_to_cart">Add to cart</button>
              </div>
          </form>';
        } else {
          echo '<button class="btn btn-info" disabled>Add to cart</button>';
        }

        echo '</div>
       </div>
     </div>';
      }
    }
    ?>

    <!-- row end-->
  </div>
  <!-- column end  -->
  <style>
    .grayscale {
      filter: grayscale(100%);
    }
  </style>
  <!-- last child -->
  <footer class="footer">
    <a href="../group_members/groupMember.html" target="_blank" style="color: red; font-family:cursive;">Team
      Members</a>
    <p>@2023 Suigetsu Project</p>
  </footer>

</body>

</html>