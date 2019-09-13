<?php
require_once "../include/cn.php";
if (!isset($_SESSION)) {
	session_start();
}
if (!isset($_GET['permit'])) {
	header('Location: permit.php');
} else {
	$permit = test_input($_GET['permit']);
	$sql = "SELECT * FROM tblpermit WHERE permit = '$permit'";
	$result = $conn->query($sql);
	if ($result->num_rows == 0) {
		header('Location: permit.php');
		exit;
	}
	$row = $result->fetch_array();
	
	if (isset($_POST['editPermit'])) {

		$date = test_input($_POST['date']);
		$orgname = test_input($_POST['orgname']);
		$activity = test_input($_POST['activity']);
		$purpose = test_input($_POST['purpose']);
		$dateandtime = test_input($_POST['dateandtime']);
		$venue = test_input($_POST['venue']);
		$noofperson = test_input($_POST['noofperson']);

		$sql = "UPDATE tblpermit SET date='$date', orgname='$orgname', activity = '$activity',purpose = '$purpose', dateandtime = '$dateandtime', venue='$venue', noofperson = '$noofperson' WHERE permit='".$_GET['permit']."'";
		$conn->query($sql)or die(mysqli_error($conn));

    //audit edit
		date_default_timezone_set('Asia/Manila');
		$user=$_SESSION["username"];
		$action = "Updated a permit record.";
		$dateandtime = date("Y-m-d H:i:s");
		$sql = "INSERT INTO tblaudit (action, user, dateandtime) VALUES ('$action', '$user', '$dateandtime')";
		$conn->query($sql) or die(mysqli_error($conn));

		header('Location: permit.php');
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
				<span class="fas fa-user-plus"></span>
				Edit Permit
			</div>
			<div class="card-body">
				<form method="post">
					<div class="form-group row">
						<label for="date" class="col-sm-2 col-form-label">Date:</label>
						<div class="col">
							<input value="<?php echo $row['date'] ?>" name="date" required type="text" id="date"  class="form-control"
							placeholder="Date">
						</div>
					</div>
					<div class="form-group row">
						<label for="orgname" class="col-sm-2 col-form-label">Name of the Organization:</label>
						<div class="col">
							<input value="<?php echo $row['orgname'] ?>" name="orgname" readonly type="text" id="orgname"  class="form-control"
							placeholder="Name of the Organization">
						</div>
					</div>
					<div class="form-group row">
						<label for="activity" class="col-sm-2 col-form-label">Activity: </label>
						<div class="col">
							<input value="<?php echo $row['activity'] ?>" name="activity" required type="text" id="activity"  class="form-control"
							placeholder="Activity">
						</div>
					</div>
					<div class="form-group row">
						<label for="purpose" class="col-sm-2 col-form-label">Purpose: </label>
						<div class="col">
							<input value="<?php echo $row['purpose'] ?>" name="purpose" required type="text" id="purpose"  class="form-control"
							placeholder="Purpose">
						</div>
					</div>
					<div class="form-group row">
						<label for="dateandtime" class="col-sm-2 col-form-label">Date &amp; Time:</label>
						<div class="col">
							<input value="<?php echo $row['dateandtime'] ?>" name="dateandtime" required type="text" id="dateandtime" class="form-control"
							placeholder="Date &amp; Time"></div>
						</div>
						<div class="form-group row">
							<label for="president" class="col-sm-2 col-form-label">Venue:</label>
							<div class="col">
								<input value="<?php echo $row['venue'] ?>" name="venue" required type="text" id="venue" class="form-control"
								placeholder="Venue"></div>
							</div>    
							<div class="form-group row">
								<label for="president" class="col-sm-2 col-form-label">No. of Person:</label>
								<div class="col">
									<input value="<?php echo $row['noofperson'] ?>" name="noofperson" required type="text" id="noofperson" class="form-control"
									placeholder="No. of Person"></div>
								</div>                   
								<div class="text-center">
									<input name="editPermit" type="submit" class="mr-5 btn btn-primary" value="Update">
									<a href="permit.php" class="ml-5 btn btn-secondary">Go Back</a>
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
