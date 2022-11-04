<?php
session_start();
include_once '../assets/conn/dbconnect.php';
$q = $_GET['q'] ?? '';
$res = mysqli_query($con, "SELECT * FROM schedules WHERE date='$q'");
if (!$res) {
    die("Error running $sql: " . mysqli_error($con));
}
?>

<div>
    <?php
    if (mysqli_num_rows($res) == 0) {
        echo "<div class='alert alert-danger' role='alert'>There is no appointment available at the moment. Please try again later.</div>";
    } else {
    ?>
        <table class="table table-hover bg-white">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                    <th>Availability</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = mysqli_fetch_array($res)) {
                    if ($row['availability'] != 'available') {
                        $avail = "danger";
                        $btnstate = "disabled";
                        $btnclick = "danger";
                    } else {
                        $avail = "primary";
                        $btnstate = "";
                        $btnclick = "primary";
                    }
                    echo "<tr>";
                    echo "<td>" . $row['date'] . "</td>";
                    echo "<td>" . $row['startTime'] . "</td>";
                    echo "<td>" . $row['endTime'] . "</td>";
                    echo "<td> <span class='p-2 rounded text-white label-" . $avail . "'>" . $row['availability'] . "</span></td>";
                    echo "<td><a href='appointment.php?&schedule_id=" . $row['id'] . "' class='btn btn-" . $btnclick . " btn-sm' role='button' " . $btnstate . ">Book Now</a></td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    <?php
    }
    ?>
</div>