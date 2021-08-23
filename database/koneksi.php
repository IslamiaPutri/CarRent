<?php
	$kon = new mysqli('localhost','root','','rent');
	if (!$kon) {
		die('Could not connect: ' . mysqli_error($con));
	}
?>
