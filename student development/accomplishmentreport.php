<?php
require_once "../include/cn.php";
if (!isset($_SESSION)) {
    session_start();
}

if (isset($_POST['uploadReport'])) {
    $target = "../accomplishmentreport/";
    $dir = "accomplishmentreport/";
    $monthyear = $_POST["month"] ." " . date("Y");
    $uploader = $_SESSION["subunit"];
    //type
    $path1 = $dir . basename($_FILES["report"]["name"]);
    $fileType = strtolower(pathinfo($path1, PATHINFO_EXTENSION));
    if ($fileType != "docx") {
        echo '<script>alert("Please upload a word file")</script>';
    }else{
        $path = $dir . "Accomplishment Report of ". $monthyear . " " . $uploader .".". $fileType;
        $targetpath = $target . "Accomplishment Report of ". $monthyear . " " . $uploader .".". $fileType;
    }
    if (file_exists($targetpath)) {
        echo '<script>alert("File already exist")</script>';
    } else {
        move_uploaded_file($_FILES["report"]["tmp_name"], $targetpath);
        $sql = "INSERT INTO tblaccomplishmentreport (path, uploader, monthyear) VALUES ('$path' ,'$uploader', '$monthyear')";
        $conn->query($sql) or die (mysqli_error($conn));
        echo '<script>alert("Uploaded Successfully");window.location.href="accreport.php"</script>';
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
                <span class="fas fa-chart-bar"></span>
                Accomplishment Report
            </div>
            <div class="card-body">
                <form action="accomplishmentreport.php" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="report">Upload Accomplishment Report <i>(.docx file)</i></label>
                        <input required type="file" name="report" class="form-control-file mb-3" id="report">
                    </div>
                    <div class="form-group">
                        <label for="month">Month</label>
                        <div class="form-inline">
                            <select required name="month" id="month" class="form-control col-md-2 mr-2">
                                <option style="font-style: italic;" value="">Select here</option>
                                <option value="January">January</option>
                                <option value="February">February</option>
                                <option value="March">March</option>
                                <option value="April">April</option>
                                <option value="May">May</option>
                                <option value="June">June</option>
                                <option value="July">July</option>
                                <option value="August">August</option>
                                <option value="September">September</option>
                                <option value="October">October</option>
                                <option value="November">November</option>
                                <option value="December">December</option>

                            </select>
                        </div>
                    </div>
                    <div class="text-center">
                        <input name="uploadReport" type="submit" class="mr-5 btn btn-primary" value="Upload">
                        <a href="accreport.php" role="button"
                           class="ml-5 btn btn-info">View Uploads</a>
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
