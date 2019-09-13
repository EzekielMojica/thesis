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

$total_pages_sql = "SELECT * FROM tblnews";
$result1 = $conn->query($total_pages_sql);
$total_rows = $result1->num_rows;
$total_pages = ceil($total_rows / $no_of_records_per_page);

$sql = "SELECT * FROM tblnews ORDER BY newsdate DESC LIMIT $offset, $no_of_records_per_page";
$result = $conn->query($sql);
?>
<div id="fb-root"></div>
<script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = 'https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.2';
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>
<div class="container-fluid">
    <div class="container mt-4">
        <ul class="list-unstyled">
            <?php
            while ($row = $result->fetch_array()) {
                echo ' <li class="media">';
                echo "<img src='$row[path]' height='200' width='250' class='mr-3 mb-3' />";
                echo " <div class=\"media-body\">
                    <h3 class=\"mt-0 mb-3\">$row[title]</h3>
                    <div>
                    ";
                echo substr($row['content'],0, 350);
                echo "
                    <footer class=\"blockquote-footer\">Uploaded by: $row[author]&nbsp; $row[newsdate]</footer>
                    <div class='container'>
                    <div class='row'>
                    <footer class='mr-5'><a href='morenews.php?newsnum=$row[newsnum]'>More</a></footer>
                     <div class=\"fb-share-button\" data-href=\"https://cvsunaicosas.000webhostapp.com/morenews.php?newsnum=$row[newsnum]\" data-layout=\"button\" data-size=\"large\" data-mobile-iframe=\"true\"><a target=\"_blank\" href=\"https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fcvsunaicosas.000webhostapp.com%2Fmorenews.php%3Fnewsnum%3D%2524row%255Bnewsnum%255D&amp;src=sdkpreparse\" class=\"fb-xfbml-parse-ignore\">Share</a></div></div></div>
                    </div>
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
</body>

</html>
