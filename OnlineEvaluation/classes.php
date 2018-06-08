<?php include 'connection.php'?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>SLU Peer Evaluation | Home</title>
        <link rel="stylesheet" href="css/style.css"/>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="icon" href="css/images/slogo.png">
        <script src="https://code.jquery.com/jquery-3.2.1.js"></script>
    </head>
    
    <body>
        
        <div class="wrapper">
            <header>
                <nav style="z-index: 1000;">
                    <div class="menu-icon">
                        <i class="fa fa-bars fa-2x"></i>
                    </div>
					<img src="css/images/slogo.png" style="height: 45px; width: 36px; position: fixed; top: 10px; left: 10px;">
                    <div class="logo">&emsp;SLU Peer Evaluation</div>
                    <div class="menu">
                        <ul>
                            <li><a  href="homepageStudent.php">Home</a></li>
                            <li><a class="active" href="classes.php">Classes</a></li>
							<li><a href="about.html">About</a></li>
                            <li style="color: white; font-size: 20px; ">Welcome &nbsp; <a href="profile.php"> 
                            <?php echo $_SESSION['firstname']. " ". $_SESSION['lastname'];?> </a>
                        </li>

                        </ul>
                    </div>
                </nav>
                            <p class="line anim-typewriter">"Online Peer Evaluation for Louisians"</p>
            </header>

            
             <div class="contents"> 
            
            </div>
            
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
        </div>
    </body>
</html>