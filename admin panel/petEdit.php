<?php
include '../inc/connection.php';

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $petID = mysqli_real_escape_string($conn, $_GET['id']);

    $ProfilePicture = mysqli_real_escape_string($conn, $_FILES['profilePictureInput']['name']);
    $Petname = mysqli_real_escape_string($conn, $_POST['petnameInput']);
    $Breed = mysqli_real_escape_string($conn, $_POST['breedInput']);
    $Gender = mysqli_real_escape_string($conn, $_POST['genderInput']);
    $Dob = mysqli_real_escape_string($conn, $_POST['dobInput']);
    $Status = mysqli_real_escape_string($conn, $_POST['statusInput']);
    $Description = mysqli_real_escape_string($conn, $_POST['descriptionInput']);
    $OwnerName = mysqli_real_escape_string($conn, $_POST['ownerNameInput']);
    $Phone = mysqli_real_escape_string($conn, $_POST['phoneInput']);
    $HomeAddress = mysqli_real_escape_string($conn, $_POST['addressInput']);
    $Whatsapp = mysqli_real_escape_string($conn, $_POST['whatsappInput']);
    $Facebook = mysqli_real_escape_string($conn, $_POST['facebookInput']);
    $Instagram = mysqli_real_escape_string($conn, $_POST['instagramInput']);
    $Email = mysqli_real_escape_string($conn, $_POST['emailInput']);
    $Img1 = mysqli_real_escape_string($conn, $_FILES['image1']['name']);
    $Img2 = mysqli_real_escape_string($conn, $_FILES['image2']['name']);
    $Img3 = mysqli_real_escape_string($conn, $_FILES['image3']['name']);

    $targetDir = "../uploads/pet/";
    $targetFile1 = $targetDir . basename($_FILES["profilePictureInput"]["name"]);
    $targetFile2 = $targetDir . basename($_FILES["image1"]["name"]);
    $targetFile3 = $targetDir . basename($_FILES["image2"]["name"]);
    $targetFile4 = $targetDir . basename($_FILES["image3"]["name"]);

    if (move_uploaded_file($_FILES["profilePictureInput"]["tmp_name"], $targetFile1) && move_uploaded_file($_FILES["image1"]["tmp_name"], $targetFile2) && move_uploaded_file($_FILES["image2"]["tmp_name"], $targetFile3) && move_uploaded_file($_FILES["image3"]["tmp_name"], $targetFile4)) {
        // File uploaded successfully
    } else {
        echo "Error uploading file.";
    }

    $sql = "UPDATE pet SET 
            Name = '$Petname',
            Breed = '$Breed',
            Gender = '$Gender',
            DOB = '$Dob',
            Status = '$Status',
            Description = '$Description',
            PetPic = '$ProfilePicture',
            OwnerName = '$OwnerName',
            Phone = '$Phone',
            Home = '$HomeAddress',
            Whatsapp = '$Whatsapp',
            FB = '$Facebook',
            Insta = '$Instagram',
            Email = '$Email',
            Img1 = '$Img1',
            Img2 = '$Img2',
            Img3 = '$Img3'
            WHERE petID = '$petID'";

    if ($conn->query($sql) === TRUE) {
        echo '<script>alert("Record updated successfully");</script>';
        header("Location: petTable.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

include '../inc/header.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: petTable.php");
    exit();
}

$petID = mysqli_real_escape_string($conn, $_GET['id']);

$sql = "SELECT * FROM pet WHERE petID = $petID";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    $profilePicture = $row['PetPic'];
    $petname = $row['Name'];
    $breed = $row['Breed'];
    $gender = $row['Gender'];
    $dob = $row['DOB'];
    $status = $row['Status'];
    $description = $row['Description'];
    $ownerName = $row['OwnerName'];
    $phone = $row['Phone'];
    $homeAddress = $row['Home'];
    $whatsapp = $row['Whatsapp'];
    $facebook = $row['FB'];
    $instagram = $row['Insta'];
    $email = $row['Email'];
    $img1 = $row['Img1'];
    $img2 = $row['Img2'];
    $img3 = $row['Img3'];
} else {
    header("Location: petTable.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Pet</title>
    <style>
        #preview {
            max-width: 100%;
            max-height: 200px;
            margin-top: 10px;
            border-radius: 10%;
        }
        .cont1{
            background-color: #ffffff85;
            border-radius: 2%;
        }
        #error{
            color: red;
        }
        #contacterror{
            color: red;
        }
        #facebookError{
            color: red;
        }
        #linkedinError{
            color: red;
        }
        #instagramError{
            color: red;
        }
        #imgerror{
            color: red;
        }
        #whatsapperror{
            color: red;
        }
        #emailerror{
            color: red;
        }
        #ownerError{
            color: red;
        }
        #galleryerror1{
            color: red;
        }
        #galleryerror2{
            color: red;
        }
        #galleryerror3{
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

        #content {
            margin-left: 250px;
            padding: 20px;
            transition: margin-left 0.3s;
        }

        #menu-toggle {
            display: none;
        }

        @media screen and (max-width: 600px) {

            #content {
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
            background-color: rgba(255, 255, 255, 0.3);
            border: 2px solid rgba(255, 255, 255, 0.5);
            border-radius: 20px;
            backdrop-filter: blur(5px);
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 2rem 3rem;
        }
        .container {
      max-width: 1200px;
      margin: 0 auto;
      padding: 20px;
    }

    .image-container {
      display: flex;
      justify-content: space-between;
      flex-wrap: wrap;
    }

    .image-container img {
      width: 30%;
      margin-bottom: 20px;
    }

    @media screen and (max-width: 768px) {
      .image-container {
        flex-direction: column;
      }

      .image-container img {
        width: 100%;
      }
    }
    </style>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
   
