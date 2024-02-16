<?php
include '../inc/connection.php';
include '../inc/header.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $profilePicture = mysqli_real_escape_string($conn, $_FILES['profilePictureInput']['name']);
    $petname = mysqli_real_escape_string($conn, $_POST['petnameInput']);
    $breed = mysqli_real_escape_string($conn, $_POST['breedInput']);
    $gender = mysqli_real_escape_string($conn, $_POST['genderInput']);
    $dob = mysqli_real_escape_string($conn, $_POST['dobInput']);
    $status = mysqli_real_escape_string($conn, $_POST['statusInput']);
    $description = mysqli_real_escape_string($conn, $_POST['descriptionInput']);
    $ownerName = mysqli_real_escape_string($conn, $_POST['ownerNameInput']);
    $phone = mysqli_real_escape_string($conn, $_POST['phoneInput']);
    $homeAddress = mysqli_real_escape_string($conn, $_POST['addressInput']);
    $whatsapp = mysqli_real_escape_string($conn, $_POST['whatsappInput']);
    $facebook = mysqli_real_escape_string($conn, $_POST['facebookInput']);
    $instagram = mysqli_real_escape_string($conn, $_POST['instagramInput']);
    $email = mysqli_real_escape_string($conn, $_POST['emailInput']);

    $targetDir = "../uploads/pet/";
    $targetFile1 = $targetDir . basename($_FILES["profilePictureInput"]["name"]);

    if (move_uploaded_file($_FILES["profilePictureInput"]["tmp_name"], $targetFile1)) {
        // File uploaded successfully
    } else {
        echo "Error uploading file.";
    }
   
    $sql = "INSERT INTO `pet`(`Name`, `Breed`, `Gender`, `DOB`, `Status`, `PetPic`, `Description`, `OwnerName`, `Phone`, `Home`, `Whatsapp`, `FB`, `Insta`, `Email`)
            VALUES ('$petname', '$breed', '$gender', '$dob', '$status', '$profilePicture','$description', '$ownerName', '$phone', '$homeAddress', '$whatsapp', '$facebook', '$instagram', '$email')";

    if ($conn->query($sql) === TRUE) {
        echo '<script>alert("New record created successfully");</script>';
        header("Location: petTable.php");
        exit(); // Add exit() after header to prevent further execution
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
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
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data" id="form1">
        
            <center>
                <div class="inputbox">
                    <label for="profilePictureInput">Profile Picture</label><br>
                    <input type="file" class="" id="profilePictureInput" name="profilePictureInput" accept="image/*" onchange="validateImage()" required><br>
                    <img src="../img/clip.jpg" id="preview" alt="Image Preview">
                    <br><span id="imgerror"></span>
            </center>
            <br>

            <div class="inputbox">
                <label for="petnameInput">Name of the pet</label>
                <input type="text" class="form-control" id="nameInput" name="petnameInput" placeholder="Enter the Pet name" oninput="validateName()" required>
                <span id="error"></span>
            </div><br>

            <div class="inputbox">
                <label for="breedInput">Breed</label>
                <input type="text" class="form-control" id="breedInput" name="breedInput" placeholder="Enter Breed">
            </div><br>

            <div class="inputbox">
                <label for="genderInput">Gender</label>
                <select class="form-control" id="genderInput" name="genderInput">
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
            </div><br>

            <div class="inputbox">
                <label for="dobInput">Date of Birth</label>
                <input type="date" class="form-control" id="dobInput" name="dobInput">
            </div><br>

            <div class="inputbox">
                <label for="statusInput">Status</label>
                <select class="form-control" id="statusInput" name="statusInput">
                    <option value="spayed">Spayed</option>
                    <option value="neutered">Neutered</option>
                </select>
            </div><br>

            <div class="inputbox">
                <label for="descriptionInput">Description</label>
                <textarea class="form-control" id="descriptionInput" name="descriptionInput" placeholder="Tell something about your pet"></textarea>
            </div><br>

            <h2>Owner Details</h2><br>
            <div class="inputbox">
                <label for="ownerNameInput">Name of the owner</label>
                <input type="text" class="form-control" id="ownerNameInput" name="ownerNameInput" placeholder="Enter the Owner name" oninput="validateOwnerName()" required>
                <span id="ownerError"></span>
            </div><br>

            <div class="inputbox">
                <label for="phoneInput">Phone</label>
                <input type="text" class="form-control" id="contactNumberInput" name="phoneInput" placeholder="Enter Phone Number" oninput="validateContactNumber()" required>
                <span id="contacterror"></span>
            </div><br>

            <div class="inputbox">
                <label for="addressInput">Home Address</label>
                <input type="text" class="form-control" id="addressInput" name="addressInput" placeholder="Enter the address">
                <span id="descerror"></span>
            </div><br><br>

            <h2>Social Media Links</h2><br>
            <div class="inputbox">
                <label for="whatsappInput">Whatsapp</label>
                <input type="text" class="form-control" id="whatsappInput" name="whatsappInput" placeholder="Enter the Whatsapp number" oninput="validateUrl('whatsapp', this.value)">
                <span id="whatsapperror"></span>
            </div><br>

            <div class="inputbox">
                <label for="facebookInput">Facebook</label>
                <input type="text" class="form-control" id="facebookInput" name="facebookInput" placeholder="Enter the URL" oninput="validateUrl('facebook', this.value)">
                <span id="facebookError"></span>
            </div>
            <br>
            <div class="inputbox">
                <label for="instagramInput">Instagram</label>
                <input type="text" class="form-control" id="instagramInput" name="instagramInput" placeholder="Enter the URL" oninput="validateUrl('instagram', this.value)">
                <span id="instagramError"></span>
            </div>
            <br>
            <div class="inputbox">
                <label for="emailInput">Email</label>
                <input type="text" class="form-control" id="emailInput" name="emailInput" placeholder="Enter the email address" oninput="validateEmail()" required>
                <span id="emailerror"></span>
            </div><br><br>

            <h2>Gallery</h2><br>
            <div class="container">
                <div class="image-container">
                    <img src="../img/clip.jpg" alt="Image 1" id="img1">
                    <img src="../img/clip.jpg" alt="Image 2" id="img2">
                    <img src="../img/clip.jpg" alt="Image 3" id="img3">
                </div>
            <!-- File Uploads -->
            <div class="inputbox">
                <label for="image1">Image 1</label>
                <input type="file" class="form-control" id="image1" name="image1" accept="image/*" onchange="validateGallery1()">
                <span id="galleryerror1"></span>
            </div><br>

            <div class="inputbox">
                <label for="image2">Image 2</label>
                <input type="file" class="form-control" id="image2" name="image2" accept="image/*" onchange="validateGallery2()">
                <span id="galleryerror2"></span>
            </div><br>

            <div class="inputbox">
                <label for="image3">Image 3</label>
                <input type="file" class="form-control" id="image3" name="image3" accept="image/*" onchange="validateGallery3()">
                <span id="galleryerror3"></span>
            </div><br>
    
        <div id="btn">
            <button type="submit" class="btn btn-primary" id="btn1">Submit</button>
        </div>
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
