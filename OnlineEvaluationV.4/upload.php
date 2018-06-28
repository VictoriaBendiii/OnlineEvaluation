<?php include('connection.php');?>
<?php
    $user = $_SESSION['username'];
    $due = strtotime($_POST["due"]);
    $due = date('Y-m-d', $due);
    $time = $_POST["expTime"];
    $type = 'form1';
    $newtime = date("H:i:s", strtotime($time));
    $group = $_POST["group"];
    $title = $_POST["title"];
    $desc = $_POST["desc"];
    $course = $_SESSION["course"];

    $target_dir = "uploads/";
    $rename_file =  $course."-". $title;
    $target_file = $target_dir . $rename_file . ".json";
    $uploadStat = 1;
    $json_file = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    
    //echo $due." ".$rename_file;
    //$groupNumbers = implode(" ", $group);

    $query_one = "INSERT INTO form (formName, formDesc, due, path, expTime, type)
        VALUES ('$title', '$desc', '$due', '$rename_file', '$newtime', '$type')";

    if (mysqli_query($conn, $query_one)) {
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    $get_form_id = "SELECT * FROM form WHERE formName = '$title' ORDER BY formID DESC;";
    $form_ID = 0;
    $query = mysqli_query($conn, $get_form_id);
    
    while($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
        $form_ID = $row['formID'];
    }

    for($x = 0; $x < count($group); $x++){
        $query_two = "INSERT INTO group_form (groupID, courseCodeForm, formID)
            VALUES ($group[$x], '$course', $form_ID)";
        if (mysqli_query($conn, $query_two)) {
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
        
    if(isset($_POST["submit"])) {
        if($json_file == "JSON") {
            echo "<script type='text/javascript'>alert('File is JSON');</script>";
            $uploadStat = 1;
        } else {
            echo "<script type='text/javascript'>alert('File is not JSON.');</script>";
            $uploadStat = 0;
        }
    }

    if (file_exists($target_file)) {
        echo "<script type='text/javascript'>alert('Sorry, file already exists.');</script>";
        $uploadStat = 0;
    }

    if ($_FILES["upload"]["size"] > 500000) {
        echo "<script type='text/javascript'>alert('Sorry, your file is too large.');</script>";
        $uploadStat = 0;
    }
    
    if($json_file != "json") {
        echo "<script type='text/javascript'>alert('Sorry, only JSON files are allowed.');</script>";
        $uploadStat = 0;
    }

    if ($uploadStat == 0) {
        echo "<script type='text/javascript'>alert('Sorry, your file was not uploaded.');</script>";
    } else {
        if (move_uploaded_file($_FILES["upload"]["tmp_name"], $target_file)) {
            echo "<script type='text/javascript'>alert('The file ". $target_file . " has been uploaded.');</script>";
        } else {
            echo "<script type='text/javascript'>alert('Sorry, there was an error uploading your file.');</script>";
        }
    }
?>
<!--<?php include('connection.php');?>-->
<html>
    <head>
        <meta name=viewport content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <meta charset="UTF-8">
        <meta name="description" content="online evaluation">
        <meta name="author" content="Group 2">
        <title>Online Evaluation</title>
        <link href="styles/formStyle.css" rel="stylesheet" type="text/css"/>
        <script src="jquery.min.js"></script>
    </head>

    <body>
    <div id='uploadContainer'>
      <p id="uploadTitle">Upload Evaluation</p>
        <form action="upload.php" method="POST" enctype="multipart/form-data" class="file-upload">  
            <label for="title" id="group">Title: </label>
            <input type="text" name="title" id="title" placeholder="Prelims Evaluation Form" required><br>
            <textarea name="desc" rows="4" cols="30" id="desc">Description...</textarea><br>
            <label for="dueDate" id="dueDate">Due Date: </label>
            <input type="date" name="due" id="dueCal" required /><br>
            <label for="expTime" id="dueDate">Time: </label>
            <input type="time" id="expTime" name="expTime" required><br>
            <label for="group[]" id="group">Groups: </label><br>
            <div style="width: 80%;margin:0 auto;">
            <?php
              /*$classcode = $_POST["classcode"]; AND courseCode = '$classcode'*/
              $user = $_SESSION['username'];
              $query = mysqli_query($conn, "SELECT DISTINCT groupID FROM user_course JOIN users USING(id) WHERE courseCode = '$course' AND identification != 'teacher' ORDER BY groupID;");

                //echo "<input type='hidden' id='course' name='course' value='$classcode'>";
              while($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
                echo "<div class='inpCont'><label class='container'>&emsp;Group ". $row["groupID"] ."<input type='checkbox' name='group[]' id='group[]' value=". $row["groupID"] ." /><span class='checkmark'></span></label></div>";
              }
            ?>
            </div>
            <div id="groupBox"></div><br><br>
            <label for="upload" class="btn">Choose a file</label>
            <input type="file" name="upload" accept="application/json" id="upload" style="display: none;" required />
            <p class="file-name" id="fileName" name="fileName" style="margin-left: 23%;">Please select a JSON file</p>
            <input type="hidden" name="form" value="<?php echo $_POST["form"]; ?>" />
            <input type="submit" value="Upload" class="uploadButton" /> 
        </form>
          <p id="note">Note: Your JSON file will be renamed with the following title:<br>
            [Course code] +"-"+ [Title]
          </p>
    </div>

<script>
    jQuery(function($) {
  $('#upload').change(function() {
    if ($(this).val()) {
        error = false;
    
      var filepath = $(this).val();
      var filename = filepath.split("\\");
      var length = filename.length;

            $(this).closest('.file-upload').find('.file-name').html(filename[length-1]);

      if (error) {
        parent.addClass('error').prepend.after('<div class="alert alert-error">' + error + '</div>');
      }
    }
  });
});
</script>
</body>
</html>
