<?php
require_once "../include/cn.php";


if (!isset($_SESSION)) {
    session_start();
}


if (isset($_POST['addWaiver'])) {

    $orgname = test_input($_POST['orgname']);
    $number = test_input($_POST['number']);
    $date = test_input($_POST['date']);
    $event = test_input($_POST['event']);

    $sql = "INSERT INTO tblwaiver (orgname, number,date, event) 
    VALUES ('$orgname', '$number','$date','$event')";
    $result = $conn->query($sql)or die(mysqli_error($conn));

    //audit add
    date_default_timezone_set('Asia/Manila');
    $user=$_SESSION["username"];
    $action = "Added a waiver.";
    $dateandtime = date("Y-m-d H:i:s");
    $sql = "INSERT INTO tblaudit (action, user, dateandtime) VALUES ('$action', '$user', '$dateandtime')";
    $conn->query($sql) or die(mysqli_error($conn));

    echo "<script>alert('Waiver successfully added!');window.location.href='waiver.php'</script>";
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
                Add Waiver
            </div>
            <div class="card-body">
                <form action="addwaiver.php" method="post">
                    <div class="form-group row">
                        <label for="orgname" class="col-sm-2 col-form-label">Name of Organization:</label>
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
                        <label for="number" class="col-sm-2 col-form-label">Number of Student:</label>
                        <div class="col">
                            <input name="number" required type="text" id="number"  class="form-control"
                            placeholder="Number of Student">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="date" class="col-sm-2 col-form-label">Date: </label>
                        <div class="col">
                            <input name="date" required type="text" id="date"  value="<?php echo date("Y-m-d")?>"  class="form-control"
                                   placeholder="YYYY-MM-DDD" pattern="[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="event" class="col-sm-2 col-form-label">Event: </label>
                        <div class="col">
                            <input name="event" required type="text" id="event"  class="form-control"
                            placeholder="Event">
                        </div>
                    </div>                   
                    <div class="text-center">
                        <input name="addWaiver" type="submit" class="mr-5 btn btn-primary" value="Add">
                        <a href="waiver.php" class="ml-5 btn btn-secondary">Go Back</a>
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
