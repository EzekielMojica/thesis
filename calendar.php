<?php
include_once "include/header.php";
require_once "include/cn.php";

if (isset($_GET['pageno'])) {
    $pageno = $_GET['pageno'];
} else {
    $pageno = 1;
}

$no_of_records_per_page = 6;
$offset = ($pageno - 1) * $no_of_records_per_page;

$total_pages_sql = "SELECT * FROM tbllostandfound";
$result1 = $conn->query($total_pages_sql);
$total_rows = $result1->num_rows;
$total_pages = ceil($total_rows / $no_of_records_per_page);

$sql = "SELECT * FROM tbllostandfound ORDER BY datefound DESC LIMIT $offset, $no_of_records_per_page";
$result = $conn->query($sql);
?>
<div class="container-fluid">
    <div class="container mt-4">

    </div>

    <?php
    include_once "include/footer.php";
    ?>

</div>
<script src="js/jquery-3.2.1.min.js"></script>
<script src="js/bootstrap.js" type="text/javascript"></script>
</body>

</html>
