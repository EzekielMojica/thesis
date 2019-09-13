<?php
require "../include/cn.php";
$ctr=0;
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
if (isset($_POST['addEvaluate'])){
    $eventid = test_input($_GET['eventid']);
    $expectation = test_input($_POST['expectation']);
    $objective = test_input($_POST['objective']);
    $timeliness = test_input($_POST['timeliness']);
    $topic = test_input($_POST['topic']);
    $activities = test_input($_POST['activities']);
    $ims = test_input($_POST['ims']);
    $management = test_input($_POST['management']);
    $venue = test_input($_POST['venue']);
    $food = test_input($_POST['food']);
    $accommodation = test_input($_POST['accommodation']);
    $sql = "INSERT INTO tblevaluation (eventid, expectation, objective, timeliness, topic, activities, ims, management, venue, food, accommodation) VALUES ('$eventid', '$expectation', '$objective', '$timeliness', '$topic', '$activities', '$ims', '$management', '$venue', '$food', '$accommodation')";
   $conn->query($sql);
//speaker
    for ($j=1;!empty($_POST["speaker$j"]);$j++){
        $name = $_POST["speaker$j"];
        $rate = $_POST["speakerRate$j"];
        $sql = "INSERT INTO tblspeaker (name, rate, eventid) VALUES ('$name', '$rate', '$eventid')";
        $conn->query($sql);
    
    }
    echo "<script>alert('Added successfully');</script>";
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
                        <span class="mr-3">Activity: <b><?php echo $row['title'] ?></b></span>
                    </div>
                    <span class="float-right">Date: <b><?php echo $row['start_event'] ?></b></span>
                    <p>Venue: <b><?php echo $row['venue'] ?></b></p>
                    <table class="table table-bordered">
                        <thead>
                            <tr class="text-center">
                                <th>Particulars</th>
                                <th>Poor</th>
                                <th>Fair</th>
                                <th>Satisfactory</th>
                                <th>Very Satisfactory</th>
                                <th>Excellent</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="text-center">
                                <td class="text-left">Meeting of your expectations</td>
                                <td><input type="radio" name="expectation" value="Poor" required></td>
                                <td><input type="radio" name="expectation" value="Fair"></td>
                                <td><input type="radio" name="expectation" value="Satisfactory"></td>
                                <td><input type="radio" name="expectation" value="Very Satisfactory"></td>
                                <td><input type="radio" name="expectation" value="Excellent"></td>
                            </tr>
                            <tr class="text-center">
                                <td class="text-left">Attainment of the objectives</td>
                                <td><input type="radio" name="objective" value="Poor" required></td>
                                <td><input type="radio" name="objective" value="Fair"></td>
                                <td><input type="radio" name="objective" value="Satisfactory"></td>
                                <td><input type="radio" name="objective" value="Very Satisfactory"></td>
                                <td><input type="radio" name="objective" value="Excellent"></td>
                            </tr>
                            <tr class="text-center">
                                <td class="text-left">Timeliness of the activity</td>
                                <td><input type="radio" name="timeliness" value="Poor" required></td>
                                <td><input type="radio" name="timeliness" value="Fair"></td>
                                <td><input type="radio" name="timeliness" value="Satisfactory"></td>
                                <td><input type="radio" name="timeliness" value="Very Satisfactory"></td>
                                <td><input type="radio" name="timeliness" value="Excellent"></td>
                            </tr>
                            <tr class="text-center">
                                <td class="text-left">Topics included</td>
                                <td><input type="radio" name="topic" value="Poor" required></td>
                                <td><input type="radio" name="topic" value="Fair"></td>
                                <td><input type="radio" name="topic" value="Satisfactory"></td>
                                <td><input type="radio" name="topic" value="Very Satisfactory"></td>
                                <td><input type="radio" name="topic" value="Excellent"></td>
                            </tr>
                            <tr>
                                <th colspan="6">Methodologies used</th>
                            </tr>
                            <tr class="text-center">
                                <td class="text-left">Activities</td>
                                <td><input type="radio" name="activities" value="Poor" required></td>
                                <td><input type="radio" name="activities" value="Fair"></td>
                                <td><input type="radio" name="activities" value="Satisfactory"></td>
                                <td><input type="radio" name="activities" value="Very Satisfactory"></td>
                                <td><input type="radio" name="activities" value="Excellent"></td>
                            </tr>
                            <tr class="text-center">
                                <td class="text-left">Instructional/Presentation Aids</td>
                                <td><input type="radio" name="ims" value="Poor" required></td>
                                <td><input type="radio" name="ims" value="Fair"></td>
                                <td><input type="radio" name="ims" value="Satisfactory"></td>
                                <td><input type="radio" name="ims" value="Very Satisfactory"></td>
                                <td><input type="radio" name="ims" value="Excellent"></td>
                            </tr>
                            <tr>
                                <th colspan="6">Resource Speaker</th>
                            </tr>
                            <tr class="text-center">
                                <th class="text-left">Name</th>
                                <th>Poor</th>
                                <th>Fair</th>
                                <th>Satisfactory</th>
                                <th>Very Satisfactory</th>
                                <th>Excellent</th>
                            </tr>
                            <?php
                            $eventid = test_input($_GET['eventid']);
                            $sql2 = "SELECT name FROM tblspeaker WHERE eventid = '$eventid' GROUP BY name";
                            $result = $conn->query($sql2);
                        if ($result->num_rows == 0) { //wala
                            echo ' <tr class="text-center">
                            <td><input type="text" name="speaker1" class="form-control" placeholder="Speaker Name" required></td>
                            <td><input type="radio" name="speakerRate1" value="Poor" required></td>
                            <td><input type="radio" name="speakerRate1" value="Fair"></td>
                            <td><input type="radio" name="speakerRate1" value="Satisfactory"></td>
                            <td><input type="radio" name="speakerRate1" value="Very Satisfactory"></td>
                            <td><input type="radio" name="speakerRate1" value="Excellent"></td>
                            </tr>
                            <tr class="text-center">
                            <td><input type="text" name="speaker2" class="form-control" placeholder="Speaker Name"></td>
                            <td><input type="radio" name="speakerRate2" value="Poor"></td>
                            <td><input type="radio" name="speakerRate2" value="Fair"></td>
                            <td><input type="radio" name="speakerRate2" value="Satisfactory"></td>
                            <td><input type="radio" name="speakerRate2" value="Very Satisfactory"></td>
                            <td><input type="radio" name="speakerRate2" value="Excellent"></td>
                            </tr>
                            <tr class="text-center">
                            <td><input type="text" name="speaker3" class="form-control" placeholder="Speaker Name"></td>
                            <td><input type="radio" name="speakerRate3" value="Poor"></td>
                            <td><input type="radio" name="speakerRate3" value="Fair"></td>
                            <td><input type="radio" name="speakerRate3" value="Satisfactory"></td>
                            <td><input type="radio" name="speakerRate3" value="Very Satisfactory"></td>
                            <td><input type="radio" name="speakerRate3" value="Excellent"></td>
                            </tr>
                            <tr class="text-center">
                            <td><input type="text" name="speaker4" class="form-control" placeholder="Speaker Name"></td>
                            <td><input type="radio" name="speakerRate4" value="Poor"></td>
                            <td><input type="radio" name="speakerRate4" value="Fair"></td>
                            <td><input type="radio" name="speakerRate4" value="Satisfactory"></td>
                            <td><input type="radio" name="speakerRate4" value="Very Satisfactory"></td>
                            <td><input type="radio" name="speakerRate4" value="Excellent"></td>
                            </tr>
                            <tr class="text-center">
                            <td><input type="text" name="speaker5" class="form-control" placeholder="Speaker Name"></td>
                            <td><input type="radio" name="speakerRate5" value="Poor"></td>
                            <td><input type="radio" name="speakerRate5" value="Fair"></td>
                            <td><input type="radio" name="speakerRate5" value="Satisfactory"></td>
                            <td><input type="radio" name="speakerRate5" value="Very Satisfactory"></td>
                            <td><input type="radio" name="speakerRate5" value="Excellent"></td>
                            </tr>
                            <tr class="text-center">
                            <td><input type="text" name="speaker6" class="form-control" placeholder="Speaker Name"></td>
                            <td><input type="radio" name="speakerRate6" value="Poor"></td>
                            <td><input type="radio" name="speakerRate6" value="Fair"></td>
                            <td><input type="radio" name="speakerRate6" value="Satisfactory"></td>
                            <td><input type="radio" name="speakerRate6" value="Very Satisfactory"></td>
                            <td><input type="radio" name="speakerRate6" value="Excellent"></td>
                            </tr>';
                        }else{ //meron
                            
                             while ($row = $result->fetch_array()) {
                                  $ctr=$ctr+1;
                                echo '<tr class="text-center">
                                <td><input readonly value="'.$row['name'].'" type="text" name="speaker'.$ctr.'" class="form-control" placeholder="Speaker Name"></td>
                                <td><input type="radio" name="speakerRate'.$ctr.'" value="Poor"></td>
                                <td><input type="radio" name="speakerRate'.$ctr.'" value="Fair"></td>
                                <td><input type="radio" name="speakerRate'.$ctr.'" value="Satisfactory"></td>
                                <td><input type="radio" name="speakerRate'.$ctr.'" value="Very Satisfactory"></td>
                                <td><input type="radio" name="speakerRate'.$ctr.'" value="Excellent"></td>
                                </tr>';      
                            }
                        }
                        ?>

                        <tr class="text-center">
                            <td class="text-left">Management Team</td>
                            <td><input type="radio" name="management" value="Poor" required></td>
                            <td><input type="radio" name="management" value="Fair"></td>
                            <td><input type="radio" name="management" value="Satisfactory"></td>
                            <td><input type="radio" name="management" value="Very Satisfactory"></td>
                            <td><input type="radio" name="management" value="Excellent"></td>
                        </tr>
                        <tr class="text-center">
                            <td class="text-left">Venue</td>
                            <td><input type="radio" name="venue" value="Poor" required></td>
                            <td><input type="radio" name="venue" value="Fair"></td>
                            <td><input type="radio" name="venue" value="Satisfactory"></td>
                            <td><input type="radio" name="venue" value="Very Satisfactory"></td>
                            <td><input type="radio" name="venue" value="Excellent"></td>
                        </tr>
                        <tr class="text-center">
                            <td class="text-left">Food</td>
                            <td><input type="radio" name="food" value="Poor" required></td>
                            <td><input type="radio" name="food" value="Fair"></td>
                            <td><input type="radio" name="food" value="Satisfactory"></td>
                            <td><input type="radio" name="food" value="Very Satisfactory"></td>
                            <td><input type="radio" name="food" value="Excellent"></td>
                        </tr>
                        <tr class="text-center">
                            <td class="text-left">Accommodation</td>
                            <td><input type="radio" name="accommodation" value="Poor" required></td>
                            <td><input type="radio" name="accommodation" value="Fair"></td>
                            <td><input type="radio" name="accommodation" value="Satisfactory"></td>
                            <td><input type="radio" name="accommodation" value="Very Satisfactory"></td>
                            <td><input type="radio" name="accommodation" value="Excellent"></td>
                        </tr>
                    </tbody>
                </table>
                <div class="text-center">
                    <input name="addEvaluate" type="submit" class="mr-5 btn btn-primary" value="Submit">
                    <a href="evaluate.php" class="ml-5 btn btn-danger">Exit</a>
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
<script>
    $(document).ready(function(){
        $("td").click(function(){
            $(this).children().prop("checked", true);
        });
    });
</script>
</body>
</html>
