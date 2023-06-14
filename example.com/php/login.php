<?php
session_start();

if(isset($_POST['reg_name']) and isset($_POST['reg_pass'])){

    $mysqli = mysqli_connect("localhost", "francesco", "some_pass", "task1");

    $name = $_POST['reg_name'];
    $password = $_POST['reg_pass'];

    $password_hash = password_hash($password, PASSWORD_DEFAULT);
    $take_user = mysqli_query($mysqli, "SELECT * FROM users WHERE LOGIN='". $name. "'");

    if(mysqli_num_rows($take_user) == 0){

        mysqli_query($mysqli, "INSERT INTO users (LOGIN, PASSWORD) VALUES ('" .$name. "', '" .$password_hash. "')");
        $_SESSION["access"] = true;
        $_SESSION["name"] = $name;
        header('Location: http://example2.com/php/account.php');

    }else{

        echo 'Попробуйте <a href="http://example2.com/html/index.html">ещё раз</a>';
    
    }

}
 
?>