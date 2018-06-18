<?php include('connection.php');?>
<html>

<head>
    <meta charset="UTF-8">
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SLU Peer Evaluation | Home</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" href="css/images/slogo.png">
    <script src="https://code.jquery.com/jquery-3.2.1.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/course_style.css">
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
                        <li><a href="homepageStudent.php">Home</a></li>
                        <li><a class="active" href="classes.php">Classes</a></li>
                        <li><a href="about.html">About</a></li>
                        <li style="color: white; font-size: 20px; ">Welcome &nbsp;
                            <a href="profile.php">
                                <?php echo $_SESSION['firstname']. " ". $_SESSION['lastname'];?> </a>
                        </li>

                    </ul>
                </div>
            </nav>
        </header>
    </div>

    <div class="container">
        <div class="head">
            <center>
             
                    <?php echo "<h1>".$_SESSION['courseCode']. "</h1> <h2>". $_SESSION['courseName']."</h2>";?>
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

        <!-- script for nav bar -->
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
    </div>
</body>

</html>
