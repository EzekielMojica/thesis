<?php
require_once "include/cn.php";
if (!isset($_GET['newsnum'])) {
    header("Location: news.php");
} else {
    $newsnum = $_GET['newsnum'];
    $sql = "SELECT * FROM tblnews WHERE newsnum = '$newsnum'";
    $result = $conn->query($sql);
    $row = $result->fetch_array();
}
include_once "include/header.php";
?>
<script>
    function gotoModal(id) {
        $('#delete').modal('toggle');
        $('#id').val(id);
    }
</script>

<div class="container-fluid">
    <div class="container mt-4">
        <?php
        if (isset($_SESSION['logid'])) {
            if ($_SESSION['logid'] == 1) {
                echo "<img src='$row[path]' class='img-fluid mx-auto d-block' alt='News thumbnail'>";
                echo " <form action=\"editnews.php\" method=\"post\">
            <input type=\"hidden\" name=\"newsnum\" value=\"$row[newsnum]\">
            <label for=\"title\">Title: </label>
            <input required name=\"title\" id=\"title\" type=\"text\" value=\"$row[title]\"
                   class=\"form-control text-center form-control-lg\">
            <label for=\"newsdate\">Date: </label>
            <input required name=\"newsdate\" id=\"newsdate\" type=\"text\" value=\"$row[newsdate]\"
                   class=\"form-control text-center\">
            <div class=\"form-group\">
                <label for=\"content\">Content: </label>
                <textarea class=\"form-control\" name=\"content\" id=\"content\" rows=\"10\">$row[content]</textarea>
            </div>";
                echo "<div class=\"text-center\"><input type='submit' name='editNews' value='Edit' class='btn btn-primary mr-5'>";

                echo "</form><input value='Delete' type='button' class='btn btn-danger ml-5' onclick='gotoModal($row[newsnum])'></div>

                 ";
            } else{
                echo "<img src='$row[path]' class='img-fluid mx-auto d-block' alt='thumbnail'>";
                echo "<h1 name='title' id='title' class='text-center'>$row[title]</h1>";
                echo "<p class='text-center'>$row[newsdate]</p>";
                echo "<p>$row[content]</p>";
                echo "<footer class=\"blockquote-footer\">Uploaded by: $row[author]</footer>";
                echo "<div class=\"text-center\"><a href=\"news.php\" class=\"btn btn-secondary\">Back</a></div>";
            }
        } else {
            echo "<img src='$row[path]' class='img-fluid mx-auto d-block' alt='thumbnail'>";
            echo "<h1 name='title' id='title' class='text-center'>$row[title]</h1>";
            echo "<p class='text-center'>$row[newsdate]</p>";
            echo "<p>$row[content]</p>";
            echo "<footer class=\"blockquote-footer\">Uploaded by: $row[author]</footer>";
            echo "<div class=\"text-center\"><a href=\"news.php\" class=\"btn btn-secondary\">Back</a></div>";
        }
        ?>
    </div>
</div>
<div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="delete" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="exampleModalLabel">Confirm Delete</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="deletenews.php" method="post">
                <div class="modal-body">
                    Re-enter your password to confirm delete:
                    <input required type="password" class="form-control" id="password" name="password">
                    <input type="hidden" id="id" name="id">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <input type="submit" class="btn btn-danger" name="delete" value="Delete">
                </div>
            </form>
        </div>
    </div>
</div>
<?php
include_once "include/footer.php";
?>
<!--<script>-->
<!--    $(document).ready(function(){-->
<!--        $("#share").click(function(){-->
<!--            FB.ui({-->
<!--                method: 'share',-->
<!--                href: 'http://localhost:63342/OSAS2/news.php',-->
<!--            }, function(response){});-->
<!--        });-->
<!--    });-->
<!--</script>-->
<script src="js/jquery-3.2.1.min.js"></script>
<script src="js/bootstrap.js" type="text/javascript"></script>
<script>
    CKEDITOR.replace( 'content', {
        tabSpaces: 4
    });
</script>
</body>

</html>
