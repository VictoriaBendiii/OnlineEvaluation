<?php include('connection.php');
	$_SESSION['numGroup'] = $_POST["numGroup"];
	header('Location: grouping.php');
?>