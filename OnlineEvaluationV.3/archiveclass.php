<?php
	include('connection.php');
	$user = mysqli_real_escape_string($conn, $_SESSION['username']);
    $sql = "select * from user_course join users using(id) join course using(courseCode) where users.username ='$user' AND course.status='Active'";
    $result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) != null) {
               while($row = mysqli_fetch_assoc($result)) {
                         $_SESSION['courseCode'] = $row['courseCode']; 
						 $corc =  $row['courseCode']; 
                         $_SESSION['courseName'] = $row['courseName']; 
                         $squery = "UPDATE course SET `status`='Archived' WHERE `courseCode`='$corc'";
					     $results = mysqli_query($conn, $squery);
							if($results){
								echo "<script type='text/javascript'>alert('Classroom archived.');
								window.location.href='teacherpage.php';</script>";
							}else{
							    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
							}
						}
					}
?>