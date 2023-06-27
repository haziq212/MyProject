<?php
include('../connect.php');
if (isset($_POST['insert_clothes'])) {

  $clothes_title = $_POST['clothes_title'];
  $clothes_description = $_POST['clothes_description'];
  $clothes_price = $_POST['clothes_price'];
  $clothes_stock = $_POST['clothes_stock'];
  $clothe_status = $_POST['clothe_status'];

  // Check if price is numeric
  if (!is_numeric($clothes_price)) {
    echo "<script>window.location.href = 'insert_clothes.php';alert('Please enter a numeric value for clothes price')</script>";
    exit();
  }

  if (!is_numeric($clothes_stock)) {
    echo "<script>window.location.href = 'insert_clothes.php';alert('Please enter a numeric value for clothes stock')</script>";
    exit();
  }

  // Accessing image
  $clothes_image1 = $_FILES['clothes_image1']['name'];

  // Accessing image tmp name
  $temp_image1 = $_FILES['clothes_image1']['tmp_name'];

  // Checking empty condition
  if ($clothes_title == '' or $clothes_description == '' or $clothes_price == '' or $clothe_status == '' or $clothes_image1 == '') {
    echo "<script>alert('Please fill all the available fields')</script>";
    exit();
  } else {
    // Get the file extension
    $file_ext = strtolower(pathinfo($clothes_image1, PATHINFO_EXTENSION));
    // Generate a unique name for the image
    $image_name = uniqid('clothes_', true) . '.' . $file_ext;
    // Define the path to store the image
    $target_path = "./clothes_images/" . $image_name;

    // Check if the file is a JPEG or PNG image
    if ($file_ext != 'jpeg' && $file_ext != 'jpg' && $file_ext != 'png') {
      echo "<script>alert('Only JPEG and PNG images are allowed')</script>";
      header("location: ./insert_clothes.php");
      exit();
    }

    move_uploaded_file($temp_image1, $target_path);

    // Insert query
    $insert_clothes = "INSERT INTO `clothes` (clothes_title, clothes_description, clothes_image1, clothes_price, date, clothe_status, clothes_stock)
        VALUES ('$clothes_title', '$clothes_description', '$image_name', '$clothes_price', NOW(), '$clothe_status', '$clothes_stock')";
    $result_query = mysqli_query($con, $insert_clothes);
    if ($result_query) {
      echo "<script>alert('Successfully inserted the clothes')</script>";
    }
  }
}
?>

<!DOCTYPE html>
<!-- Coding by CodingLab || www.codinglabweb.com -->
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

  <!-- bootstrap css link -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous" />
  <!-- font awesome link-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

  <style>
    body {
      background-color: #f8f9fa;
      font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
    }

    .container {
      max-width: 600px;
      margin: 0 auto;
      padding: 20px;
      border-radius: 20px;
      background-color: orangered;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .container h1 {
      font-size: 24px;
      font-weight: bold;
      text-align: center;
      margin-bottom: 20px;
    }

    .form-outline {
      display: flex;
      flex-direction: column;
    }

    .form-label {
      font-size: 18px;
      font-weight: bold;
      margin-bottom: 10px;
    }

    .form-control {
      padding: 10px;
      font-size: 16px;
      border: 1px solid #ccc;
      border-radius: 4px;
    }

    .form-control:focus {
      outline: none;
      border-color: #80bdff;
      box-shadow: 0 0 8px rgba(0, 123, 255, 0.3);
    }

    .btn {
      padding: 10px 20px;
      font-size: 16px;
      font-weight: bold;
      color: white;
      background-color: black;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }

    .btn:focus {
      outline: none;
      box-shadow: 0 0 8px rgba(0, 123, 255, 0.3);
    }
  </style>
</head>

<body>
  <div class="container mt-3">
    <h1>FILL ALL DETAILS</h1>
    <!-- form -->
    <form action="" method="post" enctype="multipart/form-data">
      <!-- title -->
      <div class="form-outline mb-4">
        <label for="clothes_title" class="form-label">
          CLOTHES NAME
        </label>
        <input type="text" name="clothes_title" id="clothes_title" class="form-control" placeholder="Enter Clothes Name"
          autocomplete="off" required="required">
      </div>

      <!-- Description -->
      <div class="form-outline mb-4">
        <label for="clothes_description" class="form-label">
          CLOTHES DESCRIPTION
        </label>
        <input type="text" name="clothes_description" id="clothes_description" class="form-control"
          placeholder="Enter clothes description" autocomplete="off" required="required">
      </div>

      <!-- image 1-->
      <div class="form-outline mb-4">
        <label for="clothes_image1" class="form-label">
          CLOTHES IMAGE (JPEG or PNG)
        </label>
        <input type="file" name="clothes_image1" id="clothes_image1" class="form-control" accept="image/jpeg,image/png" required="required">
      </div>

      <!-- Price -->
      <div class="form-outline mb-4">
        <label for="clothes_price" class="form-label">
          CLOTHES PRICE
        </label>
        <input type="text" name="clothes_price" id="clothes_price" class="form-control"
          placeholder="Enter clothes price (number only)" autocomplete="off" required="required">
      </div>

      <!-- Status -->
      <div class="form-outline mb-4">
        <label for="clothe_status" class="form-label">
          CLOTHES STATUS
        </label>
        <select name="clothe_status" id="clothe_status" class="form-control" placeholder="Enter clothes status"
          required="required">
          <option value="Available">Available</option>
          <option value="Unavailable">Unavailable</option>

        </select>
      </div>

      <!-- Stock -->
      <div class="form-outline mb-4">
        <label for="clothes_stock" class="form-label">
          CLOTHES STOCK
        </label>
        <input type="text" name="clothes_stock" id="clothes_stock" class="form-control"
          placeholder="Enter clothes stock (number only)" autocomplete="off" required="required">
      </div>

      <!-- price -->
      <div class="form-outline mb-4">
        <input type="submit" name="insert_clothes" id="insert_clothes" class="btn btn-dark mb-3 px-3"
          href="admin_dashboard.php" value="INSERT CLOTHES">
      </div>
    </form>
    <button class="btn btn-dark mb-3 px-3 w-100" style="color: white; text-decoration: none;">
      <a style="color: inherit; text-decoration: none;" href="admin_dashboard.php">CANCEL</a>
    </button>

  </div>
</body>

</html>