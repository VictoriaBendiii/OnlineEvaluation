<?php include('connection.php'); 
    if(!isset($_SESSION['username'])){
        header('Location: login.php');
    }

    if(!isset($_SESSION['courseCode']) && !isset($_SESSION['courseName'])){
        $_SESSION['courseCode'] = $_GET['courseCode'];
        $_SESSION['courseName'] = $_GET['courseName'];
    }else if($_SESSION['courseCode'] != $_GET['courseCode']) {
        $_SESSION['courseCode'] = $_GET['courseCode'];
        $_SESSION['courseName'] = $_GET['courseName'];
    }
?>
<html>
    <head>
        <meta name=viewport content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <meta charset="UTF-8"/>
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>SLU Peer Evaluation | Class</title>
        <link href="styles/formStyle.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="assets/css/style.css">
        <link rel="stylesheet" href="css/pstyle.css"/>
        <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css'>
        <link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css'>
        <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Montserrat:400,700'>
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="icon" href="css/images/slogo.png">
        <script src="https://code.jquery.com/jquery-3.2.1.js"></script>
		<style>
		#studentbutton:hover{
			font-weight: bold;
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
        <li><a href="teacherpage.php"><img src='images/class.png' class='picnavicon'> Classes</a></li>
        <li><a href="profteacher.php"><img src='images/profile.png' class='picnavicon'> Profile</a></li>
	<li><a href="calendar.php"><img src='images/calendar.jpg' class='picnavicon'>Calendar</a></li>
        <li><a href="signout.php"><img src='images/logout.png' class='picnavicon'> Log out</a></li>
        </ul>
        </div>
 <?php 
 	$user = $_SESSION['username'];
    $course = $_SESSION["courseCode"];

    $get_course = "SELECT * FROM peerpal.course JOIN user_course USING(courseCode) JOIN users USING(id) WHERE courseCode = '$course' AND identification != 'student';";
    $query = mysqli_query($conn, $get_course);

    while($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
        $schedule = $row['schedule'];
        $instructor_name = $row['firstname'].' '.$row['lastname'];
    }

    $get_forms = "SELECT DISTINCT formName, formDesc, formID, startDate, due, expTime from peerpal.group JOIN group_form USING(groupID) JOIN form USING(formID) WHERE courseCodeForm = '$course' ORDER BY 3 DESC";
    $query = mysqli_query($conn, $get_forms);
        
    while($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
        $exp_time = date('h:i a', strtotime($row['expTime']));
        $due = $row['due'];
        $date_now = time();
        $time = $row['expTime'];
        $due = strtotime($due);
        $now = $date_now;
        date_default_timezone_set('Asia/Manila');
        $time_now = date("H:i:s");
        $time = strtotime($time);
        $time_now = strtotime($time_now);

        if(($due <= $now AND $time_now >= $time) OR ($due < $now AND $time_now < $time)){
            echo "<form action='resultForm.php' method='post'>
                <div style='padding-bottom: 24px;'>
                <div class='editForm' style='display: block; position: relative;'>
                <p style='text-align: center'>".$row['formName']."</p><br>
                <b>Description:</b> ".$row['formDesc']."<br>
                <b>Due Date:</b> ".$row['due']."<br>
                <b>Time Due:</b> ".$exp_time."<br>
                <button type='submit' id='backBtn' style='margin-left:0%;'>See Results</button>
                <button type='submit' id='backBtn' style='margin-left:0%;' formaction='donegroups.php'>See Students Done/Not Done</a>
                </div>
                <input type='hidden' name='course' value='$course'>
                <input type='hidden' name='formID' value='".$row['formID']."'>
                </div>
              </form>";
        }else{
            echo "<form action='editForm.php' method='post'>
                <div style='padding-bottom: 24px;'>
                <div class='editForm' style='display: block; position: relative;'>
                <p style='text-align: center'>".$row['formName']."</p><br>
                <b>Description:</b> ".$row['formDesc']."<br>
                <b>Start Date:</b> ".$row['startDate']."<br>
                <b>Due Date:</b> ".$row['due']."<br>
                <b>Time Due:</b> ".$exp_time."<br>
                <button type='submit' id='backBtn' style='margin-left:0%;'>Edit Form</button>
                <button type='submit' id='backBtn' style='margin-left:0%;' formaction='donegroups.php'>See Students Done/Not Done</a>
                </div>
                <input type='hidden' name='course' value='$course'>
                <input type='hidden' name='formID' value='".$row['formID']."'>
                </div>
              </form>";
        }      
    }
 ?>
 <div class="cover">
     <?php echo $_SESSION['courseCode'] ?> <br>
     <?php echo $_SESSION['courseName'] ?> <br>
     <?php echo $schedule ?> <br>
     <?php echo $instructor_name ?>
     <?php $_SESSION["course"] = $_SESSION['courseCode'] ?>
 </div>
 <div class="teachernavigation">
	<ul>
		<?php 
		echo "<form action='teacherForm.php' method='post'>
                <div id='studbutton'>
					<button type='submit' id='studentbutton' style='margin-left:0%; padding: 0; border: none; background: none;' formaction='studentlist.php'><img src='images/studs.png' class='tnavicon'> List of Students</button>
					<input type='hidden' name='course' value='$course'>
                </div>
              </form>";
		?>
        <li><a href="uploadForm.php"><img src='images/upload.png' class='tnavicon'> Upload New Form</a></li>
        <li><a href="studentgroups.php"><img src='images/group.png' class='tnavicon'> Groups</a></li>
    </ul>
 </div>
 <div class='formActivities'>
    Activities
 </div>
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
