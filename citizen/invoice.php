<?php
session_start();
include_once '../assets/conn/dbconnect.php';

if (isset($_GET['id'])) {
    $appointmentID = $_GET['id'];
} else {
    header("Location: citizenapplist.php");
}

$res = mysqli_query($con, "SELECT a.*, b.*,c.* FROM citizens a
JOIN appointments b
On a.id = b.citizen_id
JOIN schedules c
On b.schedule_id=c.id
WHERE b.id=$appointmentID");

$userRow = mysqli_fetch_array($res, MYSQLI_ASSOC);
?>
<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>A simple, clean, and responsive HTML invoice template</title>

    <link rel="stylesheet" type="text/css" href="assets/css/invoice.css">
</head>

<body>
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="2">
                    <table>
                        <tr>
                            <td class="title">
                                <img src="assets/img/logo.png" style="width:100%; max-width:300px;">
                            </td>

                            <td>
                                Invoice #: <?php echo $userRow['id']; ?><br>
                                Created: <?php echo date("d-m-Y"); ?><br>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="information">
                <td colspan="2">
                    <table>
                        <tr>
                            <td>
                                <?php echo $userRow['address']; ?>
                            </td>

                            <td><?php echo $userRow['id']; ?><br>
                                <?php echo $userRow['names']; ?><br>
                                <?php echo $userRow['phone']; ?>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>



            <tr class="heading">
                <td>
                    Appointment Details
                </td>

                <td>
                    #
                </td>
            </tr>

            <tr class="item">
                <td>
                    Appointment ID
                </td>

                <td>
                    <?php echo $userRow['id']; ?>
                </td>
            </tr>

            <tr class="item">
                <td>
                    Schedule ID
                </td>

                <td>
                    <?php echo $userRow['schedule_id']; ?>
                </td>
            </tr>

            <tr class="item">
                <td>
                    Appointment Date
                </td>

                <td>
                    <?php echo $userRow['date']; ?>
                </td>
            </tr>

            <tr class="item">
                <td>
                    Appointment Time
                </td>

                <td>
                    <?php echo $userRow['startTime']; ?> untill <?php echo $userRow['endTime']; ?>
                </td>
            </tr>
        </table>
    </div>
    <div class="print">
        <button onclick="myFunction()">Print this page</button>
    </div>
    <script>
        function myFunction() {
            window.print();
        }
    </script>
</body>

</html>