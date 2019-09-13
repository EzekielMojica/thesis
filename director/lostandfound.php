<?php
require_once "../include/cn.php";
date_default_timezone_set('Asia/Manila');
if (!isset($_SESSION)) {
    session_start();
}

if (isset($_POST['uploadNews'])) {
    $target = "../thumbnail/";
    $dir = "thumbnail/";
    $path = $dir . basename($_FILES["thumbnail"]["name"]);
    $targetpath = $target . basename($_FILES["thumbnail"]["name"]);
    $imageFileType = strtolower(pathinfo($targetpath, PATHINFO_EXTENSION));
    // Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif") {
        echo '<script>alert("Please upload an image")</script>';
        $uploadOk = 0;
    } else if (file_exists($targetpath)) {
        echo '<script>alert("File already exist")</script>';
        $uploadOk = 0;
    } else {
        move_uploaded_file($_FILES["thumbnail"]["tmp_name"], $targetpath);

        $datefound = test_input($_POST['datefound']);
        $foundby = test_input($_POST['foundby']);
        $time = test_input($_POST['time']);
        $itemname = test_input($_POST['itemname']);
        $quantity = test_input($_POST['quantity']);
        $description = test_input($_POST["description"]);
        $remarks = 'Unclaimed';

        $sql = "INSERT INTO tbllostandfound (datefound, foundby, time, itemname, quantity, path, detail, remarks) VALUES ('$datefound', '$foundby' ,'$time', '$itemname', '$quantity', '$path', '$description', '$remarks')";
        $conn->query($sql) or die (mysqli_error($conn));

        //audit add
        date_default_timezone_set('Asia/Manila');
        $user=$_SESSION["username"];
        $action = "Added a lost and found item.";
        $dateandtime = date("Y-m-d H:i:s");
        $sql = "INSERT INTO tblaudit (action, user, dateandtime) VALUES ('$action', '$user', '$dateandtime')";
        $conn->query($sql) or die(mysqli_error($conn));

        echo "<script>alert('Item successfully added!')</script>";
      // header('Location: lostandfound.php');

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
                <span class="fas fa-shopping-basket"></span>
                Lost and Found
            </div>
            <div class="card-body">
                <form action="lostandfound.php" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="datefound">Date Found</label>
                        <input required name="datefound" type="text" id="datefound"
                               class="form-control"
                               placeholder="YYYY-MM-DDD"
                               value="<?php echo date("Y-m-d")?>"
                               pattern="[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])">
                    </div>
                    <div class="form-group">
                        <label for="foundby">Found By</label>
                        <input required type="text" name="foundby" class="form-control" id="foundby"
                               placeholder="Found By">
                    </div>
                    <div class="form-group">
                        <label for="time">Time</label>
                        <input value="<?php echo date("H:i")?>" required name="time" type="text" id="time"
                               class="form-control"
                               placeholder="HH:MM"
                               pattern="(0[0-9]|1[0-9]|2[0-3])(:[0-5][0-9])">
                    </div>
                    <div class="form-group">
                        <label for="itemname">Item Name</label>
                        <input required type="text" name="itemname" class="form-control" id="itemname"
                               placeholder="Item Name">
                    </div>
                    <div class="form-group">
                        <label for="quantity">Quantity</label>
                        <input required type="text" name="quantity" class="form-control" id="quantity"
                               placeholder="Quantity">
                    </div>
                    <div class="form-group">
                        <label for="thumbnail">Upload Thumbnail <i>(.jpg, .jpeg, .png files)</i></label>
                        <input required type="file" name="thumbnail" class="form-control-file mb-3" id="thumbnail">
                    </div>
                    <div class="form-group">
                        <label for="description">Description: </label>
                        <textarea required name="description" class="form-control mb-3" id="description" rows="6"></textarea>
                    </div>
                    <div class="text-center">
                        <input  name="uploadNews" type="submit" class="mr-5 btn btn-primary" value="Upload">
                        <input type="button" value="Go to Lost and Found" onclick="window.location.assign('lostfound.php')"
                               class="ml-5 btn btn-info">
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
