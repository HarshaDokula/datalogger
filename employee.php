<?php
require_once 'config.php';
session_start();
$id = $_SESSION['id'];
if(!isset($_SESSION['id']))
{
	header('Location:index.html');
}
else{
	$query = "select * from users where id = $id;";
	$result = mysqli_query($conn,$query);
  $row = mysqli_fetch_array($result);
	if (strcmp($row['isEmployee'],1)){
	header('Location:index.html');}
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Employee Area</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
</head>
<body>
	<header>
		<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
			<a class="navbar-brand" href="#">Datalogger</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav mr-auto">
					<li class="nav-item active">
						<a class="nav-link" href="#">Home<span class="sr-only">(current)</span></a>
					</li>
				</ul>
				<div class="my-2 my-lg-0">
					<a href="logout.php"><button class="btn btn-outline-warning btn-sm">Log out</button></a>
				</div>
			</div>
		</nav>
	</header>
	<div class="container">
		<h2>Employee Area</h2>
		<hr>
		<form action="employee.php" method="get">
			<div class="row">
				<div class="col-12">
					<label for="time">Time</label>
					<input type="time" name="time" class="form-control" id="time" step="1" required>
				</div>
			</div>
			<div class="row">
				<div class="col-12">
					<label for="client">Select Client</label>
					<select name="client" id="client" class="form-control" required>
						<option value="" selected disabled>Select Client</option>
						<?php
						$id = $_SESSION['id'];
						if(!isset($id)) {
							header("location:index.html");
						}
						$query = "select * from employees where employee=$id;";
						$result = mysqli_query($conn,$query);
						while($row=mysqli_fetch_array($result)) {
							$client = mysqli_query($conn,"select distinct * from users where id=".$row['client']);
							$clientName = mysqli_fetch_array($client);
							echo "<option value='".$row['client']."'>".$clientName['name']."</option>";
						}
						?>
					</select>
				</div>
			</div>
			<div class="row">
			  <div class="col-12">
					<label for="project">Select Project</label>
					<select name="project" id="project" class="form-control" required>
						<option value="" selected disabled>Select Project</option>

					<?php
						$id = $_SESSION['id'];
						$query = "select * from employees where employee=$id";
						$result = mysqli_query($conn,$query);
						while($row = mysqli_fetch_array($result)){
						$projectID = $row['projectID'];
							$sql = mysqli_query($conn,"select * from projects where id=$projectID");
							while($ro = mysqli_fetch_array($sql)) {
								echo "<option value='".$row['projectID']."'>".$ro['title']."</option>";
								}
						}
					?>

					</select>
				</div>
			</div>
			<div class="row">
				<div class="col-12 form-group">
					<label for="log">Log:</label>
					<textarea name="log" id="log" cols="120" rows="10" class="form-control" required></textarea>
				</div>
			</div>
			<div class="row">
				<div class="col-12 text-center">
					<input type="submit" class="btn btn-outline-primary btn-lg" name="submit">
				</div>
			</div>
		</form>
	</div>
	<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){

			$("#client").on("change",function(){
				let client = document.querySelector("#client").value;
				console.log(client);


			});

		});
	</script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
</body>
</html>

<?php
if(isset($_REQUEST['submit'])) {
	$time = $_REQUEST['time'];
	$client = $_REQUEST['client'];
	$log = $_REQUEST['log'];
	$id = $_SESSION['id'];
	$pid = $_REQUEST['project'];
	if(!isset($id)) {
		header("location:index.html");
	}
	$query = "INSERT INTO employeeLog(`empID`,`clientID`,`projectID`,`time`,`log`) VALUES($id,$client,$pid,'$time','$log')";
	$result = mysqli_query($conn,$query);
	if($result) {
		echo "Sucess";
	} else {
		echo "Error: ".mysqli_error($conn);
	}
}
?>
