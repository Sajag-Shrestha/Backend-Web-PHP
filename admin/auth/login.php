<?php
require("../connection/config.php");

if(isset($_POST['submit'])){
    $email = $_POST['email'];
    $password = $_POST['password'];
    if ($email != "" && $password != ""){
        $select = "SELECT * FROM users WHERE email = '$email' AND password = md5('$password')";
        $result = mysqli_query($con, $select);
        if ($result -> num_rows > 0){
            $data = mysqli_fetch_assoc($result);
            session_start();
            $_SESSION['name'] = $data['name'];
            $_SESSION['email'] = $data['email'];
            header("Refresh:0; url=../dashboard.php?success");
        } else{
        }
    } else {
        header("Refresh:0; URL=../index.php?empty");
    }
    
}
?>