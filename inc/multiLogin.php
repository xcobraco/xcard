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
    $enteredUsername = $_POST["email1"];
    $enteredPassword = $_POST["password1"];

    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare("SELECT UserID FROM users WHERE Email = ? AND Password = ?");
    $stmt->bind_param("ss", $enteredUsername, $enteredPassword);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the query returned a row (valid credentials)
    if ($result->num_rows > 0) {
        // Fetch the user ID
        $row = $result->fetch_assoc();
        $userID = $row['UserID'];

        // Start the session
        session_start();
        
        // Store the user ID in the session variable
        $_SESSION['userID'] = $userID;

        // Redirect to the home page
        header("Location: ../customer/customerDashboard.php");
        exit();
    } else {
        // Display SweetAlert for invalid credentials
        
        echo '<script>
          alert("Incorrect credentials");
        </script>';
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="https://i.ibb.co/80NLFyw/Whats-App-Image-2024-02-16-at-13-49-42.jpg" type="image/x-icon">
  <link rel="stylesheet" href="styles.css">
  <title>Welcome to XCobra</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.20/dist/sweetalert2.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.20/dist/sweetalert2.all.min.js"></script>
  <style>
    @import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700,800,900');

    body {
      font-family: 'Poppins', sans-serif;
      font-weight: 300;
      font-size: 15px;
      line-height: 1.7;
      color: #ffffff;
      background-color: #1f2029;
      overflow-x: hidden;

      min-height: 100vh;
      background-image: url(https://i.ibb.co/7jmTcQt/sofindd-fp-12-11-2023-303.png);
      background-repeat: no-repeat;
      background-position: center;
      background-size: cover;
    }

    a {
      cursor: pointer;
      transition: all 200ms linear;
    }

    a:hover {
      text-decoration: none;
    }

    .link {
      color: #c4c3ca;
    }

    .link:hover {
      color: #ffeba7;
    }

    p {
      font-weight: 500;
      font-size: 14px;
      line-height: 1.7;
    }

    h4 {
      font-weight: 600;
    }

    h6 span {
      padding: 0 20px;
      text-transform: uppercase;
      font-weight: 700;
    }

    .section {
      position: center;
      width: 100%;
      display: block;
    }

    .full-height {
      min-height: 100vh;
    }

    [type="checkbox"]:checked,
    [type="checkbox"]:not(:checked) {
      position: absolute;
      left: -9999px;
    }

    .checkbox:checked+label,
    .checkbox:not(:checked)+label {
      position: relative;
      display: block;
      text-align: center;
      width: 60px;
      height: 16px;
      border-radius: 8px;
      padding: 0;
      margin: 10px auto;
      cursor: pointer;
      background-color: #747474;
    }

    .checkbox:checked+label:before,
    .checkbox:not(:checked)+label:before {
      position: absolute;
      display: block;
      width: 36px;
      height: 36px;
      border-radius: 50%;
      color: #000000;
      background-color: #ffffff;
      font-family: 'unicons';
      content: '\eb4f';
      z-index: 20;
      top: -10px;
      left: -10px;
      line-height: 36px;
      text-align: center;
      font-size: 24px;
      transition: all 0.5s ease;
    }

    .checkbox:checked+label:before {
      transform: translateX(44px) rotate(-270deg);
    }


    .card-3d-wrap {
      position: relative;
      width: 440px;
      max-width: 100%;
      height: 400px;
      -webkit-transform-style: preserve-3d;
      transform-style: preserve-3d;
      perspective: 800px;
      margin-top: 60px;
    }

    .card-3d-wrapper {
      width: 100%;
      height: 100%;
      position: absolute;
      top: 0;
      left: 0;
      -webkit-transform-style: preserve-3d;
      transform-style: preserve-3d;
      transition: all 600ms ease-out;
    }

    .card-front,
    .card-back {
      width: 100%;
      height: 100%;
      background-color: #0f063a;
      background-image: url('https://media.giphy.com/media/v1.Y2lkPTc5MGI3NjExa2ExZjJkdzVzOG15bmF0OWE5NHNtbnVzc3FqdzZ5cnN0cWJhNzVwNSZlcD12MV9pbnRlcm5hbF9naWZfYnlfaWQmY3Q9Zw/ID1EbzxPaFBpQ773Zp/giphy.gif');
      background-position: bottom center;
      background-repeat: no-repeat;
      background-size: 162%;
      position: absolute;
      border-radius: 6px;
      left: 0;
      top: 0;
      -webkit-transform-style: preserve-3d;
      transform-style: preserve-3d;
      -webkit-backface-visibility: hidden;
      -moz-backface-visibility: hidden;
      -o-backface-visibility: hidden;
      backface-visibility: hidden;
    }

    .card-back {
      transform: rotateY(180deg);
    }

    .checkbox:checked~.card-3d-wrap .card-3d-wrapper {
      transform: rotateY(180deg);
    }

    .center-wrap {
      position: absolute;
      width: 100%;
      padding: 0 10px;
      top: 50%;
      left: 0;
      transform: translate3d(0, -50%, 35px) perspective(100px);
      z-index: 20;
      display: block;
    }


    .form-group {
      position: relative;
      display: block;
      margin: 0;
      padding: 0;
    }

    .form-style {
      padding: 13px 20px;
      padding-left: 55px;
      height: 48px;
      width: 68%;
      font-weight: 500;
      border-radius: 4px;
      font-size: 14px;
      line-height: 22px;
      letter-spacing: 0.5px;
      outline: none;
      color: #c4c3ca;
      background-color: #ffffff30;
      border: none;
      -webkit-transition: all 200ms linear;
      transition: all 200ms linear;
      box-shadow: 0 4px 8px 0 rgba(21, 21, 21, .2);
    }

    .form-style:focus,
    .form-style:active {
      border: none;
      outline: none;
      box-shadow: 0 4px 8px 0 rgba(21, 21, 21, .2);
    }

    .input-icon {
      position: absolute;
      top: 0;
      left: 18px;
      height: 48px;
      font-size: 24px;
      line-height: 48px;
      text-align: left;
      color: #ffeba7;
      -webkit-transition: all 200ms linear;
      transition: all 200ms linear;
    }

    .form-group input:-ms-input-placeholder {
      color: #c4c3ca;
      opacity: 0.7;
      -webkit-transition: all 200ms linear;
      transition: all 200ms linear;
    }

    .form-group input::-moz-placeholder {
      color: #c4c3ca;
      opacity: 0.7;
      -webkit-transition: all 200ms linear;
      transition: all 200ms linear;
    }

    .form-group input:-moz-placeholder {
      color: #c4c3ca;
      opacity: 0.7;
      -webkit-transition: all 200ms linear;
      transition: all 200ms linear;
    }

    .form-group input::-webkit-input-placeholder {
      color: #c4c3ca;
      opacity: 0.7;
      -webkit-transition: all 200ms linear;
      transition: all 200ms linear;
    }

    .form-group input:focus:-ms-input-placeholder {
      opacity: 0;
      -webkit-transition: all 200ms linear;
      transition: all 200ms linear;
    }

    .form-group input:focus::-moz-placeholder {
      opacity: 0;
      -webkit-transition: all 200ms linear;
      transition: all 200ms linear;
    }

    .form-group input:focus:-moz-placeholder {
      opacity: 0;
      -webkit-transition: all 200ms linear;
      transition: all 200ms linear;
    }

    .form-group input:focus::-webkit-input-placeholder {
      opacity: 0;
      -webkit-transition: all 200ms linear;
      transition: all 200ms linear;
    }

    .btn {
      border-radius: 4px;
      height: 44px;
      font-size: 13px;
      font-weight: 600;
      text-transform: uppercase;
      -webkit-transition: all 200ms linear;
      transition: all 200ms linear;
      padding: 0 30px;
      letter-spacing: 1px;
      display: -webkit-inline-flex;
      display: -ms-inline-flexbox;
      display: inline-flex;
      -webkit-align-items: center;
      -moz-align-items: center;
      -ms-align-items: center;
      align-items: center;
      -webkit-justify-content: center;
      -moz-justify-content: center;
      -ms-justify-content: center;
      justify-content: center;
      -ms-flex-pack: center;
      text-align: center;
      border: none;
      background-color: #000;
      color: #ffffff;
      box-shadow: 0 8px 24px 0 rgba(255, 235, 167, .2);
    }

    .btn:active,
    .btn:focus {
      background-color: #ffffff;
      color: #000;
      box-shadow: 0 8px 24px 0 rgba(16, 39, 112, .2);
    }

    .btn:hover {
      background-color: #ffffff;
      color: #000;
      box-shadow: 0 8px 24px 0 rgba(16, 39, 112, .2);
    }

    .logo {
      position: absolute;
      top: 30px;
      right: 30px;
      display: block;
      z-index: 100;
      transition: all 250ms linear;
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
    @media only screen and (max-width: 600px) {
    body {
        background-image: url(https://i.ibb.co/17FDV88/Artboard-1.png);
}
.card-front,
    .card-back {
      width: 100%;
      height: 100%;
      background-color: #0f063a;
      background-image: url('https://media.giphy.com/media/v1.Y2lkPTc5MGI3NjExa2ExZjJkdzVzOG15bmF0OWE5NHNtbnVzc3FqdzZ5cnN0cWJhNzVwNSZlcD12MV9pbnRlcm5hbF9naWZfYnlfaWQmY3Q9Zw/ID1EbzxPaFBpQ773Zp/giphy.gif');
      background-position: bottom center;
      background-repeat: no-repeat;
      background-size: 200%;
      position: absolute;
      border-radius: 6px;
      left: 0;
      top: 0;
      -webkit-transform-style: preserve-3d;
      transform-style: preserve-3d;
      -webkit-backface-visibility: hidden;
      -moz-backface-visibility: hidden;
      -o-backface-visibility: hidden;
      backface-visibility: hidden;
    }
}

  </style>

</head>

<body>
  <center>
    <div class="section">
      <div class="container">
        <div class="row full-height justify-content-center">`
         
          <div class="col-12 text-center align-self-center py-5">
          <img src="https://i.ibb.co/VLqmwCR/gold-logo.png"width="230" height="100" >
            <div class="section pb-5 pt-5 pt-sm-2 text-center">
              <h6 class="mb-0 pb-3"><span>Customer</span><span>Pet</span></h6>
              <input class="checkbox" type="checkbox" id="reg-log" name="reg-log" />
              <label for="reg-log"></label>
              <div class="card-3d-wrap mx-auto">
                <div class="card-3d-wrapper">
                  <div class="card-front">
                    <div class="center-wrap">
                      <div class="section text-center">
                        <h4 class="mb-4 pb-3">Customer Login</h4>

                        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" onsubmit="return validateForm()">

                          <div class="inputbox">
                            <input type="email" id="email" name="email1" class="form-style" required
                              placeholder="Your Email">
                          </div><br>

                          <div class="inputbox">
                            <input type="password" id="password" name="password1" class="form-style"
                              placeholder="Your Password">
                          </div>
                          <br>
                          <button type="submit" class="btn btn-success">Login</button><br><br>

                          <p>Don't have an account? <a href="../BuySite/index.php" class="link-info">Buy here</a></p>
                        </form>
                      </div>
                    </div>
                  </div>
                  <div class="card-back">
                    <div class="center-wrap">
                      <div class="section text-center">
                        <h4 class="mb-4 pb-3"> Pet Tag</h4>
                        <h4>Welcome to our future-ready product, where innovation meets seamless functionality!</h4><br><p>

Introducing an innovative NFC (Near Field Communication) pet tag for enhanced convenience and security in pet ownership. This advanced technology lets you easily connect crucial details about your pet directly to their tag.</p>
                        <h3 style="color: red;">Coming Soon...</h3>
                      <div hidden>
                        
                        <form method="post" action="../pet/petLogin.php" onsubmit="return validateForm()">

                          <div class="inputbox">
                            <input type="email" id="email" name="email1" class="form-style" required
                              placeholder="Your Email">
                          </div><br>

                          <div class="inputbox">
                            <input type="password" id="password" name="password1" class="form-style"
                              placeholder="Your Password">
                          </div>
                          <br>
                          <button type="submit" class="btn btn-success">Login</button><br><br>

                          <p>Don't have an account? <a href="#" class="link-info">Buy here</a></p>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </center>
  <footer class="footer">
    <p>&copy; 2023 Xcobra. All rights reserved.</p>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.20/dist/sweetalert2.all.min.js"></script>


</body>

</html>

