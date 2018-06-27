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
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://unpkg.com/scrollreveal/dist/scrollreveal.min.js"></script>
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
                            <p class="line anim-typewriter" style="color: white;">"Online Peer Evaluation for Louisians"</p>
            </header>
        </div>
        
        
        <section id="showcase">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <div class="showcase-left">
                            <img src="css/images/calendar.png"> 
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <div class="showcase-right">
                            <h1>Evaluate Easier</h1>
                            <p>SLU Peer Evaluation is a user friendly web-application where the user interface is not that complicated to use. Teachers could easily monitor the evaluations per group and students could easily keep track of the evaluations that needs to be done and pending evaluations.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <section id="testimonial">
            <div class="container">
                <p>"SLU Peer Evaluation is a helpful website for teachers and students."</p>
            </div>
        </section>
        
        <section id="showcase1">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <div class="showcase-left">
                            <h1>Evaluate Better</h1>
                            <p>SLU Peer Evaluation is much better than hard copy evaluations. Not only that it is automated, but also hassle-free.  </p>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <div class="showcase-right">
                            <img src="css/images/pencil.png"> 
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <section id="testimonial">
            <video autoplay muted loop id="myVideo">
                <source src="css/images/background%20loop.mp4" type="video/mp4">
            </video>
        </section>
        
        <section id="showcase">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <div class="showcase-left">
                            <img src="css/images/date.png"> 
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <div class="showcase-right">
                            <h1>Evaluate Faster</h1>
                            <p>Are you tired wasting time on printing evaluations and writing it down? Well, this web application is very much suited for you. For it is online, just go to a hotspot or a Wi-Fi zone to connect to the internet and go to the website. You could use your mobile devices as well for evaluations. </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <section id="whatwho">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <div class="info-left">
                            <h2>Who can use this website?</h2>
                            <p>Both students and teachers could use this website by utilizing the accounts that are already given to them by the school.</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <div class="info-right">
                            <h2>What is this website all about?</h2>
                            <p>This website is called SLU Peer Evaluation. It allows teachers to upload evaluation form formats to be filled in by students that they specify.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        
        <script>
            window.sr = ScrollReveal();
            sr.reveal('.showcase-left',{
               duration: 2000,
                origin: 'top',
                distance: '300px'
            });
            sr.reveal('.showcase-right',{
               duration: 2000,
                origin: 'right',
                distance: '300px'
            });
            sr.reveal('.info-right',{
               duration: 2000,
                origin: 'right',
                distance: '300px',
                delay: 1000
            });
            sr.reveal('.info-left',{
               duration: 2000,
                origin: 'left',
                distance: '300px',
                delay: 1000
            });
            sr.reveal('.showcase-left',{
               duration: 2000,
                origin: 'top',
                distance: '300px'
            });
        </script>
        
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
        
        <footer class="footer">
      <div class="container">
        <span class="text-muted">&copy; Evaluation Group. All rights reserved.</span>
      </div>
    </footer>
        
    </body>
</html>