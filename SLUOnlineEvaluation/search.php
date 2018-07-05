<?php	
		include('connection.php');
		$course = $_SESSION['course'];
		$key=$_GET['key'];
		$array=array();
		$con=mysqli_connect("localhost","root","","peerpal");
		$query=mysqli_query($con, "SELECT DISTINCT CONCAT(users.username,'-',users.firstname,' ',users.lastname) as completename FROM users LEFT JOIN user_course USING (id) WHERE users.username LIKE '%$key%' AND users.identification='student' AND users.username NOT IN (SELECT users.username FROM users LEFT JOIN user_course USING (id) WHERE users.identification='student' AND user_course.courseCode='$course');");
			while($row=mysqli_fetch_assoc($query)){
				$array[]=$row['completename'];
			}
		echo json_encode($array);
		mysqli_close($con);
?>