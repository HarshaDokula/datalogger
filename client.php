<?php
require_once 'config.php';
session_start();
$id = $_SESSION['id'];
if(!isset($_SESSION['id']))
{
	header('Location:index.html');
}
else {
	$query = "select * from users where id=$id;";
	$result = mysqli_query($conn,$query);
  $row = mysqli_fetch_array($result);
	if (strcmp($row['isClient'],1)){
	header('Location:index.html');}
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Client</title>
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
	<div class="container mt-4">
		<h2 class="display-3">Clients Area</h2>
		<hr>
		<?php
		$id = $_SESSION['id'];
		if(!isset($id)) {
			header("location:index.html");
		}
		$query = "select * from projects where clientID=$id;";
		$result = mysqli_query($conn,$query);
		echo "<div class='row'>";
		echo "<div class='col-12'>";
		echo "<select class='form-control' onchange='projectID()' required>";
		echo "<option value='' selected disabled>Select Project</option>";
		while($row=mysqli_fetch_array($result)) {


			echo "<option value='".$row['id']."'>".$row['title']."</option>";



		}
		echo "</div></div>";
		?>
		<div class='row'>
			<div class='col-12'>
				<?php

				if(isset($_GET['projectID'])) {
					$pid = $_GET['projectID'];
					echo "<p>testing".$pid."</p>";
				}

				 ?>
			</div>
		</div>
	</div>
	<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
	<script type="text/javascript">
		function projectID() {
			let projectID = $("select").val();
			$.ajax(
				{
					type:"GET",
					url: 'client.php',
					data: {projectID:projectID}
				}
			)
		}
	</script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
</body>
</html>
