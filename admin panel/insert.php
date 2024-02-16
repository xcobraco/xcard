<?php
include '../inc/connection.php';
include '../inc/header.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

    $targetDir = "../uploads/";
    $targetFile = $targetDir . basename($_FILES["profilePictureInput"]["name"]);

    if (move_uploaded_file($_FILES["profilePictureInput"]["tmp_name"], $targetFile)) {
        // File uploaded successfully
    } else {
        echo "Error uploading file.";
    }

    $sql = "INSERT INTO users (Name, Position, Description, Address, ProPic, Contact, Whatsapp, Facebook, Linkedin, Instagram, Email) 
            VALUES ('$name', '$position', '$description', '$address', '$profilePicture', '$contactNumber', '$whatsapp', '$facebook', '$linkedin', '$instagram', '$email')";

    if ($conn->query($sql) === TRUE) {
        echo '<script>alert("New record created successfully");</script>';
        header("Location: table.php");
        exit(); // Add exit() after header to prevent further execution
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../css/styles_in.css">
    <title>Add New user</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
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
    </style>
    
</head>
<body>
    <div class="heading">
        <h2 id="hd1">Unlock the Next Chapter<br>Share Your Details to move on !</h2>
    </div>

    <div class="cont1">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data" id="form1">
            
        <div class="form-group">
                <h4 id="topic2">Personal information</h4>
            </div><br>

            <div class="form-group">
                <label for="nameInput">Name *</label>
                <input type="text" class="form-control" id="nameInput" name="nameInput" placeholder="Enter name" oninput="validateName()" required>
                <span id="error"></span>
            </div><br>
        
            <div class="form-group">
                <label for="positionInput">Position *</label>
                <input type="text" class="form-control" id="positionInput" name="positionInput" placeholder="Enter Position" required>
                <span id="positionerror"></span>
            </div><br>
        
            <div class="form-group">
                <label for="descriptionInput">Description *</label>
                <textarea class="form-control" id="descriptionInput" name="descriptionInput" placeholder="Tell Something about you" required></textarea>        
            </div><br>

            <div class="form-group">
                <label for="descriptionInput">Home Address *</label>
                <input type="text" class="form-control" id="addressInput" name="addressInput" placeholder="Enter the address" required>
                <span id="descerror"></span>
            </div><br>
        
            <div class="form-group">
                <label for="profilePictureInput">Choose a Profile Picture *</label><br>
                <input type="file" class="form-control-file" id="profilePictureInput" name="profilePictureInput" accept="image/*"  onchange="validateImage()" required>
                <br>
                    <img src="../img/profileimg.jpg" id="preview" alt="Image Preview">
                <br><span id="imgerror"></span>
            </div><br><br>

            <div class="form-group">
                <h4 id="topic2">Social Media Links</h4>
            </div><br>
        
            <div class="form-group">
                <label for="contactNumberInput">Contact Number *</label>
                <input type="text" class="form-control" id="contactNumberInput" name="contactNumberInput" placeholder="Enter the Contact number" oninput="validateContactNumber()" required>
                <span id="contacterror"></span>
            </div><br>
        
            <div class="form-group">
                <label for="whatsappInput">Whatsapp</label>
                <input type="text" class="form-control" id="whatsappInput" name="whatsappInput" placeholder="Enter the Whatsapp number" oninput="validateWhatsapp()">
                <span id="whatsapperror"></span>
            </div><br>
        
            <div class="form-group">
            <label for="facebookInput">Facebook</label>
            <input type="text" class="form-control" id="facebookInput" name="facebookInput" placeholder="Enter the URL" oninput="validateUrl('facebook', this.value)">
            <span id="facebookError"></span>
        </div>
            <br>
            <div class="form-group">
                <label for="linkedinInput">Linkedin</label>
                <input type="text" class="form-control" id="linkedinInput" name="linkedinInput" placeholder="Enter the URL" oninput="validateUrl('linkedin', this.value)">
                <span id="linkedinError"></span>
            </div>
            <br>
            <div class="form-group">
                <label for="instagramInput">Instagram</label>
                <input type="text" class="form-control" id="instagramInput" name="instagramInput" placeholder="Enter the URL" oninput="validateUrl('instagram', this.value)">
                <span id="instagramError"></span>
            </div>
            <br>
            <div class="form-group">
                <label for="emailInput">Email *</label>
                <input type="text" class="form-control" id="emailInput" name="emailInput" placeholder="Enter the email address" oninput="validateEmail()" required>
                <span id="emailerror"></span>
            </div><br>
        
            <div id="btn">
                <button type="submit" class="btn btn-primary" id="btn1">Submit</button>
            </div>
        </form>
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
