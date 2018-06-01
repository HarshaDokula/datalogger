<?php
require_once 'config.php';
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Edit Members</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
</head>
<body>
	<?php
	ob_start();
	include "nav.html";
	$out1 = ob_get_clean();
	echo $out1;
	?>
	<div class="container table-responsive">
		<h2 class="mt-3">Edit Users</h2>
		<hr>
		<table class="table table-hover table-striped table-bordered" >
			<thead class="thead-dark">
				<tr>
					<th scope="col">Name</th>
					<!-- <th scope="col">password</th> -->
					<th scope="col">Role</th>
					<th scope="col">Edit</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$query = "select * from users";
				$result = mysqli_query($conn,$query);
				while($row=mysqli_fetch_array($result)) {
					echo "<tr>";
					echo "<td>".$row['name']."</td>";
					// echo "<td>".$row['password']."</td>";
					if(!strcmp($row['isClient'],1)) {
						echo "<td>Client</td>";
					} else {
						echo "<td>Employee</td>";
					}
					echo "<td><a href='editMember.php?id=".$row['id']."'>Edit</a></td>";
				}
				?>
			</tbody>
		</table>
	</div>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
</body>
</html>
