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

$sql = "SELECT * FROM tbllostandfound WHERE remarks = 'Unclaimed' ORDER BY datefound DESC LIMIT $offset, $no_of_records_per_page";
$result = $conn->query($sql);


?>
<div class="container-fluid">
    <div class="container mt-4">
        <ul class="list-unstyled">
            <?php
            while ($row = $result->fetch_array()) {
                echo ' <li class="media">';
                echo "<img src='$row[path]' height='200' width='250' class='mr-3 mb-3' />";
                echo " <div class=\"media-body\">
                    <h3 class=\"mt-0 mb-3\">$row[itemname]</h3>
                    $row[detail]
                </div>
            </li>";
            }
            ?>

        </ul>
        <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center">
                <li class="page-item <?php if ($pageno <= 1) {
                    echo 'disabled';
                } ?>">
                    <a class="page-link" href="<?php if ($pageno <= 1) {
                        echo '#';
                    } else {
                        echo "?pageno=" . ($pageno - 1);
                    } ?>">Prev</a>
                </li>
                <?php
                for ($i = 1; $i <= $total_pages; $i++){
                    echo "<li class=\"page-item\"><a class=\"page-link\" href=\"?pageno=$i\">$i</a></li>";
                }
                ?>

                <li class="page-item <?php if ($pageno >= $total_pages) {
                    echo 'disabled';
                } ?>">
                    <a class="page-link" href="<?php if ($pageno >= $total_pages) {
                        echo '#';
                    } else {
                        echo "?pageno=" . ($pageno + 1);
                    } ?>">Next</a>
                </li>
            </ul>
        </nav>
    </div>

    <?php
    include_once "include/footer.php";
    ?>

</div>
<script src="js/jquery-3.2.1.min.js"></script>
<script src="js/bootstrap.js" type="text/javascript"></script>
</body>

</html>