</head>
<body>
<div class="cont1">
<center>
    <section>
    <h2>Update Pet</h2><br>
    <form method="post" enctype="multipart/form-data">
        <!-- Pet ID (hidden) -->
        <input type="hidden" name="petID" value="<?php echo $petID; ?>">

        <!-- Existing Profile Picture -->
        <img src="../uploads/pet/<?php echo $profilePicture; ?>" alt="Profile Picture" width="100" id="preview"><br><br>

        <!-- Upload New Profile Picture -->
        Profile Picture: <input type="file" name="profilePictureInput" id="profilePictureInput" accept="image/*" onchange="validateImage()">
        <br><span id="imgerror"></span><br>

        <!-- Existing Data -->
        Pet Name: <input type="text" name="petnameInput" value="<?php echo $petname; ?>" class="form-control" id="nameInput" oninput="validateName()">
        <span id="error"></span><br>
        Breed: <input type="text" name="breedInput" value="<?php echo $breed; ?>" class="form-control" id="breedInput"><br>
        Gender: 
        <select class="form-control" id="genderInput" name="genderInput" value="<?php echo $gender; ?>">
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select><br>
        DOB: <input type="date" name="dobInput" value="<?php echo $dob; ?>" class="form-control" id="dobInput"><br>
        Status: 
        <select class="form-control" id="statusInput" name="statusInput" value="<?php echo $status; ?>">
                    <option value="spayed">Spayed</option>
                    <option value="neutered">Neutered</option>
                </select><br>
        Description: <textarea name="descriptionInput" class="form-control" id="descriptionInput"><?php echo $description; ?></textarea><br>
        <h2>Owner Info</h2><br>
        Owner Name: <input type="text" name="ownerNameInput" value="<?php echo $ownerName; ?>" class="form-control" id="ownerNameInput" oninput="validateOwnerName()">
        <span id="ownerError"></span><br>
        Phone: <input type="text" name="phoneInput" value="<?php echo $phone; ?>" class="form-control" id="contactNumberInput" oninput="validateContactNumber()">
        <span id="contacterror"></span><br>
        Home Address: <input type="text" name="addressInput" value="<?php echo $homeAddress; ?>" class="form-control" id="addressInput"><br>
        
        <h2>Social Media Links</h2><br>
        Whatsapp: <input type="text" name="whatsappInput" value="<?php echo $whatsapp; ?>" class="form-control" id="whatsappInput" oninput="validateUrl('whatsapp', this.value)">
        <span id="whatsapperror"></span><br>
        Facebook: <input type="text" name="facebookInput" value="<?php echo $facebook; ?>" class="form-control" id="facebookInput" oninput="validateUrl('facebook', this.value)">
        <span id="facebookError"></span><br>
        Instagram: <input type="text" name="instagramInput" value="<?php echo $instagram; ?>" class="form-control" id="instagramInput" oninput="validateUrl('instagram', this.value)">
        <span id="instagramError"></span><br>
        Email: <input type="text" name="emailInput" value="<?php echo $email; ?>" class="form-control" id="emailInput" oninput="validateEmail()">
        <span id="emailerror"></span><br>

        <h2>Gallery</h2><br>
        <div class="image-container">
                    <img src="../img/clip.jpg" alt="Image 1" id="img1">
                    <img src="../img/clip.jpg" alt="Image 2" id="img2">
                    <img src="../img/clip.jpg" alt="Image 3" id="img3">
                </div>
        <!-- Upload New Images -->
        Image 1: <input type="file" name="image1" class="form-control" id="image1" accept="image/*" onchange="validateGallery1()">
        <span id="galleryerror1"></span><br>
        Image 2: <input type="file" name="image2" class="form-control" id="image2" accept="image/*" onchange="validateGallery2()">
        <span id="galleryerror2"></span><br>
        Image 3: <input type="file" name="image3" class="form-control" id="image3" accept="image/*" onchange="validateGallery3()">
        <span id="galleryerror3"></span><br>

        <!-- Submit button -->
        <input type="submit" value="Update">
    </form>

    </section>
