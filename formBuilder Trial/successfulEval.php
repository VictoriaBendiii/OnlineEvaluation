<?php include('connection.php');
	$user = $_SESSION['username'];
	$form = $_POST["form"];
	$course = $_POST["course"];
	$form_ID = $_POST["formID"];
	$group_ID = $_POST["groupID"];

	if($form == 'form1'){
	    $score = $_POST["score"];
	    $remarks = $_POST["remarks"];

	    $score = implode("-", $score);
	    $remarks = implode("-", $remarks);

	    $query = "INSERT INTO result (score, formID, groupID, courseCode, evaluator, remarks)
	        VALUES ('$score', '$form_ID', '$group_ID', '$course', '$user', '$remarks')";

	    if (mysqli_query($conn, $query)) {
	    } else {
	        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	    }
	}else if($form == 'form2'){
		$score = $_POST["score"];
	    $score = implode("-", $score);  

	        $query = "INSERT INTO result (score, formID, groupID, courseCode, evaluator)
	        VALUES ('$score', '$form_ID', '$group_ID', '$course', '$user')";

	    if (mysqli_query($conn, $query)) {
	    } else {
	        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	    }  
	}
?>
<html>
    <head>
        <meta name=viewport content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <link href="styles/formStyle.css" rel="stylesheet" type="text/css"/>
    </head>

    <body>
    	<div id='expForm'>
    		Your evaluation is successfully submitted.
    	</div>
        <form action='studentPage.php'>
        <input type='submit' value='Go Back' id='backBtn'>
        <form>
	</body>
</html>