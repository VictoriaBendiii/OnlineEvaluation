<?php
	include('connection.php');
	if(!isset($_POST['courseCode'])){
		echo "<script type='text/javascript'>window.location.href='teacherpage.php';</script>"; exit();
	}
	$user = mysqli_real_escape_string($conn, $_SESSION['username']);
    $sql = "select * from user_course join users using(id) join course using(courseCode) where users.username ='$user' AND course.status='Active'";
    $result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) != null) {
               while($row = mysqli_fetch_assoc($result)) {
                         $squery = "UPDATE course SET `status`='Archived' WHERE `courseCode`='$_POST[courseCode]'";
					     $results = mysqli_query($conn, $squery);
							if($results){
								echo "<script type='text/javascript'>alert('Course archived.');
								window.location.href='teacherpage.php';</script>";
							}else{
							    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
							}
						}
					}
?>