<?php

// функция по удалению определенных тегов
function stripTags($string, $tags) { //$string - строка с тегами, $tags - удаляемые теги (в строку через запятую)

    $tags = explode(',', $tags); // разбиваем строку на массив

    foreach($tags as $tag) { // перебираем теги
        
        $regexp = '#</?' . trim($tag) . '( .*?>|>)#siu'; // регулярное выражение
        $string = preg_replace($regexp, '', $string); // выполняем поиск в строке
        
    }
   
    return $string;
    
}

$string = file_get_contents('index.html'); // наша строка с тегами

// удаляем теги
$_string = stripTags($string, 'meta, title'); // результат: <p>Это текст</p>
echo $_string;
?>