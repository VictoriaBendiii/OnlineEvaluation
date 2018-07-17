<?php 
    include('connection.php');
    if(!isset($_SESSION['username'])){
        header('Location: login.php');
    }

    $user = $_SESSION['username'];
    $form = $_POST["form"];
    $course = $_POST["course"];
    $form_ID = $_POST["formID"];
    $group_ID = $_POST["groupID"];
    $count = 0;
    $list_array = array();

    if($form == 'criteria'){
        $score = $_POST["score"];
        $remarks = $_POST["remarks"];
        $id = $_POST["id"];
        $size_criteria = $_POST["sizeCriteria"];
        array_push($list_array, array_chunk($score, $size_criteria)); 

        for($ctr = 0; $ctr < count($list_array); $ctr++){
            for($ct = 0; $ct < count($list_array[$ctr]); $ct++){
                $score = implode("-", $list_array[$ctr][$ct]);
                $query = "UPDATE result SET score = '$score', remarks = '$remarks[$ct]' WHERE evaluator = '$user' AND formID = $form_ID AND courseCode = '$course' AND userID = $id[$ct];";
                if (mysqli_query($conn, $query)) {
                } else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                }
            }
        }       
    }else if($form == 'multiple choice'){
        $id = $_POST["id"];
        $id = explode('-', $id[0]);
        $score = $_POST["score"];
        $length = $_POST["length"];
        $score_selected = array();
        $size_criteria = $_POST["sizeCriteria"];
        array_push($score, array_chunk($score, $length));
        $groupmates = $_POST["groupmates"];

        for($ctr = count($score)-1; $ctr < count($score); $ctr++){
            for($ct = 0; $ct < count($score[$ctr]); $ct++){
                for($c = count($score[$ctr][$ct])-1; $c < count($score[$ctr][$ct]); $c++){
                    array_push($score_selected, $_POST[$score[$ctr][$ct][$c]]);
                }
            }
        }
        array_push($list_array, array_chunk($score_selected, count($id)));

        $delete = "DELETE from result WHERE formID = $form_ID AND evaluator = '$user'";
        if(mysqli_query($conn, $delete)){ 
        }else{
            echo "<script>alert('An error occured.');</script>";
        }

        $query = "SELECT resultID from result ORDER BY resultID DESC LIMIT 1;";
        $result = mysqli_query($conn, $query);
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $last_num = $row['resultID']+1;
        }

        $query = "ALTER TABLE result auto_increment = $last_num;";
        if(mysqli_query($conn, $query)){ 
        }else{
            echo "<script>alert('An error occured.');</script>";
        }

        for($ctr = 0; $ctr < $size_criteria-1; $ctr++){
            for($ct = 0; $ct < count($id); $ct++){
                $query = "INSERT INTO result (score, formID, groupID, courseCode, evaluator, userID) VALUES ('".$list_array[0][$ctr][$ct]."','$form_ID', '$group_ID', '$course', '$user', '".$id[$ct]."')";
                    if (mysqli_query($conn, $query)) {
                    } else {
                        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                    }
            }
        }

    }else if($form == 'descriptive'){
        $remarks = $_POST["remarks"];
        $id = $_POST["id"];
        $id = explode('-', $id[0]);
        $score = count($id);
        $size_criteria = $_POST["sizeCriteria"]-1;
        array_push($list_array, array_chunk($remarks, $score));

        $delete = "DELETE from result WHERE formID = $form_ID AND evaluator = '$user'";
        if(mysqli_query($conn, $delete)){ 
        }else{
            echo "<script>alert('An error occured.');</script>";
        }

        $query = "SELECT resultID from result ORDER BY resultID DESC LIMIT 1;";
        $result = mysqli_query($conn, $query);
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $last_num = $row['resultID']+1;
        }

        $query = "ALTER TABLE result auto_increment = $last_num;";
        if(mysqli_query($conn, $query)){ 
        }else{
            echo "<script>alert('An error occured.');</script>";
        }

        for($ctr = 0; $ctr < $size_criteria; $ctr++){
            for($ct = 0; $ct < $score; $ct++){
                $query = "INSERT INTO result (formID, groupID, courseCode, evaluator, remarks, userID) VALUES ('$form_ID', '$group_ID', '$course', '$user', '".$list_array[0][$ctr][$ct]."', '".$id[$ct]."')";
                    if (mysqli_query($conn, $query)) {
                    } else {
                        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                    }
            }
        }
    }
?>
<html>
    <head>
        <meta name=viewport content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <link href="styles/formStyle.css" rel="stylesheet" type="text/css"/>
        <script src="jquery.min.js"></script>
        <meta charset="UTF-8">
        <meta name="description" content="online evaluation">
        <meta name="author" content="Group 2">
        <title>SLU Peer Evaluation | Successful Evaluation</title>
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
        <li><a href="classes.php"><img src='images/class.png' class='picnavicon'>Classes</a></li>
        <li><a href="profile.php"><img src='images/profile.png' class='picnavicon'>Profile</a></li>
        <li><a href="calendar.php"><img src='images/calendar.jpg' class='picnavicon'>Calendar</a></li>
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
        <div id='expForm'>
            Your evaluation is successfully updated.
        </div>
        <form action='course.php'>
        <input type='hidden' value='<?php echo $_SESSION['courseCode']; ?>' name='courseCode'>
        <input type='hidden' value='<?php echo $_SESSION['courseName']; ?>'' name='courseName'>
        <input type='submit' value='Go Back' id='backBtnForm'>
        <form>
    </body>
</html>
