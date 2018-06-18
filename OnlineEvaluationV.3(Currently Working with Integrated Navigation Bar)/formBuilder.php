<?php include('connection.php');?>
<html>
    <head>
        <meta name=viewport content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <link href="styles/formStyle.css" rel="stylesheet" type="text/css"/>
    </head>

    <body>
    <?php
        $user = $_SESSION['username'];
        $course = $_POST["course"];
        //$group_ID = $_POST["groupID"];
        //$course = '9358A';
        $counter = 1; 
        $num = 1;     
        $form_ID = 0;
        $group_ID = 0;
        $groupmates = array();
        $id = array();
        $url = '';

        $if_Null = "SELECT formID FROM users JOIN user_course USING(id) JOIN group_form USING(groupID) WHERE username='$user';";
        $query = mysqli_query($conn, $if_Null);
        while($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
            if($row['formID'] == NULL){
                exit("<div id='expForm'>Your group is not allowed to fill up the form. Please contact your instructor if this is a mistake.</div>
                    <form action='studentpage'>
                    <input type='submit' value='Go Back' id='backBtn'>
                    <form>");
            }
        }

        $if_result = "SELECT evaluator FROM result WHERE evaluator = '$user'";
        if (mysqli_query($conn, $if_result)) {
            exit("<div id='expForm'>You have already answered this form.</div>
                    <form action='studentpage'>
                    <input type='submit' value='Go Back' id='backBtn'>
                    <form>");
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

        $get_form_id = "SELECT * FROM form JOIN group_form USING(formID) JOIN user_course USING(groupID) JOIN users ON users.id = user_course.id WHERE username = '$user' AND courseCode = '$course';";
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
            if($due <= $now && $time_now >= $time){
                exit("<div id='expForm'>Sorry, you can't fill up the evaluation. Please contact your instructor for further details.</div>
                    <form action='studentpage'>
                    <input type='submit' value='Go Back' id='backBtn'>
                    <form>");
            }
            echo "<h1 id='formTitle'>".$row['formName']."</h1>";
        }

        $get_groupmates = "SELECT * FROM group_form JOIN user_course USING(groupID) JOIN users ON users.id = user_course.id WHERE identification = 'student' AND coursecodeForm = '$course' AND groupID = $group_ID AND username != '$user' ORDER BY lastname;";
        $query_Two = mysqli_query($conn, $get_groupmates);
        while($row = mysqli_fetch_array($query_Two, MYSQLI_ASSOC)) {
            $form_ID = $row['formID'];          
            $group_ID = $row['groupID'];
            array_push($groupmates, $row['firstname'] .' '. $row['lastname']);
            array_push($id, $row['id']);
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
                                    <th>Members</th>
                                    <th colspan='$size_criteria'>Criteria</th>
                                    <th>Remarks</th>
                                </tr>
                                <tr>
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
                                </td>";
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
            <input type='submit' value='Submit' id='submitBtn'>
            </form></div>";
        }elseif ($form_type == 'form2') {
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
                            <div class='tableContainer'>
                            <form action='successfulEval.php' method='post'>                          
                            <table class='tableForm'>
                                <tr>
                                    <th>Criteria</th>
                                    <th colspan='$size_groupmates'>Members</th>
                                </tr>
                                <tr>
                                    <td></td>";
                    for($ctr = 0; $ctr < $size_groupmates; $ctr++){
                        echo "<td>$groupmates[$ctr]
                                <input type='hidden' name='idFormTwo[]' value='".$id[$ctr]."'>
                            </td>";
                    }
                    echo "</tr>";                                   
                }else if($formCriterias['criteria'] != 'choices'){
                        echo "<tr>
                                <td>".$formCriterias['criteria']."</td>
                                <input type='hidden' name='criteria[]' value='".$formCriterias['criteria']."'>";
                        for($counter = 0; $counter < $size_groupmates; $counter++){
                            echo "<td><input type='number' name='score[]' min='1' max='$length' value='0' required></td>";
                        }     
                }                         
            } 
        echo "</div>";    
        echo "</table>
            <input type='hidden' value='".$form_ID."' name='formID'>
            <input type='hidden' value='form2' name='form'>
            <input type='hidden' value='$group_ID' name='groupID'>
            <input type='hidden' value='".$course."' name='course'>
            <input type='submit' value='Submit' id='submitBtn'>
            </form></div>";
        }              
?>
</body>
</html>