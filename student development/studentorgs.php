<?php
require_once "../include/cn.php";
if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['username'])) {
    header('Location: ../index.php');
    exit;
}
include_once "gui.php";
?>
<div class="content-wrapper">
    <div class="container-fluid">
        <?php
        include_once "studentorg.php";
        ?>
    </div>
    <?php
    include_once "../include/footer.php";
    ?>
</div>

</body>
</html>
