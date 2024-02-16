<?php
include 'connection.php';

// Check if the user is logged in
if (!isset($_SESSION['petID'])) {
    // If not logged in, redirect to login page
    header("Location: petLogin.php");
    exit(); // Ensure that the script stops execution after the redirect
}

// Access the user ID from the session
$petID = $_SESSION['petID'];

// Perform a database query to retrieve detailed information for the specified user ID
$sql = "SELECT * FROM pet WHERE petID = $petID";
$result = $conn->query($sql);

// Check if the query was successful
if ($result && $result->num_rows > 0) {
    $petDetails = $result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </head>

<body>
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-dark shadow-5-strong"
            style="box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.7);">
            <a class="navbar-brand" href="#"><img src="../Img/xcobralogo.png" height="40px" alt="XCobra Logo"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page"
                            href="petDashboard.php?id=<?php echo $petID; ?>">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="CpetEdit.php?id=<?php echo $petID; ?>">Edit Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="CpetEditPropic.php?id=<?php echo $petID; ?>">Profile Picture</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="CpetEditGallery.php?id=<?php echo $petID; ?>">Gallery</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="CpetSettings.php?id=<?php echo $petID; ?>">Settings</a>
                    </li>
                </ul>
                <div class="content-right">
                    <div class="row">
                        <div class="col">
                            <img src="../uploads/<?php echo $petDetails['PetPic']; ?>" height="50px"
                                style="border-radius: 50%;">
                        </div>
                        <div class="col" style="color: white; display: flex;">
                        <div class="pro1" style="margin-top: 0.6rem;"><?php echo $petDetails['Name']; ?></div>
                            &nbsp;&nbsp;&nbsp;
                            <a class="" href="../inc/logout.php?id=<?php echo $petID; ?>"><button type="button"
                                    class="btn btn-outline-light">Logout</button></a>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
        <!-- Navbar -->

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-DBD4e65JS5Fz5lfFbFfNMrWHBMJZm1UIWII1q8vya2HL1CMMTb4iRABU5ge5RS6W"
        crossorigin="anonymous"></script>
</body>

</html>