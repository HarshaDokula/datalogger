<?php 
require_once 'config.php';
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Add Member</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
</head>
<body>
	<?php 
	ob_start();
	include "nav.html";
	$out1 = ob_get_clean();
	echo $out1;
	?> 
	<div class="container">
		<h2>Add Member</h2>
		<hr>
		<form action="add.php" method="post">
			<div class="row">
				<div class="col-12">
					<label for="name">Name:</label>
					<input type="text" class="form-control" placeholder="Name" id="name" name="name" required>
				</div>
			</div>
			<div class="row">
				<div class="col-12">
					<label for="role">Role:</label>
					<select name="role" id="role" class="form-control" required>
						<option value="client">Client</option>
						<option value="employee">Employee</option>
					</select>
				</div>
			</div>
			<div class="row">
				<div class="col-12">
					<input type="submit" value="Add" name="submit" class="btn btn-primary mt-3">
				</div>
			</div>
		</form>
	</div>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
</body>
</html>

<?php 
if(isset($_REQUEST['submit'])) {
	$name = ucfirst($_REQUEST['name']);
	$role = $_REQUEST['role'];
	if(!strcmp($role,'client')) {
		$query = "INSERT INTO users(`name`,`password`,`isClient`) VALUES('$name','$name','1');";
	} else {
		$query = "INSERT INTO users(`name`,`password`,`isEmployee`) VALUES('$name','$name','1');";
	}
	$mysql = mysqli_query($conn,$query);
	if($mysql) {
		echo "Success";
	} else {
		echo "Failed due to error".mysqli_error($conn);
	}
}
?>