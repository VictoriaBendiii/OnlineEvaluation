<?php include('connection.php');

if(isset($_POST['register'])){
    
    $username = $_POST['username'];
    
    
    $query= "SELECT * FROM `users` WHERE username='$username'";
    
    $result = mysqli_query($conn, $query) or die (mysqli_error($conn));
    
    if(mysqli_num_rows($result) >0){
        $name_error = 'Username Exists!';
        header("location: register.php");
    }else{
        $username = mysqli_real_escape_string($conn, $_POST['username']);
						$password = mysqli_real_escape_string($conn, $_POST['password']);
						$firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
						$lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
                        $identification = mysqli_real_escape_string($conn, $_POST['identification']);
        $query = "INSERT INTO `users`(`username`, `password`, `firstname`, `lastname`, `identification`) VALUES ('$username', '$password','$firstname','$lastname', '$identification')";
    }
    
}




?>