<?php include('connection.php');
    if(!isset($_SESSION['username'])){
        header('Location: login.php');
    }
?>
<html>
    <head>
        <link href="styles/formStyle.css" rel="stylesheet" type="text/css"/>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>SLU Peer Evaluation | Form</title>
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
                            <li style="color: white; font-size: 20px; "><a style="outline: 0;" href="#" onclick="websitenav();">
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
    <?php
        $score_arr = array();
        $user = $_SESSION['username'];
        $course = $_GET["course"];
        //$group_ID = $_GET["groupID"];
        //$course = '9358A';
        $counter = 1; 
        $num = 1;     
        $form_ID = $_GET["formID"];;
        $group_ID = 0;
        $groupmates = array();
        $id = array();
        $url = '';

        $if_Null = "SELECT formID FROM users JOIN user_course USING(id) JOIN group_form USING(groupID) WHERE username='$user';";
        $query = mysqli_query($conn, $if_Null);
        while($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
            if($row['formID'] == NULL){
                exit("<div id='expForm'>Your group is not allowed to fill up the form. Please contact your instructor if this is a mistake.</div>
                    <form action='course.php'>
                    <input type='submit' value='Go Back' id='backBtnForm'>
                    <form>");
            }
        }

        $get_form_id = "SELECT * FROM form JOIN group_form USING(formID) JOIN user_course USING(groupID) JOIN users ON users.id = user_course.id WHERE username = '$user' AND courseCode = '$course' AND formID = $form_ID;";
        $query = mysqli_query($conn, $get_form_id);
        
        while($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
            $form_ID = $row['formID'];
            $group_ID = $row['groupID'];
            $due = $row['due'];
            $date_now = date("Y-m-d", time());
            $time = $row['expTime'];
            $form_type = $row['type'];
            $url = 'uploads/'.$row['path'].'.json';

            $due = strtotime($due);
            $now = $date_now;
            $now = strtotime($now);
            date_default_timezone_set('Asia/Manila');
            $time_now = date("H:i:s");
            $time = strtotime($time);
            $time_now = strtotime($time_now);

            if(($due <= $now AND $time_now >= $time) OR ($due <= $now AND $time_now < $time)){
                exit("<div id='expForm'>You have already surpassed the due date and time. Please contact your instructor for further details.</div>
                    <form action='course.php'>
                    <input type='hidden' value='".$_SESSION['courseCode']."' name='courseCode'>
                    <input type='hidden' value='".$_SESSION['courseName']."' name='courseName'>
                    <input type='submit' value='Go Back' id='backBtnForm'>
                    <form>");
            }
            echo "<h1 id='formTitle'>".$row['formName']."</h1>";
        }

        $get_groupmates = "SELECT * FROM group_form JOIN user_course USING(groupID) JOIN users ON users.id = user_course.id WHERE identification = 'student' AND coursecodeForm = '$course' AND groupID = $group_ID AND username != '$user' AND formID = $form_ID AND courseCode = '$course' ORDER BY lastname;";
        $query_Two = mysqli_query($conn, $get_groupmates);
        while($row = mysqli_fetch_array($query_Two, MYSQLI_ASSOC)) {
            $form_ID = $row['formID'];          
            $group_ID = $row['groupID'];
            array_push($groupmates, $row['firstname'] .' '. $row['lastname']);
            array_push($id, $row['id']);
        }
        

        $data = file_get_contents($url); 
        $formCriteria = json_decode($data, true);    
        if(filesize("$url") == 0){
                exit("<div id='expForm'>There is something wrong with the evaluation form. Please contact your instructor if this was a mistake.</div>
                    <form action='course.php'>
                    <input type='hidden' value='".$_SESSION['courseCode']."' name='courseCode'>
                    <input type='hidden' value='".$_SESSION['courseName']."' name='courseName'>
                    <input type='submit' value='Go Back' id='backBtnForm'>
                    <form>");
            }

        if($formCriteria[0]['criteria'] == 'criteria'){
            echo "<div id='formContainer'>
                    <div id='rating'>Rating:</div>
                        <div id='ratingWrapper'>";
            foreach ($formCriteria as $formCriterias) {
                if($formCriterias['criteria'] == 'choices'){
                    $length = count($formCriterias['choices']);
                    $size_criteria = count($formCriteria) - 1;
                    $size_groupmates = count($groupmates);
                    $size_table = count($groupmates) - 1;
                    $number = 1;
                    $totalnumber = 1;

                    for($ctr = 0; $ctr < $length; $ctr++){
                        echo "<div id='formChoice'>" . $formCriterias['choices'][$ctr] . "</div>";
                    }

                    echo "<br></div>
                            <div id='rating' style='margin-bottom: 2%;'>Criteria:</div>
                            <div class='tableContainer'>
                            <form action='updateResult.php' method='post'>                          
                            <table class='tableForm'>
                                <tr>
                                    <th>Members</th>
                                    <th colspan='$size_criteria'>Criteria</th>
                                    <th>Remarks</th>
                                </tr>
                                <tr>
                                    <td></td>";
                    for($ctr = 1; $ctr <= $size_criteria; $ctr++){
                        echo "<td>[C$ctr]</td>";
                    }
                    echo "<td></td>
                          <td></td>
                          </tr>";

                    for($counter = 0; $counter < $size_groupmates; $counter++){
                        echo "<tr>
                                <td>$groupmates[$counter]
                                    <input type='hidden' name='id[]' value='".$id[$counter]."'>
                                </td>";
                        $query = "SELECT * from result WHERE evaluator = '$user' AND formID = $form_ID AND courseCode = '$course' AND userID = $id[$counter];";
                        $query_Two = mysqli_query($conn, $query);
                        $remarks = '';
                        $ctr = 0;
                        $remarks_arr = array();
                        $result = array();
                        $total_score = 0;
                        while($row = mysqli_fetch_array($query_Two, MYSQLI_ASSOC)){
                            $score_arr[$ctr] = explode("-", $row['score']);
                            $remarks_arr[$ctr] = $row['remarks'];
                            $ctr++;
                        }
                        for($ctr = 0; $ctr < count($score_arr); $ctr++){
                            for($ct = 0; $ct < $size_criteria; $ct++){                           
                                echo "<td><input type='number' value='".$score_arr[$ctr][$ct]."' name='score[]'></td>";
                                $number++;
                            }
                            echo "<td><input type='text' value='".$remarks_arr[$ctr]."' name='remarks[]'></td>";
                        }
                        echo "</tr>";
                        $totalnumber++;
                    }                                   
                }else{
                    echo "<div id='criteria'>[C$num] - " . $formCriterias['criteria'] . "<br></div>";      $num++;
                }            
            } 
        echo "</table>
            <input type='hidden' value='".$form_ID."' name='formID'>
            <input type='hidden' value='".$course."' name='course'>
            <input type='hidden' value='$group_ID' name='groupID'>
            <input type='hidden' value='form1' name='form'>
            <input type='submit' value='Submit' id='submitBtn'>
            </form></div>";
        }else if($formCriteria[0]['criteria'] == 'multiple choice'){

        }else if($formCriteria[0]['criteria'] == 'descriptive'){

        }else{
            exit("<div id='expForm'>There is something wrong with the evaluation form. Please contact your instructor if this was a mistake.</div>
                    <form action='course.php'>
                    <input type='hidden' value='".$_SESSION['courseCode']."' name='courseCode'>
                    <input type='hidden' value='".$_SESSION['courseName']."' name='courseName'>
                    <input type='submit' value='Go Back' id='backBtnForm'>
                    <form>");
        }
      
?>
</body>
</html>