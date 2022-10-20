<?php
session_start();
include_once '../assets/conn/dbconnect.php';
if (!isset($_SESSION['citizenSession'])) {
	header("Location: ../index.php");
}

$usersession = $_SESSION['citizenSession'];

$res = mysqli_query($con, "SELECT * FROM citizens WHERE id=" . $usersession);

if ($res === false) {
	echo mysqli_error($con);
}

$userRow = mysqli_fetch_array($res, MYSQLI_ASSOC);
?>


<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<title>Peaple Dashboard</title>
	<!-- Bootstrap -->
	<!-- <link href="assets/css/bootstrap.min.css" rel="stylesheet"> -->
	<link href="assets/css/material.css" rel="stylesheet">
	<link href="assets/css/default/style.css" rel="stylesheet">
	<!-- <link href="assets/css/default/style1.css" rel="stylesheet"> -->
	<link href="assets/css/default/blocks.css" rel="stylesheet">
	<link href="assets/css/date/bootstrap-datepicker.css" rel="stylesheet">
	<link href="assets/css/date/bootstrap-datepicker3.css" rel="stylesheet">
	<link href="../assets/css/overides.css" rel="stylesheet">
	<!-- Special version of Bootstrap that only affects content wrapped in .bootstrap-iso -->
	<!-- <link rel="stylesheet" href="https://formden.com/static/cdn/bootstrap-iso.css" /> -->
	<!--Font Awesome (added because you use icons in your prepend/append)-->
	<link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css" />

</head>

