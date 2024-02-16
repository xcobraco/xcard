<?php
// Assuming your database credentials
include '../inc/connection.php';

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Escape user inputs to prevent SQL injection
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $subject = mysqli_real_escape_string($conn, $_POST['subject']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);

    // Insert data into the database
    $sql = "INSERT INTO contact (Name, Email, Subject, Message, Review_Status) VALUES ('$name', '$email', '$subject', '$message', 'Pending')";

    if ($conn->query($sql) === TRUE) {
        // Successful insertion
        echo '<script>showSuccessAlert();</script>';
        } else {
        // Display an error message
        echo '<script>showErrorAlert();</script>';
        echo "Error: " . $conn->error . "<br>SQL: " . $sql;
    }
}

// Close the connection
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>SynerX - XCobra</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500&family=Jost:wght@500;600;700&display=swap" rel="stylesheet"> 

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.20/dist/sweetalert2.all.min.js"></script>
    <script>
        function showSuccessAlert() {
            console.log("JavaScript code executed");
            Swal.fire({
                icon: "success",
                title: "Data inserted successfully",
                showConfirmButton: true,
                timer: 3000
            }).then(() => {
                window.location.href = "index.html";
            });
        }

        function showErrorAlert() {
            console.log("JavaScript code executed");
            Swal.fire({
                icon: "error",
                title: "Error occurred",
                text: "There was an error inserting data",
                showConfirmButton: true
            });
        }
    </script>




    <style>

        :root {

            --glitter: url("https://assets.codepen.io/13471/silver-glitter-background.png");
            --duration: 6.66s;
          
          }
          
          .card-front:before {
          
            content: "";
            inset: 0;
            position: absolute;
            transform: translate3d(0, 0, 0.01px);
          
            background-image: var(--glitter), var(--glitter),
              linear-gradient(120deg, black 25%, white, black 75%);
            background-size: 100% 100%, 80% 80%, 200% 200%;
            background-blend-mode: multiply, multiply, overlay;
            background-position: 50% 50%, 50% 50%, 50% 50%;
          
            mix-blend-mode: color-dodge;
            filter: brightness(2) contrast(0.8);
          
            animation: bg var(--duration) ease infinite;
          
          }
          
          .card-front {
          
            display: grid;
            position: relative;
            transform: translate3d(0, 0, 0.01px);
            width: 90vw;
            max-width: 580px;
            aspect-ratio: 3/2;
          
            border-radius: 3.5% 3.5% 3.5% 3.5% / 5% 5% 5% 5%;
          
            background-image: url(https://simey-credit-card.netlify.app/img/bgs/default.jpg);
            background-size: cover;
          
            box-shadow: 0 30px 40px -25px rgba(15, 5, 20, 1), 0 20px 50px -15px rgba(15, 5, 20, 1);
            overflow: hidden;
            animation: tilt var(--duration) ease infinite;
            image-rendering: optimizequality;
          
          }
          
          .card-front:after {
            
            content: "";
            background: none, none, linear-gradient(125deg, rgba(255,255,255,0) 0%, rgba(255,255,255,.4) 0.1%, rgba(255,255,255,0) 60%);
            background-size: 200% 200%;
            mix-blend-mode: hard-light;
            animation: bg var(--duration) ease infinite;
            
          }
          
          
          
          
          
          
          .card-front * {
          
            font-family: PT Mono, monospace;
          
          }
          
          .cardLogo,
          .expiry,
          .name,
          .number,
          .chip,
          .icon {
          
            color: #ccc;
            position: absolute;
            margin: 0;
            padding: 0;
            letter-spacing: 0.075em;
            text-transform: uppercase;
            font-size: clamp(0.75rem, 2.8vw + 0.2rem, 1.1rem);
            inset: 5%;
            text-shadow: -1px -1px 0px rgba(255,255,255,0.5),1px -1px 0px rgba(255,255,255,0.5),1px 1px 0px rgba(0,0,0,0.5),1px -1px 0px rgba(0,0,0,0.5);
            z-index: 5;
          
          }
          
          .name, .number, .expiry {
            background-image: linear-gradient(to bottom, #ededed 20%, #bababa 70%), none,
              linear-gradient(120deg, transparent 10%, white 40%, white 60%, transparent 90%);
            background-size: cover, cover, 200%;
            background-position: 50% 50%;
            background-blend-mode: overlay;
            -webkit-text-fill-color: transparent;
            -webkit-background-clip: text;
            animation: bg var(--duration) ease infinite;
            
          }
          
          .number {
          
            font-family: PT Mono, monospace;
            text-align: center;
            font-size: clamp(1rem, 8vw - 0.5rem, 2.5rem);
            letter-spacing: 0.025em;
            top: 40%;
            bottom: auto;
          
          }
          .expiry,
          .name {
          
            top: auto;
          
          }
          
          .name {
          
            font-family: PT Mono, monospace;
            text-align: center;
            font-size: clamp(1rem, 2vw - 0.5rem, 2.5rem);
            letter-spacing: 0.025em;
            top: 60%;
            bottom: auto;
          
          }
          
          .expiry {
          
            left: auto;
          
          }
          
          .cardLogo {
          
            bottom: auto;
            left: auto;
            width: 15%;
            filter: invert(1) saturate(0) brightness(1) contrast(1.2);
            mix-blend-mode: screen;
          
          }
          #r1:hover{
            transform: scale(1.2);
            transition: all ease 0.3s;
          }
          
          .chip {
          
            display: grid;
            place-items: center;
            width: 14%;
            aspect-ratio: 5/4;
            left: 10%;
            top: 30%;
            border-radius: 10% 10% 10% 10% / 15% 15% 15% 15%;
          
            background-image: none, none,
              linear-gradient(120deg, #777 10%, #ddd 40%, #ddd 60%, #777 90%);
            background-size: 200% 200%;
            background-position: 50% 50%;
          
            overflow: hidden;
            animation: bg var(--duration) ease infinite;
          
          }
          
          
          
          
          
          
          
          
          
          
          
          
          
          .chip svg {
          
            display: block;
            width: 90%;
            fill: none;
            stroke: #444;
            stroke-width: 2;
          
          }
          
          .contactless {
          
            position: absolute;
            left: 23%;
            top: 30%;
            width: 12%;
            rotate: 90deg;
          
            stroke-width: 1.25;
            stroke: currentColor;
            fill: none;
            stroke-linecap: round;
            stroke-linejoin: round;
            opacity: 0.5;
          
          }
          
          .icon {
          
            width: 25%;
            bottom: auto;
            right: auto;
            top: 0;
            left: 15px;
            filter: invert(1) hue-rotate(180deg) saturate(5) contrast(2);
          
          }
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          @keyframes tilt {
          
            0%, 100% { transform: translate3d(0, 0, 0.01px) rotateY(-20deg) rotateX(5deg); }
            50% { transform: translate3d(0, 0, 0.01px) rotateY(20deg) rotateX(5deg); }
          
          }
          
          @keyframes bg {
          
            0%, 100% { background-position: 50% 50%, calc(50% + 1px) calc(50% + 1px), 0% 50%; }
            50% { background-position: 50% 50%, calc(50% - 1px) calc(50% - 1px), 100% 50%; }
          
          }
          
          
          main {
          
            display: grid;
            grid-template-rows: minmax(20px,100px) 1fr;
            place-items: center;
            min-height: 100%;
            perspective: 1000px;
          
          }
          
         
          
          body,
          html {
          
            height: 100%;
            padding: 0;
            margin: 0;
          
          }
          
          #chip,
          #contactless {
          
            display: none;
          
          }
          
       
    </style>    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

</head>

<body data-bs-spy="scroll" data-bs-target=".navbar" data-bs-offset="51">
    <div class="container-xxl bg-white p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-grow text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Navbar & Hero Start -->
        <div class="container-xxl position-relative p-0" id="home">
            <nav class="navbar navbar-expand-lg navbar-light px-4 px-lg-5 py-3 py-lg-0">
                <a href="" class="navbar-brand p-0">
                    <h1 class="m-0"><img src="https://i.ibb.co/VLqmwCR/gold-logo.png" height="60px" alt="XCobra Logo"></h1>
                    <!-- <img src="img/logo.png" alt="Logo"> -->
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="fa fa-bars"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav mx-auto py-0">
                        <a href="#home" class="nav-item nav-link active">Home</a>
                        <a href="#about" class="nav-item nav-link">About Card</a>
                        <a href="#feature" class="nav-item nav-link">Card Type</a>
                        <a href="#pricing" class="nav-item nav-link">Pricing</a>
                        <a href="#contact" class="nav-item nav-link">Contact</a>
                    </div>
                    <a href="../inc/multiLogin.php" class="btn btn-primary-gradient rounded-pill py-2 px-4 ms-3">Login</a>
                </div>
            </nav>

            <div class="container-xxl hero-header">
                <div class="container px-lg-5">
                    <div class="row g-5">
                        <div class="col-lg-8 text-center text-lg-start">
                            <h1 class="text-white mb-4 animated slideInDown"> SynerX Smart Card </h1>
                            <p class="text-white pb-3 animated slideInDown">Your Smart Business Card, offering you unparalleled customization for a card that's as unique as your business. Elevate your networking game with limitless possibilities</p>
                            <a href="order.php" class="btn btn-primary-gradient py-sm-3 px-4 px-sm-5 rounded-pill me-3 animated slideInLeft">Buy Now</a>
                            <a href="#contact" class="btn btn-secondary-gradient py-sm-3 px-4 px-sm-5 rounded-pill animated slideInRight">Contact Us</a>
                        </div>
                        <div class="col-lg-4 d-flex justify-content-center justify-content-lg-end wow fadeInUp" data-wow-delay="0.3s">
                            <div class="owl-carousel screenshot-carousel">
                                <img class="img-fluid" src="https://i.ibb.co/tsYmV2d/p1.png" alt="">
                                <img class="img-fluid" src="https://i.ibb.co/xjMZD0b/hgjhj.png" alt="">
                                <img class="img-fluid" src="https://i.ibb.co/tbChq1r/sdfvfvsd.png" alt="">
                                <img class="img-fluid" src="https://i.ibb.co/DQpRhqt/sdvsdvs.png" alt="">
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
        <!-- Navbar & Hero End -->

        <!-- About Start -->
        <div class="container-xxl py-5" id="about">
            <div class="container py-5 px-lg-5">
                <div class="row g-5 align-items-center">
                    <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                        <h5 class="text-primary-gradient fw-medium"></h5>
                        <h1 class="mb-4">About Card</h1>
                        <p class="mb-4">Empowering Connections, Embracing Innovation: Embark on a transformative journey with us as we reshape the landscape of networking through cutting-edge technology.<br><br>
<b>•	Next-Gen NFC Technology:</b> Seamlessly share information with a simple tap.<br>
<b>•	Unmatched Durability:</b> Dustproof and waterproof for reliability in any environment.<br>
<b>•	Contactless Efficiency:</b> Simplify information exchange with convenient, contactless interactions.<br>
<b>•	Environmental Responsibility:</b> Reusable and durable solutions for a sustainable choice.<br>
                        <div class="row g-4 mb-4">
                            <div class="col-sm-6 wow fadeIn" data-wow-delay="0.5s" hidden>
                                <div class="d-flex">
                                    <i class="fa fa-cogs fa-2x text-primary-gradient flex-shrink-0 mt-1"></i>
                                    <div class="ms-3">
                                        <h2 class="mb-0" data-toggle="counter-up">150</h2>
                                        <p class="text-primary-gradient mb-0">Active user</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 wow fadeIn" data-wow-delay="0.7s" hidden>
                                <div class="d-flex">
                                    <i class="fa fa-comments fa-2x text-secondary-gradient flex-shrink-0 mt-1"></i>
                                    <div class="ms-3">
                                        <h2 class="mb-0" data-toggle="counter-up">100</h2>
                                        <p class="text-secondary-gradient mb-0">Clients Reviews</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                       
                    </div>
                    <div class="col-lg-6">
                        <img class="img-fluid wow fadeInUp" data-wow-delay="0.5s" src="img/bgrm.png">
                    </div>
                </div>
            </div>
        </div>
        <!-- About End -->


        <!-- Features Start -->
        <div class="container-xxl py-5" id="feature">
            <div class="container py-5 px-lg-5">
                <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                    
                    <h1 class="mb-5">Card Type</h1>
                </div>
                <div class="row g-4">
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="feature-item bg-light rounded p-4">
                            <div class="d-inline-flex align-items-center justify-content-center bg-primary-gradient rounded-circle mb-4" style="width: 60px; height: 60px;">
                            <i class="fa fa-layer-group text-white fs-4"></i>                            </div>
                            <h5 class="mb-3">Classic White Card</h5>
                            <img class="img-fluid wow fadeInUp" data-wow-delay="0.5s" src="img/bgr1 (4).png">
                            <center><h4 class="mb-3">LKR 3200.00</h4></center>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                        <div class="feature-item bg-light rounded p-4">
                            <div class="d-inline-flex align-items-center justify-content-center bg-secondary-gradient rounded-circle mb-4" style="width: 60px; height: 60px;">
                                <i class="fa fa-layer-group text-white fs-4"></i>
                            </div>
                            <h5 class="mb-3">Classic Black Card</h5>
                            <img class="img-fluid wow fadeInUp" data-wow-delay="0.5s" src="img/bgr1 (5).png">
                            <center><h4 class="mb-3">LKR 3600.00</h4></center>                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                        <div class="feature-item bg-light rounded p-4">
                            <div class="d-inline-flex align-items-center justify-content-center bg-primary-gradient rounded-circle mb-4" style="width: 60px; height: 60px;">
                            <i class="fa fa-shield-alt text-white fs-4"></i>
                            </div>
                            <h5 class="mb-3">Company White Card</h5>
                            <img class="img-fluid wow fadeInUp" data-wow-delay="0.5s" src="img/bgr1 (1).png">           
                            <center><h4 class="mb-3">LKR 4500.00</h4></center>             </div>
                    </div>
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="feature-item bg-light rounded p-4">
                            <div class="d-inline-flex align-items-center justify-content-center bg-secondary-gradient rounded-circle mb-4" style="width: 60px; height: 60px;">
                                <i class="fa fa-shield-alt text-white fs-4"></i>
                            </div>
                            <h5 class="mb-3">Company Black Card</h5>
                            <img class="img-fluid wow fadeInUp" data-wow-delay="0.5s" src="img/bgr1 (3).png">           
                            <center><h4 class="mb-3">LKR 4700.00</h4></center>             </div>
                    </div>
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                        <div class="feature-item bg-light rounded p-4">
                            <div class="d-inline-flex align-items-center justify-content-center bg-primary-gradient rounded-circle mb-4" style="width: 60px; height: 60px;">
                            <i class="fa fa-edit text-white fs-4"></i>
                            </div>
                            <h5 class="mb-3">Custom Card</h5>
                            <img class="img-fluid wow fadeInUp" data-wow-delay="0.5s" src="img/bgr1 (2).png">           
                            <center><h4 class="mb-3">LKR 5300.00</h4></center>             </div>
                    </div>
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                        <div class="feature-item bg-light rounded p-4">
                            <div class="d-inline-flex align-items-center justify-content-center bg-secondary-gradient rounded-circle mb-4" style="width: 60px; height: 60px;">
                            <i class="fa fa-edit text-white fs-4"></i>
                            </div>
                            <h5 class="mb-3">Custom Card [Custom Profile]</h5>
                            <img class="img-fluid wow fadeInUp" data-wow-delay="0.5s" src="img/bgr1 (6).png">            
                        <center><h4 class="mb-3">LKR 6200.00</h4></center>            </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Features End -->


        <!-- Screenshot Start -->
        <div class="container-xxl py-5">
            <div class="container py-5 px-lg-5">
                <div class="row g-5 align-items-center">
                    <div class="col-lg-8 wow fadeInUp" data-wow-delay="0.1s">
                        <h5 class="text-primary-gradient fw-medium">Screenshot</h5>
                        <h1 class="mb-4">User Friendly interface And Very Easy To Use </h1>
                        <p class="mb-4">Experience ease and comfort with our interface! It's designed to be straightforward and welcoming, so you can quickly find what you need. Enjoy a smooth, fast, and familiar journey, perfect for everyone.</p>
                        <p><i class="fa fa-check text-primary-gradient me-3"></i>Requiring minimal effort from users to complete transactions or gain access.</p>
                        <p><i class="fa fa-check text-primary-gradient me-3"></i>The tap-and-go functionality simplifies the user experience.</p>
                        <p class="mb-4"><i class="fa fa-check text-primary-gradient me-3"></i>Can be easily integrated into different devices and systems.</p>
                        <a href="" class="btn btn-primary-gradient py-sm-3 px-4 px-sm-5 rounded-pill mt-3">Buy Now</a>
                    </div>
                    <div class="col-lg-4 d-flex justify-content-center justify-content-lg-end wow fadeInUp" data-wow-delay="0.3s">
                        <div class="owl-carousel screenshot-carousel">
                            <img class="img-fluid" src="https://i.ibb.co/wN5C2Kj/dddd.png" alt="">
                            <img class="img-fluid" src="https://i.ibb.co/wYBJfZ8/dddssd.png" alt="">
                            <img class="img-fluid" src="https://i.ibb.co/2SL9v70/gbfdvdvs.png" alt="">
                            <img class="img-fluid" src="https://i.ibb.co/MSjYBhK/hgj.png" alt="">
                            <img class="img-fluid" src="https://i.ibb.co/Ln5qBt4/fevefve.png" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Screenshot End -->


        <!-- Process Start -->
        <div class="container-xxl py-5">
            <div class="container py-5 px-lg-5">
                <div class="text-center pb-4 wow fadeInUp" data-wow-delay="0.1s">
                    <h5 class="text-primary-gradient fw-medium">How It Works</h5>
                    <h1 class="mb-5">3 Easy Steps</h1>
                </div>
                <div class="row gy-5 gx-4 justify-content-center">
                    <div class="col-lg-4 col-sm-6 text-center pt-4 wow fadeInUp" data-wow-delay="0.1s" id="r1">
                        <div class="position-relative bg-light rounded pt-5 pb-4 px-4">
                            <div class="d-inline-flex align-items-center justify-content-center bg-primary-gradient rounded-circle position-absolute top-0 start-50 translate-middle shadow" style="width: 100px; height: 100px;">
                                <i class="fa fa-cog fa-3x text-white"></i>
                            </div>
                            <h5 class="mt-4 mb-3">Login to yours</h5>
                            <p class="mb-0">Login to the system with the user credentials which you recieved.</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 text-center pt-4 wow fadeInUp" data-wow-delay="0.3s" id="r1">
                        <div class="position-relative bg-light rounded pt-5 pb-4 px-4">
                            <div class="d-inline-flex align-items-center justify-content-center bg-secondary-gradient rounded-circle position-absolute top-0 start-50 translate-middle shadow" style="width: 100px; height: 100px;">
                                <i class="fa fa-address-card fa-3x text-white"></i>
                            </div>
                            <h5 class="mt-4 mb-3">Setup Your Profile</h5>
                            <p class="mb-0">Update the account with your real details and also you can apply a nice picture of yours too.</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 text-center pt-4 wow fadeInUp" data-wow-delay="0.5s" id="r1">
                        <div class="position-relative bg-light rounded pt-5 pb-4 px-4">
                            <div class="d-inline-flex align-items-center justify-content-center bg-primary-gradient rounded-circle position-absolute top-0 start-50 translate-middle shadow" style="width: 100px; height: 100px;">
                                <i class="fa fa-check fa-3x text-white"></i>
                            </div>
                            <h5 class="mt-4 mb-3">Tap n Go !</h5>
                            <p class="mb-0">Connect with others with your contact info and social media.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Process Start -->


        <main id=app>
  
            <br>
              
              <aside class="card-front">
                <label class="number" for="cardNumber">
                  Ashan pramodya
                </label>
                <label class="name" for="cardHolder">
                  Managing Directer-Xcobra
                </label>
                <label class="expiry" for="expiryMonth" >
                  Powerd by Xcobra
                </label>
               
                
                  
                
                <svg class="contactless" role="img" viewBox="0 0 24 24" aria-label="Contactless">
                  <use href="#contactless">
                </svg>
                
              </aside>
              
            </main>
            
      
            <svg id="chip">
              <g id="chip-lines">
                <polyline points="0,50 35,50"></polyline>
                <polyline points="0,20 20,20 35,35"></polyline>
                <polyline points="50,0 50,35"></polyline>
                <polyline points="65,35 80,20 100,20"></polyline>
                <polyline points="100,50 65,50"></polyline>
                <polyline points="35,35 65,35 65,65 35,65 35,35"></polyline>
                <polyline points="0,80 20,80 35,65"></polyline>
                <polyline points="50,100 50,65"></polyline>
                <polyline points="65,65 80,80 100,80"></polyline>
              </g>
            </svg>
            
            
            <svg id="contactless">
               <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
               <path d="M9.172 15.172a4 4 0 0 1 5.656 0"></path>
               <path d="M6.343 12.343a8 8 0 0 1 11.314 0"></path>
               <path d="M3.515 9.515c4.686 -4.687 12.284 -4.687 17 0"></path>
            </svg>


        <!-- Pricing Start -->
        <div class="container-xxl py-5" id="pricing">
            <div class="container py-5 px-lg-5">
                <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                    <h5 class="text-primary-gradient fw-medium">Pricing Plan</h5>
                    <h1 class="mb-5">Choose Your Plan</h1>
                </div>
                <div class="tab-class text-center pricing wow fadeInUp" data-wow-delay="0.1s">
                    <ul class="nav nav-pills d-inline-flex justify-content-center bg-primary-gradient rounded-pill mb-5">
                        <li class="nav-item">
                            <button class="nav-link active" data-bs-toggle="pill" href="#tab-1">Previous</button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link" data-bs-toggle="pill" href="#tab-2">Next</button>
                        </li>
                    </ul>
                    <div class="tab-content text-start">
                        <div id="tab-1" class="tab-pane fade show p-0 active">
                            <div class="row g-4">
                                <div class="col-lg-4">
                                    <div class="bg-light rounded">
                                        <div class="border-bottom p-4 mb-4">
                                            <h4 class="text-primary-gradient mb-1">Classic White Card</h4>
                                            
                                        </div>
                                        <div class="p-4 pt-0">
                                            <h1 class="mb-3">
                                                <small class="align-top" style="font-size: 22px; line-height: 45px;">LKR</small>3200.00
                                            </h1>
                                            <div class="d-flex justify-content-between mb-3"><span>Virtual Profile</span><i class="fa fa-check text-primary-gradient pt-1"></i></div>
                                            <div class="d-flex justify-content-between mb-3"><span>White Printed Card</span><i class="fa fa-check text-primary-gradient pt-1"></i></div>
                                            <div class="d-flex justify-content-between mb-3"><span>Editable Starndard Profile</span><i class="fa fa-check text-primary-gradient pt-1"></i></div>
                                            <div class="d-flex justify-content-between mb-2"><span>&nbsp;</span></div>
                                            <a href="order.php" class="btn btn-primary-gradient rounded-pill py-2 px-4 mt-4">Buy Now</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="bg-light rounded border">
                                        <div class="border-bottom p-4 mb-4">
                                            <h4 class="text-primary-gradient mb-1">Classic Black Card</h4>
                                            
                                        </div>
                                        <div class="p-4 pt-0">
                                            <h1 class="mb-3">
                                                <small class="align-top" style="font-size: 22px; line-height: 45px;">LKR</small>3600.00
                                            </h1>
                                            <div class="d-flex justify-content-between mb-3"><span>Virtual Profile</span><i class="fa fa-check text-primary-gradient pt-1"></i></div>
                                            <div class="d-flex justify-content-between mb-3"><span>Black Printed Card</span><i class="fa fa-check text-primary-gradient pt-1"></i></div>
                                            <div class="d-flex justify-content-between mb-3"><span>Black-Matte finishing</span><i class="fa fa-check text-primary-gradient pt-1"></i></div>
                                            <div class="d-flex justify-content-between mb-2"><span>Editable Starndard Profile</span><i class="fa fa-check text-primary-gradient pt-1"></i></div>
                                            <a href="order.php" class="btn btn-secondary-gradient rounded-pill py-2 px-4 mt-4">Buy Now</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="bg-light rounded">
                                        <div class="border-bottom p-4 mb-4">
                                            <h4 class="text-primary-gradient mb-1">Company White Card</h4>
                                            
                                        </div>
                                        <div class="p-4 pt-0">
                                            <h1 class="mb-3">
                                                <small class="align-top" style="font-size: 22px; line-height: 45px;">LKR</small>4500.00
                                            </h1>
                                            <div class="d-flex justify-content-between mb-3"><span>Custom linkable for your website</span><i class="fa fa-check text-primary-gradient pt-1"></i></div>
                                            <div class="d-flex justify-content-between mb-3"><span>Virtual Profile</span><i class="fa fa-check text-primary-gradient pt-1"></i></div>
                                            <div class="d-flex justify-content-between mb-3"><span>Custom Logo cand be added</span><i class="fa fa-check text-primary-gradient pt-1"></i></div>
                                            <div class="d-flex justify-content-between mb-2"><span>Creating website (If Requested)</span><i class="fa fa-check text-primary-gradient pt-1"></i></div>
                                            <a href="order.php" class="btn btn-primary-gradient rounded-pill py-2 px-4 mt-4">Buy Now</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="tab-2" class="tab-pane fade p-0">
                            <div class="row g-4">
                                <div class="col-lg-4">
                                    <div class="bg-light rounded">
                                        <div class="border-bottom p-4 mb-4">
                                            <h4 class="text-primary-gradient mb-1">Company Black Card</h4>
                                            
                                        </div>
                                        <div class="p-4 pt-0">
                                            <h1 class="mb-3">
                                                <small class="align-top" style="font-size: 22px; line-height: 45px;">LKR</small>4700.00
                                            </h1>
                                            <div class="d-flex justify-content-between mb-3"><span>Custom linkable for your website</span><i class="fa fa-check text-primary-gradient pt-1"></i></div>
                                            <div class="d-flex justify-content-between mb-3"><span>Black-Matte finishing</span><i class="fa fa-check text-primary-gradient pt-1"></i></div>
                                            <div class="d-flex justify-content-between mb-3"><span>Custom Logo cand be added</span><i class="fa fa-check text-primary-gradient pt-1"></i></div>
                                            <div class="d-flex justify-content-between mb-2"><span>Creating website (If Requested)</span><i class="fa fa-check text-primary-gradient pt-1"></i></div>
                                            <div class="d-flex justify-content-between mb-2"><span>&nbsp;</span></div>
                                            <div class="d-flex justify-content-between mb-2"><span>&nbsp;</span></div>
                                            <div class="d-flex justify-content-between mb-2"><span>&nbsp;</span></div>
                                            <a href="order.php" class="btn btn-primary-gradient rounded-pill py-2 px-4 mt-4">Buy Now</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="bg-light rounded border">
                                        <div class="border-bottom p-4 mb-4">
                                            <h4 class="text-primary-gradient mb-1">Custom Card</h4>
                                            
                                        </div>
                                        <div class="p-4 pt-0">
                                            <h1 class="mb-3">
                                                <small class="align-top" style="font-size: 22px; line-height: 45px;">LKR</small>5200.00
                                            </h1>
                                            <div class="d-flex justify-content-between mb-3"><span>Custom Design</span><i class="fa fa-check text-primary-gradient pt-1"></i></div>
                                            <div class="d-flex justify-content-between mb-3"><span>Editable Starndard profile</span><i class="fa fa-check text-primary-gradient pt-1"></i></div>
                                            <div class="d-flex justify-content-between mb-3"><span>Creating website (If Requested)</span><i class="fa fa-check text-primary-gradient pt-1"></i></div>
                                            <div class="d-flex justify-content-between mb-2"><span>Custom linkable for your website</span><i class="fa fa-check text-primary-gradient pt-1"></i></div>
                                            <div class="d-flex justify-content-between mb-2"><span>&nbsp;</span></div>
                                            <div class="d-flex justify-content-between mb-2"><span>&nbsp;</span></div>
                                            <div class="d-flex justify-content-between mb-2"><span>&nbsp;</span></div>
                                            <a href="order.php" class="btn btn-primary-gradient rounded-pill py-2 px-4 mt-4">Buy Now</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="bg-light rounded">
                                        <div class="border-bottom p-4 mb-4">
                                            <h4 class="text-primary-gradient mb-1">CC Card (Custom Card & Custom Profile)</h4>
                                            
                                        </div>
                                        <div class="p-4 pt-0">
                                            <h1 class="mb-3">
                                                <small class="align-top" style="font-size: 22px; line-height: 45px;">LKR</small>6200.00
                                            </h1>
                                            <div class="d-flex justify-content-between mb-3"><span>Luminous finishing</span><i class="fa fa-check text-primary-gradient pt-1"></i></div>
                                            <div class="d-flex justify-content-between mb-3"><span>Custom Design (According to your concepts)</span><i class="fa fa-check text-primary-gradient pt-1"></i></div>
                                            <div class="d-flex justify-content-between mb-3"><span>Editable Custom profile</span><i class="fa fa-check text-primary-gradient pt-1"></i></div>
                                            <div class="d-flex justify-content-between mb-3"><span>Creating website (If Requested)</span><i class="fa fa-check text-primary-gradient pt-1"></i></div>
                                            <div class="d-flex justify-content-between mb-2"><span>Custom linkable for your website</span><i class="fa fa-check text-primary-gradient pt-1"></i></div>
                                            <a href="order.php" class="btn btn-primary-gradient rounded-pill py-2 px-4 mt-4">Buy Now</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Pricing End -->

<div hidden>
        <!-- Testimonial Start -->
        <div class="container-xxl py-5" id="review">
            <div class="container py-5 px-lg-5">
                <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                    <h5 class="text-primary-gradient fw-medium">Testimonial</h5>
                    <h1 class="mb-5">What Say Our Clients!</h1>
                </div>
                <div class="owl-carousel testimonial-carousel wow fadeInUp" data-wow-delay="0.1s">
                    <div class="testimonial-item rounded p-4">
                        <div class="d-flex align-items-center mb-4">
                            <img class="img-fluid bg-white rounded flex-shrink-0 p-1" src="img/testimonial-1.jpg" style="width: 85px; height: 85px;">
                            <div class="ms-4">
                                <h5 class="mb-1">Mathisha Rathnayake</h5>
                                <p class="mb-1">CEO - MR Holdings LTD</p>
                                <div>
                                    <small class="fa fa-star text-warning"></small>
                                    <small class="fa fa-star text-warning"></small>
                                    <small class="fa fa-star text-warning"></small>
                                    <small class="fa fa-star text-warning"></small>
                                    <small class="fa fa-star text-warning"></small>
                                </div>
                            </div>
                        </div>
                        <p class="mb-0">"Using the SynerX NFC card for access control is a game-changer. The speed at which it grants access is impressive, making my daily routines much more efficient."</p>
                    </div>
                    <div class="testimonial-item rounded p-4">
                        <div class="d-flex align-items-center mb-4">
                            <img class="img-fluid bg-white rounded flex-shrink-0 p-1" src="img/testimonial-2.jpg" style="width: 85px; height: 85px;">
                            <div class="ms-4">
                                <h5 class="mb-1">Githsara Senarathne</h5>
                                <p class="mb-1">Software Engineer</p>
                                <div>
                                    <small class="fa fa-star text-warning"></small>
                                    <small class="fa fa-star text-warning"></small>
                                    <small class="fa fa-star text-warning"></small>
                                    <small class="fa fa-star text-warning"></small>
                                    <small class="fa fa-star text-warning"></small>
                                </div>
                            </div>
                        </div>
                        <p class="mb-0">"The SynerX NFC card has truly made a breeze. With a simple tap, I can give my contact info swiftly and securely. It's the epitome of convenience!"</p>
                    </div>
                    <div class="testimonial-item rounded p-4">
                        <div class="d-flex align-items-center mb-4">
                            <img class="img-fluid bg-white rounded flex-shrink-0 p-1" src="img/testimonial-3.jpg" style="width: 85px; height: 85px;">
                            <div class="ms-4">
                                <h5 class="mb-1">Hiruni Rajapakshe</h5>
                                <p class="mb-1">Senior Counselor</p>
                                <div>
                                    <small class="fa fa-star text-warning"></small>
                                    <small class="fa fa-star text-warning"></small>
                                    <small class="fa fa-star text-warning"></small>
                                    <small class="fa fa-star text-warning"></small>
                                    <small class="fa fa-star text-warning"></small>
                                </div>
                            </div>
                        </div>
                        <p class="mb-0">"Impressed by the user-friendly interface of the SynerX NFC card. The design is intuitive, making it easy for anyone to use. Kudos for simplifying the entire experience!"</p>
                    </div>
                    <div class="testimonial-item rounded p-4">
                        <div class="d-flex align-items-center mb-4">
                            <img class="img-fluid bg-white rounded flex-shrink-0 p-1" src="img/testimonial-4.jpg" style="width: 85px; height: 85px;">
                            <div class="ms-4">
                                <h5 class="mb-1">Client Name</h5>
                                <p class="mb-1">Profession</p>
                                <div>
                                    <small class="fa fa-star text-warning"></small>
                                    <small class="fa fa-star text-warning"></small>
                                    <small class="fa fa-star text-warning"></small>
                                    <small class="fa fa-star text-warning"></small>
                                    <small class="fa fa-star text-warning"></small>
                                </div>
                            </div>
                        </div>
                        <p class="mb-0">Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit diam amet diam et eos. Clita erat ipsum et lorem et sit.</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Testimonial End -->
   </div>
     

        <!-- Contact Start -->
<div class="container-xxl py-5" id="contact">
    <div class="container py-5 px-lg-5">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h5 class="text-primary-gradient fw-medium">Contact Us</h5>
            <h1 class="mb-5">Get In Touch!</h1>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <div class="wow fadeInUp" data-wow-delay="0.3s">
                    <p class="text-center mb-4">Contact us today to connect, collaborate, or simply say hello. We welcome your inquiries and look forward to assisting you. Fill out the form below, and we'll get back to you promptly. Your feedback and questions matter to us!</p>
                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" onsubmit="formdone()">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" name="name" id="name" placeholder="Your Name" required>
                                    <label for="name">Your Name</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required>
                                    <label for="email">Your Email</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" required>
                                    <label for="subject">Subject</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <textarea class="form-control" name="message" placeholder="Leave a message here" id="message" style="height: 150px" required></textarea>
                                    <label for="message">Message</label>
                                </div>
                            </div>
                            
                            <div class="col-12 text-center">
                            <button class="btn btn-primary-gradient rounded-pill py-3 px-5" type="submit" >Send Message</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Contact End -->


        
        

        <!-- Footer Start -->
        <div class="container-fluid bg-primary text-light footer wow fadeIn" data-wow-delay="0.1s">
            <div class="container py-5 px-lg-5">
            
                <div class="row g-5">
                    <div class="col-md-6 col-lg-3">
                        <p><i class="fa fa-phone-alt me-3"></i>+94 74 134 2997</p>
                        <p><i class="fa fa-envelope me-3"></i>synerxcard@gmail.com</p>
                        <div class="d-flex pt-2">
                            <a class="btn btn-outline-light btn-social" href="https://twitter.com/SynerXCard"><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-outline-light btn-social" href="http://Facebook.com/Synerxcard/"><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-outline-light btn-social" href="https://www.instagram.com/synerxcard/"><i class="fab fa-instagram"></i></a>
                            <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                    
                    
                </div>
            </div>
            <div class="container px-lg-5">
                <div class="copyright">
                    <div class="row">
                        <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                            &copy; <a class="border-bottom" href="http://synerx.lk">SynerX</a>, All Right Reserved. 
							
							<!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
							Designed By <a class="border-bottom" href="https://xcobra.co">XCobra</a>
                        </div>
                        <div class="col-md-6 text-center text-md-end">
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-lg-square back-to-top pt-2"><i class="bi bi-arrow-up text-white"></i></a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.20/dist/sweetalert2.all.min.js"></script>
 

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.20/dist/sweetalert2.all.min.js"></script>
   
   
   




    <!-- Template Javascript -->
    <script src="js/main.js"></script>
    <script>
        function formdone() {
            Swal.fire({
                icon: "success",
                title: "Request sent !",
                showConfirmButton: true,
                timer: 30000
            });
        }
    </script>
</body>

</html>