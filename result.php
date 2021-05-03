<?php
require "inc/connect.php";
    $error ="";
if (empty($_POST['name']) || empty($_POST['email']) || empty($_POST['pass']))  {
    echo "name or email or pass invaild";
} else {
    if (strlen($_POST['name']) <= 4 ) {
        $error = "less 4 <br>";
    }
    if (!preg_match('/^[a-zA-Z0-9]+$/',$_POST['name'])) {
        $error .= "رموز خاصة <br>";
    }

    if (is_numeric($_POST['name'][0])) {
        $error .="start in number <br>";
    }
    if (!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)) {
        $error .="error email <br>";
    }
    if (strlen($_POST['pass']) < 8 ) {
        $error = "pass must be 8 or more  <br>";
    }
    if (empty($error)) {
        $error = "<h1>welcome ". $_POST['name']. "</h1>";

        $username = mysqli_real_escape_string($con,$_POST['name']);
        $pass = password_hash($_POST['pass'],PASSWORD_BCRYPT);
        $pass = mysqli_real_escape_string($con,$pass);
        $email = mysqli_real_escape_string($con,$_POST['email']);

        
        $namss = "SELECT username FROM users WHERE username='".$username."' ";
        $selectusername =mysqli_query($con,$namss) or die(mysqli_error($con));
        $numname =mysqli_num_rows($selectusername);
        
        if ($numname > 0) 
        {
            echo "no";
        } 
        else {
            
            $req = "INSERT INTO users(username,password,email) VALUES('$username','$pass','$email')";
            $insert = mysqli_query($con,$req) or die(mysqli_error($con)) ;
            if ($insert) { 
                echo "تم التسجيل بنجاح ";
             }


        }
        
        
    




    }

}
echo $error;


?>
