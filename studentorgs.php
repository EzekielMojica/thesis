<?php
include_once "include/header.php";
require_once "include/cn.php";
$year = date("Y") . "-" . (date("Y") + 1);
$sql1 = "SELECT * FROM tblorgs WHERE academicyear='$year' AND type = 'Academic'";
$result1 = $conn->query($sql1) or die(mysqli_error($conn));

$sql = "SELECT * FROM tblorgs WHERE academicyear='$year' AND type = 'Non-Academic'";
$result = $conn->query($sql) or die(mysqli_error($conn));

?>
<div class="wrapper container-fluid">
    <div class="container-fluid">
        <div class="container">
            <div class="row">
            <div class="col-6">
                <h1>Academic</h1>
                 <?php
                while ($row1 = $result1->fetch_array()) {
                    $sql2 = "SELECT tbladmission.name, tblorgmember.* FROM tblorgmember INNER JOIN tblnoa ON tblorgmember.noano = tblnoa.noano INNER JOIN tbladmission ON tblnoa.admissionno = tbladmission.admissionno WHERE position = 'President' AND orgid = $row1[orgid]";
                    $result2 = $conn->query($sql2) or die(mysqli_error($conn));
                    $row2 = $result2->fetch_array();
                    echo "
                <div class='mb-3 mt-3'>
                            <div class=\"card\">
                  <div class=\"card-header\">
                   $row1[name]
                  </div>
                  <div class=\"card-body\">
                  <h5 class=\"card-title\">Adviser: $row1[adviser]</h5>
                      <h5 class=\"card-title\">President: $row2[name]</h5>
                  </div>
                  </div>
                </div>
            ";
                }
                ?>

            </div>
            <div class="col-6">
                <h1>Non-Academic</h1>
                <?php
                while ($row = $result->fetch_array()) {
                    $sql2 = "SELECT tbladmission.name, tblorgmember.* FROM tblorgmember INNER JOIN tblnoa ON tblorgmember.noano = tblnoa.noano INNER JOIN tbladmission ON tblnoa.admissionno = tbladmission.admissionno WHERE position = 'President' AND orgid = $row[orgid]";
                    $result2 = $conn->query($sql2) or die(mysqli_error($conn));
                    $row2 = $result2->fetch_array();
                    echo "
                <div class='mb-3 mt-3'>
                            <div class=\"card\">
                  <div class=\"card-header\">
                   $row[name]
                  </div>
                  <div class=\"card-body\">
                  <h5 class=\"card-title\">Adviser: $row[adviser]</h5>
                      <h5 class=\"card-title\">President: $row2[name]</h5>
                  </div>
                  </div>
                </div>
            ";
                }
                ?>
            </div>
            </div>
        </div>
    </div>
</div>
<!-- -->
<?php
include_once "include/footer.php";
?>
<script src="js/jquery-3.2.1.min.js"></script>
<script src="js/bootstrap.js" type="text/javascript"></script>

</body>

</html>
