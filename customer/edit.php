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

    $name = mysqli_real_escape_string($conn, $_POST['nameInput']);
    $position = mysqli_real_escape_string($conn, $_POST['positionInput']);
    $description = mysqli_real_escape_string($conn, $_POST['descriptionInput']);
    $address = mysqli_real_escape_string($conn, $_POST['addressInput']);
    $profilePicture = mysqli_real_escape_string($conn, $_FILES['profilePictureInput']['name']);
    $contactNumber = mysqli_real_escape_string($conn, $_POST['contactNumberInput']);
    $whatsapp = mysqli_real_escape_string($conn, $_POST['whatsappInput']);
    $facebook = mysqli_real_escape_string($conn, $_POST['facebookInput']);
    $linkedin = mysqli_real_escape_string($conn, $_POST['linkedinInput']);
    $instagram = mysqli_real_escape_string($conn, $_POST['instagramInput']);
    $email = mysqli_real_escape_string($conn, $_POST['emailInput']);

    $sql = "UPDATE users SET 
            Name = '$name',
            Position = '$position',
            Description = '$description',
            Address = '$address',
            Contact = '$contactNumber',
            Whatsapp = '$whatsapp',
            Facebook = '$facebook',
            Linkedin = '$linkedin',
            Instagram = '$instagram',
            Email = '$email'
            WHERE userID = $userID";

    if ($conn->query($sql) === TRUE) {
        echo '<script>
        Swal.fire({
            icon: "success",
            title: "Updated Successfully !!",
            showConfirmButton: true,
            timer: 5000 // Set a timer to close the alert after 5 seconds
        }).then(function() {
            window.location.href = "customerLogin.php";
        });
    </script>';
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

    $name = $row['Name'];
    $position = $row['Position'];
    $description = $row['Description'];
    $address = $row['Address'];
    $profilePicture = $row['ProPic'];
    $contactNumber = $row['Contact'];
    $whatsapp = $row['Whatsapp'];
    $facebook = $row['Facebook'];
    $linkedin = $row['Linkedin'];
    $instagram = $row['Instagram'];
    $email = $row['Email'];
} else {
    header("Location:customerDashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../css/main.css">
    <title>Edit User</title>
    <link rel="shortcut icon" href="https://i.ibb.co/rtBrF0f/newlogo.png" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.20/dist/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <style>
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
            bottom: 0;
            width: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            /* Adjust the alpha value (4th parameter) for transparency */
            color: #fff;
            text-align: center;
            padding: 10px 0;
        }

        #sidebar {
            height: 100%;
            width: 250px;
            position: fixed;
            background-color: rgba(255, 255, 255, 0.18);
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.7);
            padding-top: 20px;
            transition: margin-left 0.3s;
        }

        #sidebar a {
            padding: 10px;
            text-decoration: none;
            font-size: 18px;
            color: white;
            display: flex;
            align-items: center;
            transition: 0.3s;
        }

        #sidebar a i {
            margin-right: 10px;
        }

        #sidebar a:hover {
            background-color: #555;
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

        #error {
            color: red;
        }

        #errorPosition {
            color: red;
        }

        #contacterror {
            color: red;
        }

        #facebookError {
            color: red;
        }

        #linkedinError {
            color: red;
        }

        #instagramError {
            color: red;
        }

        #imgerror {
            color: red;
        }

        #whatsapperror {
            color: red;
        }

        #emailerror {
            color: red;
        }

        #descerror {
            color: red;
        }

        #adderror {
            color: red;
        }
        h2{
            color: white;
        }
        label{
            color: white;
        }
    </style>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.20/dist/sweetalert2.all.min.js"></script>

</head>

