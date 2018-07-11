<?php
$conn=mysqli_connect("localhost","root","","peerpal");
if(isset($_POST['content'])){
    session_start();
    $keyword = $_POST['content'];
    $course =  $_SESSION['course'];
    if(empty($keyword)){
        $sql = "SELECT users.id as id, CONCAT(users.firstname,' ',users.lastname) as name, users.username as username, users.profilepicture as profilepicture FROM users JOIN user_course USING (id) WHERE user_course.courseCode = '$course' AND users.identification='student';";
        $result = mysqli_query($conn, $sql);
        while ($row = $result->fetch_assoc()){
            echo "<div id='$row[username]' class='panel panel-default' style='width: 80%; background-color: #EFEEEC; padding: 5px;'><img src='images/profilepictures/$row[profilepicture]' style='border-radius: 50px; height: 50px; width: 50px; padding: 2px;' alt='profile picture'>";
            echo "<p style='font-size: 21px; display: inline-block;'>&nbsp;$row[name]&emsp;</p>

                <input type='hidden' name='id' value='$row[id]'>
                <input type='hidden' name='course' value='$course'><br></div>";
        }
    }else{
        $sql = "SELECT users.id as id, CONCAT(users.firstname,' ',users.lastname) as name, users.username as username, users.profilepicture as profilepicture FROM users JOIN user_course USING (id) WHERE user_course.courseCode = '$course' AND users.identification='student';";

        $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_assoc($result)) {
            if (strripos($row['username'], $keyword) !== false || strripos($row['name'], $keyword) !== false){
                echo "<div id='$row[username]' class='panel panel-default' style='width: 80%; background-color: #EFEEEC; padding: 5px;'><img src='images/profilepictures/$row[profilepicture]' style='border-radius: 50px; height: 50px; width: 50px; padding: 2px;' alt='profile picture'>";
                echo "<p style='font-size: 21px; display: inline-block;'>&nbsp;$row[name]&emsp;</p>

                <input type='hidden' name='id' value='$row[id]'>
                <input type='hidden' name='course' value='$course'><br></div>";
            }
        }
    }
}else{
    $sql = "SELECT users.id as id, CONCAT(users.firstname,' ',users.lastname) as name, users.username as username, users.profilepicture as profilepicture FROM users JOIN user_course USING (id) WHERE user_course.courseCode = '$_SESSION[course]' AND users.identification='student';";
    $result = mysqli_query($conn, $sql);
    while ($row = $result->fetch_assoc()){
        echo "<div id='$row[username]' class='panel panel-default' style='width: 80%; background-color: #EFEEEC; padding: 5px;'><img src='images/profilepictures/$row[profilepicture]' style='border-radius: 50px; height: 50px; width: 50px; padding: 2px;' alt='profile picture'>";
        echo "<p style='font-size: 21px; display: inline-block;'>&nbsp;$row[name]&emsp;</p>

                <input type='hidden' name='id' value='$row[id]'>
                <input type='hidden' name='course' value='$_SESSION[course]'><br></div>";
    }
}