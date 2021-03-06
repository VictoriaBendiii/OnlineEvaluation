<!DOCTYPE html>
<?php include('connection.php');?>
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
        <link rel='stylesheet' id='camera-css'  href='assets/css/camera.css' type='text/css' media='all'>
        <script src="https://code.jquery.com/jquery-3.2.1.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="css/calendar.css">
        
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

                <div class="container">
                    <div class="row" style="padding-top: 95px;">
                        <?php
                        $target_name = array();
                        $user = mysqli_real_escape_string($conn, $_SESSION['username']);
                        $sql = "select * from user_course join users using(id) join course using(courseCode) where users.username ='$user' AND course.status='Active';";
                        $result = mysqli_query($conn, $sql);
                        ?>


                        <?php
                        function prompt($prompt_msg){
                            echo("<script type='text/javascript'> var answer = prompt('".$prompt_msg."'); </script>");
                            $answer = "<script type='text/javascript'> document.write(answer); </script>";
                            return($answer);
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

                        </script>
                        <div id="pictureNavigation" style="display: none; height: 134px; font-weight: normal;">
                            <ul>
                                <li><a href="teacherpage.php"><img src='images/class.png' class='picnavicon'> Classes</a></li>
                                <li><a href="profteacher.php"><img src='images/profile.png' class='picnavicon'> Profile</a></li>
                                <li><a href="calendar.php"><img src='images/calendar.jpg' class='picnavicon'> Calendar</a></li>
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
                </div>

                </body>
            </html>



