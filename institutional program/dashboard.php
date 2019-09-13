<?php
include_once "gui.php";
require "../include/cn.php";
if (!isset($_SESSION)) {
    session_start();
}
$sql = "SELECT * FROM tbladmission ORDER BY admissionno";
$result = $conn->query($sql);
?>
<div class="content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div class="card mb-3">
                    <div class="card-header">
                        <span class="fas fa-users"></span>
                        Admission
                    </div>
                    <div class="card-body">
                        <div class="container-fluid">
                            <table id="myTable" class="table display table-responsive table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Admission No.</th>
                                    <th>Preference</th>
                                    <th>Preferred 1st Course</th>
                                    <th>Preferred 2nd Course</th>
                                    <th>Preferred 3rd Course</th>
                                    <th>Name</th>
                                    <th>Age</th>
                                    <th>Gender</th>
                                    <th>Address</th>
                                    <th>Civil Status</th>
                                    <th>Date of Birth</th>
                                    <th>Place of Birth</th>
                                    <th>Nationality</th>
                                    <th>Religion</th>
                                    <th>Telephone</th>
                                    <th>Cellphone</th>
                                    <th>Email</th>
                                    <th>Father's Name</th>
                                    <th>Father's Occupation</th>
                                    <th>Father's Education</th>
                                    <th>Mother's Name</th>
                                    <th>Mother's Occupation</th>
                                    <th>Mother's Education</th>
                                    <th>No. of Siblings</th>
                                    <th>Birth Order</th>
                                    <th>Family Income</th>
                                    <th>Elementary</th>
                                    <th>Elem. School Type</th>
                                    <th>Elem. Year Graduated</th>
                                    <th>High School</th>
                                    <th>HS Type</th>
                                    <th>HS Year Graduated</th>
                                    <th>Honors/Awards</th>
                                    <th>Scholarships</th>
                                    <th>Transferee's School</th>
                                    <th>Transferee's Course & Year</th>
                                    <th>Action</th>

                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                while ($row = $result->fetch_array()) {
                                    echo " <tr>
                        <td>$row[admissionno]</td>        
                        <td>$row[preference]</td>
                        <td>$row[preferredCourse1]</td>
                        <td>$row[preferredCourse2]</td>
                        <td>$row[preferredCourse3]</td>
                        <td>$row[name]</td>
                        <td>$row[age]</td>
                        <td>$row[gender]</td>
                        <td>$row[address]</td>
                        <td>$row[civilStatus]</td>
                        <td>$row[dateofbirth]</td>
                        <td>$row[placeofbirth]</td>
                        <td>$row[nationality]</td>
                        <td>$row[religion]</td>
                        <td>$row[telephone]</td>
                        <td>$row[cellphone]</td>
                        <td>$row[email]</td>
                        <td>$row[fatherName]</td>
                        <td>$row[fatherOccupation]</td>
                        <td>$row[fatherEducation]</td>
                        <td>$row[motherName]</td>
                        <td>$row[motherOccupation]</td>
                        <td>$row[motherEducation]</td>
                        <td>$row[noOfSibling]</td>
                        <td>$row[birthOrder]</td>
                        <td>$row[familyIncome]</td>
                        <td>$row[elementary]</td>
                        <td>$row[schoolTypeElem]</td>
                        <td>$row[elementaryYear]</td>
                        <td>$row[hs]</td>
                        <td>$row[schoolTypeHS]</td>
                        <td>$row[hsYear]</td>
                        <td>$row[honor]</td>
                        <td>$row[scholarship]</td>
                        <td>$row[transferSchool]</td>
                        <td>$row[transferCourseYear]</td>
                        <td class=\"text-center\">                   
                               <a href='editadmission.php?admissionno=$row[admissionno]'><span class=\"fas fa-edit\"></span></a>
                               <a href='javascript:gotoModal($row[admissionno]);'> <span class=\"fas fa-minus-circle\"></span> </a>                   
                        </td>
                    </tr>";
                                }
                                ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!--//2nd column-->
            <div class="col-md-4">
                <div class="card mb-3">
                    <div class="card-header">
                        <span class="fas fa-calendar-alt"></span>
                        Calendar of Activities
                    </div>
                    <div class="card-body">
                        <?php
                        include "../include/calendar.php";
                        ?>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <?php
    include_once "../include/footer.php";
    ?>
</div>
<script src="../js/bootstrap.bundle.min.js" type="text/javascript"></script>
<script src="../js/sb-admin.min.js" type="text/javascript"></script>
<script>
    var row;
    $(document).ready(function () {

        var table = $('#myTable').DataTable({
            "lengthChange": false,
        });
        table.buttons().container()
            .appendTo($('.col-md-6:eq(0)', table.table().container()));
    })
    ;
</script>
</body>
</html>
