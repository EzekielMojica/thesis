<?php
require_once "../include/cn.php";
if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_GET['downloadno'])) {
    header('Location: ../downloads.php');
    exit;
} else {
    $downloadno = test_input($_GET['downloadno']);
    $sql = "SELECT * FROM tbldownload WHERE downloadno = '$downloadno'";
    $result = $conn->query($sql);
    if ($result->num_rows == 0) {
        header('Location: ../downloads.php');
        exit;
    }
    $row = $result->fetch_array();
}
if (isset($_POST['editFile'])) {
    $filename = test_input($_POST["filename"]);
    $date = $_POST["date"];
    $sql = "UPDATE tbldownload SET filename = '$filename', date = '$date' WHERE downloadno = '$downloadno' ";
    $conn->query($sql) or die (mysqli_error($conn));

    //audit edit
    date_default_timezone_set('Asia/Manila');
    $user=$_SESSION["username"];
    $action = "Updated a Download file.";
    $dateandtime = date("Y-m-d H:i:s");
    $sql = "INSERT INTO tblaudit (action, user, dateandtime) VALUES ('$action', '$user', '$dateandtime')";
    $conn->query($sql) or die(mysqli_error($conn));

    header('Location: ../downloads.php');
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
                <span class="fas fa-file"></span>
                Edit File
            </div>
            <div class="card-body">
                <form method="post">
                    <div class="form-group">
                        <label for="fileName">File</label>
                        <input type="text" value="<?php echo $row['filename']?>" name="filename" class="form-control" id="fileName"
                               placeholder="File Name">
                    </div>
                    <div class="form-group">
                        <label for="date">Date</label>
                        <input value="<?php echo $row['date']?>" name="date" type="text" id="date"
                               class="form-control"
                               placeholder="YYYY-MM-DDD"
                               pattern="[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])">
                    </div>
                    <div class="text-center">
                        <input name="editFile" type="submit" class="mr-5 btn btn-primary" value="Upload">
                        <input type="button" value="Go Back" onclick="window.history.back()"
                               class="ml-5 btn btn-secondary">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php
    include_once "../include/footer.php";
    ?>
</div>
</div>

<script src="../js/bootstrap.bundle.min.js" type="text/javascript"></script>
<script src="../js/sb-admin.min.js" type="text/javascript"></script>

</body>

</html>
