<?php include('connection.php');?>
<html>

<head>
    <link href="styles/formStyle.css" rel="stylesheet" type="text/css"/>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>SLU Peer Evaluation | Class</title>
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
        <link rel="stylesheet" href="css/course_style.css">
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
        <li><a href="profile.php"><img src='images/profile.png' class='picnavicon'> Profile</a></li>
        <li><a href="signout.php"><img src='images/logout.png' class='picnavicon'> Log out</a></li>
        </ul>
        </div>

    <div class="container">
        <div class="head">
            <center>
             
                    <?php echo "<h1>".$_POST['courseCode']. "</h1> <h2>". $_POST['courseName']."</h2>";?>
            </center>
        </div>
        <div class="row"> 
            <div class="col-6 col-md-4" style="border: 2px solid black;margin: 5px;">
                <h2>Activities </h2>
                

            </div>
            <div class="col-12 col-md-7"  style="border: 2px solid black;margin: 5px;background-color:#cadfea;padding-bottom:10px;">
                <h2>Posts</h2>
                     <?php 
                        $user = $_SESSION['username'];
                        $course = $_POST["course"];

                        $get_forms = "SELECT DISTINCT formName, formDesc, formID, due, expTime from peerpal.group JOIN group_form USING(groupID) JOIN form USING(formID) WHERE courseCodeForm = '$course'";
                        $query = mysqli_query($conn, $get_forms);

                        while($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
                            echo "<form action='formBuilder.php' method='post'>
                                    <div class='post' >
                                    <center><p>".$row['formName']."</p> 
                                    Due Date: ".$row['due']."
                                    Time Due: ".$row['expTime']."<br> </center> <hr>
                                    <p>".$row['formDesc']."</p>
                                    <center> <button type='submit' class='action-button shadow animate blue'>Open Form</button>
                                    </div>
                                    <input type='hidden' name='course' value='$course'>
                                  </form>";
                        }
                    ?>
                
            </div>
        </div>
    </div>
<script>
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
    </div>
</body>

</html>
