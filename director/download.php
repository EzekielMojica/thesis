<?php
require_once "../include/cn.php";
if (!isset($_SESSION)) {
    session_start();
}

if (isset($_POST['uploadFile'])) {
    $target = "../downloads/";
    $dir = "downloads/";
    $filename = test_input($_POST["filename"]);
//    if (urlencode(basename($_FILES["file"]["name"])) != basename($_FILES["file"]["name"])) {
//        echo '<script>alert("The filename must not contain a special character")</script>';
//    } else {
    $path = $dir . basename($_FILES["file"]["name"]);
    $targetpath = $target . basename($_FILES["file"]["name"]);
    $fileType = strtolower(pathinfo($targetpath, PATHINFO_EXTENSION));
    // Allow certain file formats
    if (file_exists($targetpath)) {
        echo '<script>alert("File already exist")</script>';
        $uploadOk = 0;
    } else {
        move_uploaded_file($_FILES["file"]["tmp_name"], $targetpath);
        $date = $_POST["date"];
        $sql = "INSERT INTO tbldownload (filename, date, type, path) VALUES ('$filename', '$date' ,'$fileType', '$path')";
        $conn->query($sql) or die (mysqli_error($conn));

        //audit add
        date_default_timezone_set('Asia/Manila');
        $user=$_SESSION["username"];
        $action = "Added a download file.";
        $dateandtime = date("Y-m-d H:i:s");
        $sql = "INSERT INTO tblaudit (action, user, dateandtime) VALUES ('$action', '$user', '$dateandtime')";
        $conn->query($sql) or die(mysqli_error($conn));

        echo '<script>alert("Uploaded Successfully")</script>';
    }
    // }
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
                Upload File
            </div>
            <div class="card-body">
                <form action="download.php" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="fileName">File</label>
                        <input required type="text" name="filename" class="form-control" id="fileName"
                               placeholder="File Name">
                    </div>
                    <div class="form-group">
                        <label for="file">Upload File <i>(.docx, .xlsx, .pdf files)</i></label>
                        <input type="hidden" name="MAX_FILE_SIZE" value="2000000"/>
                        <input required type="file" name="file" class="form-control-file mb-3" id="file">
                    </div>
                    <div class="form-group">
                        <label for="date">Date</label>
                        <input required name="date" type="text" id="date"
                               class="form-control"
                               placeholder="YYYY-MM-DDD"
                               value="<?php echo date("Y-m-d")?>"
                               pattern="[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])">
                    </div>
                    <div class="text-center">
                        <input name="uploadFile" type="submit" class="mr-5 btn btn-primary" value="Upload">
                        <a href="../downloads.php" class="ml-5 btn btn-success">Go to Downloads</a>
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
