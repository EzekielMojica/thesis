<?php

require_once "../include/cn.php";
if (!isset($_SESSION)) {
    session_start();
    if (!isset($_GET['admissionno'])) {
       header('Location: admission.php');
        exit;
    } else {
        $admissionno =test_input($_GET['admissionno']);
        $studNum = test_input($_GET['admissionno']);
        $sql = "SELECT * FROM tbladmission WHERE admissionno = '$admissionno'";
        $result = $conn->query($sql);
        if ($result->num_rows == 0) {
            header('Location: admission.php');
            exit;
        }
        $row = $result->fetch_array();
    }
    if (isset($_POST['editAdmission'])) {
        $admissionno =test_input($_GET['admissionno']);
        $preference = test_input($_POST['preference']);
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
        $sql = "UPDATE tbladmission SET preference='$preference',preferredCourse1='$preferredCourse1',preferredCourse2='$preferredCourse2',preferredCourse3='$preferredCourse3',name='$name',age='$age',gender='$gender',address='$address',civilStatus='$civilStatus',dateofbirth='$dateOfBirth',placeofbirth='$placeOfBirth',nationality='$nationality',religion='$religion',telephone='$telephone',cellphone='$cellphone',email='$email',fatherName='$fatherName',fatherOccupation='$fatherOccupation',fatherEducation='$fatherEducation',motherName='$motherName',motherOccupation='$motherOccupation',motherEducation='$motherEducation',noOfSibling='$noOfSibling',birthOrder='$birthOrder',familyIncome='$familyIncome',elementary='$elementary',schoolTypeElem='$schoolTypeElem',elementaryYear='$elementaryYear',hs='$hs',schoolTypeHS='$schoolTypeHS',hsYear='$hsYear',honor='$honor',scholarship='$scholarship',transferSchool='$transferSchool',transferCourseYear='$transferCourseYear' WHERE admissionno = '$admissionno'";
        $conn->query($sql);

        //audit edit
        date_default_timezone_set('Asia/Manila');
        $user=$_SESSION["username"];
        $action = "Updated a record in admission.";
        $dateandtime = date("Y-m-d H:i:s");
        $sql = "INSERT INTO tblaudit (action, user, dateandtime) VALUES ('$action', '$user', '$dateandtime')";
        $conn->query($sql) or die(mysqli_error($conn));

        header('Location: admission.php');
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
                <span class="fas fa-calendar-alt"></span>
                Student Admission
            </div>
            <div class="card-body">
                <form method="post">
                    <b><i><p>Please Check: Preference</p></i></b>
                    <?php
                    switch ($row['preference']){
                        case "Degree":
                            echo " <div class=\"col-md-4 mb-3 form-check form-check-inline\" id=\"preference\">
                        <label class=\"form-check-label\">
                            Degree:
                            <input checked required name=\"preference\" class=\"form-check-input\" type=\"radio\" id=\"pref\"
                                   value=\"Degree\">
                        </label>
                    </div>
                        <div class=\"col-md-4 form-check form-check-inline\">
                        
                        <label class=\"form-check-label\">
                            Non-Degree:
                            <input required name=\"preference\" class=\"form-check-input\" type=\"radio\" id=\"pref\"
                                   value=\"Non-Degree\">
                        </label>
                    </div>
                    <div class=\"form-check form-check-inline\">
                        <label class=\"form-check-label\">
                            Campus:
                            <input required name=\"preference\" class=\"form-check-input\" type=\"radio\" id=\"pref\"
                                   value=\"Campus\">
                        </label>
                    </div>";
                    };
                    ?>

                    <?php
                    switch ($row['preference']){
                        case "Non-Degree":
                            echo " 
                        <div class=\"col-md-4 mb-3 form-check form-check-inline\" id=\"preference\">
                        <label class=\"form-check-label\">
                            Degree:
                            <input required name=\"preference\" class=\"form-check-input\" type=\"radio\" id=\"pref\"
                                   value=\"Degree\">
                        </label>
                        </div>
           
                        <div class=\"col-md-4 form-check form-check-inline\">
                        
                        <label class=\"form-check-label\">
                            Non-Degree:
                            <input checked required name=\"preference\" class=\"form-check-input\" type=\"radio\" id=\"pref\"
                                   value=\"Non-Degree\">
                        </label>
                    </div>
                    <div class=\"form-check form-check-inline\">
                        <label class=\"form-check-label\">
                            Campus:
                            <input required name=\"preference\" class=\"form-check-input\" type=\"radio\" id=\"pref\"
                                   value=\"Campus\">
                        </label>
                    </div>";
                    };
                    ?>

                    <?php
                    switch ($row['preference']){
                        case "Campus":
                            echo " 
                        <div class=\"col-md-4 mb-3 form-check form-check-inline\" id=\"preference\">
                        <label class=\"form-check-label\">
                            Degree:
                            <input required name=\"preference\" class=\"form-check-input\" type=\"radio\" id=\"pref\"
                                   value=\"Degree\">
                        </label>
                        </div>
           
                        <div class=\"col-md-4 form-check form-check-inline\">
                        
                        <label class=\"form-check-label\">
                            Non-Degree:
                            <input required name=\"preference\" class=\"form-check-input\" type=\"radio\" id=\"pref\"
                                   value=\"Non-Degree\">
                        </label>
                    </div>
                    <div class=\"form-check form-check-inline\">
                        <label class=\"form-check-label\">
                            Campus:
                            <input checked required name=\"preference\" class=\"form-check-input\" type=\"radio\" id=\"pref\"
                                   value=\"Campus\">
                        </label>
                    </div>";
                    };
                    ?>

                    <b><i><p>Kindly identify your Preferred course:</p></i></b>
                    <div class="form-group row">
                        <label for="preferredCourse1" class="col-sm-2 col-form-label">1st Choice:</label>
                        <div class="col-sm">
                            <select name="preferredCourse1" id="preferredCourse1" class="form-control">
                                <?php
                                switch($row['preferredCourse1']){
                                    case "BSF":
                                        echo "
                            <optgroup label=\"DEGREE COURSES\">
                                 <option value=\"BSF\">BSF</option>
                                <option value=\"BSED\">BSED</option>
                                <option value=\"BEED\">BEED</option>
                                <option value=\"BSHM\">BSHM</option>
                                <option value=\"BSBM\">BSBM</option>
                                <option value=\"BSCS\">BSCS</option>
                                <option value=\"BSIT\">BSIT</option>
                            </optgroup>
                            ";
                                        break;

                                    case "BSED":
                                        echo "
                            <optgroup label=\"DEGREE COURSES\">
                                
                                <option value=\"BSED\">BSED</option>
                                <option value=\"BEED\">BEED</option>
                                <option value=\"BSHM\">BSHM</option>
                                <option value=\"BSBM\">BSBM</option>
                                <option value=\"BSCS\">BSCS</option>
                                <option value=\"BSIT\">BSIT</option>
                                <option value=\"BSF\">BSF</option>
                            </optgroup>
                            ";
                                        break;

                                    case "BEED":
                                        echo "
                            <optgroup label=\"DEGREE COURSES\">
                                
                                <option value=\"BEED\">BEED</option>
                                <option value=\"BSHM\">BSHM</option>
                                <option value=\"BSBM\">BSBM</option>
                                <option value=\"BSCS\">BSCS</option>
                                <option value=\"BSIT\">BSIT</option>
                                <option value=\"BSF\">BSF</option>
                                <option value=\"BSED\">BSED</option>
                            </optgroup>
                            ";
                                        break;

                                    case "BSHM":
                                        echo "
                            <optgroup label=\"DEGREE COURSES\">
                                
                                <option value=\"BSHM\">BSHM</option>
                                <option value=\"BSBM\">BSBM</option>
                                <option value=\"BSCS\">BSCS</option>
                                <option value=\"BSIT\">BSIT</option>
                                <option value=\"BSF\">BSF</option>
                                <option value=\"BSED\">BSED</option>
                                <option value=\"BEED\">BEED</option>
                            </optgroup>
                            ";
                                        break;

                                    case "BSBM":
                                        echo "
                            <optgroup label=\"DEGREE COURSES\">
                                
                                <option value=\"BSBM\">BSBM</option>
                                <option value=\"BSCS\">BSCS</option>
                                <option value=\"BSIT\">BSIT</option>
                                <option value=\"BSF\">BSF</option>
                                <option value=\"BSED\">BSED</option>
                                <option value=\"BEED\">BEED</option>
                            </optgroup>
                            ";
                                        break;

                                    case "BSCS":
                                        echo "
                            <optgroup label=\"DEGREE COURSES\">
                                
                                <option value=\"BSCS\">BSCS</option>
                                <option value=\"BSIT\">BSIT</option>
                                <option value=\"BSF\">BSF</option>
                                <option value=\"BSED\">BSED</option>
                                <option value=\"BEED\">BEED</option>
                                <option value=\"BSHM\">BSHM</option>
                                <option value=\"BSBM\">BSBM</option>
                            </optgroup>
                            ";
                                        break;

                                    case "BSIT":
                                        echo "
                            <optgroup label=\"DEGREE COURSES\">
                                <
                                <option value=\"BSIT\">BSIT</option>
                                <option value=\"BSF\">BSF</option>
                                <option value=\"BSED\">BSED</option>
                                <option value=\"BEED\">BEED</option>
                                <option value=\"BSHM\">BSHM</option>
                                <option value=\"BSBM\">BSBM</option>
                                <option value=\"BSCS\">BSCS</option>
                            </optgroup>
                            ";
                                        break;

                                }
                                ?>
                            </select>


                        </div>
                        <label for="preferredCourse2" class="col-sm-2 col-form-label">2nd Choice:</label>
                        <div class="col-sm">
                            <select name="preferredCourse2" id="preferredCourse2" class="form-control">
                                <?php
                                switch($row['preferredCourse2']){
                                    case "BSF":
                                        echo "
                            <optgroup label=\"DEGREE COURSES\">
                                 <option value=\"BSF\">BSF</option>
                                <option value=\"BSED\">BSED</option>
                                <option value=\"BEED\">BEED</option>
                                <option value=\"BSHM\">BSHM</option>
                                <option value=\"BSBM\">BSBM</option>
                                <option value=\"BSCS\">BSCS</option>
                                <option value=\"BSIT\">BSIT</option>
                            </optgroup>
                            ";
                                        break;

                                    case "BSED":
                                        echo "
                            <optgroup label=\"DEGREE COURSES\">
                                
                                <option value=\"BSED\">BSED</option>
                                <option value=\"BEED\">BEED</option>
                                <option value=\"BSHM\">BSHM</option>
                                <option value=\"BSBM\">BSBM</option>
                                <option value=\"BSCS\">BSCS</option>
                                <option value=\"BSIT\">BSIT</option>
                                <option value=\"BSF\">BSF</option>
                            </optgroup>
                            ";
                                        break;

                                    case "BEED":
                                        echo "
                            <optgroup label=\"DEGREE COURSES\">
                                
                                <option value=\"BEED\">BEED</option>
                                <option value=\"BSHM\">BSHM</option>
                                <option value=\"BSBM\">BSBM</option>
                                <option value=\"BSCS\">BSCS</option>
                                <option value=\"BSIT\">BSIT</option>
                                <option value=\"BSF\">BSF</option>
                                <option value=\"BSED\">BSED</option>
                            </optgroup>
                            ";
                                        break;

                                    case "BSHM":
                                        echo "
                            <optgroup label=\"DEGREE COURSES\">
                                
                                <option value=\"BSHM\">BSHM</option>
                                <option value=\"BSBM\">BSBM</option>
                                <option value=\"BSCS\">BSCS</option>
                                <option value=\"BSIT\">BSIT</option>
                                <option value=\"BSF\">BSF</option>
                                <option value=\"BSED\">BSED</option>
                                <option value=\"BEED\">BEED</option>
                            </optgroup>
                            ";
                                        break;

                                    case "BSBM":
                                        echo "
                            <optgroup label=\"DEGREE COURSES\">
                                
                                <option value=\"BSBM\">BSBM</option>
                                <option value=\"BSCS\">BSCS</option>
                                <option value=\"BSIT\">BSIT</option>
                                <option value=\"BSF\">BSF</option>
                                <option value=\"BSED\">BSED</option>
                                <option value=\"BEED\">BEED</option>
                            </optgroup>
                            ";
                                        break;

                                    case "BSCS":
                                        echo "
                            <optgroup label=\"DEGREE COURSES\">
                                
                                <option value=\"BSCS\">BSCS</option>
                                <option value=\"BSIT\">BSIT</option>
                                <option value=\"BSF\">BSF</option>
                                <option value=\"BSED\">BSED</option>
                                <option value=\"BEED\">BEED</option>
                                <option value=\"BSHM\">BSHM</option>
                                <option value=\"BSBM\">BSBM</option>
                            </optgroup>
                            ";
                                        break;

                                    case "BSIT":
                                        echo "
                            <optgroup label=\"DEGREE COURSES\">
                                <
                                <option value=\"BSIT\">BSIT</option>
                                <option value=\"BSF\">BSF</option>
                                <option value=\"BSED\">BSED</option>
                                <option value=\"BEED\">BEED</option>
                                <option value=\"BSHM\">BSHM</option>
                                <option value=\"BSBM\">BSBM</option>
                                <option value=\"BSCS\">BSCS</option>
                            </optgroup>
                            ";
                                        break;

                                }
                                ?>
                            </select>

                        </div>
                        <label for="preferredCourse3" class="col-sm-2 col-form-label">3rd Choice:</label>
                        <div class="col-sm">
                            <select name="preferredCourse3" id="preferredCourse3" class="form-control">
                                <?php
                                switch($row['preferredCourse3']){
                                    case "BSF":
                                        echo "
                            <optgroup label=\"DEGREE COURSES\">
                                 <option value=\"BSF\">BSF</option>
                                <option value=\"BSED\">BSED</option>
                                <option value=\"BEED\">BEED</option>
                                <option value=\"BSHM\">BSHM</option>
                                <option value=\"BSBM\">BSBM</option>
                                <option value=\"BSCS\">BSCS</option>
                                <option value=\"BSIT\">BSIT</option>
                            </optgroup>
                            ";
                                        break;

                                    case "BSED":
                                        echo "
                            <optgroup label=\"DEGREE COURSES\">
                                
                                <option value=\"BSED\">BSED</option>
                                <option value=\"BEED\">BEED</option>
                                <option value=\"BSHM\">BSHM</option>
                                <option value=\"BSBM\">BSBM</option>
                                <option value=\"BSCS\">BSCS</option>
                                <option value=\"BSIT\">BSIT</option>
                                <option value=\"BSF\">BSF</option>
                            </optgroup>
                            ";
                                        break;

                                    case "BEED":
                                        echo "
                            <optgroup label=\"DEGREE COURSES\">
                                
                                <option value=\"BEED\">BEED</option>
                                <option value=\"BSHM\">BSHM</option>
                                <option value=\"BSBM\">BSBM</option>
                                <option value=\"BSCS\">BSCS</option>
                                <option value=\"BSIT\">BSIT</option>
                                <option value=\"BSF\">BSF</option>
                                <option value=\"BSED\">BSED</option>
                            </optgroup>
                            ";
                                        break;

                                    case "BSHM":
                                        echo "
                            <optgroup label=\"DEGREE COURSES\">
                                
                                <option value=\"BSHM\">BSHM</option>
                                <option value=\"BSBM\">BSBM</option>
                                <option value=\"BSCS\">BSCS</option>
                                <option value=\"BSIT\">BSIT</option>
                                <option value=\"BSF\">BSF</option>
                                <option value=\"BSED\">BSED</option>
                                <option value=\"BEED\">BEED</option>
                            </optgroup>
                            ";
                                        break;

                                    case "BSBM":
                                        echo "
                            <optgroup label=\"DEGREE COURSES\">
                                
                                <option value=\"BSBM\">BSBM</option>
                                <option value=\"BSCS\">BSCS</option>
                                <option value=\"BSIT\">BSIT</option>
                                <option value=\"BSF\">BSF</option>
                                <option value=\"BSED\">BSED</option>
                                <option value=\"BEED\">BEED</option>
                            </optgroup>
                            ";
                                        break;

                                    case "BSCS":
                                        echo "
                            <optgroup label=\"DEGREE COURSES\">
                                
                                <option value=\"BSCS\">BSCS</option>
                                <option value=\"BSIT\">BSIT</option>
                                <option value=\"BSF\">BSF</option>
                                <option value=\"BSED\">BSED</option>
                                <option value=\"BEED\">BEED</option>
                                <option value=\"BSHM\">BSHM</option>
                                <option value=\"BSBM\">BSBM</option>
                            </optgroup>
                            ";
                                        break;

                                    case "BSIT":
                                        echo "
                            <optgroup label=\"DEGREE COURSES\">
                                <
                                <option value=\"BSIT\">BSIT</option>
                                <option value=\"BSF\">BSF</option>
                                <option value=\"BSED\">BSED</option>
                                <option value=\"BEED\">BEED</option>
                                <option value=\"BSHM\">BSHM</option>
                                <option value=\"BSBM\">BSBM</option>
                                <option value=\"BSCS\">BSCS</option>
                            </optgroup>
                            ";
                                        break;

                                }
                                ?>
                            </select>

                        </div>
                    </div>
                    <b><i><p>I. Personal Information:</p></i></b>
                    <div class="form-group row">
                        <label for="name" class="ml-3 col-form-label">Name:</label>
                        <div class="col-sm-5"><input required value="<?php echo $row['name'] ?>"  name="name" type="text" id="name" class="form-control"
                                                     placeholder="Last Name, First Name, M.I."></div>
                        <label for="age" class="col-form-label">Age:</label>
                        <div class="col-sm-3"><input required value="<?php echo $row['age'] ?>"  name="age" type="text" id="age" class="form-control"
                                                     placeholder="Age"></div>
                        <label for="gender" class="col-form-label">Gender:</label>
                        <div class="col-sm">
                            <select name="gender" id="gender" class="form-control">
                                <?php
                                switch($row['gender']){
                                    case "Male":
                                        echo "
                            <optgroup label=\"Select here\">
                                <option value=\"Male\">Male</option>
                                <option value=\"Female\">Female</option>
                            </optgroup>
                            ";
                                        break;
                                    case "Female":
                                        echo "
                            <optgroup label=\"Select here\">
                                <option value=\"Female\">Female</option>
                                <option value=\"Male\">Male</option>
                            </optgroup>
                            ";
                                        break;

                                };
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="address" class="ml-3 col-form-label">Address:</label>
                        <div class="col-sm-7"><input required value="<?php echo $row['address'] ?>"  name="address" type="text" id="address" class="form-control"
                                                     placeholder="Complete Address"></div>
                        <label for="civilStatus" class="col-form-label">Civil Status:</label>
                        <div class="col-sm">
                            <select name="civilStatus" id="civilStatus" class="form-control">
                                <?php
                                switch($row['civilStatus']){
                                    case "Single":
                                        echo "
                            <optgroup label=\"Select here\">
                                <option value=\"Single\">Single</option>
                                <option value=\"Married\">Married</option>
                                <option value=\"Divorced\">Divorced</option>
                                <option value=\"Separated\">Separated</option>
                                <option value=\"Widowed\">Widowed</option>
                            </optgroup>
                            ";
                                        break;
                                    case "Married":
                                        echo "
                            <optgroup label=\"Select here\">
                                <option value=\"Married\">Married</option>
                                <option value=\"Divorced\">Divorced</option>
                                <option value=\"Separated\">Separated</option>
                                <option value=\"Widowed\">Widowed</option>
                                <option value=\"Single\">Single</option>
                                
1                            </optgroup>
                            ";
                                        break;
                                    case "Divorced":
                                        echo "
                            <optgroup label=\"Select here\">
                                <option value=\"Divorced\">Divorced</option>
                                <option value=\"Separated\">Separated</option>
                                <option value=\"Widowed\">Widowed</option>
                                <option value=\"Single\">Single</option>
                                <option value=\"Married\">Married</option>
                                
1                            </optgroup>
                            ";
                                        break;
                                    case "Separated":
                                        echo "
                            <optgroup label=\"Select here\">
                                <option value=\"Separated\">Separated</option>
                                <option value=\"Widowed\">Widowed</option>
                                <option value=\"Single\">Single</option>
                                <option value=\"Married\">Married</option>
                                <option value=\"Divorced\">Divorced</option>
                                
1                            </optgroup>
                            ";
                                        break;
                                    case "Widowed":
                                        echo "
                            <optgroup label=\"Select here\">
                                <option value=\"Widowed\">Widowed</option>
                                <option value=\"Single\">Single</option>
                                <option value=\"Married\">Married</option>
                                <option value=\"Divorced\">Divorced</option>
                                <option value=\"Separated\">Separated</option>
                                
1                            </optgroup>
                            ";
                                        break;
                                };
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="dateOfBirth" class="ml-3 col-form-label">Date of Birth:</label>
                        <div class="col-sm"><input required value="<?php echo $row['dateofbirth'] ?>"  name="dateOfBirth" type="text" id="dob" class="form-control"
                                                   placeholder="Date of Birth"></div>
                        <label for="placeOfBirth" class="col-form-label">Place of Birth:</label>
                        <div class="col-sm-7"><input required value="<?php echo $row['placeofbirth'] ?>"  name="placeOfBirth" type="text" id="pob"
                                                     class="form-control"
                                                     placeholder="Place of Birth"></div>
                    </div>
                    <div class="form-group row">
                        <label for="nationality" class="ml-3 col-form-label">Nationality:</label>
                        <div class="col-sm"><input required value="<?php echo $row['nationality'] ?>"  name="nationality" type="text" id="nat" class="form-control"
                                                   placeholder="Nationality"></div>
                        <label for="religion" class="col-form-label">Religion:</label>
                        <div class="col-sm"><input required value="<?php echo $row['religion'] ?>"  name="religion" type="text" id="rel" class="form-control"
                                                   placeholder="Religion"></div>
                    </div>
                    <div class="form-group row">
                        <label for="telephone" class="ml-3 col-form-label">Telephone #:</label>
                        <div class="col-sm"><input required value="<?php echo $row['telephone'] ?>"  name="telephone" type="text" id="tele" class="form-control"
                                                   placeholder="Telephone Number"></div>
                        <label for="cellphone" class="col-form-label">Cellphone #:</label>
                        <div class="col-sm"><input required value="<?php echo $row['cellphone'] ?>"  name="cellphone" type="text" id="cell" class="form-control"
                                                   placeholder="11-Digit Number"></div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="ml-5 col-form-label">E-mail Address:</label>
                        <div class="col-sm-7"><input required value="<?php echo $row['email'] ?>"  name="email" type="email" id="email" class="form-control"
                                                     placeholder="E-mail Address"></div>
                    </div>
                    <div class="form-group row">
                        <label for="fatherName" class="ml-3 col-form-label">Father's Name:</label>
                        <div class="col-sm"><input required value="<?php echo $row['fatherName'] ?>"  name="fatherName" type="text" id="fatherName" class="form-control"
                                                   placeholder="First Name M.I. Last Name"></div>
                        <label for="fatherOccupation" class="col-form-label">Occupation:</label>
                        <div class="col-sm"><input required value="<?php echo $row['fatherOccupation'] ?>"  name="fatherOccupation" type="text" id="fatherOcc"
                                                   class="form-control"
                                                   placeholder="Occupation"></div>
                    </div>
                    <div class="form-group row">
                        <label for="fatherEducation" class="ml-5 col-form-label">Highest Educational Attainment:</label>
                        <div class="col-sm-6"><input required value="<?php echo $row['fatherEducation'] ?>"  name="fatherEducation" type="text" id="fatherEduc"
                                                     class="form-control"></div>
                    </div>
                    <div class="form-group row">
                        <label for="motherName" class="ml-3 col-form-label">Mother's Name:</label>
                        <div class="col-sm"><input required value="<?php echo $row['motherName'] ?>"  name="motherName" type="text" id="motherName" class="form-control"
                                                   placeholder="First Name M.I. Last Name"></div>
                        <label for="motherOccupation" class="col-form-label">Occupation:</label>
                        <div class="col-sm"><input required value="<?php echo $row['motherOccupation'] ?>"  name="motherOccupation" type="text" id="motherOcc"
                                                   class="form-control"
                                                   placeholder="Occupation"></div>
                    </div>
                    <div class="form-group row">
                        <label for="motherEducation" class="ml-5 col-form-label">Highest Educational Attainment:</label>
                        <div class="col-sm-6"><input required value="<?php echo $row['motherEducation'] ?>"  name="motherEducation" type="text" id="motherEduc"
                                                     class="form-control"></div>
                    </div>
                    <div class="form-group row">
                        <label for="noOfSibling" class="ml-3 col-form-label">No. of Sibling/s:</label>
                        <div class="col-sm-6"><input required value="<?php echo $row['noOfSibling'] ?>"  name="noOfSibling" type="text" id="noofsib"
                                                     class="form-control"></div>
                        <label for="birthOrder" class="col-form-label">Birth Order:</label>
                        <div class="col-sm-3"><input required value="<?php echo $row['birthOrder'] ?>"  name="birthOrder" type="text" id="birthorder"
                                                     class="form-control"></div>
                    </div>
                    <div class="form-group row">
                        <label for="familyIncome" class="ml-3 col-form-label">Estimated Family Income:</label>
                        <div class="col-sm-4"><input required value="<?php echo $row['familyIncome'] ?>"  name="familyIncome" type="text" id="famIncome"
                                                     class="form-control"></div>
                    </div>
                    <b><i><p>II. Educational Background:</p></i></b>
                    <div class="form-group row">
                        <label for="elementary" class="ml-3 col-form-label">Elementary:</label>
                        <div class="col-sm-5"><input required value="<?php echo $row['elementary'] ?>"  name="elementary" type="text" id="elem" class="form-control"
                                                     placeholder="School Graduated"></div>
                        <?php
                        switch ($row['schoolTypeElem']){
                        case "Public":
                        echo "
                            <div class=\"col-sm-1 form-check form-check-inline\">
                                <label class=\"form-check-label\">
                                    <input checked required name=\"schoolTypeElem\" class=\"form-check-input\" type=\"radio\" id=\"elem1\"
                                           value=\"Public\">
                                    Public
                                </label>
                            </div>
                            <div class=\"col-sm-1 form-check form-check-inline\">
                                <label class=\"form-check-label\">
                                    <input required name=\"schoolTypeElem\" class=\"form-check-input\" type=\"radio\" id=\"elem1\"
                                           value=\"Private\">
                                    Private
                                </label>
                            </div>";
                            };
                        ?>

                        <?php
                        switch ($row['schoolTypeElem']){
                            case "Private":
                                echo "
                            <div class=\"col-sm-1 form-check form-check-inline\">
                                <label class=\"form-check-label\">
                                    <input required name=\"schoolTypeElem\" class=\"form-check-input\" type=\"radio\" id=\"elem1\"
                                           value=\"Public\">
                                    Public
                                </label>
                            </div>
                            <div class=\"col-sm-1 form-check form-check-inline\">
                                <label class=\"form-check-label\">
                                    <input checked required name=\"schoolTypeElem\" class=\"form-check-input\" type=\"radio\" id=\"elem1\"
                                           value=\"Private\">
                                    Private
                                </label>
                            </div>";
                        };
                        ?>

                        <label for="elementaryYear" class="ml-3 col-form-label">Year Graduated:</label>
                        <div class="col-sm"><input required value="<?php echo $row['elementaryYear'] ?>"  name="elementaryYear" type="text" id="elemYear"
                                                   class="form-control"
                                                   placeholder="Year"></div>
                    </div>
                    <div class="form-group row">
                        <label for="hs" class="ml-3 col-form-label">High School:</label>
                        <div class="col-sm-5"><input required value="<?php echo $row['hs'] ?>"  name="hs" type="text" id="hs" class="form-control"
                                                     placeholder="School Graduated"></div>
                        <?php
                        switch ($row['schoolTypeHS']){
                            case "Public":
                                echo "
                            <div class=\"col-sm-1 form-check form-check-inline\">
                                <label class=\"form-check-label\">
                                    <input checked required name=\"schoolTypeHS\" class=\"form-check-input\" type=\"radio\" id=\"hs\"
                                           value=\"Public\">
                                    Public
                                </label>
                            </div>
                            <div class=\"col-sm-1 form-check form-check-inline\">
                                <label class=\"form-check-label\">
                                    <input required name=\"schoolTypeHS\" class=\"form-check-input\" type=\"radio\" id=\"hs\"
                                           value=\"Private\">
                                    Private
                                </label>
                            </div>";
                        };
                        ?>

                        <?php
                        switch ($row['schoolTypeHS']){
                            case "Private":
                                echo "
                            <div class=\"col-sm-1 form-check form-check-inline\">
                                <label class=\"form-check-label\">
                                    <input required name=\"schoolTypeHS\" class=\"form-check-input\" type=\"radio\" id=\"hs\"
                                           value=\"Public\">
                                    Public
                                </label>
                            </div>
                            <div class=\"col-sm-1 form-check form-check-inline\">
                                <label class=\"form-check-label\">
                                    <input checked required name=\"schoolTypeHS\" class=\"form-check-input\" type=\"radio\" id=\"hs\"
                                           value=\"Private\">
                                    Private
                                </label>
                            </div>";
                        };
                        ?>


                        <label for="hsYear" class="ml-3 col-form-label">Year Graduated:</label>
                        <div class="col-sm"><input required value="<?php echo $row['hsYear'] ?>"  name="hsYear" type="text" id="hsYear" class="form-control"
                                                   placeholder="Year"></div>
                    </div>
                    <div class="form-group row">
                        <label for="honor" class="ml-3 col-form-label">Honor/s &amp; Awards Received:</label>
                        <div class="col-sm"><input value="<?php echo $row['honor'] ?>"  name="honor" type="text" id="honor" class="form-control"></div>
                    </div>
                    <div class="form-group row">
                        <label for="scholarship" class="ml-3 col-form-label">Scholarship/s Received:</label>
                        <div class="col-sm"><input value="<?php echo $row['scholarship'] ?>"  name="scholarship" type="text" id="scholarship" class="form-control"></div>
                    </div>
                    <b><i><p>For Transferees:</p></i></b>
                    <div class="form-group row">
                        <label for="transferSchool" class="ml-5 col-form-label">School attended:</label>
                        <div class="col-sm-5"><input value="<?php echo $row['transferSchool'] ?>"  name="transferSchool" type="text" id="transferSchool"
                                                     class="form-control"></div>
                        <label for="transferCourseYear" class="col-form-label">Course &amp; Year:</label>
                        <div class="col-sm"><input value="<?php echo $row['transferCourseYear'] ?>"  name="transferCourseYear" type="text" id="transferCY"
                                                   class="form-control"></div>
                    </div>
                    <div class="text-center">
                        <input name="editAdmission" type="submit" class="mr-5 btn btn-primary" value="Update">
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
