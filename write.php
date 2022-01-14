<?php
// XSS対策用関数
function h($val){
    return htmlspecialchars($val, ENT_QUOTES);
}

$name = $_POST['name'];
$age = $_POST['age'];
$areaCategory = $_POST['areaCategory'];
$rate = $_POST['rate'];
$body = $_POST['body'];

// XSS対策
//省略前 $name = htmlspecialchars($name, ENT_QUOTES);
$name = h($name);
$age = h($age);
$areaCategory = h($areaCategory);
$rate = h($rate);
$body = h($body);

//ファイルに書き込む
//$date = date('Y/m/d H:i:s');

$str = $name . '/' . $age . '/' . $areaCategory . '/' . $rate . '/' . $body. '/';

//ファイルの用意
$file = fopen('./data/data.txt', 'a');

//書き込む  「Option + "¥" で"\"を入力」
fwrite($file, $str . "\n");

//ファイルをクローズ
fclose($file);

?>


<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="main_write">
        <h1 class="txt-center">ご協力ありがとうございました！</h1>
        <p class="txt-center"><img src="img/006.png" alt=""></p>

        <div class="menue">
            <p><a href="read.php" target="_blank">アンケート結果を確認する</a></p>
            <p><a href="post.php">アンケート画面に戻る</a></p>
        </div>
    </div>
    
</body>
</html>