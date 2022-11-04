<?php
include_once '../assets/conn/dbconnect.php';
// Get the variables.
$id = $_POST['ic'];
// echo $appid;

$delete = mysqli_query($con,"DELETE FROM citizen WHERE id=$id");
// if(isset($delete)) {
//    echo "YES";
// } else {
//    echo "NO";
// }



?>

