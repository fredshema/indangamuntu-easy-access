<?php
include_once 'assets/conn/dbconnect.php';
?>
<!-- login -->
<!-- check session -->
<?php
session_start();
if (isset($_SESSION['citizenSession']) != "") {
    header("Location: citizen/citizen.php");
}
if (isset($_POST['login'])) {
    $phone = mysqli_real_escape_string($con, $_POST['phone']);
    $password  = mysqli_real_escape_string($con, $_POST['password']);
    $res = mysqli_query($con, "SELECT * FROM citizens WHERE phone = '$phone'");
    $row = mysqli_fetch_array($res);
    $count = mysqli_num_rows($res); // if uname/pass correct it returns must be 1 row
    if ($count == 1 && $row['password'] == $password) {
        $_SESSION['citizenSession'] = $row['id'];
        header("Location: citizen/dashboard.php");
    } else {
        $errMSG = "Incorrect Credentials, Try again...";
    }
}
?>
<!-- check session -->

<!-- register -->
<?php
if (isset($_POST['signup'])) {
    $names = mysqli_real_escape_string($con, $_POST['names']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $phone = mysqli_real_escape_string($con, $_POST['phone']);
    $address = mysqli_real_escape_string($con, $_POST['address']);
    //INSERT
    $query = " INSERT INTO citizens (id, names, password, phone, address) VALUES (NULL, '$names', '$password', '$phone', '$address')";
    $result = mysqli_query($con, $query);
    if ($result) {
?>
        <script type="text/javascript">
            alert('Registration successful.');
        </script>
    <?php
    } else {
    ?>
        <script type="text/javascript">
            alert('User already registered. Please try again');
        </script>
<?php
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
    <title>NIDA Appointments</title>
    <!-- Bootstrap -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/style1.css" rel="stylesheet">
    <link href="assets/css/blocks.css" rel="stylesheet">
    <link href="assets/css/date/bootstrap-datepicker.css" rel="stylesheet">
    <link href="assets/css/date/bootstrap-datepicker3.css" rel="stylesheet">
    <link href="./assets/css/overides.css" rel="stylesheet">
    <!-- Special version of Bootstrap that only affects content wrapped in .bootstrap-iso -->
    <!-- <link rel="stylesheet" href="https://formden.com/static/cdn/bootstrap-iso.css" />  -->

    <!--Font Awesome (added because you use icons in your prepend/append)-->

    <link rel="stylesheet" href="./citizen/assets/font-awesome/css/font-awesome.min.css" />
    <link href="assets/css/material.css" rel="stylesheet">
</head>

<body>
    <!-- navigation -->
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php"><img alt="Brand" src="assets/img/kev.png" height="48px"></a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">


                <ul class="nav navbar-nav navbar-right">


                    <!-- <li><a href="adminlogin.php">Admin</a></li> -->
                    <li><a href="#" data-toggle="modal" data-target="#myModal">Sign Up</a></li>

                    <li>
                        <p class="navbar-text">Already have an account?</p>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><b>Login</b> <span class="caret"></span></a>
                        <ul id="login-dp" class="dropdown-menu">
                            <li>
                                <div class="row">
                                    <div class="col-md-12">

                                        <form class="form" role="form" method="POST" accept-charset="UTF-8">
                                            <div class="form-group">
                                                <label class="sr-only" for="id">Email</label>
                                                <input type="text" class="form-control" name="phone" placeholder="Phone number" required>
                                            </div>
                                            <div class="form-group">
                                                <label class="sr-only" for="password">Password</label>
                                                <input type="password" class="form-control" name="password" placeholder="Password" required>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" name="login" id="login" class="btn btn-primary btn-block">Sign in</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- navigation -->

    <!-- modal container start -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <!-- modal content -->
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Sign Up</h4>
                </div>
                <!-- modal body start -->
                <div class="modal-body">

                    <!-- form start -->
                    <div class="container" id="wrap">
                        <div class="row">
                            <div class="col-md-6">
                                <form action="<?php $_PHP_SELF ?>" method="POST" accept-charset="utf-8" class="form" role="form">
                                    <h4>It's free and always will be.</h4>
                                    <div class="row">
                                        <div class="col-12">
                                            <input type="text" name="names" value="" class="form-control input-lg" placeholder="Full Name" required />
                                        </div>
                                    </div>
                                    <input type="text" name="phone" value="" class="form-control input-lg" placeholder="Phone number" required />
                                    <input type="address" name="address" value="" class="form-control input-lg" placeholder="Address" required />
                                    <input type="password" name="password" value="" class="form-control input-lg" placeholder="Password" required />
                                    <input type="password" name="confirm_password" value="" class="form-control input-lg" placeholder="Confirm Password" required />
                                    <span class="help-block">By clicking Create my account, you agree to our Terms and that you have read our Data Use Policy, including our Cookie Use.</span>
                                    <button class="btn btn-lg btn-primary btn-block signup-btn" type="submit" name="signup" id="signup">Create my account</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- modal end -->
    <!-- modal container end -->

    <!-- 1st section start -->
    <section id="promo-1" class="content-block promo-1 min-height-600px bg-offwhite">
        <div class="container">
            <div class="row">
                <div class="col-md-5  rounded" style="backdrop-filter: brightness(0.5);">

                    <h3 class="text-white">Make an appointment today!</h3>
                    <p class="text-white">Here is the Schedule. <br /> Please <b>Login</b> your account to make an appointment. </p>

                    <!-- date textbox -->

                    <div class="input-group bg-black p-3 rounded" style="margin-bottom:10px;">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar">
                            </i>
                        </div>
                        <input class="form-control text-white" id="date" name="date" value="<?php echo date("Y-m-d") ?>" onchange="showUser(this.value)" />
                    </div>

                    <!-- date textbox end -->

                    <!-- script start -->
                    <script>
                        function showUser(str) {
                            if (str == "") {
                                document.getElementById("txtHint").innerHTML = "";
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
                                xmlhttp.open("GET", "getuser.php?q=" + str, true);
                                console.log(str);
                                xmlhttp.send();
                            }
                        }
                    </script>
                    <div id="txtHint bg-white"><b> </b></div>
                </div>

            </div>
            <!-- /.row -->
        </div>
    </section>
    <!-- first section end -->


    <!-- second section start -->

    <!-- second section end -->
    <!-- third section start -->

    <!-- third section end -->
    <!-- forth sections start -->
    <section id="content-1-9" class="content-1-9 content-block">
        <div class="container">
            <div class="underlined-title">
                <h1>Get in Touch</h1>
                <hr>
                <h2>Feel free to drop us a line to contact us</h2>
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
                    <div class="col-xs-10 ">
                        <h4>Web Design</h4>
                        <p> Retro chillwave YOLO four loko photo booth. Brooklyn kale chips, seitan hella 3 wolf moon slow-carb paleo.</p>
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
        <!-- /.container -->
    </section>
    <!-- forth section end -->
    <!-- footer start -->
    <div class="copyright-bar bg-black">
        <div class="container">
            <p class="pull-left small">©Shyakakevincode <a href="https://www.linkedin.com/in/shyaka-kevin-066464245/">Get More About me </a></p>
            <p class="pull-right small"><a href="adminlogin.php">Admin</a></p>
        </div>
    </div>
    <!-- footer end -->
    </div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/date/bootstrap-datepicker.js"></script>
    <script src="assets/js/moment.js"></script>
    <script src="assets/js/transition.js"></script>
    <script src="assets/js/collapse.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="assets/js/bootstrap.min.js"></script>
    <script type="text/javascript">
        $('#myModal').on('shown.bs.modal', function() {
            $('#myInput').focus()
        })
    </script>
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