</center>

    <script>
        
        function validateName() {
            var nameInput = document.getElementById("nameInput");
            var nameError = document.getElementById("error");

            // Regular expression to check if the name contains only letters
            var lettersOnly = /^[a-zA-Z\s]+$/;

            if (!lettersOnly.test(nameInput.value)) {
                // Display error message if non-letter characters are present
                nameError.textContent = "Name must contain only letters.";
            } else {
                // Clear error message if the input is valid
                nameError.textContent = "";
            }
        }

        function validateOwnerName() {
            var nameInput = document.getElementById("ownerNameInput");
            var nameError = document.getElementById("ownerError");

            // Regular expression to check if the name contains only letters
            var lettersOnly = /^[a-zA-Z\s]+$/;

            if (!lettersOnly.test(nameInput.value)) {
                // Display error message if non-letter characters are present
                nameError.textContent = "Name must contain only letters.";
            } else {
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
                preview.src = '../img/clip.jpg';

                return false;
            } else {
                // Clear any previous error message
                errorSpan.innerText = '';

                // Display the selected image preview
                var reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        }

        function validateGallery1() {
            var input = document.getElementById('image1');
            var preview = document.getElementById('img1');
            var errorSpan = document.getElementById('galleryerror1');

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
                preview.src = '../img/clip.jpg';

                return false;
            } else {
                // Clear any previous error message
                errorSpan.innerText = '';

                // Display the selected image preview
                var reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        }

        function validateGallery2() {
            var input = document.getElementById('image2');
            var preview = document.getElementById('img2');
            var errorSpan = document.getElementById('galleryerror2');

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
                preview.src = '../img/clip.jpg';

                return false;
            } else {
                // Clear any previous error message
                errorSpan.innerText = '';

                // Display the selected image preview
                var reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        }

        function validateGallery3() {
            var input = document.getElementById('image3');
            var preview = document.getElementById('img3');
            var errorSpan = document.getElementById('galleryerror3');

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
                preview.src = '../img/clip.jpg';

                return false;
            } else {
                // Clear any previous error message
                errorSpan.innerText = '';

                // Display the selected image preview
                var reader = new FileReader();
                reader.onload = function(e) {
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
            var errorElement = document.getElementById(`${socialMedia}Error`);

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
                errorElement.textContent = `Invalid ${socialMedia} URL. Please enter a valid ${socialMedia} URL.`;
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

    // Perform your validations
    validateName();
    validateContactNumber();
    validateUrl('facebook', facebookInput.value);
    validateUrl('linkedin', linkedinInput.value);
    validateUrl('instagram', instagramInput.value);

    // Check if any validation fails
    if (
        nameInput.value === "" ||
        contactNumberInput.value === "" ||
        facebookInput.value === "" ||
        linkedinInput.value === "" ||
        instagramInput.value === "" ||
        document.getElementById("error").textContent !== "" ||
        document.getElementById("contacterror").textContent !== "" ||
        document.getElementById("facebookError").textContent !== "" ||
        document.getElementById("linkedinError").textContent !== "" ||
        document.getElementById("instagramError").textContent !== ""
    ) {
        // Prevent form submission
        event.preventDefault();
        alert(errorMessage); // You can display a more user-friendly error message if needed
    }
});
    </script>
    

</div>

<footer class="bg-body-tertiary text-center" style="opacity:0.5;">
    <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.05);">
        ©  All Rights Reserved.
        Designed by Xcobra
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>
</html>
