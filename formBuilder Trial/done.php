<?php include('connection.php');?>
<html>
    <head>
        <meta name=viewport content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <link href="styles/formStyle.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>

    <body>

<?php
	$user = $_SESSION['username'];
	//$course = $_POST["course"];
	//$form_ID = $_POST["formID"];
	$form_ID = 1;
	$course = '9358A';
	$groupmates = array();
	$query = "SELECT * FROM result JOIN users ON evaluator = username WHERE formID = $form_ID;";
	$execute_query = mysqli_query($conn, $query);

	$get_groupmates = "SELECT * FROM group_form JOIN user_course USING(groupID) JOIN users ON users.id = user_course.id WHERE identification = 'student' AND coursecodeForm = '$course' AND groupID = $group_ID AND username != '$user' ORDER BY lastname;";
        $query_Two = mysqli_query($conn, $get_groupmates);
        while($row = mysqli_fetch_array($query_Two, MYSQLI_ASSOC)) {
            $form_ID = $row['formID'];          
            $group_ID = $row['groupID'];
            array_push($groupmates, $row['firstname'] .' '. $row['lastname']);
        }

	echo "<div id='rating' style='text-align:center; margin: 0 auto; margin-top:10%;'>Students<br>
			<div class='tableContainerGroup'>";
	while($row = mysqli_fetch_array($execute_query, MYSQLI_ASSOC)){
			  	
	}
	echo "</table></div></div>
        </div>";
?>