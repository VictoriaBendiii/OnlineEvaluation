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
<?php 
/*	$score = '1-3-2-4-1-4';
	$result = explode("-", $score);

	list($array1, $array2) = array_chunk($result, 3);
	echo implode(" ", $array1)."<br>";
	echo implode(" ", $array2);
*/
include('connection.php'); 

	//$course = $_POST('course');
	//$form_ID = $_POST('formID');
	
	//$user = $_SESSION("username");
	$user = 2160051;
	$course = '9358A';
	$form_ID = 1;
	$result = '';
	$num = 1;     
    $group_ID = 0;
    $groupmates = array();
    $id = array();
    $group_num = array();
    $url = '';

	$query = "SELECT * from result WHERE formID = $form_ID AND courseCode = '$course';";
	$do_query = mysqli_query($conn, $query);

	/*while($row = mysqli_fetch_array($do_query, MYSQLI_ASSOC)){
		$result .= $row['score'].'-';		
	}
	$result = substr($result, 0, -1);
	$result = explode("-", $result);
	list($array1, $array2) = array_chunk($result, 3);
		echo implode(" ", $array1)."<br>";
		echo implode(" ", $array2);
	*/
	$get_form_id = "SELECT * FROM form JOIN group_form USING(formID) JOIN user_course USING(groupID) JOIN users ON users.id = user_course.id WHERE username = '$user' AND courseCode = '$course' AND formID = $form_ID;";
    $query = mysqli_query($conn, $get_form_id);

	while($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
            $form_ID = $row['formID'];
            $group_ID = $row['groupID'];
            $due = $row['due'];
            $date_now = date("Y-m-d", time());
            $time = $row['expTime'];
            $form_type = $row['type'];
            $url = 'uploads/'.$row['path'].'.json';

            $due = strtotime($due);
            $now = strtotime($date_now);
            date_default_timezone_set('Asia/Manila');
            $time_now = date("H:i:s");
            $time = strtotime($time);
            $time_now = strtotime($time_now);

            if(($due <= $now AND $time_now >= $time) OR ($due < $now AND $time_now < $time)){
                exit("<div id='expForm'>You have already surpassed the due date and time. Please contact your instructor for further details.</div>
                    <form action='classes.php'>
                    <input type='submit' value='Go Back' id='backBtnForm'>
                    <form>");
            }
            echo "<h1 id='formTitle'>".$row['formName']."</h1>";
        }

        $get_groupmates = "SELECT * FROM course JOIN group_form JOIN user_course USING(groupID) JOIN users ON users.id = user_course.id WHERE course.courseCode = courseCodeForm AND course.courseCode = '$course' AND courseCodeForm = '$course' AND user_course.courseCode = '$course' AND formID = $form_ID ORDER BY groupID, lastname;";
        $query_Two = mysqli_query($conn, $get_groupmates);
        while($row = mysqli_fetch_array($query_Two, MYSQLI_ASSOC)) {
            $form_ID = $row['formID'];          
            $group_ID = $row['groupID'];
            array_push($groupmates, $row['firstname'] .' '. $row['lastname']);
            array_push($id, $row['id']);
            array_push($group_num, $row['groupID']);
        }
        
        if($form_type == 'form1'){
            $data = file_get_contents($url); 
            $formCriteria = json_decode($data, true);

            if(filesize("$url") == 0){
                echo '<h3 class="quiz" style="text-align:center;">There is something wrong with your form</h3>
                      <button class="submitButton" onclick="formBuilder.php">Go Back</button>';
            }

            echo "<div id='formContainer'>
                    <div id='rating'>Rating:</div>
                        <div id='ratingWrapper'>";
            foreach ($formCriteria as $formCriterias) {
                if($formCriterias['criteria'] == 'choices'){
                    $length = count($formCriterias['choices']);
                    $size_criteria = count($formCriteria) - 1;
                    $size_groupmates = count($groupmates);
                    $size_table = count($groupmates) - 1;
                    $number = 1;
                    $totalnumber = 1;

                    for($ctr = 0; $ctr < $length; $ctr++){
                        echo "<div id='formChoice'>" . $formCriterias['choices'][$ctr] . "</div>";
                    }

                    echo "<br></div>
                            <div id='rating' style='margin-bottom: 2%;'>Criteria:</div>
                            <div class='tableContainer'>
                            <form action='successfulEval.php' method='post'>                          
                            <table class='tableForm'>
                                <tr>
                                    <th>Students</th>
                                    <th>Group #</th>
                                    <th colspan='$size_criteria'>Criteria</th>
                                    <th>Remarks</th>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>";
                    for($ctr = 1; $ctr <= $size_criteria; $ctr++){
                        echo "<td>[C$ctr]</td>";
                    }
                    echo "<td></td>
                          <td></td>
                          </tr>";

                    for($counter = 0; $counter < $size_groupmates; $counter++){
                        echo "<tr>
                                <td>$groupmates[$counter]
                                    <input type='hidden' name='id[]' value='".$id[$counter]."'>
                                </td>
                                <td>".$group_num[$counter]."</td>";
                        for($ct = 1; $ct <= $size_criteria; $ct++){
                            echo "<td><input type='number' name='score[]' min='1' max='$length' value='0' required></td>";
                            $number++;
                        }
                        echo "<td><input type='text' name='remarks[]' required></td>
                            </tr>";
                        $totalnumber++;
                    }                  
                    echo "</div>";                  
                }else{
                    echo "<div id='criteria'>[C$num] - " . $formCriterias['criteria'] . "<br></div>";      $num++;
                }            
            }   
        echo "</table>
            <input type='hidden' value='".$form_ID."' name='formID'>
            <input type='hidden' value='".$course."' name='course'>
            <input type='hidden' value='$group_ID' name='groupID'>          
            <input type='hidden' value='form1' name='form'>
            <input type='submit' value='Export as a PDF' id='submitBtn'>
            </form></div>";
    }
?>