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
                <div class="container">
				<div class="row">
					<?php
                    $target_name = array();
                $user = mysqli_real_escape_string($conn, $_SESSION['username']);
                $target = "classes.php";
                $sql = "select * from user_course join users using(id) join course using(courseCode) where users.username ='$user'";
                $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) > 0) {
                        // output data of each row
                        while($row = mysqli_fetch_assoc($result)) {
                            echo "<div class='col-md-3'> <div class='grey-box-icon'> <div class='icon-box-top grey-box-icon-pos'>
                                        <img src='assets/images/1.PNG' alt='' style='width: 100px; height: auto;' />
                                    </div><a href='classes.php'> <h4>&nbsp; <div> ".$row["courseCode"].  "<br>" . $row["courseName"]." <br></h4> </a>
						</div>
					</div>";
                        
                        }
                         echo "<a><div class='col-md-2' data-toggle='modal' data-target='#myModal'></a>
                                <div class='grey-box-icon'> 
                                    <div class='icon-box-top grey-box-icon-pos' style='margin: 0px;'>
                                        <img src='assets/images/2.PNG' alt='' style='width: 100px; height: auto;' />
                                    </div> 
                                <h4 style='margin: 10px; padding: 0px; color: black;'>Join a class</h4>
						      </div>
					       </div></a>";
                    
                    } else{
                            echo "<a><div class='col-md-2' data-toggle='modal' data-target='#myModal'></a>
                                <div class='grey-box-icon'> 
                                    <div class='icon-box-top grey-box-icon-pos' style='margin: 0px;'>
                                        <img src='assets/images/2.PNG' alt='' style='width: 100px; height: auto;' />
                                    </div> 
                                <h4 style='margin: 10px; padding: 0px; color: black;'>Join a class</h4>
						      </div>
					       </div></a>";
                        }
        
        if(isset($_POST['add'])){
            
            $query = "SELECT * FROM USER_COURSE JOIN COURSE USING (courseCode) JOIN users using (id) where identification= 'student' and username='".$_SESSION["username"]."'";
            $result = mysqli_query($conn,$query);
            $row = mysqli_fetch_array($result,MYSQLI_ASSOC);     
            $_SESSION['id'] = $row['id'];
            $id = $_SESSION['id'];
			
			$query2 = "INSERT INTO user_course (id, courseCode, groupID) VALUES ('$id', '".$_POST["classcode"]."',null)";
			
            
			if ($conn->multi_query($query2) === TRUE) {
                 echo "<meta http-equiv='refresh' content='0'>";
}
        }   $conn->close();
        
    ?>
  
      </div>
    
    </div>
            </header>
                          <!-- Modal -->
      <form id ="classForm" method = "post" class="form-horizontal">
      
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" >
                      <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                          <div class="modal-header" style="background-color: #3d84e6">
                            <h5 class="modal-title" id="exampleModalLongTitle" style="text-align: center; color: white; font-size: 2em">JOIN A CLASS</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body" style="text-align: center; font-size: 1.3em;">
                            To join a class, type in the code given <br> by your teacher below
                              <div class="form-group">
                                  <label for="usr"></label>
                                    <input type="text" class="form-control" id="usr" placeholder="code" name="classcode">
                              </div>               
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" name ="add">Join class</button>
                          </div>
                        </div>
                      </div>
                </div>
      </form> 
	  
	  <div id="pictureNavigation" style="display: none;">
		<ul>
		<li><a href="classes.php"><img src='images/class.png' class='picnavicon'> Classes</a></li>
		<li><a href="profile.php"><img src='images/profile.png' class='picnavicon'> Profile</a></li>
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