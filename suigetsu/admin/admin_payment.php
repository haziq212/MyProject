<?php
// Database connectivity  
$conn = mysqli_connect('localhost', 'root', '', 'suigetsu');
$sql = "SELECT * FROM payment order by status";
$result = mysqli_query($conn, $sql); // Use mysqli_query instead of $conn->query

// Get Update id and status
if (isset($_GET['payment_id']) && isset($_GET['status'])) {
  $id = $_GET['payment_id'];
  $status = $_GET['status'];
  $ordersid = $_GET['ordersId'];

  // Update payment table
  mysqli_query($conn, "UPDATE payment SET status='$status' WHERE payment_id = '$id'");

  // Update orders table
  mysqli_query($conn, "UPDATE orders SET orderStatus='$status' WHERE ordersid = '$ordersid'");

  //header("location:index.php");
  die();
}
mysqli_close($conn); // Close the database connection
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Suigetsu</title>
  <link rel="stylesheet" href="../style.css" />
  <link rel="apple-touch-icon" sizes="180x180" href="../favicon/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="../favicon/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="../favicon/favicon-16x16.png">
  <link rel="manifest" href="../favicon/site.webmanifest">
  <!-- Fontawesome CDN Link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" />
  <!-- Unicons -->
  <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />


  <style>
    table,
    td,
    th {
      border: 1px solid;
    }

    table {
      width: 100%;
      border-collapse: collapse;
    }

    h2 {
      width: 100%;
      font-size: 25px;
      text-align: center;
    }

    td {
      text-align: center
    }

    .container {
      width: 80%;
      background: wheat;
      border: solid 1px;
      border-radius: 20px;
      margin: auto;
      padding: 20px 20px;
      height: 500px;
      overflow: auto;
      box-shadow: 10px;
      padding-left: 270px;
      padding-right: 270px;
    }

    .container .content {
      background-color: #ededed;
      display: flex;
      align-items: center;
      width: auto;
      align-items: center;
      padding: 5%;
      margin: 130px;
      position: relative;
      border-radius: 10px;
    }

    select {
      width: 100%;
      padding: 0.5rem 0;
      font-size: 1rem;
    }

    .container button {
      background-color: red;
      border-style: solid;
      border-color: black;
      border-width: 1px;
      position: absolute;
      margin-top: 5px;
      right: 20%;
      top: 540px;
    }
  </style>

</head>

<body style="background: none;">

  <!--header-->
  <header class="header">
    <nav class="nav">
      <a href="#" class="nav_logo">SUIGETSU</a>

      <a class="button" href="../logout.php" onclick="alert('You are successfully logout!')" style="color: black">
        Logout</a>
    </nav>


    <section>
      <br>
      <div class="container">
        <h2>View Payment</h2><br>

        <table>
          <tr>
            <th>Payment ID</th>
            <th>Customer ID</th>
            <th>Total Amount</th>
            <th>Receipt</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
          <!-- PHP CODE TO FETCH DATA FROM ROWS -->
          <?php
          // LOOP TILL END OF DATA
          while ($rows = mysqli_fetch_assoc($result)) {
            ?>
            <tr>
              <!-- FETCHING DATA FROM EACH ROW OF EVERY COLUMN -->
              <td>
                <?php echo $rows['payment_id']; ?>
              </td>
              <td>
                <?php echo $rows['customerId']; ?>
              </td>
              <td>
                <?php echo $rows['payment_amount']; ?>
              </td>
              <td><a href="../customer/customer_payment/upload/<?php echo $rows['receipt']; ?>"
                  target="_blank">Receipt</a></td>


              <?php
              if ($rows['status'] == 'Pending') {
                echo '<td><span style="color:#ffbb33;font-weight:500;">Pending<span></td>';
              }
              if ($rows['status'] == 'Accept') {
                echo '<td><span style="color:#00c851;font-weight:500;">Accept<span></td>';
              }
              if ($rows['status'] == 'Reject') {
                echo '<td><span style="color:#eb6060;font-weight:500;">Reject<span></td>';
              }
              if ($rows['status'] == 'Completed') {
                echo '<td><span style="color:black;font-weight:500;">Completed<span></td>';
              }
              ?>
              <td>
                <select
                  onchange="status_update(this.options[this.selectedIndex].value, '<?php echo $rows['payment_id'] ?>', '<?php echo $rows['ordersId'] ?>')">
                  <option value=" ">Update Status</option>
                  <option value="Pending">Pending</option>
                  <option value="Accept">Accept</option>
                  <option value="Completed">Completed</option>
                  <option value="Reject">Reject</option>
                </select>
              </td>
            </tr>
            <?php
          }
          ?>
        </table>

        <button class="button" name="back" onclick="history.back(-1)">
          Back
        </button>
      </div>
    </section>
  </header>

  <script type="text/javascript">
    function status_update(value, payment_id, ordersid) {
      let url = "http://localhost/suigetsu/admin/admin_payment.php";
      window.location.href = url + "?payment_id=" + payment_id + "&ordersId=" + ordersid + "&status=" + value;
      window.location.reload(); // Refresh the page
    }
  </script>
</body>

</html>