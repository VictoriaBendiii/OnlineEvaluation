<?php include('connection.php');
  $course = $_POST["course"];
  $form_ID = $_POST["formID"];
  $get_form = "SELECT * FROM form WHERE formID = '$form_ID';"; 
  $query = mysqli_query($conn, $get_form);

  while($row = mysqli_fetch_array($query, MYSQLI_ASSOC)){
    $name = $row['formName'];
    $desc = $row['formDesc'];
    $due = $row['due'];
    $expTime = $row['expTime'];
  }
?>
<html>
    <head>
        <link href="styles/formStyle.css" rel="stylesheet" type="text/css"/>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>SLU Peer Evaluation | Form</title>
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
    </head>

    <body>
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
                            <li style="color: white; font-size: 20px; "><a style="outline: 0!important;" href="#" onclick="websitenav();">
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

    <div id='uploadContainer'>
      <p id="uploadTitle">Edit Evaluation</p>
        <form action="upload.php" method="POST" enctype="multipart/form-data" class="file-upload">  
            <label for="title" id="group">Title: </label>
            <input style="margin-top: -160px;" type="text" name="title" id="title" value='<?php echo $name; ?>' required><br>
            <textarea name="desc" rows="4" cols="30" id="desc"></textarea><br>
            <label for="dueDate" id="dueDate">Due Date: </label>
            <input type="date" name="due" id="dueCal" value='<?php echo $due; ?>' required /><br>
            <label for="expTime" id="dueDate">Time: </label>
            <input type="time" id="expTime" name="expTime" value='<?php echo $expTime; ?>' required><br>
            <label for="group[]" id="group">Groups: </label><br>
            <div style="width: 80%;margin:0 auto;">
            <?php
              /*$classcode = $_POST["classcode"]; AND courseCode = '$classcode'*/
              $user = $_SESSION['username'];
              $course = $_SESSION['course'];
              $query = mysqli_query($conn, "SELECT DISTINCT groupID FROM user_course JOIN users USING(id) WHERE courseCode = '$course' AND identification != 'teacher' ORDER BY groupID;");

                //echo "<input type='hidden' id='course' name='course' value='$classcode'>";
              while($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
                if($row['groupID'] == NULL){
                    echo "<div class='inpCont' style='text-align:center;'>No Groups yet</div>";
                }else{
                    echo "<div class='inpCont'><label class='container'>&emsp;Group ". $row["groupID"] ."<input type='checkbox' name='group[]' id='group[]' value=". $row["groupID"] ." /><span class='checkmark'></span></label></div>";
                }
              }
            ?>
            </div>
            <div id="groupBox"></div><br><br>
            <label for="upload" class="btn">Choose a file</label>
            <input type="file" name="upload" accept="application/json" id="upload" style="display: none;" required />
            <p class="file-name" id="fileName" name="fileName" style="margin-left: 23%;">Please select a JSON file</p>
			<br>
            <input type="submit" value="Submit" class="uploadButton" /> 
        </form>
          <p id="note">Note: Your JSON file will be renamed with the following title:<br>
            [Course code] +"-"+ [Title]
          </p>
    </div>

<script>
    document.getElementById('desc').value = '<?php echo $desc; ?>';
    var filepath, filename, length;

    jQuery(function($) {
  $('#upload').change(function() {
    if ($(this).val()) {
        error = false;
    
      filepath = $(this).val();
      filename = filepath.split("\\");
      length = filename.length;

            $(this).closest('.file-upload').find('.file-name').html(filename[length-1]);

      if (error) {
        parent.addClass('error').prepend.after('<div class="alert alert-error">' + error + '</div>');
      }
    }
  });
});

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
</body>
</html>