<?php
require_once "../include/cn.php";


if (!isset($_SESSION)) {
    session_start();
}


if (isset($_POST['addAccomplished'])) {

    $orgname = test_input($_POST['orgname']);
    $proposedate = test_input($_POST['date']);
    $activity = test_input($_POST['activity']);
    $name = test_input($_POST['name']);
    $date = test_input($_POST['date']);
    $participants = test_input($_POST['participants']);
    $remarks = test_input($_POST['remarks']);

    $sql = "INSERT INTO tblaccomplished (orgname, proposedate, activity, name, date, participants, remarks) 
    VALUES ('$orgname', '$proposedate', '$activity','$name','$date','$participants', '$remarks')";
    $result = $conn->query($sql)or die(mysqli_error($conn));

    //audit add
    date_default_timezone_set('Asia/Manila');
    $user=$_SESSION["username"];
    $action = "Added an accomplished activity record.";
    $dateandtime = date("Y-m-d H:i:s");
    $sql = "INSERT INTO tblaudit (action, user, dateandtime) VALUES ('$action', '$user', '$dateandtime')";
    $conn->query($sql) or die(mysqli_error($conn));

   echo "<script>alert('Accomplished Activity successfully added!');window.location.href='accomplishedactivity.php'</script>";
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
                Add Accomplished Activity
            </div>
            <div class="card-body">
                <form action="addaccomplishedactivity.php" method="post">

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
                        <label for="date" class="col-sm-2 col-form-label">Proposed Date:</label>
                        <div class="col">
                            <input name="proposedate" required type="date" id="date"  value="<?php echo date("Y-m-d")?>"  class="form-control"
                                   placeholder="YYYY-MM-DDD" pattern="[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])">
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
                        <label for="name" class="col-sm-2 col-form-label">Name: </label>
                        <div class="col">
                            <input name="name" required type="text" id="name"  class="form-control"
                            placeholder="Name">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="date" class="col-sm-2 col-form-label">Date</label>
                        <div class="col">
                            <input name="date" required type="date" id="date"  value="<?php echo date("Y-m-d")?>"  class="form-control"
                                   placeholder="YYYY-MM-DDD" pattern="[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])"></div>
                        </div>
                        <div class="form-group row">
                            <label for="president" class="col-sm-2 col-form-label">Participants:</label>
                            <div class="col">
                                <input name="participants" required type="text" id="participants" class="form-control"
                                placeholder="Participants"></div>
                            </div>    
                            <div class="form-group row">
                                <label for="remarks" class="col-sm-2 col-form-label">Remarks:</label>
                                <div class="col">
                                    <input name="remarks" required type="text" id="remarks" class="form-control"
                                    placeholder="Remarks"></div>
                                </div>                   
                                <div class="text-center">
                                    <input name="addAccomplished" type="submit" class="mr-5 btn btn-primary" value="Add">
                                    <a href="accomplishedactivity.php" class="ml-5 btn btn-secondary">Go Back</a>
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
