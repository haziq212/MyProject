<!-- connect file -->
<?php
include('../connect.php');

if (isset($_POST['clothesId']) && isset($_POST['clothe_status'])) {
  $clothesId = $_POST['clothesId'];
  $clothe_status = $_POST['clothe_status'];

  $update_query = "UPDATE `clothes` SET `clothe_status`='$clothe_status' WHERE `clothesId`='$clothesId'";
  mysqli_query($con, $update_query);

  header("Location: admin_update.php"); // Redirect back to the main page after updating the status
  exit();
}

if (isset($_POST['clothesId']) && isset($_POST['clothes_price'])) {
  $clothesId = $_POST['clothesId'];
  $clothes_price = $_POST['clothes_price'];

  $update_query = "UPDATE `clothes` SET `clothes_price`='$clothes_price' WHERE `clothesId`='$clothesId'";
  mysqli_query($con, $update_query);

  header("Location: admin_update.php"); // Redirect back to the main page after updating the price
  exit();
}

if (isset($_POST['clothesId']) && isset($_POST['clothes_stock'])) {
  $clothesId = $_POST['clothesId'];
  $clothes_stock = $_POST['clothes_stock'];

  $update_query = "UPDATE `clothes` SET `clothes_stock`='$clothes_stock' WHERE `clothesId`='$clothesId'";
  mysqli_query($con, $update_query);

  header("Location: admin_update.php"); // Redirect back to the main page after updating the stock
  exit();
}

//php code for title
if (isset($_POST['clothesId']) && isset($_POST['clothes_title'])) {
  $clothesId = $_POST['clothesId'];
  $clothes_title = $_POST['clothes_title'];

  $update_query = "UPDATE `clothes` SET `clothes_title`='$clothes_title' WHERE `clothesId`='$clothesId'";
  mysqli_query($con, $update_query);

  header("Location: admin_update.php"); // Redirect back to the main page after updating the price
  exit();
}
//php code for desc
if (isset($_POST['clothesId']) && isset($_POST['clothes_description'])) {
  $clothesId = $_POST['clothesId'];
  $clothes_description = $_POST['clothes_description'];

  $update_query = "UPDATE `clothes` SET `clothes_description`='$clothes_description' WHERE `clothesId`='$clothesId'";
  mysqli_query($con, $update_query);

  header("Location: admin_update.php"); // Redirect back to the main page after updating the price
  exit();
}

//php code for change image
if (isset($_POST['clothesId']) && isset($_POST['clothes_stock'])) {
  $clothesId = $_POST['clothesId'];
  $clothes_stock = $_POST['clothes_stock'];

  $update_query = "UPDATE `clothes` SET `clothes_stock`='$clothes_stock' WHERE `clothesId`='$clothesId'";
  mysqli_query($con, $update_query);

  header("Location: admin_update.php"); // Redirect back to the main page after updating the price
  exit();
}

if (isset($_FILES['clothes_image1']) && $_FILES['clothes_image1']['error'] == 0) {
  $clothesId = $_POST['clothesId'];
  $clothes_image1 = $_FILES['clothes_image1'];

  // Get the file name and extension
  $file_name = $_FILES['clothes_image1']['name'];
  $file_extension = pathinfo($file_name, PATHINFO_EXTENSION);

  // Generate a unique name for the image
  $new_file_name = uniqid() . '.' . $file_extension;

  // Move the uploaded file to the desired directory
  move_uploaded_file($_FILES['clothes_image1']['tmp_name'], './clothes_images/' . $new_file_name);

  // Update the database with the new image name
  $update_query = "UPDATE `clothes` SET `clothes_image1`='$new_file_name' WHERE `clothesId`='$clothesId'";
  mysqli_query($con, $update_query);

  header("Location: admin_update.php"); // Redirect back to the main page after updating the image
  exit();
}

?>

<!DOCTYPE html>

