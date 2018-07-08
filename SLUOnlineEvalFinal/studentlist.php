<?php include('connection.php');
	if(!isset($_SESSION['username'])){
        header('Location: login.php');
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>SLU Peer Evaluation | Course Students</title>
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
		<script src="typeahead.min.js"></script>
	<style type="text/css">
	#studentbutton:hover{
		filter: grayscale(100%);
	}
	.bs-example{
	font-family: sans-serif;
	position: relative;
	margin: 50px;
}
.typeahead, .tt-query, .tt-hint {
	border: 2px solid #CCCCCC;
	border-radius: 8px;
	font-size: 24px;
	height: 30px;
	line-height: 30px;
	outline: medium none;
	padding: 8px 12px;
	width: 396px;
}
.tt-hint{
			opacity: 0;
		}
.typeahead {
	background-color: #FFFFFF;
}
.typeahead:focus {
	border: 2px solid #0097CF;
}
.tt-query {
	box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075) inset;
}
.tt-hint {
	color: #999999;
}
.tt-dropdown-menu {
	background-color: #FFFFFF;
	border: 1px solid rgba(0, 0, 0, 0.2);
	border-radius: 8px;
	box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
	margin-top: 12px;
	padding: 8px 0;
	width: 422px;
}
.tt-suggestion {
	font-size: 24px;
	line-height: 24px;
	padding: 3px 20px;
}
.tt-suggestion.tt-is-under-cursor {
	background-color: #0097CF;
	color: #FFFFFF;
}
.tt-suggestion p {
	margin: 0;
}
	</style>
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
		<script>
		$(document).ready(function(){ 	 	
		$('input.typeahead').typeahead({
        name: 'typeahead',
        remote:'search.php?key=%QUERY',
        limit : 10
			});
		});
		</script>
		<div id="groupaccordions">
		<?php 
		$course = $_SESSION['course'];
        $query = mysqli_query($conn, "SELECT users.id as id, CONCAT(users.firstname,' ',users.lastname) as name, users.username as username, users.profilepicture as profilepicture FROM users JOIN user_course USING (id) WHERE user_course.courseCode = '$course' AND users.identification='student';");
		
		echo "<center><p id='classCode'>Students Enrolled in $course</p><br>";
		echo "<form action='addstudenttocourse.php' id='addstuds' method='get' style='display: inline;'>
					<input type='text' style='font-size: 19px; padding: 5px;' autocomplete='off' spellcheck='false' name='idnumber' class='typeahead tt-query' id='typeahead' placeholder='ID number'>
					<input type='hidden' name='course' value='$course'>
					<button type='submit' id='studentbutton' style='margin:0%; padding: 0; border: none; background: none;'><img src='images/add.png' style='height: 28px; width: 28px; padding: 2px;' alt='mark' id='adds'></button>
              </form>";
	    echo "<h1> </h1>";
		echo "<table>";
        while($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
			$ids = $row['id'];
			$fullname = $row['name'];
			$usersnames = $row['username'];
			$profpic = $row['profilepicture'];
			echo "<td><img src='images/profilepictures/$profpic' style='height: 50px; width: 50px; padding: 2px;' alt='profile picture'></td>";
			echo "<td><p style='font-size: 21px;'>&nbsp;$fullname&emsp;</p></td>
				<td><form action='removestudent.php' id='studentbutton$ids' method='post' style='display: inline;'>
				<input type='hidden' name='id' value='$ids'>
					<input type='hidden' name='course' value='$course'>
					<input type='hidden' name='fullname' value='$fullname'>
					<button type='button' id='studentbutton' style='margin:0%; padding: 0; border: none; background: none;' onclick=\"(function(){
						if(confirm('Are you sure you want to remove $fullname?')){
							$('#studentbutton$ids').submit();
						}
					})();return false;\"><img src='images/x.png' style='height: 20px; width: 20px; padding: 2px;' alt='mark' id='removes'></button>
              </form></td>";
			  echo "</tr>";
        }
			  echo "</table></center>";
        ?>
		</div>
	</body>

</html>