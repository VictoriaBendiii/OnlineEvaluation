<?php include 'connection.php'?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>SLU Peer Evaluation | Profile</title>
        <link rel="stylesheet" href="css/pstyle.css"/>
        <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css'>
        <link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css'>
        <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Montserrat:400,700'>
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
		<link rel="icon" href="css/images/slogo.png">
        <script src="https://code.jquery.com/jquery-3.2.1.js"></script>
    </head>
    
    <body>
        
        <div class="wrapper">
            <header>
                <nav style="z-index: 1000; background-color: RGBA(92,115,139, 0.6);">
                    <div class="menu-icon">
                        <i class="fa fa-bars fa-2x"></i>
                    </div>
					<img src="css/images/slogo.png" style="height: 45px; width: 36px; position: fixed; top: 10px; left: 10px;">
                    <div class="logo">&emsp;SLU Peer Evaluation</div>
                    <div class="menu">
                        <ul>
                            <li style="color: white; font-size: 20px; "><a class="active" href="#" onclick="websitenav();">
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
            </header>
        </div>
		<div id="pictureNavigation" style="display: none;">
		<ul>
		<li><a href="classes.php"><img src='images/class.png' class='picnavicon'> Classes</a></li>
		<li><a href="profile.php"><img src='images/profile.png' class='picnavicon'> Profile</a></li>
		<li><a href="signout.php"><img src='images/logout.png' class='picnavicon'> Log out</a></li>
		</ul>
		</div>
		<?php 
			$username = $_SESSION['username'];
			if(isset($_POST['submit'])){
			if( $_FILES["file"]['name'] != "" ) {
			$uploadfolder = $_SERVER['DOCUMENT_ROOT']."/spews/images/profilepictures";
			$filename = $_FILES["file"]['name'];

			move_uploaded_file( $_FILES["file"]['tmp_name'], "$uploadfolder/$username.jpg" ) or 
               die( "Could not copy file.");
			}else {
				die("No file specified.");
			}
        	$query = "UPDATE users SET `profilepicture`='$username.jpg' WHERE `username`='$username'";
			$result = mysqli_query($conn, $query);
						if($result){
							echo "<script type='text/javascript'>alert('Profile picture changed.');
								  window.location.href='profile.php';</script>";
						} else {
							echo mysqli_error($conn);
						}
			} else {
			?>
			<div id="up" style="display: none;">
			<img src="images/exit.png" class="exitone" onclick="document.getElementById('up').style.display='none'">
				<form enctype="multipart/form-data" action="profile.php" method="post">
					<input type="file" name="file" id="file">
					<input type="submit" name="submit" id="button" value="upload">
				</form>
			</div>
			<?php } ?>
			
			<?php
					$username = $_SESSION['username'];
					if(isset($_POST['submits'])){
						$old = $_POST['oldp'];
						$new= $_POST['pass'];
						$newCheck = $_POST['newp'];
						$querie = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username';");
						while($row = mysqli_fetch_array($querie, MYSQLI_ASSOC)) {
						$password = $row['password'];
						}
						if($password === $old && $new === $newCheck){
						$querys = "UPDATE users SET `password`='$new' WHERE `username`='$username'";
						$result = mysqli_query($conn, $querys);
						if($result){
							echo "<script type='text/javascript'>alert('Password changed.');
						    window.location.href='profile.php';</script>";
						} else {
							echo mysqli_error($conn);
							}
						} else if($password !== $old) {
							echo "<script type='text/javascript'>alert('Incorrect password.');
						    window.location.href='profile.php';</script>";
						} else if($new !== $newCheck) {
							echo "<script type='text/javascript'>alert('Passwords do not match.');
						    window.location.href='profile.php';</script>";
						}
					} else {
				?>
			<div id="changepass" style="display: none;">
			<img src="images/exit.png" class="exitone" onclick="document.getElementById('changepass').style.display='none'">
				<form action="profile.php" method="post">
					<input type="password" name="oldp" class="passwd" id="oldp" placeholder="Old Password">
					<input type="password" name="pass" class="passwd" id="pass" placeholder="New Password">
					<input type="password" name="newp" class="passwd" id="newp" placeholder="Repeat New Password">
					<input type="submit" name="submits" id="button" value="submit">
				</form>
			</div>
			<?php } ?>
		<?php 
			$username = $_SESSION['username'];
        	$query = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username';");
    
        	while($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
            	$first = $row['firstname'];
            	$last = $row['lastname'];
            	$username = $row['username'];
				$profilepicture = $row['profilepicture'];

            	echo "<div class='profile-container'>
						<img src='images/profilepictures/$profilepicture' class='profpic' alt='profile picture'>
						<div id='space' style='padding-top: 20px'></div>
						<div class='row more-info'>
						<div class='col-md-6'>
							<h5><b>Name</b></h5>
						<p><div class='profileText'>
                        $first $last</div>
						</p>
						</div>
						<div class='col-md-6'>
						<h5><b>ID Number</b></h5>
							<p>$username</p>
						</div>
						</div>
						<div class='row more-info'>
						<div class='col-md-6'>
						<h5><b>Course</b></h5>
						<p>BSIT</p>
						</div>
						<div class='col-md-6'>
							<h5><b>Email</b></h5>
							<p>$username@slu.edu.ph</p>
						</div>
						</div>
						<br>
					<div class='col-md-6 profile-info'>
					<button onclick='return upload();' style='width:100%;' type='button' class='btn btn-primary col-md-7 col-xs-7' >Change Profile Picture</button><br>
					</div>
					<div class='col-md-6 profile-info'>
					<button onclick='return chpswd();' style='width:100%;' type='button' class='btn btn-primary col-md-7 col-xs-7'>Change Password</button>
					</div>
						</div>";
        	}

        ?>
        <script type="text/javascript">
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
		
		function openpSettings(){
			var z = document.getElementById("pChoices");
			var a = document.getElementById("up");
			var x = document.getElementById("changepass");
			if (z.style.display === "none") {
				z.style.display = "block";
			} else {
				z.style.display = "none";
			}
			if (a.style.display === "block") {
				a.style.display = "none";
			} 
			if (x.style.display === "block") {
				x.style.display = "none";
			}
		}
		function upload(){
			var a = document.getElementById("up");
			var x = document.getElementById("changepass");
			if (a.style.display === "none" || x.style.display === "block") {
				a.style.display = "block";
				x.style.display = "none";
			} else {
				a.style.display = "none";
			}
		}
		function chpswd(){
			var a = document.getElementById("up");
			var x = document.getElementById("changepass");
			if (x.style.display === "none" || a.style.display === "block") {
				a.style.display = "none";
				x.style.display = "block";
			} else {
				x.style.display = "none";
			}
		}
		$(document).ready(function(){
		$(document).mouseup(function(e){
        var subject = $("#pChoices"); 
		if(e.target.id != subject.attr('id')){
            subject.fadeOut();
		}
			});
		});
		 $(document).ready(function(){
			$(document).mouseup(function(e){
				var subject = $("#pictureNavigation"); 

        if(e.target.id != subject.attr('id') && !subject.has(e.target).length){
            subject.fadeOut();
				}
			});
		});
		function websitenav(){
			var x = document.getElementById("pictureNavigation");
			if (x.style.display === "none") {
				x.style.display = "block";
			} else {
				x.style.display = "none";
			}
		}
        </script>
    </body>
</html>