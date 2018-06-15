<html>
	<head>
        <meta name=viewport content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <link href="styles/formStyle.css" rel="stylesheet" type="text/css"/>
    </head>
<body>

<div id="wrapper">
<br />
<br />

<?php
	$url = 'form.json'; 
    $data = file_get_contents($url); 
    $formCriterias = json_decode($data, true);
	$counter = 0;
	$score = 0;
	
        foreach ($formCriterias as $quizQuestion) {
		  $studentAnswer = $_POST[$counter];		

		if($studentAnswer == $quizQuestion['answer']){
			$score++;
		}
		$counter++;
	}
	echo "<center id='score'>Your Score is <br> $score/$counter <br></center>";
	echo "<form action='process.php?id=1' method='post' id='quizForm' id='1' class='quiz'> 
                <ol>"; 
	$counter = 0;
    foreach ($formCriterias as $quizQuestion) {
        if($quizQuestion != null || $quizQuestion != undefined){
            echo '<li style="text-align:center;">
                    <h4>'. $quizQuestion['question']. '</h4> 
                    <div>
                        <label for="answerOneA">A)'. $quizQuestion['choices'][0]. '</label>
                    </div>
        
                    <div>
                        <label for="answerOneB">B)'. $quizQuestion['choices'][1]. '</label>
                    </div>
        
                    <div>
                        <label for="answerOneC">C)'. $quizQuestion['choices'][2]. '</label>
                    </div>

                    <div>
                        <label for="answerOneD">D)'. $quizQuestion['choices'][3].'</label>
                    </div>
                    <h4>Answer: '. $quizQuestion['answer']. '</h4> 
                    <h4>Your Answer: '. $_POST[$counter]. '</h4>
                </li>';
                $counter++;
        }
    }
        echo "</ol>
            <a href='../index.html' class='continueButton'>Continue Adventure</a>
             </form>";
?>
</div>
<script>
function goBack() {
    window.history.back();
}
</script>
</body>
</html>