<?php

// Include PHPMailer autoloader
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Include PHPMailer autoloader
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';

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
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings</title>
    <link rel="shortcut icon" href="https://i.ibb.co/rtBrF0f/newlogo.png" type="image/png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/main.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.20/dist/sweetalert2.all.min.js"></script>

    <style>
        /* Your existing styles here */



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

        .form-container {
            max-width: 600px;
            margin: auto;
            margin-top: 50px;
        }

        .form-container form {
            margin-bottom: 20px;
        }

        footer {
            background-color: rgba(0, 0, 0, 0.05);
            opacity: 0.8;
            width: 100%;
            bottom: 0;
            text-align: center;
            color: black;
        }
        h2{
            color: white;
        }
        label{
            color: white;
        }
    </style>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <div class="container-fluid">
        <div class="row">


            <div class="container">
                <div class="form-container">
                    <!-- Change Password Form -->
                    <center>
                    <section>
                        <form method="post" id="changePasswordForm" onsubmit="return validatePasswordForm()">
                            <h2>Change Password</h2>

                            <div class="form-outline mb-4">
                                <label class="form-label" for="oldPassword">Old Password</label>
                                <input type="password" id="oldPassword" name="oldPassword"
                                    class="form-control form-control-lg" required />
                            </div>

                            <div class="form-outline mb-4">
                                <label class="form-label" for="newPassword">New Password</label>
                                <input type="password" id="newPassword" name="newPassword"
                                    class="form-control form-control-lg" minlength="8" required />
                            </div>

                            <div class="form-outline mb-4">
                                <label class="form-label" for="confirmPassword">Confirm Password</label>
                                <input type="password" id="confirmPassword" name="confirmPassword"
                                    class="form-control form-control-lg" minlength="8" required />
                            </div>

                            <div class="pt-1 mb-4">
                                
                                <button class="btn btn-dark" type="submit">Change Password</button>
    
                            </div>
                        </form>
                    </section>
                    <br>
                    <!-- Change Email Form -->
                    <section>
                        <form method="post" id="changeEmailForm" onsubmit="return validateEmailForm()">
                            <h2>Change Email Address</h2>

                            <div class="form-outline mb-4">
                                <label class="form-label" for="oldEmail">Old Email Address</label>
                                <input type="email" id="oldEmail" name="oldEmail" class="form-control form-control-lg"
                                    required />
                            </div>

                            <div class="form-outline mb-4">
                                <label class="form-label" for="newEmail">New Email Address</label>
                                <input type="email" id="newEmail" name="newEmail" class="form-control form-control-lg"
                                    required />
                            </div>

                            <div class="pt-1 mb-4">
                            
                                <button class="btn btn-dark" type="submit">Change Email
                                    Address</button>
                            </div>

                        </form>
                    </section>
                    <br>
                    <section>
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"
                            class="text-center p-4">
                            <h2>Change Background Image</h2><br>

                            <div class="form-check form-check-inline">
                                <input type="radio" name="back_color" id="image1"
                                    value="https://media.giphy.com/media/3ftDhNX7b0AV5o5dhg/giphy.gif"
                                    class="form-check-input">
                                <label for="image1">
                                    <img src="https://media.giphy.com/media/3ftDhNX7b0AV5o5dhg/giphy.gif" width="130px"
                                        height="110px" class="img-fluid">
                                </label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input type="radio" name="back_color"
                                    value="https://media.giphy.com/media/tZZTCbdO5cRUVUULFL/giphy.gif"
                                    class="form-check-input">
                                <label for="image2">
                                    <img src="https://media.giphy.com/media/tZZTCbdO5cRUVUULFL/giphy.gif"
                                        width="130px" height="110px" class="img-fluid">
                                </label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input type="radio" name="back_color" id="image3"
                                    value="https://media.giphy.com/media/p6EDJOPtyd0DJSuDef/giphy.gif"
                                    class="form-check-input">
                                <label for="image3">
                                    <img src="https://media.giphy.com/media/p6EDJOPtyd0DJSuDef/giphy.gif" width="130px"
                                        height="110px" class="img-fluid">
                                </label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input type="radio" name="back_color" id="image3"
                                    value="https://media.giphy.com/media/qTeiUJNlcoMe3LOMkk/giphy.gif"
                                    class="form-check-input">
                                <label for="image3">
                                    <img src="https://media.giphy.com/media/qTeiUJNlcoMe3LOMkk/giphy.gif" width="130px"
                                        height="110px" class="img-fluid">
                                </label>
                            </div>

                            <br><br>

                            <input class="btn btn-dark" type="submit" value="Change Background">
                        </form>

                    </section>
                    </center>
                    <br>
                </div>
            </div>
            <!-- Fixed Footer -->
            <footer class="footer">
                <p>&copy; 2023 Xcobra. All rights reserved.</p>
            </footer>
            <script>
                // JavaScript functions for form validations
                function validatePasswordForm() {
                    var oldPassword = document.getElementById("oldPassword").value.trim();
                    var newPassword = document.getElementById("newPassword").value.trim();
                    var confirmPassword = document.getElementById("confirmPassword").value.trim();

                    if (newPassword !== confirmPassword) {
                        Swal.fire({
                            icon: "error",
                            title: "New password and confirm password do not match",
                            showConfirmButton: true,
                            timer: 3000
                        });
                        return false;
                    }

                    return true;
                }

                function validateEmailForm() {
                    var oldEmail = document.getElementById("oldEmail").value.trim();
                    var newEmail = document.getElementById("newEmail").value.trim();

                    return true;
                }
            </script>

            <?php
            // PHP code for handling form submissions
            
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Change Password Form Submission
                if (isset($_POST['oldPassword']) && isset($_POST['newPassword']) && isset($_POST['confirmPassword'])) {
                    $oldPassword = $_POST['oldPassword'];
                    $newPassword = $_POST['newPassword'];
                    $confirmPassword = $_POST['confirmPassword'];

                    if ($oldPassword === $userDetails['Password']) {

                        if ($newPassword === $confirmPassword) {

                            $updatePasswordSql = "UPDATE users SET Password = '$newPassword' WHERE userID = $userID";

                            if ($conn->query($updatePasswordSql) === TRUE) {

                                // Send a welcome email to the user using PHPMailer
                                $mail = new PHPMailer(true);

                                try {
                                    //Server settings
                                    $mail->isSMTP();
                                    $mail->Host = 'smtp.gmail.com'; // Your SMTP server
                                    $mail->SMTPAuth = true;
                                    $mail->Username = 'xcobra.corp@gmail.com'; // Your SMTP username
                                    $mail->Password = 'fuykqclqftdfiphn'; // Your SMTP password
                                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption
                                    $mail->Port = 587; // TCP port to connect to
            
                                    //Recipients
                                    $mail->setFrom('amkashan2@gmail.com', 'XCobra');
                                    $mail->addAddress($userDetails['Email']);

                                    // Content
                                    $mail->isHTML(true);
                                    $mail->Subject = 'Welcome to XCobra';
                                    $htmlBody = '<html>
                                    <head>
                                        <style>
                                            body {
                                                font-family: Arial, sans-serif;
                                               
                                                color: #333;
                                                margin: 0;
                                                padding: 0;
                                            }
                                            .container {
                                               max-width: 600px;
                                margin: 0 auto;
                                padding: 20px;
                                background: url(https://media.giphy.com/media/VUo8NNocdrUdHy8s7z/giphy.gif) no-repeat center center;
                                background-size: cover;
                                border-radius: 30px;
                                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                                backdrop-filter: blur(5px);
                                            }
                                            .container2 {
                                               max-width: 600px;
                                margin: 0 auto;
                                padding: 20px;
                                background-size: cover;
                                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                                backdrop-filter: blur(5px);
                                            }
                                             .button {
                                border: none;
                                border-radius: 30px;
                                background-color: rgba(255, 255, 255, 0.5);
                                padding: 10px 35px;
                                text-align: center;
                                text-decoration: none;
                                display: inline-block;
                                font-size: 18px;
                                margin: 4px 2px;
                                transition-duration: 0.4s;
                                cursor: pointer;
                            }
                            .button:hover {
                                background: url(https://media.giphy.com/media/AdtB8TtizElk0OrRGR/giphy.gif);
                            }
                            .button2 {
                                background: url(https://media.giphy.com/media/emdlFGZyqmmk723pal/giphy.gif);
                                color: white;
                            }
                            .button2:hover {
                                background: url(https://media.giphy.com/media/PXApia9fVviiWREDRq/giphy.gif)			no-repeat center center;
                                color: white;
                            }
                                            p{
                                            color: #FFFFFF;
                                            
                                            }
                                            h3 {
                                                color: #FFFFFF;
                                            }
                                            ul {
                                                list-style-type: none;
                                                
                                                padding: 0;
                                            }
                                            li {
                                                margin-bottom: 10px;
                                                color: #FFFFFF
                                            }
                                            img {
                                                max-width: 50%;
                                                height: auto;
                                            }
                                        </style>
                                    </head>
                                    <body>
                                        <div class="container">
                                          <center> <img src="https://i.ibb.co/rtBrF0f/newlogo.png" alt="unnamed-Copy-removebg-preview" border="0"></center>
                                            <center><h3>You have successfully changed your password.<br>Login again with your new password to continue.</h3></center>
                                            <hr>
                                            <center>
                                            <p>Updated Password Details:</p>
                                            <ul>
                                                <li><strong>Old Password : </strong> ' . $oldPassword . '</li>
                                                <li><strong>New Password : </strong> ' . $newPassword . '</li>
                                                </center>
                                                <br>
                                                <li><strong>Ready to dive in? :</strong>&nbsp; &nbsp;&nbsp; <a href="http://xcobra.co/newXcard/customer/customerLogin.php"> <button class="button button2">Click here to log in</button> </a> </li>
                                            </ul>
                                            
                                            <hr>
                                            <p>This is an auto generated e-mail. Do not reply.</p>
                                            
                                        </div>
                                        <div class="container2">
                                        <p style="color: black;"><b>DISCLAIMER</b><br><br>
                    This e-mail is confidential. It may also be legally privileged. If you are not the intended recipient or have received it in error, please delete it and all copies from your system and notify the sender immediately by return e-mail. Any unauthorized reading, reproducing, printing or further dissemination of this e-mail or its contents is strictly  prohibited and may be unlawful. Internet communications cannot be guaranteed to be timely, secure, error or virus-free.
                    The sender does not accept liability for any errors or omissions.
                    </p>
                     </div>
                                    </body>
                                </html>';

                                    $mail->Body = $htmlBody;
                                    $mail->send();
                                    echo '<script>
                            console.log("JavaScript code executed");
                            Swal.fire({
                                icon: "success",
                                title: "Password updated successfully",
                                showConfirmButton: true,
                                timer: 3000
                            }).then(function() {
                                window.location.href = "../inc/logout.php";
                            });
                        </script>';

                                    // Redirect to a success page or do other actions
                                    exit();
                                } catch (Exception $e) {
                                    // Display an error message
                                    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
                                }

                            } else {
                                echo "Error updating password: " . $conn->error;
                            }
                        } else {
                            echo '<script>
                                console.log("JavaScript code executed");
                                Swal.fire({
                                    icon: "error",
                                    title: "New password and confirm password do not match",
                                    showConfirmButton: true,
                                    timer: 3000
                                });
                            </script>';
                        }
                    } else {
                        echo '<script>
                            console.log("JavaScript code executed");
                            Swal.fire({
                                icon: "error",
                                title: "Incorrect old password",
                                showConfirmButton: true,
                                timer: 3000
                            });
                        </script>';
                    }
                }

            }

            // Change Email Form Submission
            if (isset($_POST['oldEmail']) && isset($_POST['newEmail'])) {
                $oldEmail = $_POST['oldEmail'];
                $newEmail = $_POST['newEmail'];

                if ($oldEmail === $userDetails['Email']) {
                    $updateEmailSql = "UPDATE users SET Email = '$newEmail' WHERE userID = $userID";
                    if ($conn->query($updateEmailSql) === TRUE) {

                        $mail = new PHPMailer(true);

                                try {
                                    //Server settings
                                    $mail->isSMTP();
                                    $mail->Host = 'smtp.gmail.com'; // Your SMTP server
                                    $mail->SMTPAuth = true;
                                    $mail->Username = 'amkashan2@gmail.com'; // Your SMTP username
                                    $mail->Password = 'nnsczsllpjwzxeik'; // Your SMTP password
                                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption
                                    $mail->Port = 587; // TCP port to connect to
            
                                    //Recipients
                                    $mail->setFrom('amkashan2@gmail.com', 'XCobra');
                                    $mail->addAddress($userDetails['Email']);


                                    $mail->addCC($newEmail);

                                    // Content
                                    $mail->isHTML(true);
                                    $mail->Subject = 'Welcome to XCobra';
                                    $htmlBody = '<html>
                                    <head>
                                        <style>
                                            body {
                                                font-family: Arial, sans-serif;
                                               
                                                color: #333;
                                                margin: 0;
                                                padding: 0;
                                            }
                                            .container {
                                               max-width: 600px;
                                margin: 0 auto;
                                padding: 20px;
                                background: url(https://media.giphy.com/media/VUo8NNocdrUdHy8s7z/giphy.gif) no-repeat center center;
                                background-size: cover;
                                border-radius: 30px;
                                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                                backdrop-filter: blur(5px);
                                            }
                                            .container2 {
                                               max-width: 600px;
                                margin: 0 auto;
                                padding: 20px;
                                background-size: cover;
                                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                                backdrop-filter: blur(5px);
                                            }
                                             .button {
                                border: none;
                                border-radius: 30px;
                                background-color: rgba(255, 255, 255, 0.5);
                                padding: 10px 35px;
                                text-align: center;
                                text-decoration: none;
                                display: inline-block;
                                font-size: 18px;
                                margin: 4px 2px;
                                transition-duration: 0.4s;
                                cursor: pointer;
                            }
                            .button:hover {
                                background: url(https://media.giphy.com/media/AdtB8TtizElk0OrRGR/giphy.gif);
                            }
                            .button2 {
                                background: url(https://media.giphy.com/media/emdlFGZyqmmk723pal/giphy.gif);
                                color: white;
                            }
                            .button2:hover {
                                background: url(https://media.giphy.com/media/PXApia9fVviiWREDRq/giphy.gif)			no-repeat center center;
                                color: white;
                            }
                                            p{
                                            color: #FFFFFF;
                                            
                                            }
                                            h3 {
                                                color: #FFFFFF;
                                            }
                                            ul {
                                                list-style-type: none;
                                                
                                                padding: 0;
                                            }
                                            li {
                                                margin-bottom: 10px;
                                                color: #FFFFFF
                                            }
                                            img {
                                                max-width: 50%;
                                                height: auto;
                                            }
                                        </style>
                                    </head>
                                    <body>
                                        <div class="container">
                                          <center> <img src="https://i.ibb.co/rtBrF0f/newlogo.png" alt="unnamed-Copy-removebg-preview" border="0"></center>
                                            <center><h3>You have successfully changed your Email Address.<br>Login again with your new Email address to continue.</h3></center>
                                            <hr>
                                            <center>
                                            <p>Updated Email Details:</p>
                                            <ul>
                                                <li><strong>Old Email : </strong> ' . $oldEmail . '</li>
                                                <li><strong>New Email : </strong> ' . $newEmail . '</li>
                                                </center>
                                                <br>
                                                <li><strong>Ready to dive in? :</strong>&nbsp; &nbsp;&nbsp; <a href="http://xcobra.co/newXcard/customer/customerLogin.php"> <button class="button button2">Click here to log in</button> </a> </li>
                                            </ul>
                                            
                                            <hr>
                                            <p>This is an auto generated e-mail. Do not reply.</p>
                                            
                                        </div>
                                        <div class="container2">
                                        <p style="color: black;"><b>DISCLAIMER</b><br><br>
                    This e-mail is confidential. It may also be legally privileged. If you are not the intended recipient or have received it in error, please delete it and all copies from your system and notify the sender immediately by return e-mail. Any unauthorized reading, reproducing, printing or further dissemination of this e-mail or its contents is strictly  prohibited and may be unlawful. Internet communications cannot be guaranteed to be timely, secure, error or virus-free.
                    The sender does not accept liability for any errors or omissions.
                    </p>
                     </div>
                                    </body>
                                </html>';

                                    $mail->Body = $htmlBody;
                                    $mail->send();
                                    echo '<script>
                                Swal.fire({
                                    icon: "success",
                                    title: "Email updated successfully",
                                    showConfirmButton: true,
                                    timer: 3000
                                }).then(function() {
                                        window.location.href = "../inc/logout.php";
                                });
                            </script>';
                                    // Redirect to a success page or do other actions
                                    exit();
                                } catch (Exception $e) {
                                    // Display an error message
                                    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
                                }
                        
                        
                    } else {
                        echo '<script>
                                Swal.fire({
                                    icon: "error",
                                    title: "Error updating email",
                                    showConfirmButton: true,
                                    timer: 3000
                                });
                            </script>';
                    }
                } else {
                    echo '<script>
                            Swal.fire({
                                icon: "error",
                                title: "Incorrect old email",
                                showConfirmButton: true,
                                timer: 3000
                            });
                        </script>';
                }
            }

            if (isset($_POST['back_color'])) {

                $backColor = $_POST['back_color'];

                $sql = "UPDATE users SET Back = '$backColor' WHERE userID = $userID";

                if ($conn->query($sql) === TRUE) {
                    echo '<script>
                                        console.log("JavaScript code executed");
                                        Swal.fire({
                                            icon: "success",
                                            title: "Background updated successfully",
                                            showConfirmButton: true,
                                            timer: 3000
                                        });
                                    </script>';
                } else {
                    echo "Error updating record: " . $conn->error;
                }
            }

            $conn->close();

            ?>
        </div>
    </div>
</body>

</html>