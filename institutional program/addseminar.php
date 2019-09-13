<?php
require_once "../include/cn.php";

if (!isset($_SESSION)) {
    session_start();
}


if (isset($_POST['addSeminar'])) {

    $date = test_input($_POST['date']);
    $keyperson = test_input($_POST['keyperson']);
    $subunit = test_input($_SESSION['subunit']);
    $objective = test_input($_POST['objective']);
    $title = test_input($_POST['title']);
    $venue = test_input($_POST['venue']);
    $participants = test_input($_POST['participants']);
    $sponsoragency = test_input($_POST['sponsoragency']);
    $remarks = test_input($_POST['remarks']);
    $semester = $_POST['semester'];
    $year = test_input($_POST['year']);

    $sql = "INSERT INTO tblseminar (date, subunit, keyperson, objective, title, venue, participants, sponsoragency, remarks, semester,sy) 
    VALUES ('$date', '$subunit', '$keyperson', '$objective', '$title', '$venue', '$participants', '$sponsoragency', '$remarks', '$semester','$year')";
    $result = $conn->query($sql)or die(mysqli_error($conn));

    //audit add
    date_default_timezone_set('Asia/Manila');
    $user=$_SESSION["username"];
    $action = "Added a seminar attended record.";
    $dateandtime = date("Y-m-d H:i:s");
    $sql = "INSERT INTO tblaudit (action, user, dateandtime) VALUES ('$action', '$user', '$dateandtime')";
    $conn->query($sql) or die(mysqli_error($conn));

    echo "<script>alert('Seminar successfully added!');window.location.href = 'seminar.php';</script>";
  
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
                Add Seminar
            </div>
            <div class="card-body">
                <form action="addseminar.php" method="post">

                    <div class="form-group row">
                        <label for="keyperson" class="col-sm-2 col-form-label">Sponsoring Unit/Key Person:</label>
                        <div class="col">
                            <input name="keyperson" required type="text" id="keyperson"  class="form-control"
                                   placeholder="Sponsoring Unit/Key Person">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="date" class="col-sm-2 col-form-label">Date:</label>
                        <div class="col">
                            <input name="date" required type="text" id="date" value="<?php echo date("M d, Y")?>"  class="form-control"
                                  >
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="objective" class="col-sm-2 col-form-label">Objectives: </label>
                        <div class="col">
                            <input name="objective" required type="text" id="objective"  class="form-control"
                                   placeholder="Objectives">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="title" class="col-sm-2 col-form-label">Title of Seminar: </label>
                        <div class="col">
                            <input name="title" required type="text" id="title"  class="form-control"
                                   placeholder="Title of Seminar">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="venue" class="col-sm-2 col-form-label">Venue/Location</label>
                        <div class="col">
                            <input name="venue" required type="text" id="venue" class="form-control"
                                   placeholder="Venue/Location"></div>
                    </div>
                    <div class="form-group row">
                        <label for="sponsoragency" class="col-sm-2 col-form-label">Sponsoring Unit/Agency</label>
                        <div class="col">
                            <input name="sponsoragency" required type="text" id="sponsoragency" class="form-control"
                                   placeholder="Sponsoring Unit/Agency"></div>
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
                    <div class="form-group row" id="name">
                        <label for="semester" class="col-sm-2 col-form-label">Semester:</label>
                        <div class="col-md-2" id="semester">
                            <select class="form-control" name="semester"  required>
                                <option value="">Select here</option>
                                <optgroup>
                                <option value="1st">1st</option>
                                <option value="2nd">2nd</option>
                                </optgroup>
                            </select>
                        </div>
                        <div class="col">
                            <input name="year" required type="text" id="year" class="form-control"
                                   placeholder="Year">
                        </div>
                    </div>
                    <div class="text-center">
                        <input name="addSeminar" type="submit" class="mr-5 btn btn-primary" value="Add">
                        <a href="seminar.php" class="ml-5 btn btn-secondary">Go Back</a>
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
