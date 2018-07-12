<?php include('connection.php');

  
?>
<html>

<head>
    <meta charset="UTF-8">
    <title>SLU Peer Evaluation | Log In</title>
    <link rel="stylesheet" type="text/css" href="css/rstyle.css" />
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,400" rel="stylesheet">
    <link rel="icon" href="css/images/slogo.png">
</head>

<body>
    <center>
        <nav>
            <div class="menu-icon">
                <i class="fa fa-bars fa-2x"></i>
            </div>
            <img src="css/images/slogo.png" style="height: 45px; width: 36px; position: fixed; top: 10px; left: 10px; filter: blur(0.2px);">
            <div class="logo">&emsp;SLU Peer Evaluation</div>
            <div class="menu">
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="register.php">Sign Up</a></li>
                    <li><a class="active" href="login.php">Log In</a></li>
                    <li><a href="about.html">About</a></li>
                </ul>
            </div>
        </nav>
        <div class="header">
        </div>
        <div class="wrapper">
            <div class="form_wrapper" style="position: relative; top: -60px; margin: auto;">
                <div class="form_container">
                    <div class="title_container">
                        <h2>Log In</h2>
                    </div>
                    <div class="row clearfix">
                        <div class="">
                            <?php
          if(isset($_SESSION['username']) && isset($_SESSION['identification']) ){
            if($_SESSION['identification'] == 'student'){
            header("location: classes.php");
          }else{
            header("location: teacherpage.php");
          }
          
          }else{
					if(!empty($_POST['username']) && !empty($_POST['password']))
					{
						$user = mysqli_real_escape_string($conn, $_POST['username']);
						$pass = mysqli_real_escape_string($conn, $_POST['password']);
                        

						$query = mysqli_query($conn, "SELECT *FROM `users` WHERE username = '$user' and password = '$pass' and identification = 'student'");
     		 			$row = mysqli_fetch_array($query,MYSQLI_ASSOC);      
      					$count = mysqli_num_rows($query);
                       
                        
           $Tquery = mysqli_query($conn, "SELECT *FROM `users` WHERE username = '$user' and password = '$pass' and identification = 'teacher'");
     		 			$Trow = mysqli_fetch_array($Tquery,MYSQLI_ASSOC);      
      					$Tcount = mysqli_num_rows($Tquery);
                        
     			
      					if($count == 1) 
      					{
         					$_SESSION['username'] = $user;
         					$_SESSION['firstname'] = $row['firstname'];
         					$_SESSION['lastname'] = $row['lastname'];
        	        $_SESSION['identification'] = $row['identification'];
         					header("location: classes.php");
      					}
                        
      					if($Tcount == 1) 
      					{
         					$_SESSION['username'] = $user;
         					$_SESSION['firstname'] = $Trow['firstname'];
         					$_SESSION['lastname'] = $Trow['lastname'];
        	                $_SESSION['identification'] =  $Trow['identification'];
                            $_SESSION['id'] = $Trow['id'];
         					//wala pang redirection sa teacher page..
                            header("location: teacherpage.php"); 
                            
      					}
      					else 
      					{
         					echo "<div id='tag-line'>Your Login Name or Password is invalid</div>";
         					?>
                                <a href="login.php" id="tag-line" style="color: red;">Try again.</a>
                                <?php 
      					}
					}
					else
					{

//                        
                        
				?>
                                <form action="login.php" method="post">
                                    <div class="input_field"> <span><i aria-hidden="true" class="fa fa-envelope"></i></span>
                                        <input type="username" name="username" placeholder="Username or ID Number" required />
                                    </div>
                                    <div class="input_field"> <span><i aria-hidden="true" class="fa fa-lock"></i></span>
                                        <input type="password" name="password" placeholder="Password" required />
                                    </div>

                                    <input class="button" id="login" type="submit" value="Log-in" />
                                    <div>
                                        <p id="caption">Don't have an account yet?<a href="register.php" id="link"> Register now!</a></p>
                                    </div>
                                </form>
                        </div>
                    </div>
                </div>
                <?php
					}


            }            
				?>
            </div>
        </div>
    </center>
    <script type="text/javascript">
        $(function() {
            var welcomeSection = $('.welcome-section'),
                enterButton = welcomeSection.find('.enter-button');

            setTimeout(function() {
                welcomeSection.removeClass('content-hidden');
            }, 800);

            enterButton.on('click', function(e) {
                e.preventDefault();
                welcomeSection.addClass('content-hidden').fadeOut();
            });
        });

    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $(".menu-icon").on("click", function() {
                $("nav ul").toggleClass("showing");
            });
        });

        $(window).on("scroll", function() {
            if ($(window).scrollTop()) {
                $('nav').addClass('black');
            } else {
                $('nav').removeClass('black');
            }
        })

    </script>
</body>

</html>
