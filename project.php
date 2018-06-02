<?php
require_once 'config.php';
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Add Project</title>
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
		<h2>Add Project</h2>
		<hr>
		<form action="project.php" method="post">
			<div class="row">
				<div class="col-12">
					<label for="title">Project Title</label>
					<input type="text" class="form-control" id="title" name="title" required autofocus autocomplete="false">
				</div>
			</div>
			<div class="row">
				<div class="col-12 form-group">
					<label for="desc">Project Description</label>
					<textarea name="desc" id="desc" cols="120" rows="10" class="form-control" required></textarea>
				</div>
			</div>
			<div class="row">
				<div class="col-12">
					<label for="client">Select Client</label>
					<select name="client" id="client" class="form-control" required>
						<?php
						$query = "select * from users where isClient='1'";
						$result = mysqli_query($conn,$query);

						while($row = mysqli_fetch_array($result)) {
							echo "<option value='".$row['id']."'>".$row[
								'name']."</option>";
							}
							if(!$result) {
								echo "Error: ".mysqli_error($conn);
							}
							?>
						</select>
					</div>
				</div>
				<div class="row">
					<div class="col-12">
						<label for="employee">Select Employee(s)</label>
						<select multiple name="employee[]" id="employee" class="form-control" required>
							<?php
							$query = "select * from users where isEmployee='1'";
							$result = mysqli_query($conn,$query);

							while($row = mysqli_fetch_array($result)) {
								echo "<option value='".$row['id']."'>".$row[
									'name']."</option>";
								}
								if(!$result) {
									echo "Error: ".mysqli_error($conn);
								}
								?>
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
			$title = $_REQUEST['title'];
			$desc = $_REQUEST['desc'];
			$client = $_REQUEST['client'];
			$employee = implode(',',$_REQUEST['employee']);
			$query = "INSERT INTO projects(`title`,`description`,`clientID`,`employees`) VALUES('$title','$desc','$client','$employee');";
			$mysql = mysqli_query($conn,$query);
			foreach($_REQUEST['employee'] as $employe) {
				$q = "INSERT INTO employees(`client`,`employee`) VALUES('$client','$employe');";
				$exec = mysqli_query($conn,$q) or die('Error: '.mysqli_error());

			}
			if($mysql) {
				$e = mysqli_query($conn,"select * from projects where clientID='$client'") or die('Error: '.mysqli_error());
				$id = mysqli_fetch_array($e);
				

				echo "Success";
			} else {
				echo "Failed due to error".mysqli_error($conn);
			}
		}
		?>
