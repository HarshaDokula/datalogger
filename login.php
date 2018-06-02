<?php
require_once 'config.php';
session_start();
?>
<?php
$userid = $_REQUEST['userid'];
$password = $_REQUEST['password'];
$query = "select * from `users` where id = $userid and password = '$password'";
$result = mysqli_query($conn,$query)  or die("Error: " . mysqli_error($conn));
$row = mysqli_fetch_array($result);
$count = mysqli_num_rows($result);
if($count>0)
{
	$_SESSION['id'] = $userid;
	if(!strcmp($row['isEmployee'],1))
	{
		header("location:employee.php");
	} elseif (!strcmp($row['isClient'],1)) {
		header("location:client.php");
	} else {
		header("location:add.php");
	}
} else {
	echo "error: ".mysqli_error($conn);

}
?>
