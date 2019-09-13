<?php
require_once "../include/cn.php";


if (!isset($_SESSION)) {
    session_start();
    if (!isset($_GET['nstp'])) {
        header("Location: nstpenrollees.php");
        exit;
    } else {
        $nstp = test_input($_GET['nstp']);
        $sql = "SELECT tbladmission.*, tblnoa.course, tblnstpenrollees.* FROM tblnstpenrollees INNER JOIN tblnoa ON tblnstpenrollees.noano = tblnoa.noano INNER JOIN tbladmission ON tblnoa.admissionno = tbladmission.admissionno WHERE nstp = '$nstp'";
        $result = $conn->query($sql);
        if ($result->num_rows == 0) {
            header('Location: nstpenrollees.php');
            exit;
        }
        $row = $result->fetch_array();
    }
}
if (isset($_POST['editNSTP'])) {
    $nstp = test_input($_GET['nstp']);
    $serialno = test_input($_POST['serialno']);
    $category = test_input($_POST['category']);
    $paddress = test_input($_POST['paddress']);
    $sql = "UPDATE tblnstpenrollees SET serialno = '$serialno', category = '$category', paddress = '$paddress' WHERE nstp = '$nstp';";
    $result = $conn->query($sql);

    //audit edit
    date_default_timezone_set('Asia/Manila');
    $user=$_SESSION["username"];
    $action = "Updated a student record in NSTP.";
    $dateandtime = date("Y-m-d H:i:s");
    $sql = "INSERT INTO tblaudit (action, user, dateandtime) VALUES ('$action', '$user', '$dateandtime')";
    $conn->query($sql) or die(mysqli_error($conn));

    header("Location: nstpenrollees.php");
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
                Edit NSTP Enrollees
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
                            <input required name="name" value="<?php echo $row['name']?>" disabled type="text" class="form-control" id="fn"
                                   placeholder="First Name"></div>
                    </div>
                    <div class="form-group row">
                        <label for="cys" class="col-sm-2 col-form-label">Course/Program:</label>
                        <div class="col">
                            <input value="<?php echo $row['course']?>" disabled required name="cys" type="text" id="cys" class="form-control"
                                   placeholder="Course/Program"></div>
                    </div>
                    <div class="form-group row">
                        <label for="gender" class="col-sm-2 col-form-label">Gender:</label>
                        <div class="col">
                            <input value="<?php echo $row['gender']?>" disabled required name="gender" type="text" id="gender" class="form-control"
                                   placeholder="Gender"></div>
                        <label for="birthdate" class="col-sm-2 col-form-label">Birthdate:</label>
                        <div class="col">
                            <input value="<?php echo $row['dateofbirth']?>" disabled required name="birthdate" type="text" id="birthdate" class="form-control"
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
                            <input value="<?php echo $row['cellphone'] ?>" disabled name="contactno" required type="text" id="contactno" class="form-control"
                                   placeholder="Contact Number"></div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-sm-2 col-form-label">E-mail:</label>
                        <div class="col">
                            <input value="<?php echo $row['email'] ?>" disabled name="email" required type="text" id="email" class="form-control"
                                   placeholder="E-mail"></div>
                    </div>
                    <div class="text-center">
                        <input  name="editNSTP" type="submit" class="mr-5 btn btn-primary" value="Done">
                        <a href="nstpenrollees.php" class="ml-5 btn btn-secondary">Go Back</a>
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
