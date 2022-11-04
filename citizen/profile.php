<?php
session_start();
include_once '../assets/conn/dbconnect.php';

if (!isset($_SESSION['citizenSession'])) {
	header("Location: ../index.php");
}

$res = mysqli_query($con, "SELECT * FROM citizens WHERE id=" . $_SESSION['citizenSession']);
$userRow = mysqli_fetch_array($res, MYSQLI_ASSOC);
?>
<!-- update -->
<?php
if (isset($_POST['submit'])) {
	//variables
	$names = mysqli_real_escape_string($con, $_POST['names']);
	$phone = mysqli_real_escape_string($con, $_POST['phone']);
	$address = mysqli_real_escape_string($con, $_POST['address']);

	$res = mysqli_query($con, "UPDATE citizens SET names='$names', phone='$phone', address='$address' WHERE id=" . $_SESSION['citizenSession']);

	if ($res) {
		header('Location: profile.php');
	} else {
		echo mysqli_error($con);
	}
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<title>Citizen Dashboard</title>
	<!-- Bootstrap -->
	<link href="assets/css/bootstrap.min.css" rel="stylesheet">
	<link href="assets/css/default/style.css" rel="stylesheet">
	<!-- <link href="assets/css/default/style1.css" rel="stylesheet"> -->
	<link href="assets/css/default/blocks.css" rel="stylesheet">
	<link href="assets/css/date/bootstrap-datepicker.css" rel="stylesheet">
	<link href="assets/css/date/bootstrap-datepicker3.css" rel="stylesheet">
	<!-- Special version of Bootstrap that only affects content wrapped in .bootstrap-iso -->
	<link rel="stylesheet" href="https://formden.com/static/cdn/bootstrap-iso.css" />
	<!--Font Awesome (added because you use icons in your prepend/append)-->
	<link rel="stylesheet" href="https://formden.com/static/cdn/font-awesome/4.4.0/css/font-awesome.min.css" />
	<!-- <link href="assets/css/material.css" rel="stylesheet"> -->
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
						<li><a href="profile.php">Profile</a></li>
						<li><a href="citizenapplist.php?citizenId=<?php echo $userRow['id']; ?>">Appointment</a></li>
					</ul>
				</ul>

				<ul class="nav navbar-nav navbar-right">
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<i class="fa fa-user"></i>
							<?php echo $userRow['names']; ?>
							<b class="caret"></b>
						</a>
						<ul class="dropdown-menu">
							<li>
								<a href="profile.php"><i class="fa fa-fw fa-user"></i> Profile</a>
							</li>
							<li>
								<a href="citizenapplist.php"><i class="glyphicon glyphicon-file"></i> Appointment</a>
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

	<div class="container">
		<section style="padding-bottom: 50px; padding-top: 50px;">
			<div class="row">
				<!-- start -->
				<!-- USER PROFILE ROW STARTS-->
				<div class="row">
					<div class="col-md-3 col-sm-3">

						<div class="user-wrapper">
							<img src="assets/img/2.jpg" class="img-responsive" />
							<div class="description">
								<h4><?php echo $userRow['names']; ?></h4>
								<h5> <strong> Website Designer </strong></h5>
								<p>
									You can update your profile
								</p>
								<hr />
								<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Update Profile</button>
							</div>
						</div>
					</div>

					<div class="col-md-9 col-sm-9  user-wrapper">
						<div class="description">
							<h3> <?php echo $userRow['names']; ?></h3>
							<hr />
							<div class="panel panel-default">
								<div class="panel-body">
									<table class="table table-user-information" align="center">
										<tbody>
											<tr>
												<td>Phone number</td>
												<td><?php echo $userRow['phone']; ?></td>
											</tr>
											<tr>
												<td>Address</td>
												<td><?php echo $userRow['address']; ?></td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>

						</div>

					</div>
				</div>
				<!-- USER PROFILE ROW END-->
				<!-- end -->
				<div class="col-md-4">

					<!-- Large modal -->

					<!-- Modal -->
					<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									<h4 class="modal-title" id="myModalLabel">Modal title</h4>
								</div>
								<div class="modal-body">
									<!-- form start -->
									<form action="<?php $_PHP_SELF ?>" method="post">
										<table class="table table-user-information">
											<tbody>
												<tr>
													<td>Names:</td>
													<td>
														<input type="text" class="form-control" name="names" value="<?php echo $userRow['names']; ?>" />
													</td>
												</tr>
												<tr>
													<td>Phone number:</td>
													<td>
														<input type="text" class="form-control" name="phone" value="<?php echo $userRow['phone']; ?>" />
													</td>
												<tr>
													<td>Address</td>
													<td><textarea class="form-control" name="address"><?php echo $userRow['address']; ?></textarea></td>
												</tr>
												<tr>
													<td>
														<input type="submit" name="submit" class="btn btn-info" value="Update Info">
													</td>
												</tr>
											</tbody>

										</table>



									</form>
									<!-- form end -->
								</div>

							</div>
						</div>
					</div>
					<br /><br />
				</div>

			</div>
			<!-- ROW END -->
		</section>
		<!-- SECTION END -->
	</div>
	<!-- CONATINER END -->
	<script src="assets/js/jquery.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>

	<script type="text/javascript">
		$(function() {
			$('#citizenDOB').datetimepicker();
		});
	</script>
</body>

</html>