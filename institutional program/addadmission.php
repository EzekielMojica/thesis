<?php
require_once "../include/cn.php";

if (!isset($_SESSION)) {
    session_start();
}
if (isset($_POST['addAdmission'])) {
    

    // if (!empty($_POST['preference'])) {
    $preference = test_input($_POST['preference']);
    // }else{ }
    $preferredCourse1 = test_input($_POST['preferredCourse1']);
    $preferredCourse2 = test_input($_POST['preferredCourse2']);
    $preferredCourse3 = test_input($_POST['preferredCourse3']);
    $name = test_input($_POST['name']);
    $age = test_input($_POST['age']);
    $gender = test_input($_POST['gender']);
    $address = test_input($_POST['address']);
    $civilStatus = test_input($_POST['civilStatus']);
    $dateOfBirth = test_input($_POST['dateOfBirth']);
    $placeOfBirth = test_input($_POST['placeOfBirth']);
    $nationality = test_input($_POST['nationality']);
    $religion = test_input($_POST['religion']);
    $telephone = test_input($_POST['telephone']);
    $cellphone = test_input($_POST['cellphone']);
    $email = test_input($_POST['email']);
    $fatherName = test_input($_POST['fatherName']);
    $fatherOccupation = test_input($_POST['fatherOccupation']);
    $fatherEducation = test_input($_POST['fatherEducation']);
    $motherName = test_input($_POST['motherName']);
    $motherOccupation = test_input($_POST['motherOccupation']);
    $motherEducation = test_input($_POST['motherEducation']);
    $noOfSibling = test_input($_POST['noOfSibling']);
    $birthOrder = test_input($_POST['birthOrder']);
    $familyIncome = test_input($_POST['familyIncome']);
    $elementary = test_input($_POST['elementary']);
    // if (!empty($_POST['schoolTypeElem'])) {
    $schoolTypeElem = test_input($_POST['schoolTypeElem']);
    // }else{ }
    $elementaryYear = test_input($_POST['elementaryYear']);
    $hs = test_input($_POST['hs']);
    // if (!empty($_POST['schoolTypeHS'])) {
        $schoolTypeHS = test_input($_POST['schoolTypeHS']);
    //}else{ }
    $hsYear = test_input($_POST['hsYear']);
    $honor = test_input($_POST['honor']);
    $scholarship = test_input($_POST['scholarship']);
    $transferSchool = test_input($_POST['transferSchool']);
    $transferCourseYear = test_input($_POST['transferCourseYear']);

    $sql = "INSERT INTO tbladmission(preference, preferredCourse1, preferredCourse2, preferredCourse3, name, age, gender, address, civilStatus, dateofbirth, placeofbirth, nationality, religion, telephone, cellphone, email, fatherName, fatherOccupation, fatherEducation, motherName, motherOccupation, motherEducation, noOfSibling, birthOrder, familyIncome, elementary, schoolTypeElem, elementaryYear, hs, schoolTypeHS, hsYear, honor, scholarship, transferSchool, transferCourseYear) 
            VALUES ('$preference', '$preferredCourse1', '$preferredCourse2', '$preferredCourse3', '$name', '$age', '$gender', '$address', '$civilStatus', '$dateOfBirth', '$placeOfBirth', '$nationality', '$religion', '$telephone', '$cellphone', '$email', '$fatherName', '$fatherOccupation', '$fatherEducation', '$motherName', '$motherOccupation', '$motherEducation', '$noOfSibling', '$birthOrder', '$familyIncome', '$elementary', '$schoolTypeElem', '$elementaryYear', '$hs', '$schoolTypeHS', '$hsYear', '$honor', '$scholarship', '$transferSchool', '$transferCourseYear')";
    $result = $conn->query($sql) or die(mysqli_error($conn));

    //audit add
    date_default_timezone_set('Asia/Manila');
    $user=$_SESSION["username"];
    $action = "Added a record in admission";
    $dateandtime = date("Y-m-d H:i:s");
    $sql = "INSERT INTO tblaudit (action, user, dateandtime) VALUES ('$action', '$user', '$dateandtime')";
    $conn->query($sql) or die(mysqli_error($conn));

    echo "<script>alert('Admission record successfully added!');window.location.href='admission.php';</script>";
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
                <span class="fas fa-calendar-alt"></span>
                Student Admission
            </div>
            <div class="card-body">
                <form action="addadmission.php" method="post">
                    <b><i><p>Please Check: Preference</p></i></b>
                    <div class="col-md-4 mb-3 form-check form-check-inline" id="preference">
                        <label class="form-check-label">
                            Degree:
                            <input required name="preference" class="form-check-input" type="radio" id="pref"
                                   value="Degree">
                        </label>
                    </div>
                    <div class="col-md-4 form-check form-check-inline">
                        <label class="form-check-label">
                            Non-Degree:
                            <input name="preference" class="form-check-input" type="radio" id="pref"
                                   value="Non-Degree">
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <label class="form-check-label">
                            Campus:
                            <input name="preference" class="form-check-input" type="radio" id="pref"
                                   value="Campus">
                        </label>
                    </div>
                    <b><i><p>Kindly identify your Preferred course:</p></i></b>
                    <div class="form-group row">
                        <label for="preferredCourse1" class="col-sm-2 col-form-label">1st Choice:</label>
                        <div class="col-sm">
                          <!-- <input required name="preferredCourse1" type="text" id="prefCourse1" class="form-control">  -->
                            <select name="preferredCourse1" id="prefCourse1" class="form-control">
                                <option value="">Select here</option>
                                <optgroup label="BACHELOR'S DEGREE">
                                    <option value="BSF">BSF</option>
                                    <option value="BSED">BSED</option>
                                    <option value="BEED">BEED</option>
                                    <option value="BSHM">BSHM</option>
                                    <option value="BSBM">BSBM</option>
                                    <option value="BSCS">BSCS</option>
                                    <option value="BSIT">BSIT</option>
                                </optgroup>
                            </select>
                        </div>
                        <label for="preferredCourse2" class="col-sm-2 col-form-label">2nd Choice:</label>
                        <div class="col-sm">
                          <!--  <input required name="preferredCourse2" type="text" id="prefCourse2" class="form-control"> -->
                            <select name="preferredCourse2" id="prefCourse2" class="form-control">
                                <option value="">Select here</option>
                                <optgroup label="BACHELOR'S DEGREE">
                                    <option value="BSF">BSF</option>
                                    <option value="BSED">BSED</option>
                                    <option value="BEED">BEED</option>
                                    <option value="BSHM">BSHM</option>
                                    <option value="BSBM">BSBM</option>
                                    <option value="BSCS">BSCS</option>
                                    <option value="BSIT">BSIT</option>
                                </optgroup>
                            </select>
                        </div>
                        <label for="preferredCourse3" class="col-sm-2 col-form-label">3rd Choice:</label>
                        <div class="col-sm">
                           <!-- <input required name="preferredCourse3" type="text" id="prefCourse3" class="form-control"> -->
                            <select name="preferredCourse3" id="prefCourse3" class="form-control">
                                <option value="">Select here</option>
                                <optgroup label="BACHELOR'S DEGREE">
                                    <option value="BSF">BSF</option>
                                    <option value="BSED">BSED</option>
                                    <option value="BEED">BEED</option>
                                    <option value="BSHM">BSHM</option>
                                    <option value="BSBM">BSBM</option>
                                    <option value="BSCS">BSCS</option>
                                    <option value="BSIT">BSIT</option>
                                </optgroup>
                            </select>
                        </div>
                    </div>
                    <b><i><p>I. Personal Information:</p></i></b>
                    <div class="form-group row">
                        <label for="name" class="ml-3 col-form-label">Name:</label>
                        <div class="col-sm-5"><input required name="name" type="text" id="name" class="form-control"
                                        placeholder="Last Name, First Name, M.I."></div>
                        <label for="age" class="col-form-label">Age:</label>
                        <div class="col-sm-3"><input required name="age" type="text" id="age" class="form-control"
                                        placeholder="Age"></div>
                        <label for="gender" class="col-form-label">Gender:</label>
                        <div class="col-sm">
                            <select required name="gender" id="gender" class="form-control">
                                <option value="">Gender</option>
                                <optgroup>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </optgroup>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="address" class="ml-3 col-form-label">Address:</label>
                        <div class="col-sm-7"><input required name="address" type="text" id="address" class="form-control"
                                        placeholder="Complete Address"></div>
                        <label for="civilStatus" class="col-form-label">Civil Status:</label>
                        <div class="col-sm">
                            <select required name="civilStatus" id="cs" class="form-control">
                                <option value="">Civil Status</option>
                                <optgroup>
                                    <option value="Single">Single</option>
                                    <option value="Married">Married</option>
                                    <option value="Divorced">Divorced</option>
                                    <option value="Separated">Separated</option>
                                    <option value="Widowed">Widowed</option>
                                </optgroup>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="dateOfBirth" class="ml-3 col-form-label">Date of Birth:</label>
                        <div class="col-sm"><input required name="dateOfBirth" type="text" id="dob" class="form-control"
                                        placeholder="MM/DD/YYYY"></div>
                        <label for="placeOfBirth" class="col-form-label">Place of Birth:</label>
                        <div class="col-sm-7"><input required name="placeOfBirth" type="text" id="pob"
                                        class="form-control"
                                        placeholder="Place of Birth"></div>
                    </div>
                    <div class="form-group row">
                        <label for="nationality" class="ml-3 col-form-label">Nationality:</label>
                        <div class="col-sm"><input required name="nationality" type="text" id="nat" class="form-control"
                                        placeholder="Nationality"></div>
                        <label for="religion" class="col-form-label">Religion:</label>
                        <div class="col-sm"><input required name="religion" type="text" id="rel" class="form-control"
                                        placeholder="Religion"></div>
                    </div>
                    <div class="form-group row">
                        <label for="telephone" class="ml-3 col-form-label">Telephone #:</label>
                        <div class="col-sm"><input required name="telephone" type="text" id="tele" class="form-control"
                                        placeholder="Telephone Number"></div>
                        <label for="cellphone" class="col-form-label">Cellphone #:</label>
                        <div class="col-sm"><input required name="cellphone" type="text" id="cell" class="form-control"
                                        placeholder="11-Digit Number"></div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="ml-5 col-form-label">E-mail Address:</label>
                        <div class="col-sm-7"><input required name="email" type="email" id="email" class="form-control"
                                        placeholder="E-mail Address"></div>
                    </div>
                    <div class="form-group row">
                        <label for="fatherName" class="ml-3 col-form-label">Father's Name:</label>
                        <div class="col-sm"><input required name="fatherName" type="text" id="fatherName" class="form-control"
                                        placeholder="First Name M.I. Last Name"></div>
                        <label for="fatherOccupation" class="col-form-label">Occupation:</label>
                        <div class="col-sm"><input required name="fatherOccupation" type="text" id="fatherOcc"
                                        class="form-control"
                                        placeholder="Occupation"></div>
                    </div>
                    <div class="form-group row">
                        <label for="fatherEducation" class="ml-5 col-form-label">Highest Educational Attainment:</label>
                        <div class="col-sm-6"><input required name="fatherEducation" type="text" id="fatherEduc"
                                        class="form-control"></div>
                    </div>
                    <div class="form-group row">
                        <label for="motherName" class="ml-3 col-form-label">Mother's Name:</label>
                        <div class="col-sm"><input required name="motherName" type="text" id="motherName" class="form-control"
                                        placeholder="First Name M.I. Last Name"></div>
                        <label for="motherOccupation" class="col-form-label">Occupation:</label>
                        <div class="col-sm"><input required name="motherOccupation" type="text" id="motherOcc"
                                        class="form-control"
                                        placeholder="Occupation"></div>
                    </div>
                    <div class="form-group row">
                        <label for="motherEducation" class="ml-5 col-form-label">Highest Educational Attainment:</label>
                        <div class="col-sm-6"><input required name="motherEducation" type="text" id="motherEduc"
                                        class="form-control"></div>
                    </div>
                    <div class="form-group row">
                        <label for="noOfSibling" class="ml-3 col-form-label">No. of Sibling/s:</label>
                        <div class="col-sm-6"><input required name="noOfSibling" type="text" id="noofsib"
                                        class="form-control"></div>
                        <label for="birthOrder" class="col-form-label">Birth Order:</label>
                        <div class="col-sm-3"><input required name="birthOrder" type="text" id="birthorder"
                                        class="form-control"></div>
                    </div>
                    <div class="form-group row">
                        <label for="familyIncome" class="ml-3 col-form-label">Estimated Family Income:</label>
                        <div class="col-sm-4"><input required name="familyIncome" type="text" id="famIncome"
                                        class="form-control"></div>
                    </div>
                    <b><i><p>II. Educational Background:</p></i></b>
                    <div class="form-group row">
                        <label for="elementary" class="ml-3 col-form-label">Elementary:</label>
                        <div class="col-sm-5"><input required name="elementary" type="text" id="elem" class="form-control"
                                        placeholder="School Graduated"></div>
                        <div class="col-sm-1 form-check form-check-inline">
                            <label class="form-check-label">
                                <input required name="schoolTypeElem" class="form-check-input" type="radio" id="elem1"
                                       value="Public">
                                Public
                            </label>
                        </div>
                        <div class="col-sm-1 form-check form-check-inline">
                            <label class="form-check-label">
                                <input required name="schoolTypeElem" class="form-check-input" type="radio" id="elem1"
                                       value="Private">
                                Private
                            </label>
                        </div>
                        <label for="elementaryYear" class="ml-3 col-form-label">Year Graduated:</label>
                        <div class="col-sm"><input required name="elementaryYear" type="text" id="elemYear"
                                        class="form-control"
                                        placeholder="Year"></div>
                    </div>
                    <div class="form-group row">
                        <label for="hs" class="ml-3 col-form-label">High School:</label>
                        <div class="col-sm-5"><input required name="hs" type="text" id="hs" class="form-control"
                                        placeholder="School Graduated"></div>
                        <div class="col-sm-1 form-check form-check-inline">
                            <label class="form-check-label">
                                <input required name="schoolTypeHS" class="form-check-input" type="radio" id="hs1"
                                       value="Public">
                                Public
                            </label>
                        </div>
                        <div class="col-sm-1 form-check form-check-inline">
                            <label class="form-check-label">
                                <input required name="schoolTypeHS" class="form-check-input" type="radio" id="hs1"
                                       value="Private">
                                Private
                            </label>
                        </div>
                        <label for="hsYear" class="ml-3 col-form-label">Year Graduated:</label>
                        <div class="col-sm"><input required name="hsYear" type="text" id="hsYear" class="form-control"
                                                   placeholder="Year"></div>
                    </div>
                    <div class="form-group row">
                        <label for="honor" class="ml-3 col-form-label">Honor/s &amp; Awards Received:</label>
                        <div class="col-sm"><input name="honor" type="text" id="honor" class="form-control"></div>
                    </div>
                    <div class="form-group row">
                        <label for="scholarship" class="ml-3 col-form-label">Scholarship/s Received:</label>
                        <div class="col-sm"><input name="scholarship" type="text" id="scholarship" class="form-control"></div>
                    </div>
                    <b><i><p>For Transferees:</p></i></b>
                    <div class="form-group row">
                        <label for="transferSchool" class="ml-5 col-form-label">School attended:</label>
                        <div class="col-sm-5"><input name="transferSchool" type="text" id="transferSchool"
                                    class="form-control"></div>
                        <label for="transferCourseYear" class="col-form-label">Course &amp; Year:</label>
                        <div class="col-sm"><input name="transferCourseYear" type="text" id="transferCY"
                                    class="form-control"></div>
                    </div>
                    <div class="text-center">
                        <input name="addAdmission" type="submit" class="mr-5 btn btn-primary" value="Add">
                        <a href="admission.php" class="ml-5 btn btn-secondary">Go Back</a>
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
