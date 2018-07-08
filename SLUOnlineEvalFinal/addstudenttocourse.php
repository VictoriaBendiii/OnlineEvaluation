<?php
	include('connection.php');
	
	$idnumber = explode( "-", mysqli_real_escape_string($conn, $_GET['idnumber']));
	$course = mysqli_real_escape_string($conn, $_GET['course']);
	mysqli_query($conn, "INSERT INTO user_course (`id`, `courseCode`) VALUES ((SELECT id FROM users WHERE username='$idnumber[0]'), '$course');");
	echo "<script type='text/javascript'>
		if(!alert('$idnumber[0] added to the course.'))
			document.location='studentlist.php'</script>";
?>