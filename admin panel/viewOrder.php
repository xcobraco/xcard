<?php
include '../inc/connection.php';
include '../inc/header.php';

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if an ID is provided in the URL
if (isset($_GET['id'])) {
    $oId = $_GET['id'];

    // Perform a database query to retrieve detailed information for the specified user ID
    $sql = "SELECT * FROM purchase WHERE id = $oId";
    $result = $conn->query($sql);

    // Check if the query was successful
    if ($result && $result->num_rows > 0) {
        $orderDetails = $result->fetch_assoc();
    }}
?>
<!DOCTYPE html>
<head>
    <title>Order</title>
</head>
<body>
    <center>
    <br>
    <h3><b>Order Details</b></h3><br>
    <h5><strong>Choice :</strong>&nbsp;<?php echo $orderDetails['choice']; ?></h5>
    <h5><strong>Name :</strong>&nbsp;<?php echo $orderDetails['name']; ?></h5>
    <h5><strong>Position :</strong>&nbsp;<?php echo $orderDetails['position']; ?></h5>
    <h5><strong>Company :</strong>&nbsp;<?php echo $orderDetails['company']; ?></h5><br><br>
    <h3><b>Contact Details</b></h3><br>
    <h5><strong>Contact No :</strong>&nbsp;<?php echo $orderDetails['contact']; ?></h5>
    <h5><strong>Email :</strong>&nbsp;<?php echo $orderDetails['email']; ?></h5>
    <h5><strong>Address :</strong>&nbsp;<?php echo $orderDetails['address']; ?></h5><br><br>
    <h3><b>Payment Details</b></h3><br>
    <h5><strong>Email to send Slip :</strong>&nbsp;<?php echo $orderDetails['slipEmail']; ?></h5>
    <h5><strong>Payment Method :</strong>&nbsp;<?php echo $orderDetails['payType']; ?></h5>
    <h5><strong>Coupon code :</strong>&nbsp;<?php echo $orderDetails['couponCode']; ?></h5>
    <h5><strong>Proof :</strong></h5>
    <img src="../BuySite/uploads/<?php echo $orderDetails['payslip']; ?>" width="900" id="preview"><br><br>
    <h5><strong>Logo :</strong></h5>
    <img src="../BuySite/uploads/<?php echo $orderDetails['logo']; ?>" width="100" id="preview"><br><br>
    <h5><strong>Design :</strong></h5>
    <img src="../BuySite/uploads/<?php echo $orderDetails['design']; ?>" width="100" id="preview"><br><br>
    </center>
    <br><br><br><br>
</body>
</html>