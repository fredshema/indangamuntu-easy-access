<?php
include_once '../assets/conn/dbconnect.php';
// Get the variables.
$icCitizen = $_POST['ic'];
// echo $appid;

$delete = mysqli_query($con,"DELETE FROM citizen WHERE icCitizen=$icCitizen");
// if(isset($delete)) {
//    echo "YES";
// } else {
//    echo "NO";
// }



?>

