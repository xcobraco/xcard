<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    // If not logged in, redirect to login page
    header("Location: ../admin.html");
    exit(); // Ensure that the script stops execution after the redirect
}
?>
<?php
include 'connection.php';

// Start the session

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        .navbar {
            background-color: rgba(255, 255, 255,) !important;
            opacity: 0.75;
        }
        .navbar-nav .nav-link {
            padding-left: 3rem;
            color: black;
            opacity: 1; /* Set opacity to 100% */
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
    
    <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
            <a class="nav-link" href="home.php">Dashboard<span class="sr-only"></span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="table.php">View users</a>
        </li> 
        <li class="nav-item">
            <a class="nav-link" href="petTable.php">View Pets</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="orders.php">View Orders</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="test.php">Test</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="../inc/multiLogin.php">customer Login</a>
        </li>
        </ul>
        <span class="navbar-text">
        Version 1.0
        </span>
    </div>
    </nav>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-eWMoiHyo8S/ZNOEAgX8egRLVp9F8PaTlN20YcvHq+6blFISQvHEm6OMpFXTaIHFi" crossorigin="anonymous"></script>
</body>
</html>
