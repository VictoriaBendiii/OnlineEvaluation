<?php include('connection.php');
if(!isset($_SESSION['username'])){
    header('Location: login.php');
}
?>
<html>
    <head>
        <meta name=viewport content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <link href="styles/formStyle.css" rel="stylesheet" type="text/css"/>
        <meta charset="UTF-8">
        <meta name="description" content="online evaluation">
        <meta name="author" content="Group 2">
        <title>SLU Peer Evaluation | Group Students</title>
        <link rel="icon" href="css/images/slogo.png">
        <link rel="stylesheet" href="css/pstyle.css"/>
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css'>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css'>
        <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Montserrat:400,700'>
        <style type="text/css">
            #studentbutton:hover{
                filter: grayscale(100%);
            }
            .bs-example{
                font-family: sans-serif;
                position: relative;
                margin: 50px;
            }
            .typeahead, .tt-query, .tt-hint {
                border: 2px solid #CCCCCC;
                border-radius: 8px;
                font-size: 24px;
                height: 30px;
                line-height: 30px;
                outline: medium none;
                padding: 8px 12px;
                width: 396px;
            }
            .tt-hint{
                opacity: 0;
            }
            .typeahead {
                background-color: #FFFFFF;
            }
            .typeahead:focus {
                border: 2px solid #0097CF;
            }
            .tt-query {
                box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075) inset;
            }
            .tt-hint {
                color: #999999;
            }
            .tt-dropdown-menu {
                background-color: #FFFFFF;
                border: 1px solid rgba(0, 0, 0, 0.2);
                border-radius: 8px;
                box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
                margin-top: 12px;
                padding: 8px 0;
                width: 422px;
            }
            .tt-suggestion {
                font-size: 24px;
                line-height: 24px;
                padding: 3px 20px;
            }
            .tt-suggestion.tt-is-under-cursor {
                background-color: #0097CF;
                color: #FFFFFF;
            }
            .tt-suggestion p {
                margin: 0;
            }
            #submitGrouping:hover{
                filter: grayscale(100%);
            }
        </style>
    </head>

    <body style="overflow-x: hidden;">
        <div class="wrapper">
            <header>
                <nav style="z-index: 1000; background-color: RGBA(92,115,139, 0.6); position: fixed; top: 0px;">
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
                <li><a href="calendar.php"><img src='images/calendar.jpg' class='picnavicon'>Calendar</a></li>
                <li><a href="signout.php"><img src='images/logout.png' class='picnavicon'>Log out</a></li>
            </ul>
        </div>
        <script type="text/javascript">
            var numb = 0;
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

            $(document).ready(function(){
                $("#searchStudent").keyup(function(){
                    var content = $("#searchStudent").val();
                    $.post("groupingsearch.php", {
                        content: content
                    }, function(data, status){
                        $("#stds").html(data);
                    });
                });
            });
        </script>

        <?php
        $user = $_SESSION['username'];
        $course = $_SESSION["course"];

        $query = "SELECT * FROM user_course JOIN users USING(id) WHERE courseCode = '$course' AND username != '$user' AND identification != 'teacher' ORDER BY lastname;";
        $execute_query = mysqli_query($conn, $query);	 		
        ?>

        <div class="row">
            <div id="rating" style="text-align:center; margin: 0 auto; margin-top: 98px;"><h1>Assign Students to a Group</h1></div>
            <?php 
            $course = $_SESSION['course'];
            $query = mysqli_query($conn, "SELECT users.id as id, CONCAT(users.firstname,' ',users.lastname) as name, users.username as username, users.profilepicture as profilepicture FROM users JOIN user_course USING (id) WHERE user_course.courseCode = '$course' AND users.identification='student';");
            echo "<center><h2 id='classCode'>Classcode $course</h2></center>";
            ?>
            <div class="col-lg-1"></div>
            <div class="col-lg-4">
                <center><h2 id='classCode'>Students</h2>
                    <input type='text' style='width: 80%; font-size: 19px;' name='searchStudent' class='typeahead tt-query' id='searchStudent' placeholder='Search by id number or name'>
                    <br><br>
                    <div id='stds' class='col-lg-12' style='overflow-y: auto; height: calc(100vh - 320px);'>
                        <?php include("groupingsearch.php");?>
                    </div>
                </center>
            </div>
            <div class="col-lg-6" style="border-left: solid #D0D2CF 2px; height: calc(100vh - 210px);">
                <center><h2 id='classCode'>Groups</h2>
                    <form id='groupform' action='assignGroup.php' method="post" style='display: inline;'>
                        <div id='groupinput'><label for='numbgroups'><h3>Enter Number of Groups:</h3></label>
                            <input type='number' style='padding: 5px;' id="numbgroups" name='numbgroups' min="1" max="15">
                            <button type='button' id='enternums' onclick="createGroupConts()" style='margin:0%; padding: 0; border: none; background: none;'><img src='images/enter.png' style='height: 28px; width: 28px; padding: 2px;' alt='mark' id='adds'></button>
                        </div>
                        <div id='groupCont' style="overflow-y: auto; height: calc(100vh - 340px);" class='row'>
                        </div>
                    </form>
                </center>
            </div>
        </div>
        <script src="https://rawgit.com/bevacqua/dragula/master/dist/dragula.js"></script>
        <script src="assets/js/drag.js"></script>
    </body>
    <script>
        function createGroupConts() {
            numb = $("#numbgroups").val();
            for (var i = 1; i <= numb; i++) {
                $( "#groupCont" ).append( "<div id='"+i+"' class='panel panel-default' style='width: 80%; min-height: 100px; max-height: 200px; overflow-y: auto; border-color: #000000; font-size: 24px;'>Group "+i+"</div>");
            }
            $("#groupinput").remove();
            $("#groupform").append("<button type='button' id='submitGrouping' onclick='submitGroup()' style='border: none; background: none;'><img src='images/submit.png' style='height: 38px;' alt='submit' id='adds'></button>");
            dragula([document.getElementById('stds'),document.getElementById('1'),document.getElementById('2'),document.getElementById('3'),document.getElementById('4'),document.getElementById('5'),document.getElementById('6'),document.getElementById('7'),document.getElementById('8'),document.getElementById('9'),document.getElementById('10'),document.getElementById('11'),document.getElementById('12'),document.getElementById('13'),document.getElementById('14'),document.getElementById('15')], {
                revertOnSpill: true
            });
        }
        function submitGroup(){
                $('<input>').attr({
                    type: 'hidden',
                    name: 'totalgroups',
                    value: ''+numb
                }).appendTo('form#groupform');

            for(var num = 1; num <= numb; num++ ){
                $('#'+num).children().find("input[name='id']").each(function(){
                    $('<input>').attr({
                        type: 'hidden',
                        name: 'group'+num+'[]',
                        value: ''+$(this).val()
                    }).appendTo('form#groupform');

                })
            }
            if (confirm("Click OK to Submit")){
                $('form#groupform').submit();
            }
        }
    </script>
</html>
