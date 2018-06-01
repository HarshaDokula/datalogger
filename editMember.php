<?php
require_once 'config.php';
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Edit Member</title>
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
		<h2>Edit Member</h2>
		<hr>
		<?php
		$id = $_GET['id'];
		$query = "select * from users where id = '$id';";
		$result = mysqli_query($conn,$query);
		$row = mysqli_fetch_array($result);
		?>
		<form action="editMember.php" method="get">
			<?php
				echo "<input type='hidden' name='id' value='".$_GET['id']."'>"
			?>
			<div class="row">
				<div class="col-12">
					<label for="name">Name</label>
					<?php
					echo "<input type='text' name='name' class='form-control' value='".$row['name']."' required>"
					?>
				</div>
			</div>
			<div class="row">
				<div class="col-12">

					<?php
					echo "<input type='hidden' name='password' class='form-control' value='".$row['password']."' required>"
					?>
				</div>
			</div>
			<div class="row">
				<div class="col-12">
					<label for="role">Role:</label>
					<select name="role" id="role" class="form-control" required>
						<?php
						if(!strcmp($row['isClient'],1)) {
							echo "<option value='client' selected>Client</option>
							<option value='employee'>Employee</option>";
						} else {
							echo "<option value='client'>Client</option>
							<option value='employee' selected>Employee</option>";
						}
						?>
					</select>
				</div>
			</div>
			<div class="row">
				<div class="col-12">
					<input type="submit" name="submit" value="Edit" class="btn btn-primary mt-3">
				</div>
			</div>
			<div class="row">
				<div class="col-12">
					<input type="submit" name="Rstpassword" value="Reset password" class="btn btn-primary mt-3">
				</div>
			</div>
			<div class="row">
				<div class="col-12">
					<pre>

					</pre>
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
	$id = $_REQUEST['id'];
	$name = $_REQUEST['name'];
  $password = $_REQUEST['password'];
	$role = $_REQUEST['role'];

	if(!strcmp($role, 'client')) {
		$query = "UPDATE users set name = '$name', password = '$password', isClient=1, isEmployee=NULL where id = $id;";
	} else {
		$query = "UPDATE users set name = '$name', password = '$password', isEmployee=1, isClient=NULL  where id = $id;";
	}
	$result = mysqli_query($conn,$query);
	if($result) {
		echo '<div class="container"><div class="row">
			          <div class ="col-8">
								  <div class="alert alert-primary" role="alert">Sucessufly changed</div>
	              </div>
						</div>
						</div>';
	} else {
		echo "Failed with error: ".mysqli_error($conn);
	}
}
elseif (isset($_REQUEST['Rstpassword'])) {
	$id = $_REQUEST['id'];
	$name = $_REQUEST['name'];
	$query = " UPDATE users set password = '$name' where id = $id and name = '$name';";
	$result = mysqli_query($conn,$query);
	if($result) {
		echo '<div class="container"><div class="row">
			          <div class ="col-8">
								  <div class="alert alert-primary" role="alert">Sucessufly changed</div>
	              </div>
						</div>
						</div>';
	} else {
		echo "Failed with error: ".mysqli_error($conn);
	}
}


?>