<body>


    <br>
    <center>
        <section>
            <h2>Edit User</h2>
            <form id="form1" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?id=' . $userID; ?>"
                method="post" enctype="multipart/form-data" onsubmit="formdone()">
                <center><img src="../uploads/<?php echo $profilePicture; ?>" id="preview" alt="Image Preview"></center>
                <br>
                <div class="inputbox">
                    <label for="nameInput">Name</label><span style="color: red;">*</span>
                    <input type="text" class="form-control" id="nameInput" name="nameInput" value="<?php echo $name; ?>"
                        oninput="validateName()" required placeholder="Enter Name">
                    <span id="error"></span>
                </div><br>

                <div class="inputbox">
                    <label for="positionInput">Position</label><span style="color: red;">*</span>
                    <input type="text" class="form-control" id="positionInput" value="<?php echo $position; ?>"
                        name="positionInput" placeholder="Enter Position" oninput="validatePosition()" required>
                    <span id="errorPosition"></span>
                </div><br>

                <div class="inputbox">
                    <label for="descriptionInput">Description</label><span style="color: red;">*</span>
                    <textarea class="form-control" id="descriptionInput" name="descriptionInput"
                        placeholder="Tell something about you" required
                        oninput="descErr()"><?php echo $description; ?></textarea>
                    <span id="descerror"></span>
                </div><br>


                <div class="inputbox">
                    <label for="descriptionInput">Home Address</label><span style="color: red;">*</span>
                    <input type="text" class="form-control" id="addressInput" value="<?php echo $address; ?>"
                        name="addressInput" placeholder="Enter the address" required oninput="addErr()">
                    <span id="adderror"></span>
                </div><br>

                <div class="inputbox">
                    <h4 id="topic2" style="color: white;">Social Media Links</h4>
                </div><br>

                <div class="inputbox">
                    <label for="contactNumberInput">Contact Number</label><span style="color: red;">*</span>
                    <input type="text" class="form-control" id="contactNumberInput" name="contactNumberInput"
                        value="<?php echo $contactNumber; ?>" placeholder="Enter the Contact number"
                        oninput="validateContactNumber()" required>
                    <span id="contacterror"></span>
                </div><br>

                <div class="inputbox">
                    <label for="whatsappInput">Whatsapp</label>
                    <input type="text" class="form-control" id="whatsappInput" name="whatsappInput"
                        value="<?php echo $whatsapp; ?>" placeholder="Enter the Whatsapp number"
                        oninput="validateWhatsapp()">
                    <span id="whatsapperror"></span>
                </div><br>

                <div class="inputbox">
                    <label for="facebookInput">Facebook</label>
                    <input type="text" class="form-control" id="facebookInput" name="facebookInput"
                        value="<?php echo $facebook; ?>" placeholder="Enter the URL"
                        oninput="validateUrl('facebook', this.value)">
                    <span id="facebookError"></span>
                </div>
                <br>
                <div class="inputbox">
                    <label for="linkedinInput">Linkedin</label>
                    <input type="text" class="form-control" id="linkedinInput" name="linkedinInput"
                        value="<?php echo $linkedin; ?>" placeholder="Enter the URL"
                        oninput="validateUrl('linkedin', this.value)">
                    <span id="linkedinError"></span>
                </div>
                <br>
                <div class="inputbox">
                    <label for="instagramInput">Instagram</label>
                    <input type="text" class="form-control" id="instagramInput" name="instagramInput"
                        value="<?php echo $instagram; ?>" placeholder="Enter the URL"
                        oninput="validateUrl('instagram', this.value)">
                    <span id="instagramError"></span>
                </div>
                <br>
                <div class="inputbox">
                    <label for="emailInput">Email</label><span style="color: red;">*</span>
                    <input type="text" class="form-control" readonly id="emailInput" name="emailInput"
                        value="<?php echo $email; ?>" placeholder="Enter the email address" oninput="validateEmail()"
                        required>
                    <span id="emailerror"></span>
                </div><br>

                <div id="btn">
                    <button type="submit" class="btn btn-dark" id="btn1">Update</button>
                </div>
            </form>
        </section>
    </center>
    </div><br><br><br>

    <!-- Fixed Footer -->
    <footer class="footer">
        <p>&copy; 2023 Xcobra. All rights reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <script>
        function formdone() {
            Swal.fire({
                icon: "success",
                title: "Updated successfully",
                showConfirmButton: true,
                timer: 30000
            });
        }

        function descErr() {
            var DInput = document.getElementById("descriptionInput");
            var DError = document.getElementById("descerror");

            if (DInput.value.trim() === "") {
                DError.textContent = "Description is required.";
            }
        }

        function addErr() {
            var AInput = document.getElementById("addressInput");
            var AError = document.getElementById("adderror");

            if (AInput.value.trim() === "") {
                AError.textContent = "Address is required.";
            }
        }

        function validateName() {
            var nameInput = document.getElementById("nameInput");
            var nameError = document.getElementById("error");

            // Regular expression to check if the name contains only letters
            var lettersOnly = /^[a-zA-Z\s\u0D80-\u0DFF\u0B80-\u0BFF]+$/;
            if (nameInput.value.trim() === "") {
                nameError.textContent = "Name is required.";
            } else
                if (!lettersOnly.test(nameInput.value)) {
                    // Display error message if non-letter characters are present
                    nameError.textContent = "Name must contain only letters.";
                }

                else {
                    // Clear error message if the input is valid
                    nameError.textContent = "";
                }
        }

        function validatePosition() {
            var nameInput = document.getElementById("positionInput");
            var nameError = document.getElementById("errorPosition");

            // Regular expression to check if the name contains only letters

            if (positionInput.value.trim() === "") {
                nameError.textContent = "Position is required.";
            }
            else {
                // Clear error message if the input is valid
                nameError.textContent = "";
            }
        }



        function validateImage() {
            var input = document.getElementById('profilePictureInput');
            var preview = document.getElementById('preview');
            var errorSpan = document.getElementById('imgerror');

            // Get the selected file
            var file = input.files[0];

            // Define allowed file formats
            var allowedFormats = ['jpg', 'png'];

            // Get the file extension
            var fileExtension = file.name.split('.').pop().toLowerCase();

            // Check if the file format is allowed
            if (allowedFormats.indexOf(fileExtension) === -1) {
                // Display error message
                errorSpan.innerText = 'Invalid format. Use JPG or PNG';

                // Clear the file input and preview
                input.value = '';
                preview.src = '';

                return false;
            } else {
                // Clear any previous error message
                errorSpan.innerText = '';

                // Display the selected image preview
                var reader = new FileReader();
                reader.onload = function (e) {
                    preview.src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        }

        function validateWhatsapp() {
            var whatsappInput = document.getElementById('whatsappInput');
            var whatsappError = document.getElementById('whatsapperror');

            // Regular expression to check if the input contains only digits
            var digitPattern = /^\d+$/;

            // Check if the input contains only digits
            if (!digitPattern.test(whatsappInput.value)) {
                // Display error message
                whatsappError.innerText = 'Must contain only digits';

                // You may choose to clear the input in case of an error
                // whatsappInput.value = '';
            } else {
                // Clear any previous error message
                whatsappError.innerText = '';
            }
        }

        function validateContactNumber() {
            var contactNumberInput = document.getElementById("contactNumberInput");
            var contactError = document.getElementById("contacterror");

            // Regular expression to check if the contact number contains only digits and has a maximum length of 10
            var digitsOnly = /^\d{1,10}$/;

            if (!digitsOnly.test(contactNumberInput.value)) {
                // Display error message if the validation fails
                contactError.textContent = "Must contain only digits and have a maximum length of 10.";
            } else {
                // Clear error message if the input is valid
                contactError.textContent = "";
            }
        }

        function validateUrl(socialMedia, url) {
            var errorElement = document.getElementById(${socialMedia}Error);

            // Regular expressions to check if the URL contains the required substring
            var facebookRegex = /www\.facebook\.com/;
            var linkedinRegex = /www\.linkedin\.com/;
            var instagramRegex = /www\.instagram\.com/;

            var isValid = false;

            switch (socialMedia) {
                case 'facebook':
                    isValid = facebookRegex.test(url);
                    break;
                case 'linkedin':
                    isValid = linkedinRegex.test(url);
                    break;
                case 'instagram':
                    isValid = instagramRegex.test(url);
                    break;
            }

            if (!isValid) {
                // Display error message if the validation fails
                errorElement.textContent = Invalid ${socialMedia} URL. Please enter a valid ${socialMedia} URL.;
            } else {
                // Clear error message if the input is valid
                errorElement.textContent = "";
            }
        }

        function validateEmail() {
            var emailInput = document.getElementById('emailInput');
            var emailError = document.getElementById('emailerror');

            // Regular expression to check if the input is a valid email address
            var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

            // Check if the input is a valid email address
            if (!emailPattern.test(emailInput.value)) {
                // Display error message
                emailError.innerText = 'Invalid email address';

                // You may choose to clear the input in case of an error
                // emailInput.value = '';
            } else {
                // Clear any previous error message
                emailError.innerText = '';
            }
        }

        // Optional: You can also add a form submission event listener to perform final validation before submitting the form
        document.getElementById("form1").addEventListener("submit", function (event) {
            
            var nameInput = document.getElementById("nameInput");
            var contactNumberInput = document.getElementById("contactNumberInput");
            var facebookInput = document.getElementById("facebookInput");
            var linkedinInput = document.getElementById("linkedinInput");
            var instagramInput = document.getElementById("instagramInput");
            var errorMessage = "You have to fill this field";

            if (!/^[a-zA-Z\s\u0D80-\u0DFF\u0B80-\u0BFF]+$/.test(nameInput.value) || !/^\d{1,10}$/.test(contactNumberInput.value) ||
            !/www\.facebook\.com/.test(facebookInput.value) || !/www\.linkedin\.com/.test(linkedinInput.value) || !/www\.instagram\.com/.test(instagramInput.value)) {
                // Prevent form submission if any of the inputs are invalid
                Swal.fire({
                    icon: 'warning',
                    title: 'Warning!',
                    text: 'Please correct the issues',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'OK'
                });
                event.preventDefault();
            }
        });
    </script>
</body>

</html>
