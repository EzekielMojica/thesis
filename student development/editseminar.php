<?php

require_once "../include/cn.php";
if (!isset($_SESSION)) {
    session_start();
    if (!isset($_GET['seminarno'])) {
        header('Location: seminar.php');
        exit;
    } else {
        $seminarno = test_input($_GET['seminarno']);
        $sql = "SELECT * FROM tblseminar WHERE seminarno = '$seminarno'";
        $result = $conn->query($sql);
        if ($result->num_rows == 0) {
            header('Location: seminar.php');
            exit;
        }
        $row = $result->fetch_array();
    }
    if (isset($_POST['editSeminar'])) {

        $date = test_input($_POST['date']);
        $subunit = test_input($_POST['subunit']);
        $keyperson = test_input($_POST['keyperson']);
        $objective = test_input($_POST['objective']);
        $title = test_input($_POST['title']);
        $venue = test_input($_POST['venue']);
        $participants = test_input($_POST['participants']);
        $sponsoragency = test_input($_POST['sponsoragency']);
        $remarks = test_input($_POST['remarks']);
        $semester =  $_POST['semester'];
        $year = test_input($_POST['year']) ;
        $sql = "UPDATE tblseminar SET date='$date', subunit = '$subunit', keyperson = '$keyperson', objective = '$objective', title = '$title', venue = '$venue', participants='$participants', sponsoragency = '$sponsoragency', remarks = '$remarks', semester = '$semester', sy='$year' WHERE seminarno='" . $_GET['seminarno'] . "'";
        $conn->query($sql) or die(mysqli_error($conn));

        //audit edit
        date_default_timezone_set('Asia/Manila');
        $user=$_SESSION["username"];
        $action = "Updated a Seminar record.";
        $dateandtime = date("Y-m-d H:i:s");
        $sql = "INSERT INTO tblaudit (action, user, dateandtime) VALUES ('$action', '$user', '$dateandtime')";
        $conn->query($sql) or die(mysqli_error($conn));;

        header('Location: seminar.php');
    }
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
                Edit Seminar
            </div>
            <div class="card-body">
                <form method="post">

                    <div class="form-group row">
                        <label for="keyperson" class="col-sm-2 col-form-label">Sponsoring Unit/Key Person:</label>
                        <div class="col">
                            <input value="<?php echo $row['keyperson'] ?>" name="keyperson" required type="text"
                                   id="keyperson" class="form-control"
                                   placeholder="Sponsoring Unit/Key Person">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="date" class="col-sm-2 col-form-label">Date:</label>
                        <div class="col">
                            <input value="<?php echo $row['date'] ?>" name="date" required type="text" id="date"
                                   class="form-control"
                                   placeholder="Date">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="subunit" class="col-sm-2 col-form-label">Sub-Unit:</label>
                        <div class="col">
                            <input value="<?php echo $row['subunit'] ?>" name="subunit" required type="text"
                                   id="subunit" class="form-control"
                                   placeholder="Sub-Unit">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="objective" class="col-sm-2 col-form-label">Objectives: </label>
                        <div class="col">
                            <input value="<?php echo $row['objective'] ?>" name="objective" required type="text"
                                   id="objective" class="form-control"
                                   placeholder="Objectives">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="title" class="col-sm-2 col-form-label">Title of Seminar: </label>
                        <div class="col">
                            <input value="<?php echo $row['title'] ?>" name="title" required type="text" id="title"
                                   class="form-control"
                                   placeholder="Title of Seminar">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="venue" class="col-sm-2 col-form-label">Venue/Location</label>
                        <div class="col">
                            <input value="<?php echo $row['venue'] ?>" name="venue" required type="text" id="venue"
                                   class="form-control"
                                   placeholder="Venue/Location"></div>
                    </div>
                    <div class="form-group row">
                        <label for="sponsoragency" class="col-sm-2 col-form-label">Sponsoring Unit/Agency</label>
                        <div class="col">
                            <input value="<?php echo $row['sponsoragency'] ?>" name="sponsoragency" required type="text"
                                   id="sponsoragency" class="form-control"
                                   placeholder="Sponsoring Unit/Agency"></div>
                    </div>
                    <div class="form-group row">
                        <label for="president" class="col-sm-2 col-form-label">Participants:</label>
                        <div class="col">
                            <input value="<?php echo $row['participants'] ?>" name="participants" required type="text"
                                   id="participants" class="form-control"
                                   placeholder="Participants"></div>
                    </div>
                    <div class="form-group row">
                        <label for="remarks" class="col-sm-2 col-form-label">Remarks:</label>
                        <div class="col">
                            <input value="<?php echo $row['remarks'] ?>" name="remarks" required type="text"
                                   id="remarks" class="form-control"
                                   placeholder="Remarks"></div>
                    </div>
                    <div class="form-group row" id="name">
                        <label for="semester" class="col-sm-2 col-form-label">Semester:</label>
                        <div class="col-md-2" id="semester">
                            <select class="form-control" name="semester">
                                <?php
                        
                                switch ($row['semester']) {
                                    case "1st":
                                        echo " <option value=\"1st\">1st</option>
                                <option value=\"-2nd\">2nd</option>";
                                        break;
                                    case "2nd":
                                        echo " <option value=\"2nd\">2nd</option>
                                <option value=\"-1st\">1st</option>";
                                };
                                ?>
                            </select>
                        </div>
                        <div class="col">
                            <input value="<?php echo $row['sy'] ?>" name="year" required type="text" id="semester" class="form-control"
                                   placeholder="Year">
                        </div>
                    </div>
                    <div class="text-center">
                        <input name="editSeminar" type="submit" class="mr-5 btn btn-primary" value="Edit">
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