<?php

require_once "../include/cn.php";
if (!isset($_SESSION)) {
    session_start();
    if (!isset($_GET['orgid'])) {
        header('Location: studentorgs.php');
        exit;
    } else {
        $orgid = test_input($_GET['orgid']);
        $sql = "SELECT * FROM tblorgs WHERE orgid = '$orgid'";
        $result = $conn->query($sql);
        if ($result->num_rows == 0) {
            header('Location: studentorgs.php');
            exit;
        }
        $row = $result->fetch_array();
    }
    if (isset($_POST['editOrg'])) {
        $type = test_input($_POST['type']);
        $name = test_input($_POST['name']);
        $date = test_input($_POST['date']);
        $year = test_input($_POST['year']);
        $adviser = test_input($_POST['adviser']);
        $president = test_input($_POST['president']);
        $sql = "UPDATE tblorgs SET type='$type', name='$name', date = '$date', academicyear = '$year', adviser='$adviser' WHERE orgid='" . $_GET['orgid'] . "'";
        $conn->query($sql) or die(mysqli_error($conn));


        //audit edit
        date_default_timezone_set('Asia/Manila');
        $user=$_SESSION["username"];
        $action = "Updated an organization record.";
        $dateandtime = date("Y-m-d H:i:s");
        $sql = "INSERT INTO tblaudit (action, user, dateandtime) VALUES ('$action', '$user', '$dateandtime')";
        $conn->query($sql) or die(mysqli_error($conn));

        header('Location: studentorgs.php');
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
                Edit Organization
            </div>
            <div class="card-body">
                <form method="post">
                    <div class="form-group row">
                        <label for="type" class="col-sm-2 col-form-label">Type:</label>
                        <div class="col">
                            <select name="type" id="type" class="form-control">
                                <?php
                                switch ($row['type']) {
                                    case "Academic":
                                        echo "<optgroup>
                                    <option value=\"Academic\">Academic</option>
                                    <option value=\"Non-Academic\">Non-Academic</option>
                                </optgroup>";
                                        break;
                                    case "Non-Academic":
                                        echo "<optgroup>
                                    <option value=\"Non-Academic\">Non-Academic</option>
                                    <option value=\"Academic\">Academic</option>
                                </optgroup>";
                                        break;
                                }
                                ?>


                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Name of the Organization:</label>
                        <div class="col">
                            <input value="<?php echo $row['name'] ?>" name="name" required type="text" id="name"
                                   class="form-control"
                                   placeholder="Name of the Organization">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="date" class="col-sm-2 col-form-label">Date of Application: </label>
                        <div class="col">
                            <input value="<?php echo $row['date'] ?>" name="date" required type="text" id="date"
                                   class="form-control"
                                   placeholder="Date of Application">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Academic Year: </label>
                        <div class="col">
                            <input value="<?php echo $row['academicyear'] ?>" name="year" required type="text" id="year"
                                   class="form-control"
                                   placeholder="Academic Year">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="adviser" class="col-sm-2 col-form-label">Adviser:</label>
                        <div class="col">
                            <input value="<?php echo $row['adviser'] ?>" name="adviser" required type="text"
                                   id="adviser" class="form-control"
                                   placeholder="Adviser"></div>
                    </div>
                    <div class="text-center">
                        <input name="editOrg" type="submit" class="mr-5 btn btn-primary" value="Update">
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
