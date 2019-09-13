<?php
require_once "../include/cn.php";


if (!isset($_SESSION)) {
    session_start();
    if (!isset($_GET['nstp'])) {
        header("Location: xnstpenrollees.php");
        exit;
    } else {
        $nstp = test_input($_GET['nstp']);
        $sql = "SELECT * FROM tblxnstpenrollees WHERE nstp = '$nstp'";
        $result = $conn->query($sql);
        if ($result->num_rows == 0) {
            header('Location: xnstpenrollees.php');
            exit;
        }
        $row = $result->fetch_array();
    }
}
if (isset($_POST['editNSTP'])) {
    $nstp = test_input($_GET['nstp']);
    $serialno = test_input($_POST['serialno']);
    $category = test_input($_POST['category']);
    $lastName = test_input($_POST['lastName']);
    $firstName = test_input($_POST['firstName']);
    $middleName = test_input($_POST['middleName']);
    $cys = test_input($_POST['cys']);
    $gender = test_input($_POST['gender']);
    $birthdate = test_input($_POST['birthdate']);
    $paddress = test_input($_POST['paddress']);
    $contactno = test_input($_POST['contactno']);
    $email = test_input($_POST['email']);
    $sql = "UPDATE tblxnstpenrollees SET serialno = '$serialno', category = '$category', lastname = '$lastName', firstname = '$firstName', middlename = '$middleName', cys = '$cys', gender = '$gender', birthdate = '$birthdate', paddress = '$paddress', contactno = '$contactno', email = '$email' WHERE nstp = '$nstp';";
    $result = $conn->query($sql) or die(mysqli_error($conn));

    //audit edit
    date_default_timezone_set('Asia/Manila');
    $user=$_SESSION["username"];
    $action = "Updated a student record in NSTP.";
    $dateandtime = date("Y-m-d H:i:s");
    $sql = "INSERT INTO tblaudit (action, user, dateandtime) VALUES ('$action', '$user', '$dateandtime')";
    $conn->query($sql) or die(mysqli_error($conn));

    header("Location: xnstpenrollees.php");
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
                <span class="fas fa-edit"></span>
                Edit Cross NSTP Enrollees
            </div>
            <div class="card-body">
                <form method="post">
                    <div class="form-group row">
                        <label for="serialno" class="col-sm-2 col-form-label">Serial Number:</label>
                        <div class="col">
                            <input value="<?php echo $row['serialno'] ?>" name="serialno" type="text" id="serialno" class="form-control"
                                   placeholder="Serial Number"></div>
                        <label for="category" class="col-sm-2 col-form-label">Category:</label>
                        <div class="col">
                            <select name="category" id="category" class="form-control">
                            <?php
                            switch($row['category']){

                            case "CWTS":
                            echo "
                           
                                <optgroup label=\"PROGRAM COMPONENTS\">
                                    <option value=\"CWTS\">Civic Welfare Training Service (CWTS)</option>
                                    <option value=\"LTS\">Literacy Training Service (LTS)</option>
                                </optgroup>
                            </optgroup>
                            ";
                            break;

                            case "LTS":
                            echo "
                          
                                <optgroup label=\"PROGRAM COMPONENTS\">
                                    <option value=\"LTS\">Literacy Training Service (LTS)</option>
                                    <option value=\"CWTS\">Civic Welfare Training Service (CWTS)</option>  
                                </optgroup>
                            </optgroup>
                            ";
                            break;

                            }
                            ?>
                            </select></div>
                    </div>
                    <div class="form-group row" id="name">
                        <label for="name" class="col-sm-2 col-form-label">Name:</label>
                        <div class="col" id="firstName">
                            <input value="<?php echo $row['firstname'] ?>" name="firstName" required type="text" class="form-control" id="fn"
                                   placeholder="First Name"></div>
                        <div class="col" id="middleName">
                            <input value="<?php echo $row['middlename'] ?>" name="middleName" required type="text" class="form-control" id="mn"
                                   placeholder="Middle Name"></div>
                        <div class="col" id="lastName">
                            <input value="<?php echo $row['lastname'] ?>" name="lastName" required type="text" class="form-control" id="ln"
                                   placeholder="Last Name"></div>
                    </div>
                    <div class="form-group row">
                        <label for="cys" class="col-sm-2 col-form-label">Course/Program:</label>
                        <div class="col">
                            <input value="<?php echo $row['cys'] ?>" name="cys" required type="text" id="cys" class="form-control"
                                   placeholder="CYS"></div>
                    </div>
                    <div class="form-group row">
                        <label for="gender" class="col-sm-2 col-form-label">Gender:</label>
                        <div class="col">
                            <input value="<?php echo $row['gender'] ?>" name="gender" required type="text" id="gender" class="form-control"
                                   placeholder="Gender"></div>
                        <label for="birthdate" class="col-sm-2 col-form-label">Birthdate:</label>
                        <div class="col">
                            <input value="<?php echo $row['birthdate'] ?>" name="birthdate" required type="text" id="birthdate" class="form-control"
                                   placeholder="Birthdate"></div>
                    </div>
                    <div class="form-group row">
                        <label for="paddress" class="col-sm-2 col-form-label">Provincial Address:</label>
                        <div class="col">
                            <input value="<?php echo $row['paddress'] ?>" name="paddress" required type="text" id="paddress" class="form-control"
                                   placeholder="Provincial Address"></div>
                    </div>
                    <div class="form-group row">
                        <label for="contactno" class="col-sm-2 col-form-label">Contact Number:</label>
                        <div class="col">
                            <input value="<?php echo $row['contactno'] ?>" name="contactno" required type="text" id="contactno" class="form-control"
                                   placeholder="Contact Number"></div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-sm-2 col-form-label">E-mail:</label>
                        <div class="col">
                            <input value="<?php echo $row['email'] ?>" name="email" required type="text" id="email" class="form-control"
                                   placeholder="E-mail"></div>
                    </div>
                    <div class="text-center">
                        <input  name="editNSTP" type="submit" class="mr-5 btn btn-primary" value="Done">
                        <a href="xnstpenrollees.php" class="ml-5 btn btn-secondary">Go Back</a>
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
