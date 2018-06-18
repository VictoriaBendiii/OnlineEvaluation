<?php include('connection.php');?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="free-educational-responsive-web-template-webEdu">
	<meta name="author" content="webThemez.com">
	<title>Classes</title>
	<link rel="favicon" href="assets/images/favicon.png">
	<link rel="stylesheet" media="screen" href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,700">
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/font-awesome.min.css"> 
	<link rel="stylesheet" href="assets/css/bootstrap-theme.css" media="screen"> 
	<link rel="stylesheet" href="assets/css/style.css">
    <link rel='stylesheet' id='camera-css'  href='assets/css/camera.css' type='text/css' media='all'> 
	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	<script src="assets/js/html5shiv.js"></script>
	<script src="assets/js/respond.min.js"></script>
	<![endif]-->
</head>
<body>
   
    
	<!-- Fixed navbar -->
	<div class="navbar navbar-inverse">
		<div class="container">
			<div class="navbar-header">
				<!-- Button for smallest screens -->
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
                <a class="navbar-brand" href="teacherhome.php"><h1 style="color: dimgray; padding,margin: 0px !important;">Online Evaluation Tool</h1></a>
			</div>
			<div class="navbar-collapse collapse">
				<ul class="nav navbar-nav pull-right mainNav">
					<li class="active "><a href="#">Home</a></li>
					<li><a href="#">About</a></li>
                    <li><a href="#">Add a class</a></li>
                    <li><a href="signout.php"><span class="glyphicon glyphicon-log-out"></span> Log-out</a></li>
					<li style="color: GRAY; font-size: 18px; margin: auto; padding: 6px;">Welcome &nbsp; <?php echo $_SESSION['firstname']. " ". $_SESSION['lastname'];?></li>
				</ul>
			</div>
			<!--/.nav-collapse -->
		</div>
	</div>
	<!-- /.navbar -->

  <div class="container">
    <div class="row">
					<?php
                    $target_name = array();
					$id = mysqli_real_escape_string($conn, $_SESSION['id']);
                $user = mysqli_real_escape_string($conn, $_SESSION['username']);
                $target = "teacherpage.php";
                $sql = "select * from user_course join users using(id) join course using(courseCode) where users.username =  '$user'";
                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) > 0) {
                        // output data of each row
                        while($row = mysqli_fetch_assoc($result)) {
                            echo "<div class='col-md-3'> <div class='grey-box-icon'> <div class='icon-box-top grey-box-icon-pos'>
                                        <img src='assets/images/1.PNG' alt='' style='width: 100px; height: auto;' />
                                    </div><a href='teacherpage.php'> <h4>&nbsp; <div> ".$row["courseCode"].  "<br>" . $row["courseName"]." <br></h4> </a>
						</div>
					</div>";
                        }
                        
                        
                        
                        echo "<a><div class='col-md-2' data-toggle='modal' data-target='#myModal'></a>
                                <div class='grey-box-icon'> 
                                    <div class='icon-box-top grey-box-icon-pos' style='margin: 0px;'>
                                        <img src='assets/images/2.PNG' alt='' style='width: 100px; height: auto;' />
                                    </div> 
                                <h4 style='margin: 10px; padding: 0px; color: black;'>Add a class</h4>
						      </div>
					       </div></a>";
                    }
                ?>
        
        
          <?php
        
        
        if(isset($_POST['add'])){
            
            
          $id =  $_SESSION["id"];
			
			
            $query = "INSERT INTO course (courseCode, courseName, courseDescription, schedule) VALUES ('".$_POST["code"]."', '".$_POST["name"]."', '".$_POST["desc"]."', '".$_POST["sched"]."')";
			$query = "INSERT INTO user_course (id, courseCode) VALUES ('$id', '".$_POST["code"]."')";
			
            
			if ($conn->multi_query($query) === TRUE) {
    echo "New records created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
 
			//mysqli_close($conn);
        }   $conn->close();
        
        
    ?>
  
        
        
      </div>
        
        
    </div>
      <!-- Modal -->
      <form id ="classForm" method = "post" class="form-horizontal">
      
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" >
                      <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                          <div class="modal-header" style="background-color: #3d84e6">
                            <h5 class="modal-title" id="exampleModalLongTitle" style="text-align: center; color: white; font-size: 2em">ADD A CLASS</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body" style="text-align: center; font-size: 1.3em;">
                            To add a class, please fill in the form <br> indicated below.
                              <div class="form-group">
                                  <label for="code"></label>
                                  <input type="text" class="form-control" name="code" placeholder="Course Code" required>
                              </div>
                              
                              
                              <div class="form-group">
                                  <label for="name"></label>
                                  <input type="text" class="form-control" name="name" placeholder="Course Name" required>
                              </div>
                              
                              <div class="form-group">
                                  <label for="desc"></label>
                                  <input type="text" class="form-control" name="desc" placeholder="Course Description" required>
                              </div>
                              
                               <div class="form-group">
                                  <label for="sched"></label>
                                  <input type="text" class="form-control" name="sched" placeholder="Schedule" required>
                              </div>             
                              
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" name ="add">Add class</button>
                          </div>
                        </div>
                      </div>
                </div>
      </form>
      
      
      
      
    
     

      
      
	<!-- JavaScript libs are placed at the end of the document so the pages load faster -->
	<script src="assets/js/modernizr-latest.js"></script> 
	<script type='text/javascript' src='assets/js/jquery.min.js'></script>
    <script type='text/javascript' src='assets/js/fancybox/jquery.fancybox.pack.js'></script>
    
    <script type='text/javascript' src='assets/js/jquery.mobile.customized.min.js'></script>
    <script type='text/javascript' src='assets/js/jquery.easing.1.3.js'></script> 
    <script type='text/javascript' src='assets/js/camera.min.js'></script> 
    <script src="assets/js/bootstrap.min.js"></script> 
	<script src="assets/js/custom.js"></script>
    <script>
		jQuery(function(){
			
			jQuery('#camera_wrap_4').camera({
                transPeriod: 500,
                time: 3000,
				height: '600',
				loader: 'false',
				pagination: true,
				thumbnails: false,
				hover: false,
                playPause: false,
                navigation: false,
				opacityOnGrid: false,
				imagePath: 'assets/images/'
			});

		});
      
	</script>
    
</body>
</html>
