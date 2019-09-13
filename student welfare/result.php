<?php
require "../include/cn.php";
if (!isset($_SESSION)) {
    session_start();
}

if (isset($_GET['eventid'])) {
    $eventid = test_input($_GET['eventid']);
    $sql = "SELECT * FROM tblevent WHERE eventid = '$eventid'";
    $result = $conn->query($sql);
    $row = $result->fetch_array();
} else {
    header('Location: evaluate.php');
}
if (!isset($_SESSION['username'])) {
    header('Location: ../index.php');
    exit;
}
include_once "gui.php";
?>
<div class="content-wrapper">
    <div class="container-fluid">
        <div class="card mb-3">
            <div class="card-header">
                <span class="far fa-sticky-note"></span>
                Evaluation Form
            </div>
            <div class="card-body">
                <form action="" method="post">
                    <div class="form-inline">
                        <span class="mr-3">Activity: <b><?php echo $row['title'];?></b></span>
                    </div>
                    <span class="float-right">Date: <b><?php echo $row['start_event']; ?></b></span>
                    <p>Venue: <b><?php echo $row['venue']; ?></b></p>
                    <table class="table table-bordered">
                        <thead>
                        <tr class="text-center">
                            <th>Particulars</th>
                            <th>Poor</th>
                            <th>Fair</th>
                            <th>Satisfactory</th>
                            <th>Very Satisfactory</th>
                            <th>Excellent</th>
                            <th>Total</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="text-center">
                            <td class="text-left">Meeting of your expectations</td>
                            <?php
                            $sql = "
                            SELECT
                            COUNT(IF(expectation = 'Poor','YES', NULL)) AS poor,
                            COUNT(IF(expectation = 'Fair','YES', NULL)) AS fair,
                            COUNT(IF(expectation = 'Satisfactory','YES', NULL)) AS satisfactory,
                            COUNT(IF(expectation = 'Very Satisfactory','YES', NULL)) AS verySatisfactory,
                            COUNT(IF(expectation = 'Excellent','YES', NULL)) AS excellent,
                            COUNT(expectation) AS total
                            FROM `tblevaluation` WHERE eventid = $eventid
                            ";
                            $result = $conn->query($sql);
                            $row = $result->fetch_array();
                            for ($j=0;$j<(count($row)/2);$j++){
                                echo "<td>$row[$j]</td>";
                            }
                            ?>
                        </tr>
                        <tr class="text-center">
                            <td class="text-left">Attainment of the objectives</td>
                            <?php
                            $sql = "
                            SELECT
                            COUNT(IF(objective = 'Poor','YES', NULL)) AS poor,
                            COUNT(IF(objective = 'Fair','YES', NULL)) AS fair,
                            COUNT(IF(objective = 'Satisfactory','YES', NULL)) AS satisfactory,
                            COUNT(IF(objective = 'Very Satisfactory','YES', NULL)) AS verySatisfactory,
                            COUNT(IF(objective = 'Excellent','YES', NULL)) AS excellent,
                            COUNT(objective) AS total
                            FROM `tblevaluation` WHERE eventid = $eventid
                            ";
                            $result = $conn->query($sql);
                            $row = $result->fetch_array();
                            for ($j=0;$j<(count($row)/2);$j++){
                                echo "<td>$row[$j]</td>";
                            }
                            ?>
                        </tr>
                        <tr class="text-center">
                            <td class="text-left">Timeliness of the activity</td>
                            <?php
                            $sql = "
                            SELECT
                            COUNT(IF(timeliness = 'Poor','YES', NULL)) AS poor,
                            COUNT(IF(timeliness= 'Fair','YES', NULL)) AS fair,
                            COUNT(IF(timeliness = 'Satisfactory','YES', NULL)) AS satisfactory,
                            COUNT(IF(timeliness = 'Very Satisfactory','YES', NULL)) AS verySatisfactory,
                            COUNT(IF(timeliness = 'Excellent','YES', NULL)) AS excellent,
                            COUNT(timeliness) AS total
                            FROM `tblevaluation` WHERE eventid = $eventid
                            ";
                            $result = $conn->query($sql);
                            $row = $result->fetch_array();
                            for ($j=0;$j<(count($row)/2);$j++){
                                echo "<td>$row[$j]</td>";
                            }
                            ?>
                        </tr>
                        <tr class="text-center">
                            <td class="text-left">Topics included</td>
                            <?php
                            $sql = "
                            SELECT
                            COUNT(IF(topic = 'Poor','YES', NULL)) AS poor,
                            COUNT(IF(topic= 'Fair','YES', NULL)) AS fair,
                            COUNT(IF(topic = 'Satisfactory','YES', NULL)) AS satisfactory,
                            COUNT(IF(topic = 'Very Satisfactory','YES', NULL)) AS verySatisfactory,
                            COUNT(IF(topic = 'Excellent','YES', NULL)) AS excellent,
                            COUNT(topic) AS total
                            FROM `tblevaluation` WHERE eventid = $eventid
                            ";
                            $result = $conn->query($sql);
                            $row = $result->fetch_array();
                            for ($j=0;$j<(count($row)/2);$j++){
                                echo "<td>$row[$j]</td>";
                            }
                            ?>
                        </tr>
                        <tr>
                            <th colspan="7">Methodologies used</th>
                        </tr>
                        <tr class="text-center">
                            <td class="text-left">Activities</td>
                            <?php
                            $sql = "
                            SELECT
                            COUNT(IF(activities = 'Poor','YES', NULL)) AS poor,
                            COUNT(IF(activities = 'Fair','YES', NULL)) AS fair,
                            COUNT(IF(activities = 'Satisfactory','YES', NULL)) AS satisfactory,
                            COUNT(IF(activities = 'Very Satisfactory','YES', NULL)) AS verySatisfactory,
                            COUNT(IF(activities = 'Excellent','YES', NULL)) AS excellent,
                            COUNT(activities) AS total
                            FROM `tblevaluation` WHERE eventid = $eventid
                            ";
                            $result = $conn->query($sql);
                            $row = $result->fetch_array();
                            for ($j=0;$j<(count($row)/2);$j++){
                                echo "<td>$row[$j]</td>";
                            }
                            ?>
                        </tr>
                        <tr class="text-center">
                            <td class="text-left">Instructional/Presentation Aids</td>
                            <?php
                            $sql = "
                            SELECT
                            COUNT(IF(ims = 'Poor','YES', NULL)) AS poor,
                            COUNT(IF(ims = 'Fair','YES', NULL)) AS fair,
                            COUNT(IF(ims = 'Satisfactory','YES', NULL)) AS satisfactory,
                            COUNT(IF(ims = 'Very Satisfactory','YES', NULL)) AS verySatisfactory,
                            COUNT(IF(ims = 'Excellent','YES', NULL)) AS excellent,
                            COUNT(ims) AS total
                            FROM `tblevaluation` WHERE eventid = $eventid
                            ";
                            $result = $conn->query($sql);
                            $row = $result->fetch_array();
                            for ($j=0;$j<(count($row)/2);$j++){
                                echo "<td>$row[$j]</td>";
                            }
                            ?>
                        </tr>
                        <tr>
                            <th colspan="7">Resource Speaker</th>
                        </tr>
                        <tr class="text-center">
                            <th class="text-left">Name</th>
                            <th>Poor</th>
                            <th>Fair</th>
                            <th>Satisfactory</th>
                            <th>Very Satisfactory</th>
                            <th>Excellent</th>
                            <th>Total</th>
                        </tr>
                            <?php
                            $sql = "SELECT name,
                            COUNT(IF(rate='Poor', 'YES', NULL)) AS Poor, 
                            COUNT(IF(rate = 'Fair','YES', NULL)) AS fair,
                            COUNT(IF(rate = 'Satisfactory','YES', NULL)) AS satisfactory,
                            COUNT(IF(rate = 'Very Satisfactory','YES', NULL)) AS verySatisfactory,
                            COUNT(IF(rate = 'Excellent','YES', NULL)) AS excellent,
                            COUNT(rate) AS total FROM tblspeaker
                            WHERE eventid = $eventid GROUP BY name";
                            $result = $conn->query($sql);
                            while ($row = $result->fetch_array()){
                                echo "<tr class='text-center'>";
                                echo "<td class='text-left'>$row[name]</td>";
                                echo "<td>$row[1]</td>";
                                echo "<td>$row[2]</td>";
                                echo "<td>$row[3]</td>";
                                echo "<td>$row[4]</td>";
                                echo "<td>$row[5]</td>";
                                echo "<td>$row[6]</td>";
                                echo "</tr>";
                            }
                            ?>
                        <tr class="text-center">
                            <td class="text-left">Management Team</td>
                            <?php
                            $sql = "
                            SELECT
                            COUNT(IF(management = 'Poor','YES', NULL)) AS poor,
                            COUNT(IF(management = 'Fair','YES', NULL)) AS fair,
                            COUNT(IF(management = 'Satisfactory','YES', NULL)) AS satisfactory,
                            COUNT(IF(management = 'Very Satisfactory','YES', NULL)) AS verySatisfactory,
                            COUNT(IF(management = 'Excellent','YES', NULL)) AS excellent,
                            COUNT(management) AS total
                            FROM `tblevaluation` WHERE eventid = $eventid
                            ";
                            $result = $conn->query($sql);
                            $row = $result->fetch_array();
                            for ($j=0;$j<(count($row)/2);$j++){
                                echo "<td>$row[$j]</td>";
                            }
                            ?>
                        </tr>
                        <tr class="text-center">
                            <td class="text-left">Venue</td>
                            <?php
                            $sql = "
                            SELECT
                            COUNT(IF(venue = 'Poor','YES', NULL)) AS poor,
                            COUNT(IF(venue = 'Fair','YES', NULL)) AS fair,
                            COUNT(IF(venue = 'Satisfactory','YES', NULL)) AS satisfactory,
                            COUNT(IF(venue = 'Very Satisfactory','YES', NULL)) AS verySatisfactory,
                            COUNT(IF(venue = 'Excellent','YES', NULL)) AS excellent,
                            COUNT(venue) AS total
                            FROM `tblevaluation` WHERE eventid = $eventid
                            ";
                            $result = $conn->query($sql);
                            $row = $result->fetch_array();
                            for ($j=0;$j<(count($row)/2);$j++){
                                echo "<td>$row[$j]</td>";
                            }
                            ?>
                        </tr>
                        <tr class="text-center">
                            <td class="text-left">Food</td>
                            <?php
                            $sql = "
                            SELECT
                            COUNT(IF(food = 'Poor','YES', NULL)) AS poor,
                            COUNT(IF(food = 'Fair','YES', NULL)) AS fair,
                            COUNT(IF(food = 'Satisfactory','YES', NULL)) AS satisfactory,
                            COUNT(IF(food = 'Very Satisfactory','YES', NULL)) AS verySatisfactory,
                            COUNT(IF(food = 'Excellent','YES', NULL)) AS excellent,
                            COUNT(food) AS total
                            FROM `tblevaluation` WHERE eventid = $eventid
                            ";
                            $result = $conn->query($sql);
                            $row = $result->fetch_array();
                            for ($j=0;$j<(count($row)/2);$j++){
                                echo "<td>$row[$j]</td>";
                            }
                            ?>
                        </tr>
                        <tr class="text-center">
                            <td class="text-left">Accommodation</td>
                            <?php
                            $sql = "
                            SELECT
                            COUNT(IF(accommodation = 'Poor','YES', NULL)) AS poor,
                            COUNT(IF(accommodation = 'Fair','YES', NULL)) AS fair,
                            COUNT(IF(accommodation = 'Satisfactory','YES', NULL)) AS satisfactory,
                            COUNT(IF(accommodation = 'Very Satisfactory','YES', NULL)) AS verySatisfactory,
                            COUNT(IF(accommodation = 'Excellent','YES', NULL)) AS excellent,
                            COUNT(accommodation) AS total
                            FROM `tblevaluation` WHERE eventid = $eventid
                            ";
                            $result = $conn->query($sql);
                            $row = $result->fetch_array();
                            for ($j=0;$j<(count($row)/2);$j++){
                                echo "<td>$row[$j]</td>";
                            }
                            ?>
                        </tr>
                        </tbody>
                    </table>
                    <div class="text-center">
                        <a href="printeval.php?eventid=<?php echo $_GET['eventid']?>" class="btn btn-primary mr-5"><span class="fas fa-print">&nbsp;</span>Print</a>
                        <input name="back" type="button" class="ml-5 btn btn-secondary" value="Go Back" onclick="window.history.back()">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php
    include_once "../include/footer.php";
    ?>
</div>
<script src="../js/bootstrap.bundle.min.js" type="text/javascript"></script>
<script src="../js/sb-admin.min.js" type="text/javascript"></script>
</body>
</html>
