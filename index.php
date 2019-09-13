<?php
include_once "include/header.php";
require_once "include/cn.php";
$sql = "SELECT * FROM tblnews ORDER BY newsdate DESC LIMIT 3";
$result = $conn->query($sql);
?>
<!-- Carousel -->
<div id="carousel" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">

        <div class="carousel-item active">
            <img class="d-block w-100" src="pictures/slide2.jpg" alt="Second slide" style="height: 300px;">
        </div>
        <div class="carousel-item">
            <img class="d-block w-100" src="pictures/slide3.jpg" alt="Third slide" style="height: 300px;">
        </div>
        <div class="carousel-item">
            <img class="d-block w-100" src="pictures/slide4.jpg" alt="Fourth slide" style="height: 300px;">
        </div>
    </div>
    <a class="carousel-control-prev" href="#carousel" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carousel" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
<!-- Caruosel End -->
<div class="container-fluid">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <h3 style="padding-top: 30px;">Mission</h3>
                <p class="text-justify">Cavite State University shall provide excellent, equitable and relevant
                    educational opportunities in the arts, science and technology through
                    quality instruction and responsive research and development activities.
                    It shall produce professional, skilled and morally upright individuals
                    for global competitiveness.</p>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <h3 style="padding-top: 30px;">Vision</h3>
                <p class="text-justify">The premier university in historic Cavite recognized for excellence in
                    the development of morally upright and globally competitive individuals.</p>
            </div>
        </div><br>
        <!-- <blockquote class="text-right">
             <a href="about.php">More</a>
             </blockquote>
        -->
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="container-fluid pb-2 pt-2" style="background-color: #8cd98c;">
                <h1 class="text-center">News</h1>
            </div><br>
        </div> 
        <div class="container-fluid">
            <div class="row">
                <?php
                while ($row = $result->fetch_array()){
                    echo "<div class=\"text-center col-lg-4 col-md-4 col-sm-6 col-xs-12 container\">
                    <img  src='$row[path]' class=\"img-thumbnail center-block\"
                         style=\"height: 300px; width: 300px\">
                    <h3>$row[title]</h3>
                    <p class=\"text-justify\">
                      ".substr($row['content'],0, 250)." . . . 
                    </p>
                </div>";
                }
                ?>
            </div>
            <blockquote class="text-right">
                <a href="news.php">More</a>
            </blockquote>
        </div>
    </div>
</div>
<?php
include_once "include/footer.php";
?>
<script src="js/jquery-3.2.1.min.js"></script>
<script src="js/bootstrap.js" type="text/javascript"></script>
</body>
</html>
