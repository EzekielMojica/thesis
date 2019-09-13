<?php
require_once "../include/cn.php";
if (!isset($_SESSION)) {
    session_start();
}

if (isset($_POST['uploadNews'])) {
    $target = "../thumbnail/";
    $dir = "thumbnail/";
    $title = test_input($_POST["title"]);
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
        $content = $_POST["content"];
        $newsdate = $_POST["date"];
        $author = $_SESSION["x"];
        $sql = "INSERT INTO tblnews (title, path, content, newsdate, author) VALUES ('$title', '$path' ,'$content', '$newsdate', '$author')";
        $conn->query($sql) or die (mysqli_error($conn));
        echo '<script>alert("Uploaded Successfully")</script>';
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
                <span class="fas fa-newspaper"></span>
                Upload News
            </div>
            <div class="card-body">
                <form action="balita.php" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="title">Article Title</label>
                        <input type="text" name="title" class="form-control" id="title"
                               placeholder="Title">
                    </div>
                    <div class="form-group">
                        <label for="thumbnail">Upload Thumbnail <i>(.jpg, .jpeg, .png files)</i></label>
                        <input type="file" name="thumbnail" class="form-control-file mb-3" id="thumbnail">
                    </div>
                    <div class="form-group">
                        <label for="content">Content: </label>
                        <textarea name="content" class="form-control mb-3" id="content" rows="6"></textarea>
                        <script>
                            CKEDITOR.replace( 'content', {
                                tabSpaces: 4
                            });
                        </script>
                    </div>
                    <div class="form-group">
                        <label for="date">Date</label>
                        <input name="date" type="text" id="date"
                               class="form-control"
                               placeholder="YYYY-MM-DDD"
                               value="<?php echo date("Y-m-d")?>"
                               pattern="[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])">
                    </div>
                    <div class="text-center">
                        <input name="uploadNews" type="submit" class="mr-5 btn btn-primary" value="Upload">
                        <a href="../news.php" class="ml-5 btn btn-success">Go to News</a>
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
