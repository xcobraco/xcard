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

include '../inc/customerNavbar.php';

// Check if the user is logged in
if (!isset($_SESSION['userID'])) {
    // If not logged in, redirect to login page
    header("Location: ../inc/multiLogin.php");
    exit(); // Ensure that the script stops execution after the redirect
}

// Access the user ID from the session
$userID = $_SESSION['userID'];

// Perform a database query to retrieve detailed information for the specified user ID
$sql = "SELECT * FROM users WHERE UserID = $userID";
$result = $conn->query($sql);

// Check if the query was successful
if ($result && $result->num_rows > 0) {
    $userDetails = $result->fetch_assoc();
}

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userID = mysqli_real_escape_string($conn, $_GET['id']);
    $profilePicture = mysqli_real_escape_string($conn, $_FILES['profilePictureInput']['name']);

    $sql = $sql = "UPDATE users SET 
            ProPic = '$profilePicture'            
            WHERE userID = $userID";


    $targetDir = "../uploads/";
    $targetFile = $targetDir . basename($_FILES["profilePictureInput"]["name"]);

    if (move_uploaded_file($_FILES["profilePictureInput"]["tmp_name"], $targetFile)) {
        // File uploaded successfully
    } else {
        echo "Error uploading file.";
    }

    if ($conn->query($sql) === TRUE) {
        echo '<script>alert("Picture updated successfully");</script>';
        header("Location: customerDashboard.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: customerDashboard.php");
    exit();
}

$userID = mysqli_real_escape_string($conn, $_GET['id']);

$sql = "SELECT * FROM users WHERE userID = $userID";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    $profilePicture = $row['ProPic'];

} else {
    header("Location: customerDashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../css/main.css">
    <title>Edit Profile Picture</title>
    <link rel="shortcut icon" href="https://i.ibb.co/rtBrF0f/newlogo.png" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        /* Hide the default file input */
        input[type="file"] {
            display: none;
        }

        /* Style the custom file input container */
        .file-input-container {
            position: relative;
            display: inline-block;
            cursor: pointer;
            font-size: 14px;
            padding: 10px 15px;
            border: 2px solid #3498db;
            color: #3498db;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        /* Style for the file name display */
        .file-name {
            margin-left: 10px;
        }

        /* Hover effect for the container */
        .file-input-container:hover {
            background-color: #3498db;
            color: #fff;
        }

        /* Style the file input label */
        .file-label {
            display: block;
            margin-bottom: 8px;
        }

        /* Style the file input icon (optional) */
        .file-icon {
            display: inline-block;
            margin-right: 8px;
        }

        /* Style the file input on selection */
        input[type="file"]:focus+.file-input-container {
            outline: 2px solid #3498db;
        }

        #preview {
            max-width: 100%;
            max-height: 200px;
            margin-top: 10px;
            border-radius: 10%;
        }

        .cont1 {
            background-color: #ffffff85;
            border-radius: 2%;
        }

        #imgerror {
            color: red;
        }
    </style>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
        }

        .navbar {
            outline: 1px solid black;
            outline-offset: -1px;
            /* Adjust this value as needed */
        }

        /* Optional: Remove box-shadow */
        .shadow-5-strong {
            background-color: rgba(0, 0, 0, 0.7);
        }

        .footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            /* Adjust the alpha value (4th parameter) for transparency */
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
            #sidebar {
                margin-left: -250px;
            }

            #content {
                margin-left: 0;
            }

            #sidebar.open {
                margin-left: 0;
            }

            #menu-toggle {
                display: block;
                position: fixed;
                top: 10px;
                left: 10px;
                z-index: 1;
                cursor: pointer;
            }
        }

        h2 {
            color: white;
        }

        label {
            color: white;
        }

        footer {
            background-color: rgba(0, 0, 0, 0.05);
            opacity: 0.8;
            width: 100%;
            bottom: 0;
            text-align: center;
            color: black;
        }

        section {
            position: relative;
            max-width: 800px;
            background-color: rgba(0, 0, 0, 0.41);
            border: 2px solid #ffc107;
            border-radius: 20px;
            backdrop-filter: blur(5px);
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 2rem 3rem;
        }
    </style>
    <style>
        .file-input-container {
            display: inline-block;
            cursor: pointer;
            font-size: 14px;
            padding: 10px 15px;
            border: 2px solid #ba8b00;
            color: #FFFFFF;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .file-input-container:hover {
            background-color: #0000007a;
            color: #DCD206;
        }

        /* Style the file input icon (optional) */
        .file-icon {
            display: inline-block;
            margin-right: 8px;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.20/dist/sweetalert2.all.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

    <center>
        <div class="container">
            <br><br>
            <section>
                <h2>Edit Profile Picture</h2>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?id=' . $userID; ?>" method="post"
                    enctype="multipart/form-data" onsubmit="formdone()">

                    <div class="inputbox">
                        <br>
                        <input type="file" class="form-control" id="imageInput" style="display: none;"
                            value="<?php echo $profilePicture; ?>" name="profilePictureInput" accept="image/*" required>

                        <!-- Label with a button -->
                        <label for="imageInput" class="file-input-container">
                            <span class="fa fa-cloud-upload">&nbsp;</span>
                            <!-- You can replace this with your preferred file icon -->
                            Click here to choose a profile picture
                        </label><br>
                        <img src="../uploads/<?php echo $profilePicture; ?>" id="preview" alt="Image Preview">
                        <br><span id="imgerror"></span>
                    </div><br>

                    <div id="btn">
                        <button type="submit" class="btn btn-dark" id="btn1">Update</button>
                    </div>
                </form>
            </section>
        </div>
    </center>

    <!-- Fixed Footer -->
    <footer class="footer">
        <p>&copy; 2023 Xcobra. All rights reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <script>

        document.getElementById('imageInput').addEventListener('change', function (event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    const preview = document.getElementById('preview');
                    preview.src = e.target.result;
                    preview.style.display = 'block'; // Show the image
                };
                reader.readAsDataURL(file);
            }
        });

        function formdone() {
            Swal.fire({
                icon: "success",
                title: "Picture updated successfully",
                showConfirmButton: true,
                timer: 30000
            });
        }
    </script>
</body>

</html>

<?php
$conn->close();
?>