<?php	
		include('connection.php');
		$course = $_SESSION['course'];
		$key=$_GET['key'];
		$array=array();
		$con=mysqli_connect("localhost","root","","peerpal");
		$query=mysqli_query($con, "SELECT users.id as id, CONCAT(users.firstname,' ',users.lastname) as name, users.username as username, users.profilepicture as profilepicture FROM users JOIN user_course USING (id) WHERE user_course.courseCode = '$course' AND users.identification='student' AND users.username LIKE '%$key%';");
			while($row=mysqli_fetch_assoc($query)){
				$array[]=$row['completename'];
			}
		echo json_encode($array);
		mysqli_close($con);
?>