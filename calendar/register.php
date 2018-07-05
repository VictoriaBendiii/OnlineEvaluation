<?php include('connection.php');
if (isset($_POST['register_btn'])) {
    register();
}
?>
<html>

    <head>
        <meta charset="UTF-8">

        <title>SLU Peer Evaluation | Sign Up</title>
        <link rel="stylesheet" type="text/css" href="css/rstyle.css" />

        <link href="https://fonts.googleapis.com/css?family=Roboto:100,400" rel="stylesheet">
        <link rel="icon" href="css/images/slogo.png">
    </head>

    <body>
        <center>
            <nav class="notransition">
                <div class="menu-icon">
                    <i class="fa fa-bars fa-2x"></i>
                </div>
                <img src="css/images/slogo.png" style="height: 45px; width: 36px; position: fixed; top: 10px; left: 10px; filter: blur(0.2px);">
                <div class="logo">&emsp;SLU Peer Evaluation</div>
                <div class="menu">
                    <ul>
                        <li><a href="index.php">Home</a></li>
                        <li><a class="active" href="register.php">Sign Up</a></li>
                        <li><a href="login.php">Log In</a></li>
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
                            <h2>Sign Up</h2>
                        </div>
                        <div class="row clearfix">
                            <div class="">
                                <?php
                                if(!empty($_POST['username']) && !empty($_POST['password']))

                                {
                                    $username = mysqli_real_escape_string($conn, $_POST['username']);
                                    $password = mysqli_real_escape_string($conn, $_POST['password']);
                                    $cpassword = mysqli_real_escape_string($conn, $_POST['cpassword']);
                                    $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
                                    $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
                                    $identification = mysqli_real_escape_string($conn, $_POST['identification']);


                                ?>

                                <?php

                                    if (!empty($username)) 


                                    {
                                        $username_query = mysqli_query($conn, "SELECT *
                                           FROM users
                                           WHERE username = '$username'");
                                        $count=mysqli_num_rows( $username_query);
                                        
                                        if($count==0)
                                            
                                        {

                                            echo "Signup Successful. Please proceed to Login.";

                                            $query = "INSERT INTO `users`(`username`, `password`, `firstname`, `lastname`, `identification`) VALUES ('$username', '$password','$firstname','$lastname', '$identification')";
                                            $resulta = mysqli_query($conn, $query);


                                            

                                        }
                                        else
                                        {
                                            echo "Username already exists";
                                            exit;
                                        }
                                    }
                                        $password_query = mysqli_query($conn, "SELECT *
                                           FROM users
                                           WHERE password = '$password'");
                                        $count=mysqli_num_rows( $password_query);
                                        if($password != $cpassword){
                                                echo "Password did not match.";
                                                exit;
                                            }

                                }
                                {

                                ?>
                                <form action="register.php" method="post">
                                    <div class="input_field"> <span><i aria-hidden="true" class="fa fa-envelope"></i></span>
                                        <input type="username" name="username" placeholder="Username or ID Number" required />
                                    </div>
                                    <div class="input_field"> <span><i aria-hidden="true" class="fa fa-lock"></i></span>
                                        <input type="password" name="password" placeholder="Password" required />
                                    </div>
                                    <div class="input_field"> <span><i aria-hidden="true" class="fa fa-lock"></i></span>
                                        <input type="password" name="cpassword" placeholder="Re-type Password" required />
                                    </div>
                                    <div class="row clearfix">
                                        <div class="col_half">
                                            <div class="input_field"> <span><i aria-hidden="true" class="fa fa-user"></i></span>
                                                <input type="text" name="firstname" placeholder="First Name" required />
                                            </div>
                                        </div>
                                        <div class="col_half">
                                            <div class="input_field"> <span><i aria-hidden="true" class="fa fa-user"></i></span>
                                                <input type="text" name="lastname" placeholder="Last Name" required />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="input_field radio_option">
                                        <input type="radio" name="identification" id="rd1" value="teacher">
                                        <label for="rd1">Teacher</label>
                                        <input type="radio" name="identification" id="rd2" value="student">
                                        <label for="rd2">Student</label>
                                    </div>
                                    <input class="button" id="signup" type="submit" value="Sign Up" name="submit" />
                                </form>
                            </div>
                        </div>
                    </div>
                    <?php
                                }
                    ?>
                </div>
            </div>
        </center>
    </body>

</html>
