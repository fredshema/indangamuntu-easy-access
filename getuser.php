<?php

include_once 'assets/conn/dbconnect.php';
$q = $_GET['q'];
// echo $q;
$res = mysqli_query($con, "SELECT * FROM employeeschedule WHERE scheduleDate='$q'");

if (!$res) {
    die("Error running $sql: " . mysqli_error($con));
}

?>
<!DOCTYPE html>
<html lang="en">

<body class="bg-white">
    <?php

    if (mysqli_num_rows($res) == 0) {
        echo "<div class='alert alert-danger' role='alert'>THERE  is not appointment available at the moment. Please try again later.</div>";
    } else {
    ?>
        <table class="table table-hover bg-white">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                    <th>Availability</th>
                </tr>
            <tbody>
                <?php
                while ($row = mysqli_fetch_assoc($res)) {
                    if ($row['bookAvail'] != 'available') {
                        $avail = "danger";
                    } else {
                        $avail = "primary";
                    }
                    echo "<td>" . $row['scheduleDate'] . "</td>";
                    echo "<td>" . $row['startTime'] . "</td>";
                    echo "<td>" . $row['endTime'] . "</td>";
                    echo "<td> <span class='label label-" . $avail . "'>" . $row['bookAvail'] . "</span></td>";
                }
                ?>
            </tbody>
            </thead>
        </table>
    <?php
    }
    ?>
    </tbody>
</body>

</html>