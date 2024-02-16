<?php
    include '../inc/connection.php';

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Start the session
session_start();

include'../inc/customerNavbar.php';

// Check if the user is logged in
if (!isset($_SESSION['userID'])) {
    // If not logged in, redirect to login page
    header("Location: ../inc/multiLogin.php");
    exit(); // Ensure that the script stops execution after the redirect
}

$sql = "SELECT * FROM users WHERE UserID = $userID";
$result = $conn->query($sql);

// Check if the query was successful
if ($result && $result->num_rows > 0) {
    $userDetails = $result->fetch_assoc();
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../css/main.css">
    <title><?php echo $userDetails['Name']; ?></title>
    <link rel="shortcut icon" href="https://i.ibb.co/rtBrF0f/newlogo.png" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
   

    <style>
                
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
        }

        .navbar {
      outline: 1px solid black;
      outline-offset: -1px; /* Adjust this value as needed */
    }

    /* Optional: Remove box-shadow */
    .shadow-5-strong {
        background-color: rgba(0, 0, 0, 0.7);
    }

    .footer {
      
      bottom: 0;
      width: 100%;
      background-color: rgba(0, 0, 0, 0.7); /* Adjust the alpha value (4th parameter) for transparency */
      color: #fff;
      text-align: center;
      padding: 10px 0;
    }

       

        #content {
            margin-left: 250px;
            padding: 20px;
            transition: margin-left 0.3s;
        }

        #menu-toggle {
            display: none;
        }

        @media screen and (max-width: 600px) {
           
            #menu-toggle {
                display: block;
                position: fixed;
                top: 10px;
                left: 10px;
                z-index: 1;
                cursor: pointer;
            }
           
        }
        footer {
            background-color: rgba(0, 0, 0, 0.05);
            opacity: 0.8;
            width: 100%;
            bottom: 0;
            text-align: center;
            color: black;
        }
       
        .iframe-custom {
          width: 100%;
          height: 800px;
          border: 7px solid black;
          overflow: hidden;
        }
    </style>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

</head>
<body >


   <iframe class="iframe-custom" src="../profile/index.php?id=<?php echo $userID; ?>"></iframe>
    
    <!-- Fixed Footer -->
<footer class="footer">
    <p>&copy; 2023 Xcobra. All rights reserved.</p>
  </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    
</body>
</html>

<?php
$conn->close();
?>