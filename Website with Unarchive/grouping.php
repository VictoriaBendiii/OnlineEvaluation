<?php include('connection.php');?>
<html>
    <head>
        <meta name=viewport content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <link href="styles/formStyle.css" rel="stylesheet" type="text/css"/>
        <script src="jquery.min.js"></script>
        <meta charset="UTF-8">
        <meta name="description" content="online evaluation">
        <meta name="author" content="Group 2">
        <title>SLU Peer Evaluation | Group Students</title>
		<link rel="icon" href="css/images/slogo.png">
		<link rel="stylesheet" href="css/pstyle.css"/>
		<link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css'>
        <link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css'>
        <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Montserrat:400,700'>
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
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
	$user = $_SESSION['username'];
	$course = $_SESSION["course"];
    $numGroup = 15;
    if(isset($_SESSION["numGroup"])){
        $numGroup = $_SESSION["numGroup"];
    }

    $query = mysqli_query($conn, "SELECT DISTINCT groupID FROM user_course JOIN users USING(id) WHERE courseCode = '$course' AND identification != 'teacher' ORDER BY groupID;");
    $rowcount = mysqli_num_rows($query);
    if($rowcount == 0){
        exit("<div id='expForm'>There are currently no students enrolled.</div>
        <form action='teacherpage.php'>
        <input type='submit' value='Go Back' id='backBtnForm'>
        <form>");
    }

	$query = "SELECT * FROM user_course JOIN users USING(id) WHERE courseCode = '$course' AND username != '$user' AND identification != 'teacher' ORDER BY lastname;";
	$execute_query = mysqli_query($conn, $query);

	echo "<div id='rating' style='text-align:center; margin: 0 auto; margin-top:10%; font-size: 27px;'>Assign Students to a Group<br><br>
			<div class='tableContainerGroup'>
                <form action='grouping.php' method='post'>   
                    <label for='numGroup' id='rating' style='text-align:center; margin: 0 auto; margin-top:3%; font-size: 20px;'>Number of Groups: </label>
                    <input type='number' name='numGroup' id='numGroup' max = '15' />
                    <input type='submit' value='Limit Group' id='backBtn' style='margin:0 auto;' formaction='limit.php'>
                    <br>                       
                <table class='tableFormGroup'>
                    <tr>
                        <th>Students</th>
                        <th>Group #</th>
                    </tr>";
	while($row = mysqli_fetch_array($execute_query, MYSQLI_ASSOC)){
		echo "<tr>
				<td>".$row['firstname'] .' '. $row['lastname']."<input type='hidden' value='".$row['id']."' name='id[]'></td>";
		if($row['groupID'] == null){
			echo "<td><input type='number' name='group[]' min='1' max='$numGroup' style='width:10%; text-align:center;'></td>
			  </tr>";
		}else{
			echo "<td><input type='number' name='group[]' min='1' max='$numGroup' style='width:10%; text-align:center;' value='".$row['groupID']."'></td>
			  </tr>";
		}		  	
	}
	echo "</table></div></div>
		<div id='submitGroup'>
		<input type='hidden' value='$course' name='course'>
        <input type='submit' value='Submit' id='backBtn'>
        </form>
        </div>";

    if($_SERVER["REQUEST_METHOD"] == "POST") {
    	$course = $_POST["course"];
    	//$course = '9358A';
    	$id = $_POST["id"];
    	$group = $_POST["group"];

    	for($ctr = 0; $ctr < count($id); $ctr++){
    		$query = "SELECT * FROM user_course JOIN users USING(id) WHERE courseCode = '$course' AND id = '$id[$ctr]' AND identification != 'teacher'";

			if(mysqli_query($conn, $query)) {
				$query_two= "UPDATE user_course SET groupID='$group[$ctr]' WHERE id=$id[$ctr];";
				if (!mysqli_query($conn, $query_two)) {
					echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	    		} 
	    	} else {
	        	echo "Error: " . $sql . "<br>" . mysqli_error($conn); 	        	
	    	}
    	}
    		echo "<meta http-equiv='refresh' content='0'>";		 		
    }
?>
</body>
</html>