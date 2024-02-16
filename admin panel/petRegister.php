<?php
include '../inc/header.php';

// Include PHPMailer autoloader
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Include PHPMailer autoloader
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Welcome to XCobra</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.20/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.20/dist/sweetalert2.all.min.js"></script>


<style>
.bg-image-vertical {
    position: relative;
    overflow: hidden;
    background-repeat: no-repeat;
    background-position: right center;
    background-size: auto 100%;
}

@media (min-width: 1025px) {
    .h-custom-2 {
        height: 100%;
    }
}

.content {
    padding-left: 1rem;
}

.logo {
    padding-top: 3rem;
    text-align: center;
    /* Center the text in the logo div */
}

img {
    max-width: 100%;
    /* Make sure images don't overflow their containers */
    height: auto;
    /* Maintain aspect ratio */
}
</style>
</head>

<body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<section class="vh-100 bg-image-vertical">
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12 col-md-6 text-black">
            <!-- Updated to take full width on small screens -->
            <div class="px-5 ms-md-4">
                <div class="logo">
                    <i><img src="../Img/xcobralogo.png" height="60px"></i>
                    <span class="h1 fw-bold mb-0">XCobra</span>
                </div>
            </div>
            <div class="content">
                <div class="d-flex align-items-center h-custom-2 px-5 ms-md-4 mt-5 pt-5 pt-md-0 mt-md-n5">
                    <form style="width: 100%;" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" onsubmit="return validateForm()">
                        <h3 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Register</h3>

                        <div class="form-outline mb-4">
                            <label class="form-label" for="email">Email address</label>
                            <input type="email" id="email" name="email" class="form-control form-control-lg" required />
                        </div>

                        <div class="form-outline mb-4">
                            <label class="form-label" for="password">Password</label>
                            <input type="password" id="password" name="password" class="form-control form-control-lg" required />
                        </div>

                        <div class="pt-1 mb-4">
                            <button class="btn btn-info btn-lg btn-block" type="submit">Register</button>
                        </div>

                    </form>



                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-6 px-0">
            <img src="../img/img3.jpg" alt="Login image" class="w-100 vh-100" style="object-fit: cover; object-position: left;">
        </div>
    </div>
</div>
</section>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.20/dist/sweetalert2.all.min.js"></script>

<script>
function validateForm() {
    var emailInput = document.getElementById("email");
    var passwordInput = document.getElementById("password");
    var confirmPasswordInput = document.getElementById("confirmPassword");

    var emailValue = emailInput.value.trim();
    var passwordValue = passwordInput.value;
    var confirmPasswordValue = confirmPasswordInput.value;

    // Basic email validation
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(emailValue)) {
        Swal.fire({
            icon: "error",
            title: "Invalid email address",
            showConfirmButton: true,
            timer: 3000
        });
        return false; // Prevent form submission
    }

    // Password length check
    if (passwordValue.length < 8) {
        Swal.fire({
            icon: "error",
            title: "Password must be at least 8 characters long",
            showConfirmButton: true,
            timer: 3000
        });
        return false; // Prevent form submission
    }

    // Password match check
    if (passwordValue !== passwordValue) {
        Swal.fire({
            icon: "error",
            title: "Passwords do not match",
            showConfirmButton: true,
            timer: 3000
        });
        return false; // Prevent form submission
    }

    // You can add more validations if needed

    return true; // Allow form submission
}
</script>
<?php
    // PHP code for handling form submission
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Database connection
        include '../inc/connection.php';

        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Get user input
        $enteredEmail = $_POST["email"];
        $enteredPassword = $_POST["password"];

        // Check if email already exists
        $checkEmailQuery = "SELECT * FROM pet WHERE Email = '$enteredEmail'";
        $result = $conn->query($checkEmailQuery);

        if ($result->num_rows > 0) {
            // Email already exists, show an error message
            echo '<script>
                Swal.fire({
                    icon: "error",
                    title: "Email address is already in use",
                    showConfirmButton: true,
                    timer: 5000 // Set a timer to close the alert after 5 seconds
                });
            </script>';
        } else {
            // Insert user data into the database
            $insertQuery = "INSERT INTO pet (Email, Password, Back) VALUES ('$enteredEmail', '$enteredPassword', 'https://media.giphy.com/media/3ftDhNX7b0AV5o5dhg/giphy.gif')";

            if ($conn->query($insertQuery) === TRUE) {
                // Registration successful

                // Send a welcome email to the user using PHPMailer
                $mail = new PHPMailer(true);

                try {
                    //Server settings
                    $mail->isSMTP();
                    $mail->Host       = 'smtp.gmail.com'; // Your SMTP server
                    $mail->SMTPAuth   = true;
                    $mail->Username   = 'amkashan2@gmail.com'; // Your SMTP username
                    $mail->Password   = 'nnsczsllpjwzxeik'; // Your SMTP password
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption
                    $mail->Port       = 587; // TCP port to connect to

                    //Recipients
                    $mail->setFrom('amkashan2@gmail.com', 'XCobra');
                    $mail->addAddress($enteredEmail);

                    // Content
                    $mail->isHTML(true);
                    $mail->Subject = 'Welcome to XCobra';
                    $mail->Body    = 'Thank you, ' . $enteredEmail . ', for registering with XCobra! user name =, ' . $enteredEmail . ',password =, ' . $enteredPassword . ',';

                    $mail->send();
                    // Redirect to a success page or do other actions
                    echo '<script>
                    Swal.fire({
                        icon: "success",
                        title: "Email sent successfully !",
                        showConfirmButton: true,
                        timer: 2000 
                    }).then(function() {
                        window.location.href = "home.php";
                    });
                </script>';
                    exit();
                } catch (Exception $e) {
                    // Display an error message
                    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
                }
            } else {
                // Display SweetAlert for registration failure
                echo '<script>
                    Swal.fire({
                        icon: "error",
                        title: "Registration failed",
                        text: "Please try again later",
                        showConfirmButton: true,
                        timer: 5000 // Set a timer to close the alert after 5 seconds
                    }).then(function() {
                        window.location.href = "../customerLogin.php";
                    });
                </script>';
            }
        }

        $conn->close();
    }
    ?>
</body>

</html>