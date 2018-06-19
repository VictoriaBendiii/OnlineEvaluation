<?php include 'connection.php'?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>SLU Peer Evaluation | Home</title>
        <link rel="stylesheet" href="css/styles.css"/>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="icon" href="css/images/slogo.png">
        	<link rel="favicon" href="assets/images/favicon.png">
	<link rel="stylesheet" media="screen" href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,700">
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/font-awesome.min.css"> 
	<link rel="stylesheet" href="assets/css/bootstrap-theme.css" media="screen"> 
	<link rel="stylesheet" href="assets/css/style.css">
    <link rel='stylesheet' id='camera-css'  href='assets/css/camera.css' type='text/css' media='all'>
        <script src="https://code.jquery.com/jquery-3.2.1.js"></script>
    </head>
    
    <body>
        
        <div class="wrapper">
            <header>
                <nav style="z-index: 1000; background-color: RGBA(92,115,139, 0.6);">
                    <div class="menu-icon">
                        <i class="fa fa-bars fa-2x"></i>
                    </div>
					<img src="css/images/slogo.png" style="height: 45px; width: 36px; position: absolute; top: 10px; left: 10px;">
                    <div class="logo">&emsp;SLU Peer Evaluation</div>
                    <div class="menu">
                        <ul>
                            <li style="color: white; font-size: 20px; "><a style="outline: 0 !important;" href="#" onclick="websitenav();">
                            <?php 
							$username = $_SESSION['username'];
							$query = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username';");
    
							while($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
							$profilepicture = $row['profilepicture'];
							$first = $row['firstname'];
							$last = $row['lastname'];
							echo "<img src='images/profilepictures/$profilepicture' class='navpic' alt='profile picture'>";
							}
							?> </a></li>
                        </ul>
                    </div>
                </nav>
		
		<div id="groupaccordions">
		<?php 
		//$course = $_POST['courseCode'];
		$course = $_SESSION['course'];
        $query = mysqli_query($conn, "SELECT COUNT(distinct(groupID)) AS groupNumbers FROM user_course WHERE courseCode='$course';");

        while($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
			$groupnums = $row['groupNumbers'];
        }
		
		//echo "<center><p id='classCode'>$course</p></center>";
		echo "<center><p id='classCode'>$course</p></center>";
		
		for($i = 1; $i <= $groupnums; $i++){
		$querys = mysqli_query($conn, "SELECT users.username AS username, CONCAT(users.firstname,' ',users.lastname) AS fullname, users.profilepicture AS profpic FROM user_course JOIN users USING(id) WHERE courseCode='$course' AND user_course.groupID=$i ORDER BY users.lastname;");
		echo "<button class='accordion' id='doneText'>Group $i</button> <div class='panel'>";
					while($row = mysqli_fetch_array($querys, MYSQLI_ASSOC)) {
					$profpic = $row["profpic"];
					$fullname = $row["fullname"];
					$username = $row["username"];
					$queryt = mysqli_query($conn, "SELECT DISTINCT CASE WHEN EXISTS(SELECT * FROM result JOIN users ON users.username = result.evaluator WHERE users.username = '$username') THEN 'images/check.png' ELSE 'images/x.png' END AS isdone FROM result JOIN users ON users.username = result.evaluator;");
					while($rows = mysqli_fetch_array($queryt, MYSQLI_ASSOC)) {
					$isdone = $rows["isdone"];
					echo "<img src='images/profilepictures/$profpic' style='height: 50px; width: 50px; padding: 2px;' alt='profile picture'>";
					echo "&emsp;";
					echo "$fullname&nbsp;<img src='$isdone' style='height: 30px; width: 30px; padding: 2px;' alt='mark'>";
					echo "<br>";
						}
					}
		echo "</div>";
		}

        ?>
		</div>

	  <div id="pictureNavigation" style="display: none;">
		<ul>
		<li><a href="teacherpage.php"><img src='images/class.png' class='picnavicon'> Classes</a></li>
		<li><a href="profteacher.php"><img src='images/profile.png' class='picnavicon'> Profile</a></li>
		<li><a href="signout.php"><img src='images/logout.png' class='picnavicon'> Log out</a></li>
		</ul>
	  </div>
    <script src="assets/js/modernizr-latest.js"></script> 
	<script type='text/javascript' src='assets/js/jquery.min.js'></script>
    <script type='text/javascript' src='assets/js/fancybox/jquery.fancybox.pack.js'></script>
    
    <script type='text/javascript' src='assets/js/jquery.mobile.customized.min.js'></script>
    <script type='text/javascript' src='assets/js/jquery.easing.1.3.js'></script> 
    <script type='text/javascript' src='assets/js/camera.min.js'></script> 
    <script src="assets/js/bootstrap.min.js"></script> 
	<script src="assets/js/custom.js"></script>
            
    <script type="text/javascript">
	
	var acc = document.getElementsByClassName("accordion");
	var i;

	for (i = 0; i < acc.length; i++) {
    acc[i].addEventListener("click", function() {
        this.classList.toggle("active");
		
        var panel = this.nextElementSibling;
        if (panel.style.display === "block") {
            panel.style.display = "none";
        } else {
            panel.style.display = "block";
			}
		});
	}
        $(document).ready(function(){
			$(document).mouseup(function(e){
				var subject = $("#pictureNavigation"); 

        if(e.target.id != subject.attr('id') && !subject.has(e.target).length){
            subject.fadeOut();
				}
			});
		});
		
        $(function() {
           var welcomeSection = $('.welcome-section'),
               enterButton = welcomeSection.find('.enter-button');
            
            setTimeout(function() {
                welcomeSection.removeClass('content-hidden');
            },800);
            
            enterButton.on('click', function(e){
               e.preventDefault();
                welcomeSection.addClass('content-hidden').fadeOut();
            });
        });
            
        </script>
        
        <script type="text/javascript">
        
        $(document).ready(function(){
            $(".menu-icon").on("click", function(){
                $("nav ul").toggleClass("showing");
            });
        });
            
        $(window).on("scroll", function(){
            if($(window).scrollTop()) {
                $('nav').addClass('black');
            } else {
                $('nav').removeClass('black');
            }
        })    
		
		function websitenav(){
			var x = document.getElementById("pictureNavigation");
			if (x.style.display === "none") {
				x.style.display = "block";
			} else {
				x.style.display = "none";
			}
		}
            
        </script>
        </div>
    </body>
</html>