<body>

	<!-- navigation -->
	<nav class="navbar navbar-default " role="navigation">
		<div class="container-fluid">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="citizen.php"><img alt="Brand" src="assets/img/kev.png" height="40px"></a>
			</div>
			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
					<ul class="nav navbar-nav">
						<li><a href="citizen.php">Home</a></li>
						<!-- <li><a href="profile.php?citizenId=<?php echo $userRow['icCitizen']; ?>" >Profile</a></li> -->
						<li><a href="citizenapplist.php?citizenId=<?php echo $userRow['icCitizen']; ?>">Appointment</a></li>
					</ul>
				</ul>

				<ul class="nav navbar-nav navbar-right">
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $userRow['citizenFirstName']; ?> <?php echo $userRow['citizenLastName']; ?><b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li>
								<a href="profile.php?citizenId=<?php echo $userRow['icCitizen']; ?>"><i class="fa fa-fw fa-user"></i> Profile</a>
							</li>
							<li>
								<a href="citizenapplist.php?citizenId=<?php echo $userRow['icCitizen']; ?>"><i class="glyphicon glyphicon-file"></i> Appointment</a>
							</li>
							<li class="divider"></li>
							<li>
								<a href="citizenlogout.php?logout"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
							</li>
						</ul>
					</li>
				</ul>
			</div>
		</div>
	</nav>
	<!-- navigation -->

	<!-- 1st section start -->
	<section id="promo-1" class="content-block promo-1 min-height-600px bg-offwhite">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-md-8">

					<?php if ($userRow['citizenMaritialStatus'] == "") {
						echo '<div class="row">
						<div class="col-lg-12">
							<div class="alert alert-danger">
								<i class="fa fa-info-circle"></i> <strong>Please complete your profile.</strong>
							</div>
						</div>
					</div>';
					}
					?>
					<?php
					echo '<div class="row">
						<div class="col-lg-12">
							<div class="alert alert-warning font-weight-bold">
								Hello ' . $userRow['citizenFirstName'] . ' ' .  $userRow['citizenLastName'] . ' Make appointment today!
							</div>
						</div>
					</div>';
					?>
					<!-- notification end -->
					<div class="input-group" style="margin-bottom:10px;">
						<div class="input-group-addon">
							<i class="fa fa-calendar">
							</i>
						</div>
						<input class="form-control" id="date" name="date" value="<?php echo date("Y-m-d") ?>" onchange="showUser(this.value)" />
					</div>
				</div>
				<!-- date textbox end -->
				<!-- script start -->
				<script>
					function showUser(str) {

						if (str == "") {
							document.getElementById("txtHint").innerHTML = "No data to be shown";
							return;
						} else {
							if (window.XMLHttpRequest) {
								// code for IE7+, Firefox, Chrome, Opera, Safari
								xmlhttp = new XMLHttpRequest();
							} else {
								// code for IE6, IE5
								xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
							}
							xmlhttp.onreadystatechange = function() {
								if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
									document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
								}
							};
							xmlhttp.open("GET", "getschedule.php?q=" + str, true);
							console.log(str);
							xmlhttp.send();
						}
					}
				</script>

				<!-- script start end -->

				<!-- table appointment start -->
				<!-- <div class="container"> -->
				<div class="container">
					<div class="row">
						<div class="col-xs-12 col-md-8">
							<div id="txtHint" class="font-weight-bold"></div>
						</div>
					</div>
				</div>
				<!-- </div> -->
				<!-- table appointment end -->
			</div>
		</div>
		<!-- /.row -->
		</div>
	</section>
	<!-- first section end -->
	<!-- forth sections start -->
	<section id="content-1-9" class="content-1-9 content-block">
		<div class="container">
			<div class="underlined-title">
				<h1>Get in Touch</h1>
				<hr>
				<h3>Feel free to drop us a line to contact us</h3>
			</div>
			<div class="row">
				<div class="col-md-4 col-sm-12 col-xs-12 pad25">
					<div class="col-xs-2">
						<span class="fa fa-pencil"></span>
					</div>
					<div class="col-xs-10">
						<h4>Branding</h4>
						<p>Retro chillwave YOLO four loko photo booth. Brooklyn kale chips, seitan hella 3 wolf moon slow-carb paleo.</p>
					</div>
				</div>
				<div class="col-md-4 col-sm-12 col-xs-12 pad25">
					<div class="col-xs-2">
						<span class="fa fa-code"></span>
					</div>
					<div class="col-xs-10">
						<h4>Web Design</h4>
						<p>Retro chillwave YOLO four loko photo booth. Brooklyn kale chips, seitan hella 3 wolf moon slow-carb paleo.</p>
					</div>
				</div>
				<div class="col-md-4 col-sm-12 col-xs-12 pad25">
					<div class="col-xs-2">
						<span class="fa fa-comments-o"></span>
					</div>
					<div class="col-xs-10">
						<h4>Social Marketing</h4>
						<p>Retro chillwave YOLO four loko photo booth. Brooklyn kale chips, seitan hella 3 wolf moon slow-carb paleo.</p>
					</div>
				</div>
				<div class="col-md-4 col-sm-12 col-xs-12 pad25">
					<div class="col-xs-2">
						<span class="fa fa-search"></span>
					</div>
					<div class="col-xs-10">
						<h4>SEO</h4>
						<p>Retro chillwave YOLO four loko photo booth. Brooklyn kale chips, seitan hella 3 wolf moon slow-carb paleo.</p>
					</div>
				</div>
				<div class="col-md-4 col-sm-12 col-xs-12 pad25">
					<div class="col-xs-2">
						<span class="fa fa-mobile"></span>
					</div>
					<div class="col-xs-10">
						<h4>Mobile Apps</h4>
						<p>Retro chillwave YOLO four loko photo booth. Brooklyn kale chips, seitan hella 3 wolf moon slow-carb paleo.</p>
					</div>
				</div>
				<div class="col-md-4 col-sm-12 col-xs-12 pad25">
					<div class="col-xs-2">
						<span class="fa fa-bookmark"></span>
					</div>
					<div class="col-xs-10">
						<h4>Corporate Literture</h4>
						<p>Retro chillwave YOLO four loko photo booth. Brooklyn kale chips, seitan hella 3 wolf moon slow-carb paleo.</p>
					</div>
				</div>
			</div>
			<!-- /.row -->
		</div>
	</section>
	<!-- forth section end -->

	<!-- footer start -->
	<div class="copyright-bar bg-black">
		<div class="container">
			<p class="pull-left small">©shyakakevin</p>
			<p class="pull-right small">Made with us <i class="fa fa-heart pomegranate"></i> on Planet Earth</p>
		</div>
	</div>
	<!-- footer end -->

	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script src="assets/js/jquery.js"></script>
	<script src="assets/js/date/bootstrap-datepicker.js"></script>
	<script src="assets/js/moment.js"></script>
	<script src="assets/js/transition.js"></script>
	<script src="assets/js/collapse.js"></script>
	<!-- Include all compiled plugins (below), or include individual files as needed -->
	<script src="assets/js/bootstrap.min.js"></script>

	<!-- date start -->
	<script>
		$(document).ready(function() {
			var date_input = $('input[name="date"]'); //our date input has the name "date"
			var container = $('.bootstrap-iso form').length > 0 ? $('.bootstrap-iso form').parent() : "body";
			date_input.datepicker({
				format: 'yyyy-mm-dd',
				container: container,
				todayHighlight: true,
				autoclose: true,
			})
		})
	</script>
	<!-- date end -->


</body>

</html>