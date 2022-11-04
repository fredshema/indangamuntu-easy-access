<?php
session_start();
include_once '../assets/conn/dbconnect.php';
$session = $_SESSION['citizenSession'];
$res = mysqli_query($con, "SELECT a.*, b.*,c.* FROM citizens a
	JOIN appointments b
		On a.id = b.citizen_id
	JOIN schedules c
		On b.schedule_id = c.id
	WHERE b.citizen_id ='$session'");
if (!$res) {
	die("Error running $sql: " . mysqli_error($sql));
}
$userRow = mysqli_fetch_array($res);
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<title>Make Appoinment</title>
	<link href="assets/css/bootstrap.min.css" rel="stylesheet">
	<link href="assets/css/material.css" rel="stylesheet">

	<link href="assets/css/default/style.css" rel="stylesheet">
	<link href="assets/css/default/blocks.css" rel="stylesheet">
	<link href="../assets/css/overides.css" rel="stylesheet">
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
	<div class="container">
		<div class="row">
			<div class="page-header mb-0">
				<h4 class="text-black">Your Appointment list</h4>
			</div>
			<div class="panel panel-primary">
				<div class="panel-heading">
					List of appointments
				</div>
				<div class="panel-body">
					<table class="table table-hover">
						<thead>
							<tr>
								<th>Names</th>
								<th>Schedule Day</th>
								<th>Start Time</th>
								<th>End Time</th>
								<th>Print</th>
							</tr>
						</thead>
						<tbody>
							<?php
							if (!$res) {
								die("Error running $sql: " . mysqli_error($sql));
							}
							$userRow = mysqli_fetch_array($res);

							if ($userRow) {
								echo '<tr>';
								echo '<td>' . $userRow['names'] . '</td>';
								echo '<td>' . $userRow['date'] . '</td>';
								echo '<td>' . $userRow['startTime'] . '</td>';
								echo '<td>' . $userRow['endTime'] . '</td>';
								echo '<td><a href="invoice.php?id=' . $userRow['id'] . '" class="btn btn-sm btn-primary">Print</a></td>';
								echo '</tr>';
							} else {
								echo '<tr>';
								echo '<td colspan="5">No appointments</td>';
								echo '</tr>';
							}
							?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>

	<!-- display appoinment end -->
	<script src="assets/js/jquery.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
</body>

</html>