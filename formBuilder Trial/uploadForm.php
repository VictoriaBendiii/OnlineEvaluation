<?php include('connection.php');?>
<html>
    <head>
        <meta name=viewport content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <link href="styles/formStyle.css" rel="stylesheet" type="text/css"/>
        <script src="jquery.min.js"></script>
        <meta charset="UTF-8">
        <meta name="description" content="online evaluation">
        <meta name="author" content="Group 2">
        <title>Online Evaluation</title>
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
              $query = mysqli_query($conn, "SELECT * from users JOIN user_course USING(id) JOIN group_form ON courseCode = courseCodeForm JOIN form USING(formID) WHERE username = $user AND identification = 'teacher'");

                //echo "<input type='hidden' id='course' name='course' value='$classcode'>";
              while($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
                echo "<div class='inpCont'><label class='container'>Group ". $row["groupID"] ."<input type='checkbox' name='group[]' id='group[]' value=". $row["groupID"] ." /><span class='checkmark'></span></label></div>";
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
</script>
</body>
</html>