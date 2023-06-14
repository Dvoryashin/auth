<?php
session_start();

$clientId     = '51674244';
$clientSecret = 'SEmhKVX8cThhU3hKVT7f'; 
$redirectUri  = 'http://example2.com/php/account.php'; 
 

$params = array(
	'client_id'     => $clientId,
	'redirect_uri'  => $redirectUri,
	'response_type' => 'code',
	'v'             => '5.131',
 

	'scope'         => 'photos,offline',
);
 
echo '<a href="http://oauth.vk.com/authorize?' . http_build_query( $params ) . '">Авторизация через ВКонтакте</a></br>';

if(isset($_POST['auth_name']) and isset($_POST['auth_pass'])){

    $mysqli = mysqli_connect("localhost", "francesco", "some_pass", "task1");

    $name = $_POST['auth_name'];
    $password = $_POST['auth_pass'];

    $take_password = mysqli_query($mysqli, "SELECT PASSWORD FROM users WHERE LOGIN='". $name. "'");
    $hash_password = $take_password->fetch_assoc()['PASSWORD'];
    $check_password = password_verify($password, $hash_password);


    if($check_password == 1){

        $_SESSION["access"] = true;
        $_SESSION["name"] = $name;
        header('Location: http://example2.com/php/account.php');

    }else{

        echo 'Войти не удалось. Попробуйте <a href="http://example2.com/php/signin.php">ещё раз</a>';
    
    }

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/css/style.css">
  <title>Document</title>
</head>
<body>
  <div class="form_auth_block">
    <div class="form_auth_block_content">
      <p class="form_auth_block_head_text">Авторизация</p>
      <form class="form_auth_style" action="/php/signin.php" method="post">
        <label>Введите Ваше имя</label>
        <input type="text" name="auth_name" placeholder="Введите Ваше имя" required >
        <label>Введите Ваш пароль</label>
        <input type="password" name="auth_pass" placeholder="Введите пароль" required >
        <button class="form_auth_button" type="submit" name="form_auth_submit">Войти</button>
      </form>
    </div>
    <p>Ещё нет аккаунта? Тогда <a href="/html/index.html">зарегистрируйтесь</a></p>
  </div>
</body>
</html>
