<?php
session_start();

if(!isset($_SESSION['citizenSession']))
{
 header("Location: citizendashboard.php");
}
else if(isset($_SESSION['citizenSession'])!="")
{
 header("Location: ../index.php");
}

if(isset($_GET['logout']))
{
 session_destroy();
 unset($_SESSION['citizenSession']);
 header("Location: ../index.php");
}
?>