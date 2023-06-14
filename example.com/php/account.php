<?php
session_start();

$clientId     = '51674244';
$clientSecret = 'SEmhKVX8cThhU3hKVT7f'; 
$redirectUri  = 'http://example2.com/php/account.php'; 

if (isset($_GET['code'])) {
    $result = true;
    $params = [
        'client_id' => $clientId,
        'client_secret' => $clientSecret,
        'code' => $_GET['code'],
        'redirect_uri' => $redirectUri
    ];

    $token = json_decode(file_get_contents('https://oauth.vk.com/access_token' . '?' . urldecode(http_build_query($params))), true);

    if (isset($token['access_token'])) {
        $_SESSION['access'] = true;
        $params = [
            'uids' => $token['user_id'],
            'fields' => 'uid,first_name,last_name,screen_name,sex,bdate,photo_big',
            'access_token' => $token['access_token'],
            'v' => '5.101'];

        $userInfo = json_decode(file_get_contents('https://api.vk.com/method/users.get' . '?' . urldecode(http_build_query($params))), true);
        if (isset($userInfo['response'][0]['id'])) {
            $userInfo = $userInfo['response'][0];
            $result = true;
        }
    }

    if ($result) {
        echo "Пользователь VK</br>";
        echo "Имя пользователя: " . $userInfo['first_name'] . " " . $userInfo['login'] .'<br />';
        echo "Lorem ipsum dolor sit amet consectetur adipisicing elit. </br> Dolor natus, ratione fuga numquam ut voluptates quo,</br> nemo quasi temporibus repudiandae molestias. Veritatis ab enim</br> tempore placeat nesciunt, molestias eum consequuntur?</br>";
        echo '<img src="' . $userInfo['photo_big'] . '" />'; echo "<br />";

    }
}else{
    if($_SESSION['access'] != true){
        header('Location: http://example2.com/html/index.html');
    }else{
        echo "Обычный пользователь</br>";
        echo "Имя пользователя: " . $_SESSION['name'] .'<br />';
        echo "Lorem ipsum dolor sit amet consectetur adipisicing elit. </br> Dolor natus, ratione fuga numquam ut voluptates quo,</br> nemo quasi temporibus repudiandae molestias. Veritatis ab enim</br> tempore placeat nesciunt, molestias eum consequuntur?</br>";
    }
}
if($_SESSION['access'] != true){
    header('Location: http://example2.com/html/index.html');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="account.css">
</head>
<body>
    
</body>
</html>