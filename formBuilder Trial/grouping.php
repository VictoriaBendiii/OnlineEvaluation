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
	$course = '9358A';
	$query = "SELECT * FROM user_course JOIN users USING(id) WHERE courseCode = '$course' AND username != '$user' AND identification != 'teacher' ORDER BY lastname;";
	$execute_query = mysqli_query($conn, $query);

	echo "<div id='rating' style='text-align:center; margin: 0 auto; margin-top:10%;'>Students<br>
			<div class='tableContainerGroup'>
                <form action='grouping.php' method='post'>                          
                <table class='tableFormGroup'>
                    <tr>
                        <th>Students</th>
                        <th>Group #</th>
                    </tr>";
	while($row = mysqli_fetch_array($execute_query, MYSQLI_ASSOC)){
		echo "<tr>
				<td>".$row['firstname'] .' '. $row['lastname']."<input type='hidden' value='".$row['id']."' name='id[]'></td>";
		if($row['groupID'] == null){
			echo "<td><input type='text' name='group[]' style='width:7%; text-align:center;'></td>
			  </tr>";
		}else{
			echo "<td><input type='text' name='group[]' style='width:7%; text-align:center;' value='".$row['groupID']."'></td>
			  </tr>";
		}		  	
	}
	echo "</table></div></div>
		<div id='submitGroup'>
		<input type='hidden' value='$course' name='course'>
        <input type='submit' value='Submit' id='backBtn'>
        </form>
        </div>";

    if($_SERVER["REQUEST_METHOD"] == "POST") {
    	//$course = $_POST["course"];
    	$course = '9358A';
    	$id = $_POST["id"];
    	$group = $_POST["group"];

    	for($ctr = 0; $ctr < count($id); $ctr++){
    		$query = "SELECT * FROM user_course JOIN users USING(id) WHERE courseCode = '$course' AND id = '$id[$ctr]' AND identification != 'teacher'";

			if(mysqli_query($conn, $query)) {
				$query_two= "UPDATE user_course SET groupID='$group[$ctr]' WHERE id=$id[$ctr];";
				if (!mysqli_query($conn, $query_two)) {
					echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	    		} 
	    	} else {
	        	echo "Error: " . $sql . "<br>" . mysqli_error($conn); 	        	
	    	}
    	}
    		echo "<script>	
	    			$(document).ready(function(){
					$('#myModal').modal('show');
					});
				  </script>
				  <div id='myModal' class='modal fade'>
    				<div class='modal-dialog' style='width:30%'>
        				<div class='modal-content'>
            				<div class='modal-header'>
                			<button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
            				</div>
            			<div class='modal-body'>
							<h4>Successfully Updated the Groups</h4>
                			<form action='' method='post'>
                    			<input type='submit' value='Proceed' class='btn btn-primary' style='margin:0 auto;'>
                			</form>
            			</div>
        				</div>
    					</div>
					</div>";		 		
    }
?>