<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Suigetsu</title>
  <!--bootstrap css link -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <!-- font -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- css file -->
  <link rel="stylesheet" href="style.css" />
  <link rel="apple-touch-icon" sizes="180x180" href="../favicon/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="../favicon/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="../favicon/favicon-16x16.png">
  <link rel="manifest" href="../favicon/site.webmanifest">
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-light" style="height: 60px; background-color: rgb(226, 43, 43);">
    <div class="container-fluid">
      <div class="collapse navbar-collapse" id="navbarScroll">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="btn btn-outline-danger btn-light" href="../logout.php" style="color: black; font-weight: bold; "
              onclick="alert('You are successfully logout!')">LOGOUT</a>
          </li>
        </ul>

        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="btn btn-outline-info btn-info" href="admin_dashboard.php"
              style="color: black; font-weight: bold;">DASHBOARD</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- second child -->
  <nav style="height: 50px; background-color: black;">
    <a>
      <h2 style="color: white; text-align: center; margin: auto; font-weight: bold;">ADMINISTRATOR VIEW</h2>
    </a>
  </nav>

  <!-- fourth child -->
  <div class="row">
    <!-- fetching clothes -->
    <?php
    $select_query = "SELECT * FROM `clothes` ORDER BY clothe_status";
    $result_query = mysqli_query($con, $select_query);

    while ($row = mysqli_fetch_assoc($result_query)) {
      $clothesId = $row['clothesId'];
      $clothes_title = $row['clothes_title'];
      $clothes_description = $row['clothes_description'];
      $clothes_image1 = $row['clothes_image1'];
      $clothes_price = $row['clothes_price'];
      $clothes_stock = $row['clothes_stock'];
      $clothe_status = $row['clothe_status'];

      $availability = ($clothe_status == 'available') ? '<span class="badge bg-success">Available</span>' : '<span class="badge bg-danger">Unavailable</span>';
      $imageClass = ($clothe_status == 'available') ? '' : 'grayscale'; // CSS class for grayscale effect
    
      echo '
          <div class="col-md-15 mb-10">
            <div class="card">
              <img src="./clothes_images/' . $clothes_image1 . '" class="card-img-top ' . $imageClass . '" alt="' . $clothes_title . '">
              <div class="card-body">               
                
                <form action="admin_update.php" method="POST" class="mt-2">
                  <div class="mb-3">
                    <input type="hidden" name="clothesId" value="' . $clothesId . '">
                    <select name="clothe_status" class="form-select" onchange="this.form.submit()">
                      <option value="available" ' . ($clothe_status == 'available' ? 'selected' : '') . '>Available</option>
                      <option value="unavailable" ' . ($clothe_status == 'unavailable' ? 'selected' : '') . '>Unavailable</option>
                    </select>
                  </div>
                </form>

                <form action="admin_update.php" method="POST" class="mt-2">
                  <div class="input-group mb-3">
                    <input type="hidden" name="clothesId" value="' . $clothesId . '">
                    <input type="text" name="clothes_price" class="form-control" value="' . $clothes_price . '">
                    <button type="submit" class="btn btn-success">CHANGE PRICE</button>
                  </div>
                </form>

                <form action="admin_update.php" method="POST" class="mt-2">
                  <div class="input-group">
                    <input type="hidden" name="clothesId" value="' . $clothesId . '">
                    <input type="text" name="clothes_stock" class="form-control" value="' . $clothes_stock . '">
                    <button type="submit" class="btn btn-primary">UPDATE STOCK</button>
                  </div>
                </form>

                <form action="admin_update.php" method="POST" class="mt-2">
                  <input type="hidden" name="clothesId" value="' . $clothesId . '">
                  <div class="input-group">
                    <input type="text" name="clothes_title" class="form-control" value="' . $clothes_title . '">
                    <button type="submit" class="btn btn-primary">UPDATE TITLE</button>
                  </div>
                </form>

                <form action="admin_update.php" method="POST" class="mt-2">
                  <input type="hidden" name="clothesId" value="' . $clothesId . '">
                  <div class="input-group">
                    <input type="text" name="clothes_description" class="form-control" value="' . $clothes_description . '">
                    <button type="submit" class="btn btn-primary">DESCRIPTION</button>
                  </div>
                </form>

                <form action="admin_update.php" method="POST" enctype="multipart/form-data" class="mt-2">
                  <input type="hidden" name="clothesId" value="' . $clothesId . '">
                  <div class="input-group">
                    <input type="file" name="clothes_image1" class="form-control" accept="image/*">
                    <button type="submit" class="btn btn-primary">CHANGE IMAGE</button>
                  </div>
                </form>

              </div>
            </div>
          </div>';
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
    <p>@2023 Suigetsu Project</p>
  </footer>

  <!--bootstrap js link -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
    crossorigin="anonymous"></script>
</body>

</html>