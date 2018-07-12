<?php
include('connection.php');
$totalgroups = $_POST['totalgroups'];
if($totalgroups >= 1){
    for($x = 0; $x < count($_POST['group1']); $x++){
        $id = $_POST['group1'][$x];
        $sql = "UPDATE user_course SET groupID='1' WHERE id='$id' AND courseCode = '$_SESSION[course]';";
        mysqli_query($conn,$sql);
    }
}
if($totalgroups >= 2){
    for($x = 0; $x < count($_POST['group2']); $x++){
        $id = $_POST['group2'][$x];
        $sql = "UPDATE user_course SET groupID='2' WHERE id='$id' AND courseCode = '$_SESSION[course]';";
        mysqli_query($conn,$sql);
    }
}
if($totalgroups >= 3){
    for($x = 0; $x < count($_POST['group3']); $x++){
        $id = $_POST['group3'][$x];
        $sql = "UPDATE user_course SET groupID='3' WHERE id='$id' AND courseCode = '$_SESSION[course]';";
        mysqli_query($conn,$sql);
    }
}
if($totalgroups >= 4){
    for($x = 0; $x < count($_POST['group4']); $x++){
        $id = $_POST['group4'][$x];
        $sql = "UPDATE user_course SET groupID='4' WHERE id='$id' AND courseCode = '$_SESSION[course]';";
        mysqli_query($conn,$sql);
    }
}
if($totalgroups >= 5){
    for($x = 0; $x < count($_POST['group5']); $x++){
        $id = $_POST['group5'][$x];
        $sql = "UPDATE user_course SET groupID='5' WHERE id='$id' AND courseCode = '$_SESSION[course]';";
        mysqli_query($conn,$sql);
    }
}
if($totalgroups >= 6){
    for($x = 0; $x < count($_POST['group6']); $x++){
        $id = $_POST['group6'][$x];
        $sql = "UPDATE user_course SET groupID='6' WHERE id='$id' AND courseCode = '$_SESSION[course]';";
        mysqli_query($conn,$sql);
    }
}
if($totalgroups >= 7){
    for($x = 0; $x < count($_POST['group7']); $x++){
        $id = $_POST['group7'][$x];
        $sql = "UPDATE user_course SET groupID='7' WHERE id='$id' AND courseCode = '$_SESSION[course]';";
        mysqli_query($conn,$sql);
    }
}
if($totalgroups >= 8){
    for($x = 0; $x < count($_POST['group8']); $x++){
        $id = $_POST['group8'][$x];
        $sql = "UPDATE user_course SET groupID='8' WHERE id='$id' AND courseCode = '$_SESSION[course]';";
        mysqli_query($conn,$sql);
    }
}
if($totalgroups >= 9){
    for($x = 0; $x < count($_POST['group9']); $x++){
        $id = $_POST['group9'][$x];
        $sql = "UPDATE user_course SET groupID='9' WHERE id='$id' AND courseCode = '$_SESSION[course]';";
        mysqli_query($conn,$sql);
    }
}
if($totalgroups >= 10){
    for($x = 0; $x < count($_POST['group10']); $x++){
        $id = $_POST['group10'][$x];
        $sql = "UPDATE user_course SET groupID='10' WHERE id='$id' AND courseCode = '$_SESSION[course]';";
        mysqli_query($conn,$sql);
    }
}
if($totalgroups >= 11){
    for($x = 0; $x < count($_POST['group11']); $x++){
        $id = $_POST['group11'][$x];
        $sql = "UPDATE user_course SET groupID='11' WHERE id='$id' AND courseCode = '$_SESSION[course]';";
        mysqli_query($conn,$sql);
    }
}
if($totalgroups >= 12){
    for($x = 0; $x < count($_POST['group12']); $x++){
        $id = $_POST['group12'][$x];
        $sql = "UPDATE user_course SET groupID='12' WHERE id='$id' AND courseCode = '$_SESSION[course]';";
        mysqli_query($conn,$sql);
    }
}
if($totalgroups >= 13){
    for($x = 0; $x < count($_POST['group13']); $x++){
        $id = $_POST['group13'][$x];
        $sql = "UPDATE user_course SET groupID='13' WHERE id='$id' AND courseCode = '$_SESSION[course]';";
        mysqli_query($conn,$sql);
    }
}
if($totalgroups >= 14){
    for($x = 0; $x < count($_POST['group14']); $x++){
        $id = $_POST['group14'][$x];
        $sql = "UPDATE user_course SET groupID='14' WHERE id='$id' AND courseCode = '$_SESSION[course]';";
        mysqli_query($conn,$sql);
    }
}
if($totalgroups >= 15){
    for($x = 0; $x < count($_POST['group15']); $x++){
        $id = $_POST['group15'][$x];
        $sql = "UPDATE user_course SET groupID='15' WHERE id='$id' AND courseCode = '$_SESSION[course]';";
        mysqli_query($conn,$sql);
    }
}
header("location:studentgroups.php");
?>