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
      <p id="uploadTitle">Choose the Type of Evaluation</p>
      <div id="upContainer" align="center">
        <form action="uploadForm.php" method="POST" enctype="multipart/form-data" id="uploadBlock">
          <input type="hidden" name="form" value="form1" />
          <button id="form1Btn"></button><br>
          Form 1
        </form>
        <form action="uploadForm.php" method="POST" enctype="multipart/form-data" id="uploadBlock">
          <input type="hidden" name="form" value="form2" />
          <button id="form2Btn"></button><br>
          Form 2
        </form>
      </div>

    </body>
</html>