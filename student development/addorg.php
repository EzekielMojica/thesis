<?php
require_once "../include/cn.php";


if (!isset($_SESSION)) {
    session_start();
}


if (isset($_POST['addOrg'])) {
    
    $type = test_input($_POST['type']);
    $orgName = test_input($_POST['name']);
    $adviser = test_input($_POST['adviser']);
    $date = test_input($_POST['date']);
    $year = test_input($_POST['year']);
    $sql = "INSERT INTO tblorgs (type, name,date, academicyear, adviser) 
             VALUES ('$type','$orgName', '$date','$year','$adviser')";
    $result = $conn->query($sql)or die(mysqli_error($conn));

    $sql = "SELECT LAST_INSERT_ID()";
    $result = $conn->query($sql)or die(mysqli_error($conn));
    $row = $result->fetch_array();
    $orgid = $row[0];

    //audit add
    date_default_timezone_set('Asia/Manila');
    $user=$_SESSION["username"];
    $action = "Added an organization record.";
    $dateandtime = date("Y-m-d H:i:s");
    $sql = "INSERT INTO tblaudit (action, user, dateandtime) VALUES ('$action', '$user', '$dateandtime')";
    $conn->query($sql) or die(mysqli_error($conn));

    echo "<script>alert('New organization successfully added! Now proceeding to add president'); window.location.href='noalist.php?orgid=". $orgid ."';</script>";
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
                Add Organization
            </div>
            <div class="card-body">
                <form action="addorg.php" method="post">
                    <div class="form-group row">
                        <label for="type" class="col-sm-2 col-form-label">Type:</label>
                        <div class="col">
                            <select name="type" id="type" class="form-control" required>
                                <option value="">Select type here</option>
                                <optgroup>
                                    <option value="Academic">Academic</option>
                                    <option value="Non-Academic">Non-Academic</option>
                                </optgroup>   
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Name of the Organization:</label>
                        <div class="col">
                            <input name="name" required type="text" id="name"  class="form-control"
                                placeholder="Name of the Organization">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="date" class="col-sm-2 col-form-label">Date of Application: </label>
                        <div class="col">
                            <input name="date" required type="text" id="date" value="<?php echo date("Y-m-d")?>"  class="form-control"
                                   placeholder="YYYY-MM-DDD" pattern="[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Academic Year: </label>
                        <div class="col">
                            <input name="year" required type="text" id="year"  class="form-control"
                                   placeholder="Academic Year">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="adviser" class="col-sm-2 col-form-label">Adviser:</label>
                        <div class="col">
                            <input name="adviser" required type="text" id="adviser" class="form-control"
                                placeholder="Adviser"></div>
                    </div>
                    <div class="text-center">
                        <input name="addOrg" type="submit" class="mr-5 btn btn-primary" value="Add">
                        <a href="studentorgs.php" class="ml-5 btn btn-secondary">Go Back</a>
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
