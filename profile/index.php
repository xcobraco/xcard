<?php
include '../inc/connection.php';

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if an ID is provided in the URL
if (isset($_GET['id'])) {
    $userId = $_GET['id'];

    // Perform a database query to retrieve detailed information for the specified user ID
    $sql = "SELECT * FROM users WHERE UserID = $userId";
    $result = $conn->query($sql);

    // Check if the query was successful
    if ($result && $result->num_rows > 0) {
        $userDetails = $result->fetch_assoc();
?>

<!DOCTYPE HTML>
<html>
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?php echo $userDetails['Name']; ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Free HTML5 Website Template by freehtml5.co" />
	<meta name="keywords" content="free website templates, free html5, free template, free bootstrap, free website template, html5, css3, mobile first, responsive" />
	<meta name="author" content="freehtml5.co" />

  	<!-- Facebook and Twitter integration -->
	<meta property="og:title" content=""/>
	<meta property="og:image" content=""/>
	<meta property="og:url" content=""/>
	<meta property="og:site_name" content=""/>
	<meta property="og:description" content=""/>
	<meta name="twitter:title" content="" />
	<meta name="twitter:image" content="" />
	<meta name="twitter:url" content="" />
	<meta name="twitter:card" content="" />

	<link href="https://fonts.googleapis.com/css?family=Space+Mono" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Kaushan+Script" rel="stylesheet">
	
	<!-- Animate.css -->
	<link rel="stylesheet" href="css/animate.css">
	<!-- Icomoon Icon Fonts-->
	<link rel="stylesheet" href="css/icomoon.css">
	<!-- Bootstrap  -->
	<link rel="stylesheet" href="css/bootstrap.css">

	<!-- Theme style  -->
	<link rel="stylesheet" href="css/style.css">

	<!-- Modernizr JS -->
	<script src="js/modernizr-2.6.2.min.js"></script>
	<!-- FOR IE9 below -->
	<!--[if lt IE 9]>
	<script src="js/respond.min.js"></script>
	<![endif]-->
    <style>
    .profile-thumb {
  width: 100px; /* Adjust the width and height as needed */
  height: 100px;
  background-size: cover;
  background-position: center;
  border-radius: 50%;
  overflow: hidden;
}

    </style>
	</head>
	<body>
		
	<div class="fh5co-loader"></div>
	
	<div id="page">	
	<header id="fh5co-header" class="fh5co-cover js-fullheight" role="banner" style="background-image:url(<?php echo $userDetails['Back']; ?>);" data-stellar-background-ratio="0.5">
		<div class="overlay"></div>
		<div class="container">
			
			<div class="row">
				<div class="col-md-8 col-md-offset-2 text-center">
					<div class="display-t js-fullheight">
						<div class="display-tc js-fullheight animate-box" data-animate-effect="fadeIn">
							<div class="profile-thumb" style="background-image: url('../uploads/<?php echo $userDetails['ProPic']; ?>');"></div>

							<h1><span><?php echo $userDetails['Name']; ?></span></h1>
							<h3><span><?php echo $userDetails['Position']; ?></span></h3><br>
						
							<div style="text-align: center;">
								<ul class="fh5co-social-icons">
								<li><a href="mailto:<?php echo $userDetails['Email']; ?>" target="_blank"><i class="icon-email"></i></a>
								</li>
									<li><a href="<?php echo $userDetails['Whatsapp']; ?>" onclick="window.location.href='tel:<?php echo $userDetails['Whatsapp']; ?>';return false;"><i class="icon-whatsapp"></i></a></li>
									<li><a href="<?php echo $userDetails['Facebook']; ?>" target="_blank"><i class="icon-facebook2"></i></a></li>
									<li><a href="<?php echo $userDetails['Linkedin']; ?>" target="_blank"><i class="icon-linkedin2"></i></a></li>
									<li><a href="<?php echo $userDetails['Instagram']; ?>" target="_blank"><i class="icon-instagram"></i></a></li>
									<li><a href="<?php echo $userDetails['Contact']; ?>" onclick="window.location.href='tel:<?php echo $userDetails['Contact']; ?>';return false;"><i class="icon-phone"></i></a></li>
								</ul>
							</div>	
						</div>
					</div>
				</div>
			</div>
		</div>
	</header>
 

	<div id="fh5co-about" class="animate-box">
		<div class="container">
			<div class="row">
				<div class="col-md-8 col-md-offset-2 text-center fh5co-heading">
					<h2>About Me</h2>
				</div>
			</div>
			<div class="row">
				<div class="col-md-4">
					<ul class="info">
						<li><span class="first-block">Full Name:</span><span class="second-block"><?php echo $userDetails['Name']; ?></span></li>
						<li><span class="first-block">Phone:</span><span class="second-block"><?php echo $userDetails['Contact']; ?></span></li>
					<li>
    <span class="first-block">whatsapp:</span>
    <span class="second-block">
        <a href="whatsapp://send?phone=<?php echo $userDetails['Whatsapp']; ?>">
            <?php echo $userDetails['Whatsapp']; ?>
        </a>
    </span>
</li>

						<li><span class="first-block">Email:</span><span class="second-block"><?php echo $userDetails['Email']; ?></span></li>
						<li><span class="first-block">Address:</span><span class="second-block"><?php echo $userDetails['Address']; ?></span></li>
					</ul>
				</div>
				<div class="col-md-8">
					<h2>Hello There!</h2>
					<p><?php echo $userDetails['Description']; ?></p>
					</p>
				</div>
			</div>
		</div>
	</div><br><br>
	
	<div id="fh5co-footer">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<p>&copy;  All Rights Reserved. <br>Designed by Xcobra</a> </p>
				</div>
			</div>
		</div>
	</div>

	<div class="gototop js-top">
		<a href="#" class="js-gotop"><i class="icon-arrow-up22"></i></a>
	</div>
	
	<!-- jQuery -->
	<script src="js/jquery.min.js"></script>
	<!-- jQuery Easing -->
	<script src="js/jquery.easing.1.3.js"></script>
	<!-- Bootstrap -->
	<script src="js/bootstrap.min.js"></script>
	<!-- Waypoints -->
	<script src="js/jquery.waypoints.min.js"></script>
	<!-- Stellar Parallax -->
	<script src="js/jquery.stellar.min.js"></script>
	<!-- Easy PieChart -->
	<script src="js/jquery.easypiechart.min.js"></script>
	<!-- Google Map -->
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCefOgb1ZWqYtj7raVSmN4PL2WkTrc-KyA&sensor=false"></script>
	<script src="js/google_map.js"></script>
	
	<!-- Main -->
	<script src="js/main.js"></script>
	

		
	<?php
    } else {
        echo "User not found.";
    }
} else {
    echo "Invalid request. User ID not provided.";
}

// Close connection
$conn->close();
?>
	

	</body>
</html>

