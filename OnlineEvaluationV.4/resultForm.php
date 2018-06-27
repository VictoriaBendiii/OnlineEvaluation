<?php include('connection.php'); ?>
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
                <nav style="z-index: 1000; background-color: RGBA(92,115,139, 0.6); position: fixed; top: 0px;"">
                    <div class="menu-icon">
                        <i class="fa fa-bars fa-2x"></i>
                    </div>
                    <img src="css/images/slogo.png" style="height: 45px; width: 36px; position: fixed; top: 10px; left: 10px;">
                    <div class="logo">&emsp;SLU Peer Evaluation</div>
                    <div class="menu">
                        <ul>
                            <li style="color: white; font-size: 20px;"><a href="#" style="outline: 0;" onclick="websitenav();">
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
        <li><a href="teacherpage.php"><img src='images/class.png' class='picnavicon'>Classes</a></li>
        <li><a href="profteacher.php"><img src='images/profile.png' class='picnavicon'>Profile</a></li>
        <li><a href="signout.php"><img src='images/logout.png' class='picnavicon'>Log out</a></li>
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
	$course = $_POST['course'];
	$form_ID = $_POST['formID'];	
	$user = $_SESSION["username"];
	$result = '';
	$num = 1;     
    $group_ID = 0;
    $groupmates = array();
    $id = array();
    $group_num = array();
    $score_arr = array();
    $url = '';

	$get_form_id = "SELECT * FROM users JOIN user_course USING(id) JOIN group_form ON courseCode = courseCodeForm JOIN form USING(formID) WHERE username = '$user' AND formID = $form_ID;";
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
            $now = strtotime($date_now);
            date_default_timezone_set('Asia/Manila');
            $time_now = date("H:i:s");
            $time = strtotime($time);
            $time_now = strtotime($time_now);

            echo "<h1 id='formTitle'>".$row['formName']."</h1>";
        }

        $get_groupmates = "SELECT * FROM course JOIN group_form JOIN user_course USING(groupID) JOIN users ON users.id = user_course.id WHERE course.courseCode = courseCodeForm AND course.courseCode = '$course' AND courseCodeForm = '$course' AND user_course.courseCode = '$course' AND formID = $form_ID ORDER BY groupID, lastname;";
        $query_Two = mysqli_query($conn, $get_groupmates);
        while($row = mysqli_fetch_array($query_Two, MYSQLI_ASSOC)) {
            $form_ID = $row['formID'];          
            $group_ID = $row['groupID'];
            array_push($groupmates, $row['firstname'] .' '. $row['lastname']);
            array_push($id, $row['id']);
            array_push($group_num, $row['groupID']);
        }
        
        if($form_type == 'form1'){
            $data = file_get_contents($url); 
            $formCriteria = json_decode($data, true);

            if(filesize("$url") == 0){
                echo '<h3 class="quiz" style="text-align:center;">There is something wrong with your form</h3>
                      <button class="submitButton" onclick="formBuilder.php">Go Back</button>';
            }

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
                            <form action='successfulEval.php' method='post'>                          
                            <table class='tableForm'>
                                <tr>
                                    <th>Students</th>
                                    <th>Group #</th>
                                    <th colspan='$size_criteria'>Criteria</th>
                                    <th>Total</th>
                                    <th>Remarks</th>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>";
                    for($ctr = 1; $ctr <= $size_criteria; $ctr++){
                        echo "<td>[C$ctr]</td>";
                    }
                    echo "<td></td>
                    	  <td></td>
                          <td></td>
                          </tr>";

                    for($counter = 0; $counter < $size_groupmates; $counter++){
                        echo "<tr>
                                <td>$groupmates[$counter]
                                    <input type='hidden' name='id[]' value='".$id[$counter]."'>
                                </td>
                                <td>".$group_num[$counter]."</td>";
                        $query = "SELECT * from result JOIN users ON id = userID WHERE formID = $form_ID AND courseCode = '$course' AND userID = $id[$counter] ORDER BY lastname;";
                        $query_Two = mysqli_query($conn, $query);
                        $score_avg = 0;
                        $remarks_arr = array();
                        $remarks = '';
        				$ctr = 0;
        				$result = array();
        				$total_score = 0;
        				while($row = mysqli_fetch_array($query_Two, MYSQLI_ASSOC)){
        					$score_arr[$ctr] = explode("-", $row['score']);
        					$remarks_arr[$ctr] = $row['remarks'];
        					$ctr++;
        				}
        				if(count($score_arr) == 1){
        					for($ctr = 0; $ctr < count($score_arr); $ctr++){
		                        for($ct = 0; $ct < $size_criteria; $ct++){                           
		                            echo "<td>".$score_arr[$ctr][$ct]."</td>";
		                            $score_avg = $score_arr[$ctr][$ct];
		                            $total_score += $score_avg;
		                            $number++;
		                        }
		                        echo "<td>".$total_score."</td>";
		                        echo "<td>".$remarks_arr[$ctr]."</td>";
	                    	}
        				}else{
        					switch(count($score_arr)){
        						case 2:
		        					for($ctr = 0; $ctr < count($score_arr)-1; $ctr++){
		        						for($ct = 0; $ct < $size_criteria; $ct++){
		        							$result[$ctr][$ct] = $score_arr[$ctr][$ct] + $score_arr[$ctr+1][$ct];
		        							$score_avg = round(($result[$ctr][$ct])/(count($score_arr)), 2);
		        							$total_score += $score_avg;
		        							$remarks = $remarks_arr[$ctr]."<br>".$remarks_arr[$ctr+1];
		        							echo "<td>".$score_avg."</td>";
        								}
        								echo "<td>".$total_score."</td>";
        								echo "<td>".$remarks."</td>";
        							} break;
        						case 3:
		        					for($ctr = 0; $ctr < count($score_arr)-2; $ctr++){
		        						for($ct = 0; $ct < $size_criteria; $ct++){
		        							$result[$ctr][$ct] = $score_arr[$ctr][$ct] + $score_arr[$ctr+1][$ct] + $score_arr[$ctr+2][$ct];
		        							$score_avg = round(($result[$ctr][$ct])/(count($score_arr)), 2);
		        							$total_score += $score_avg;
		        							$remarks = $remarks_arr[$ctr]."<br>".$remarks_arr[$ctr+1]."<br>".$remarks_arr[$ctr+2];
		        							echo "<td>".$score_avg."</td>";
        								}
        								echo "<td>".$total_score."</td>";
        								echo "<td>".$remarks."</td>";
        							} break;
        						case 4:
		        					for($ctr = 0; $ctr < count($score_arr)-3; $ctr++){
		        						for($ct = 0; $ct < $size_criteria; $ct++){
		        							$result[$ctr][$ct] = $score_arr[$ctr][$ct] + $score_arr[$ctr+1][$ct] + $score_arr[$ctr+2][$ct] + $score_arr[$ctr+3][$ct];
		        							$score_avg = round(($result[$ctr][$ct])/(count($score_arr)), 2);
		        							$total_score += $score_avg;
		        							$remarks = $remarks_arr[$ctr]."<br>".$remarks_arr[$ctr+1]."<br>".$remarks_arr[$ctr+2]."<br>".$remarks_arr[$ctr+3];
		        							echo "<td>".$score_avg."</td>";
        								}
        								echo "<td>".$total_score."</td>";
        								echo "<td>".$remarks."</td>";
        							} break;
        						case 5:
		        					for($ctr = 0; $ctr < count($score_arr)-4; $ctr++){
		        						for($ct = 0; $ct < $size_criteria; $ct++){
		        							$result[$ctr][$ct] = $score_arr[$ctr][$ct] + $score_arr[$ctr+1][$ct] + $score_arr[$ctr+2][$ct] + $score_arr[$ctr+3][$ct] + $score_arr[$ctr+4][$ct];
		        							$score_avg = round(($result[$ctr][$ct])/(count($score_arr)), 2);
		        							$total_score += $score_avg;
		        							$remarks = $remarks_arr[$ctr]."<br>".$remarks_arr[$ctr+1]."<br>".$remarks_arr[$ctr+2]."<br>".$remarks_arr[$ctr+3]."<br>".$remarks_arr[$ctr+4];
		        							echo "<td>".$score_avg."</td>";
        								}
        								echo "<td>".$total_score."</td>";
        								echo "<td>".$remarks."</td>";
        							} break;
        						case 6:
		        					for($ctr = 0; $ctr < count($score_arr)-5; $ctr++){
		        						for($ct = 0; $ct < $size_criteria; $ct++){
		        							$result[$ctr][$ct] = $score_arr[$ctr][$ct] + $score_arr[$ctr+1][$ct] + $score_arr[$ctr+2][$ct] + $score_arr[$ctr+3][$ct] + $score_arr[$ctr+4][$ct] + $score_arr[$ctr+5][$ct];
		        							$score_avg = round(($result[$ctr][$ct])/(count($score_arr)), 2);
		        							$total_score += $score_avg;
		        							$remarks = $remarks_arr[$ctr]."<br>".$remarks_arr[$ctr+1]."<br>".$remarks_arr[$ctr+2]."<br>".$remarks_arr[$ctr+3]."<br>".$remarks_arr[$ctr+4]."<br>".$remarks_arr[$ctr+5];
		        							echo "<td>".$score_avg."</td>";
        								}
        								echo "<td>".$total_score."</td>";
        								echo "<td>".$remarks."</td>";
        							} break;
        						case 7:
		        					for($ctr = 0; $ctr < count($score_arr)-6; $ctr++){
		        						for($ct = 0; $ct < $size_criteria; $ct++){
		        							$result[$ctr][$ct] = $score_arr[$ctr][$ct] + $score_arr[$ctr+1][$ct] + $score_arr[$ctr+2][$ct] + $score_arr[$ctr+3][$ct] + $score_arr[$ctr+4][$ct] + $score_arr[$ctr+5][$ct] + $score_arr[$ctr+6][$ct];
		        							$score_avg = round(($result[$ctr][$ct])/(count($score_arr)), 2);
		        							$total_score += $score_avg;
		        							$remarks = $remarks_arr[$ctr]."<br>".$remarks_arr[$ctr+1]."<br>".$remarks_arr[$ctr+2]."<br>".$remarks_arr[$ctr+3]."<br>".$remarks_arr[$ctr+4]."<br>".$remarks_arr[$ctr+5]."<br>".$remarks_arr[$ctr+6];
		        							echo "<td>".$score_avg."</td>";
        								}
        								echo "<td>".$total_score."</td>";
        								echo "<td>".$remarks."</td>";
        							} break;
        						case 8:
		        					for($ctr = 0; $ctr < count($score_arr)-7; $ctr++){
		        						for($ct = 0; $ct < $size_criteria; $ct++){
		        							$result[$ctr][$ct] = $score_arr[$ctr][$ct] + $score_arr[$ctr+1][$ct] + $score_arr[$ctr+2][$ct] + $score_arr[$ctr+3][$ct] + $score_arr[$ctr+4][$ct] + $score_arr[$ctr+5][$ct] + $score_arr[$ctr+6][$ct] + $score_arr[$ctr+7][$ct];
		        							$score_avg = round(($result[$ctr][$ct])/(count($score_arr)), 2);
		        							$total_score += $score_avg;
		        							$remarks = $remarks_arr[$ctr]."<br>".$remarks_arr[$ctr+1]."<br>".$remarks_arr[$ctr+2]."<br>".$remarks_arr[$ctr+3]."<br>".$remarks_arr[$ctr+4]."<br>".$remarks_arr[$ctr+5]."<br>".$remarks_arr[$ctr+6]."<br>".$remarks_arr[$ctr+7];
		        							echo "<td>".$score_avg."</td>";
        								}
        								echo "<td>".$total_score."</td>";
        								echo "<td>".$remarks."</td>";
        							} break;
        						case 9:
		        					for($ctr = 0; $ctr < count($score_arr)-8; $ctr++){
		        						for($ct = 0; $ct < $size_criteria; $ct++){
		        							$result[$ctr][$ct] = $score_arr[$ctr][$ct] + $score_arr[$ctr+1][$ct] + $score_arr[$ctr+2][$ct] + $score_arr[$ctr+3][$ct] + $score_arr[$ctr+4][$ct] + $score_arr[$ctr+5][$ct] + $score_arr[$ctr+6][$ct] + $score_arr[$ctr+7][$ct] + $score_arr[$ctr+8][$ct];
		        							$score_avg = round(($result[$ctr][$ct])/(count($score_arr)), 2);
		        							$total_score += $score_avg;
		        							$remarks = $remarks_arr[$ctr]."<br>".$remarks_arr[$ctr+1]."<br>".$remarks_arr[$ctr+2]."<br>".$remarks_arr[$ctr+3]."<br>".$remarks_arr[$ctr+4]."<br>".$remarks_arr[$ctr+5]."<br>".$remarks_arr[$ctr+6]."<br>".$remarks_arr[$ctr+7]."<br>".$remarks_arr[$ctr+8];
		        							echo "<td>".$score_avg."</td>";
        								}
        								echo "<td>".$total_score."</td>";
        								echo "<td>".$remarks."</td>";
        							} break;
        						case 10:
		        					for($ctr = 0; $ctr < count($score_arr)-9; $ctr++){
		        						for($ct = 0; $ct < $size_criteria; $ct++){
		        							$result[$ctr][$ct] = $score_arr[$ctr][$ct] + $score_arr[$ctr+1][$ct] + $score_arr[$ctr+2][$ct] + $score_arr[$ctr+3][$ct] + $score_arr[$ctr+4][$ct] + $score_arr[$ctr+5][$ct] + $score_arr[$ctr+6][$ct] + $score_arr[$ctr+7][$ct] + $score_arr[$ctr+8][$ct] + $score_arr[$ctr+9][$ct];
		        							$score_avg = round(($result[$ctr][$ct])/(count($score_arr)), 2);
		        							$total_score += $score_avg;
		        							$remarks = $remarks_arr[$ctr]."<br>".$remarks_arr[$ctr+1]."<br>".$remarks_arr[$ctr+2]."<br>".$remarks_arr[$ctr+3]."<br>".$remarks_arr[$ctr+4]."<br>".$remarks_arr[$ctr+5]."<br>".$remarks_arr[$ctr+6]."<br>".$remarks_arr[$ctr+7]."<br>".$remarks_arr[$ctr+8]."<br>".$remarks_arr[$ctr+9];
		        							echo "<td>".$score_avg."</td>";
        								}
        								echo "<td>".$total_score."</td>";
        								echo "<td>".$remarks."</td>";
        							} break;
        						case 11:
		        					for($ctr = 0; $ctr < count($score_arr)-10; $ctr++){
		        						for($ct = 0; $ct < $size_criteria; $ct++){
		        							$result[$ctr][$ct] = $score_arr[$ctr][$ct] + $score_arr[$ctr+1][$ct] + $score_arr[$ctr+2][$ct] + $score_arr[$ctr+3][$ct] + $score_arr[$ctr+4][$ct] + $score_arr[$ctr+5][$ct] + $score_arr[$ctr+6][$ct] + $score_arr[$ctr+7][$ct] + $score_arr[$ctr+8][$ct] + $score_arr[$ctr+9][$ct] + $score_arr[$ctr+10][$ct];
		        							$score_avg = round(($result[$ctr][$ct])/(count($score_arr)), 2);
		        							$total_score += $score_avg;
		        							$remarks = $remarks_arr[$ctr]."<br>".$remarks_arr[$ctr+1]."<br>".$remarks_arr[$ctr+2]."<br>".$remarks_arr[$ctr+3]."<br>".$remarks_arr[$ctr+4]."<br>".$remarks_arr[$ctr+5]."<br>".$remarks_arr[$ctr+6]."<br>".$remarks_arr[$ctr+7]."<br>".$remarks_arr[$ctr+8]."<br>".$remarks_arr[$ctr+9]."<br>".$remarks_arr[$ctr+10];
		        							echo "<td>".$score_avg."</td>";
        								}
        								echo "<td>".$total_score."</td>";
        								echo "<td>".$remarks."</td>";
        							} break;
        						case 12:
		        					for($ctr = 0; $ctr < count($score_arr)-11; $ctr++){
		        						for($ct = 0; $ct < $size_criteria; $ct++){
		        							$result[$ctr][$ct] = $score_arr[$ctr][$ct] + $score_arr[$ctr+1][$ct] + $score_arr[$ctr+2][$ct] + $score_arr[$ctr+3][$ct] + $score_arr[$ctr+4][$ct] + $score_arr[$ctr+5][$ct] + $score_arr[$ctr+6][$ct] + $score_arr[$ctr+7][$ct] + $score_arr[$ctr+8][$ct] + $score_arr[$ctr+9][$ct] + $score_arr[$ctr+10][$ct] + $score_arr[$ctr+11][$ct];
		        							$score_avg = round(($result[$ctr][$ct])/(count($score_arr)), 2);
		        							$total_score += $score_avg;
		        							$remarks = $remarks_arr[$ctr]."<br>".$remarks_arr[$ctr+1]."<br>".$remarks_arr[$ctr+2]."<br>".$remarks_arr[$ctr+3]."<br>".$remarks_arr[$ctr+4]."<br>".$remarks_arr[$ctr+5]."<br>".$remarks_arr[$ctr+6]."<br>".$remarks_arr[$ctr+7]."<br>".$remarks_arr[$ctr+8]."<br>".$remarks_arr[$ctr+9]."<br>".$remarks_arr[$ctr+10]."<br>".$remarks_arr[$ctr+11];
		        							echo "<td>".$score_avg."</td>";
        								}
        								echo "<td>".$total_score."</td>";
        								echo "<td>".$remarks."</td>";
        							} break;
        						case 13:
		        					for($ctr = 0; $ctr < count($score_arr)-12; $ctr++){
		        						for($ct = 0; $ct < $size_criteria; $ct++){
		        							$result[$ctr][$ct] = $score_arr[$ctr][$ct] + $score_arr[$ctr+1][$ct] + $score_arr[$ctr+2][$ct] + $score_arr[$ctr+3][$ct] + $score_arr[$ctr+4][$ct] + $score_arr[$ctr+5][$ct] + $score_arr[$ctr+6][$ct] + $score_arr[$ctr+7][$ct] + $score_arr[$ctr+8][$ct] + $score_arr[$ctr+9][$ct] + $score_arr[$ctr+10][$ct] + $score_arr[$ctr+11][$ct] + $score_arr[$ctr+12][$ct];
		        							$score_avg = round(($result[$ctr][$ct])/(count($score_arr)), 2);
		        							$total_score += $score_avg;
		        							$remarks = $remarks_arr[$ctr]."<br>".$remarks_arr[$ctr+1]."<br>".$remarks_arr[$ctr+2]."<br>".$remarks_arr[$ctr+3]."<br>".$remarks_arr[$ctr+4]."<br>".$remarks_arr[$ctr+5]."<br>".$remarks_arr[$ctr+6]."<br>".$remarks_arr[$ctr+7]."<br>".$remarks_arr[$ctr+8]."<br>".$remarks_arr[$ctr+9]."<br>".$remarks_arr[$ctr+10]."<br>".$remarks_arr[$ctr+11]."<br>".$remarks_arr[$ctr+12];
		        							echo "<td>".$score_avg."</td>";
        								}
        								echo "<td>".$total_score."</td>";
        								echo "<td>".$remarks."</td>";
        							} break;
        						case 14:
		        					for($ctr = 0; $ctr < count($score_arr)-13; $ctr++){
		        						for($ct = 0; $ct < $size_criteria; $ct++){
		        							$result[$ctr][$ct] = $score_arr[$ctr][$ct] + $score_arr[$ctr+1][$ct] + $score_arr[$ctr+2][$ct] + $score_arr[$ctr+3][$ct] + $score_arr[$ctr+4][$ct] + $score_arr[$ctr+5][$ct] + $score_arr[$ctr+6][$ct] + $score_arr[$ctr+7][$ct] + $score_arr[$ctr+8][$ct] + $score_arr[$ctr+9][$ct] + $score_arr[$ctr+10][$ct] + $score_arr[$ctr+11][$ct] + $score_arr[$ctr+12][$ct] + $score_arr[$ctr+13][$ct];
		        							$score_avg = round(($result[$ctr][$ct])/(count($score_arr)), 2);
		        							$total_score += $score_avg;
		        							$remarks = $remarks_arr[$ctr]."<br>".$remarks_arr[$ctr+1]."<br>".$remarks_arr[$ctr+2]."<br>".$remarks_arr[$ctr+3]."<br>".$remarks_arr[$ctr+4]."<br>".$remarks_arr[$ctr+5]."<br>".$remarks_arr[$ctr+6]."<br>".$remarks_arr[$ctr+7]."<br>".$remarks_arr[$ctr+8]."<br>".$remarks_arr[$ctr+9]."<br>".$remarks_arr[$ctr+10]."<br>".$remarks_arr[$ctr+11]."<br>".$remarks_arr[$ctr+12]."<br>".$remarks_arr[$ctr+13];
		        							echo "<td>".$score_avg."</td>";
        								}
        								echo "<td>".$total_score."</td>";
        								echo "<td>".$remarks."</td>";
        							} break;
        						case 15:
		        					for($ctr = 0; $ctr < count($score_arr)-14; $ctr++){
		        						for($ct = 0; $ct < $size_criteria; $ct++){
		        							$result[$ctr][$ct] = $score_arr[$ctr][$ct] + $score_arr[$ctr+1][$ct] + $score_arr[$ctr+2][$ct] + $score_arr[$ctr+3][$ct] + $score_arr[$ctr+4][$ct] + $score_arr[$ctr+5][$ct] + $score_arr[$ctr+6][$ct] + $score_arr[$ctr+7][$ct] + $score_arr[$ctr+8][$ct] + $score_arr[$ctr+9][$ct] + $score_arr[$ctr+10][$ct] + $score_arr[$ctr+11][$ct] + $score_arr[$ctr+12][$ct] + $score_arr[$ctr+13][$ct] + $score_arr[$ctr+14][$ct];
		        							$score_avg = round(($result[$ctr][$ct])/(count($score_arr)), 2);
		        							$total_score += $score_avg;
		        							$remarks = $remarks_arr[$ctr]."<br>".$remarks_arr[$ctr+1]."<br>".$remarks_arr[$ctr+2]."<br>".$remarks_arr[$ctr+3]."<br>".$remarks_arr[$ctr+4]."<br>".$remarks_arr[$ctr+5]."<br>".$remarks_arr[$ctr+6]."<br>".$remarks_arr[$ctr+7]."<br>".$remarks_arr[$ctr+8]."<br>".$remarks_arr[$ctr+9]."<br>".$remarks_arr[$ctr+10]."<br>".$remarks_arr[$ctr+11]."<br>".$remarks_arr[$ctr+12]."<br>".$remarks_arr[$ctr+13]."<br>".$remarks_arr[$ctr+14];
		        							echo "<td>".$score_avg."</td>";
        								}
        								echo "<td>".$total_score."</td>";
        								echo "<td>".$remarks."</td>";
        							} break;		
        					}
        				}				
                        echo "</tr>";
                        $totalnumber++;
                    }                  
                    echo "</div>";                  
                }else{
                    echo "<div id='criteria'>[C$num] - " . $formCriterias['criteria'] . "<br></div>";      $num++;
                }            
            }   
        echo "</table>
            <input type='hidden' value='".$form_ID."' name='formID'>
            <input type='hidden' value='".$course."' name='course'>
            <input type='hidden' value='$group_ID' name='groupID'>          
            <input type='hidden' value='form1' name='form'>
            <input type='submit' value='Export as a File' id='submitBtn'>
            </form></div>";
    }
?>
</body>
</html>