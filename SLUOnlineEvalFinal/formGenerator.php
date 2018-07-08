<?php include('connection.php');
?>
<html>
    <head>
        <meta name=viewport content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <link href="styles/formStyle.css" rel="stylesheet" type="text/css"/>
        <script src="assets/js/jquery.min.js"></script>
        <meta charset="UTF-8">
        <meta name="description" content="online evaluation">
        <meta name="author" content="Group 2">
        <title>SLU Peer Evaluation | Upload</title>
		<link rel="icon" href="css/images/slogo.png">
		<link rel="stylesheet" href="css/pstyle.css"/>
		<link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css'>
        <link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css'>
        <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Montserrat:400,700'>
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
		<script src="https://code.jquery.com/jquery-3.2.1.js"></script>
    </head>

    <body>
	<div class="wrapper">
            <header>
                <nav style="z-index: 1000; background-color: RGBA(92,115,139, 0.6); position: fixed; top: 0px;"">
                    <div class="menu-icon">
                        <i class="fa fa-bars fa-2x"></i>
                    </div>
                    <img src="css/images/slogo.png" style="height: 45px; width: 36px; position: fixed; top: 10px; left: 10px;">
                    <div class="logo">&emsp;SLU Peer Evaluation</div>
                    <div class="menu">
                        <ul>
                            <li style="color: white; font-size: 20px; "><a class="active" href="#" onclick="websitenav();">
                            </a></li>
                        </ul>
                    </div>
                </nav>
            </header>
        </div>
		<script type="text/javascript">
        
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
    <div id='uploadContainer'>
      <p id="uploadTitle">Generate Evaluation Form</p>
        <form action="generate.php" method="POST" enctype="multipart/form-data" class="file-upload"  
            <label for="title" id="group">Title: </label>
            <input type="text" name="title" id="title" placeholder="Prelims Evaluation Form" maxlength="50" required><br>
            <label for="typeEval" id="typeFormLabl" style="font-weight:normal;">Type of Evaluation: </label>
            <select name="typeEval" id="typeEval" style="margin-left: 1%;">
            	<option value="Likert">Likert</option>
            	<option value="Multiple Choice">Multiple Choice</option>
            	<option value="Descriptive">Descriptive</option>
            </select><br>
            <div class="toAppendAfter">
            <div class="wrapScale">
            <label for="scale" id="scaleLabl" style="font-weight:normal;">Scale: </label><br>
		        <div class="scaleWrap">
		            <div>
		            	<input type="text" name="scale[]" id="scale" placeholder="Good" maxlength="240" style="margin-left: 110px;width:50%;font-size:18px;" required>
		            	<button type='button' id='addScale' style='margin:0%; padding: 0; border: none; background: none;'><img src='images/add.png' style='height: 28px; width: 28px; padding: 2px;' alt='add' id='add'></button>
		            </div>
		        </div>
	    	</div>
	    	</div>
            <br>
            <label for="criteria" id="criteriaLabl" style="font-weight:normal;">Criteria: </label><br>
            <div class="criteriaWrap">
	            <div>
		            <input type="text" name="criteria[]" id="criteria" placeholder="Describe the work ethic of the student." maxlength="240" style="margin-left: 110px;width:50%;font-size:18px;" required>
		            <button type='button' id='addCriteria' style='margin:0%; padding: 0; border: none; background: none;'><img src='images/add.png' style='height: 28px; width: 28px; padding: 2px;' alt='add' id='addC'></button>
		        </div>
		    </div>
            <br>
            <div style="width: 80%;margin:0 auto;">
            </div>
			<br>
            <input type="submit" value="Generate" class="uploadButton"/> 
        </form>
    </div>
<script>
    var max = 15;
    var x = 1;
    var typeEval = $("#typeEval");
   	var selectedVal = '';
   	var toAppend = '';

    var y = 1;
    $(typeEval).click(function(e){
    	var selectedValue = $("#typeEval option:selected").text();
    	var className = document.getElementsByClassName("wrapScale");
    	if(selectedValue == "Descriptive" && y == 1){
        	y = 0;
        	for (var i = 0; i < className.length; i++){
			  className[i].style.display = 'none';
			}
    	}else if(selectedValue != "Descriptive" && y == 0){
			y = 1;
			x = 1;
			for (var i = 0; i < className.length; i++){
			  className[i].style.display = 'block';
			}
    	}
    });

    $("#addScale").click(function(e){
    	x = 1;
	    var scaleWrap = $(".scaleWrap");
    	var textVal = $('#scale').val();
    	toAppend = '<div style="margin-top: 1%;"><input type="text" name="scale[]" value="'+textVal+'" maxlength="240" style="margin-left: 110px;width:50%;font-size:18px;" required /><a href="#" class="removeScale" style="margin-left:2%;">X</a></div>';
        e.preventDefault();
        if(x < max){ 
            x++; 
            $(scaleWrap).append(toAppend); 
        }
    });
   
    $(".scaleWrap").on("click",".removeScale", function(e){
        e.preventDefault(); $(this).parent('div').remove(); x--;
    })
  
    $("#addCriteria").click(function(e){
    	var x = 1;
    	var criteriaWrap = $(".criteriaWrap");
    	var textVal = $('#criteria').val();
    	var toAppend = '<div style="margin-top: 1%;"><input type="text" name="criteria[]" value="'+textVal+'" maxlength="240" style="margin-left: 110px;width:50%;font-size:18px;" required /><a href="#" class="removeCriteria" style="margin-left:2%;">X</a></div>';
        e.preventDefault();
        if(x < max){ 
            x++; 
            $(criteriaWrap).append(toAppend); 
        }
    });
   
    $(".criteriaWrap").on("click",".removeCriteria", function(e){
        e.preventDefault(); $(this).parent('div').remove(); x--;
    })
</script>
</body>
</html>