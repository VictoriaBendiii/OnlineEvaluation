<?php
	include('connection.php');
	if(!isset($_POST['id'])){
		echo "<script type='text/javascript'>window.location.href='studentlist.php';</script>"; exit();
	}
    $sql = "DELETE FROM user_course WHERE id=$_POST[id] AND courseCode='$_POST[course]';";
    $result = mysqli_query($conn, $sql);
	echo "<script type='text/javascript'>
		if(!alert('$_POST[fullname] removed from course.'))
			document.location='studentlist.php'</script>";
?>