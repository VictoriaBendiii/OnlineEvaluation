<?php include('connection.php'); ?>
<html>
    <head>
        <meta name=viewport content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <link href="styles/formStyle.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="assets/css/style.css">
    </head>

    <body>
 <?php 
 	$user = $_SESSION['username'];
    $course = $_POST["course"];

    $get_forms = "SELECT DISTINCT formName, formDesc, formID, due, expTime from peerpal.group JOIN group_form USING(groupID) JOIN form USING(formID) WHERE courseCodeForm = '$course'";
    $query = mysqli_query($conn, $get_forms);
        
    while($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
        $exp_time = date('h:i a', strtotime($row['expTime']));
        echo "<form action='editForm.php' method='post'>
                <div class='editForm'>
                <p style='text-align: center'>".$row['formName']."</p><br>
                Description: ".$row['formDesc']."<br>
                Due Date: ".$row['due']."<br>
                Time Due: ".$exp_time."<br>
                <button type='submit' class='btn-link'>Edit Form</button>
                </div>
                <input type='hidden' name='course' value='$course'>
                <input type='hidden' name='formID' value='".$row['formID']."'>
              </form>";
    }
 ?>