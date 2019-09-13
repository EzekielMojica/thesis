<?php
require_once "../include/cn.php";


if (!isset($_SESSION)) {
    session_start();
}

$sql = "SELECT * FROM tblpermit";
$result = $conn->query($sql);
$permitno = 0;
while ($row = $result->fetch_array()) {
    $permitno ++;
}

if (isset($_POST['addPermit'])) {

    $date = test_input($_POST['date']);
    $orgname = test_input($_POST['orgname']);
    $activity = test_input($_POST['activity']);
    $purpose = test_input($_POST['purpose']);
    $dateandtime = test_input($_POST['dateandtime']);
    $venue = test_input($_POST['venue']);
    $noofperson = test_input($_POST['noofperson']);

    $sql = "INSERT INTO tblpermit (permitno, date, orgname,activity, purpose, dateandtime, venue, noofperson) 
    VALUES ('$permitno', '$date','$orgname', '$activity','$purpose','$dateandtime','$venue', '$noofperson')";
    $result = $conn->query($sql)or die(mysqli_error($conn));

    //audit add
    date_default_timezone_set('Asia/Manila');
    $user=$_SESSION["username"];
    $action = "Added a permit.";
    $dateandtime = date("Y-m-d H:i:s");
    $sql = "INSERT INTO tblaudit (action, user, dateandtime) VALUES ('$action', '$user', '$dateandtime')";
    $conn->query($sql) or die(mysqli_error($conn));

    echo "<script>alert('Permit successfully added!');window.location.href='permit.php'</script>";
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
                <span class="fas fa-user-plus"></span>
                Add Permit
            </div>
            <div class="card-body">
                <form action="addpermit.php" method="post">
                    <div class="form-group row">
                        <label for="date" class="col-sm-2 col-form-label">Date:</label>
                        <div class="col">
                            <input name="date" required type="text" id="date"  value="<?php echo date("Y-m-d")?>"  class="form-control"
                                   placeholder="YYYY-MM-DDD" pattern="[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="orgname" class="col-sm-2 col-form-label">Name of the Organization:</label>
                        <div class="col">
                            <select name="orgname" class="form-control">
                                <optgroup label="Academic">
                            <?php
                            $sql = "SELECT * FROM tblorgs WHERE type = 'Academic'";
                            $result = $conn->query($sql);
                            while ($row = $result->fetch_array()){
                                echo "<option value='$row[name]'>$row[name]</option>";
                            }
                            echo "</optgroup>";

                            echo "<optgroup label=\"Non-Academic\">";
                            $sql = "SELECT * FROM tblorgs WHERE type = 'Non-Academic'";
                            $result = $conn->query($sql);
                            while ($row = $result->fetch_array()){
                                echo "<option value='$row[name]'>$row[name]</option>";
                            }
                            echo "</optgroup>";
                            ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="activity" class="col-sm-2 col-form-label">Activity: </label>
                        <div class="col">
                            <input name="activity" required type="text" id="activity"  class="form-control"
                            placeholder="Activity">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="purpose" class="col-sm-2 col-form-label">Purpose: </label>
                        <div class="col">
                            <input name="purpose" required type="text" id="purpose"  class="form-control"
                            placeholder="Purpose">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="dateandtime" class="col-sm-2 col-form-label">Date &amp; Time:</label>
                        <div class="col">
                            <input name="dateandtime" required type="datetime-local" id="dateandtime" class="form-control"
                            placeholder="Date &amp; Time"></div>
                        </div>
                        <div class="form-group row">
                            <label for="president" class="col-sm-2 col-form-label">Venue:</label>
                            <div class="col">
                                <input name="venue" required type="text" id="venue" class="form-control"
                                placeholder="Venue"></div>
                            </div>    
                            <div class="form-group row">
                                <label for="president" class="col-sm-2 col-form-label">No. of Person:</label>
                                <div class="col">
                                    <input name="noofperson" required type="text" id="noofperson" class="form-control"
                                    placeholder="No. of Person"></div>
                                </div>                   
                                <div class="text-center">
                                    <input name="addPermit" type="submit" class="mr-5 btn btn-primary" value="Add">
                                    <a href="permit.php" class="ml-5 btn btn-secondary">Go Back</a>
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
