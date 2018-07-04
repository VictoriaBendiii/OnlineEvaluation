<?php include('connection.php');
    if(!isset($_SESSION['username'])){
        header('Location: login.php');
    }
?>
<html>

<head>
    <meta charset="UTF-8">
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SLU Peer Evaluation | Home</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" href="css/images/slogo.png">
    <script src="https://code.jquery.com/jquery-3.2.1.js"></script>
    <link rel="stylesheet" href="css/insideClassroom.css">
</head>

<body>
    <div class="wrapper">
        <header>
            <nav style="z-index: 1000;">
                <div class="menu-icon">
                    <i class="fa fa-bars fa-2x"></i>
                </div>
                <img src="css/images/slogo.png" style="height: 45px; width: 36px; position: fixed; top: 10px; left: 10px;">
                <div class="logo">&emsp;SLU Peer Evaluation</div>
                <div class="menu">
                    <ul>
                        <li><a href="classroomF.php">Home</a></li>
                        <li><a href="classroomF.php">Classes</a></li>
                        <li><a class="active" href="joinClass.php">Join in a Class</a></li>
                        <li><a href="about.html">About</a></li>
                        <li>Welcome <?php echo $_SESSION['firstname']. " ". $_SESSION['lastname'];?></li>
                    </ul>
                </div>
            </nav>
        </header>

        <div class="page-header">
            <section>
                <h1>Join Class</h1>
                <h2>To join a class, type the code given by your instructor below </h2>
                <?php
					if(!empty($_POST['courseCode']))
					{
						$classCode = mysqli_real_escape_string($conn, $_POST['courseCode']);
						
						$query = mysqli_query($conn, "SELECT * FROM `course` WHERE courseCode = '$classCode'");
     		 			$row = mysqli_fetch_array($query,MYSQLI_ASSOC);      
      					$count = mysqli_num_rows($query);
                        
      					if($count == 1) 
      					{
         					$_SESSION['courseCode'] = $classCode;
         					$_SESSION['courseName'] = $row['courseName'];
         					$_SESSION['courseDescription'] = $row['courseDescription'];
        	 
         					header("location: course.php");
      					}
      					else 
      					{
         					echo "<div id='tag-line'>Invalid Classcode</div>";
         					?>
                    <a href="joinClass.php" id="tag-line" style="color: red;">Try again.</a>
                    <?php 
      					}
					}
					else
					{
				?>
                    <form action="joinClass.php" method="post">

                        <input name="courseCode" placeholder='Ex. 9364A' type='text'>
                        <input class="button" type="submit" value="Enter" />
                    </form>


            </section>
            <?php
                    }
    ?>
        </div>
    </div>

        <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
        <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js'></script>
        <script src="js/index.js"></script>
</body>

</html>
