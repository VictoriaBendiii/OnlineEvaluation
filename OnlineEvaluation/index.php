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
                            <li><a class="active" href="index.php">Home</a></li>
                            <li><a href="register.php">Sign Up</a></li>
                            <li><a href="login.php">Log In</a></li>
							<li><a href="about.html">About</a></li>
                        </ul>
                    </div>
                </nav>
                            <p class="line anim-typewriter">"Online Peer Evaluation for Louisians"</p>
            </header>

            
            <div class="contents">
				<center><p class="textTitle" style="font-size: 38px;">SLU Peer Evaluation</p></center>
				<br>
				<br>
				<div class="pics">
				<img id="calendar" src="css/images/calendar.png">
				<img id="pencil" src="css/images/pencil.png">
				<img id="date" src="css/images/date.png">
				<div id="squareOne" class="middle"><p>Evaluate Easier.</p></div>
				<div id="squareTwo" class="middle"><p>Evaluate Better.</p></div>
				<div id="squareThree" class="middle"><p>Evaluate Faster.</p></div>
				</div>
                <p class="textTitle" style="color: #FFFFFF; background-color: #2B3856; padding: 20px;">What is this website all about?</p> 
				<br> 
				<p style="color: #2B3856; font-size: 22px;">&emsp;This website is called SLU Peer Evaluation. It allows teachers to upload evaluation form formats 
				to be filled in by students that they specify.</p>
				<br>
				<br>
				<p class="textTitle" style="color: #FFFFFF; background-color: #2B3856; padding: 20px;">Who can use this website?</p> 
				<br> 
				<p style="color: #2B3856; font-size: 22px;">&emsp;Both students and teachers could use this website by utilizing the accounts that 
				are already given to them by the school.</p>
			</div>
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
    </body>
</html>