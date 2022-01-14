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

<div class="main">
<p class="logo"><img src="img/logo.png" alt=""></p>
<hr>
<h1>試合アンケート</h1>

<h2>1月 8日(土)</h2>
<p>NTT JAPAN RUGBY LEAGUE ONE 2022 #1<br>
東京・味の素スタジアム</p>
<p><img src="img/img01.png" alt=""></p>
<p><img src="img/220108_3938.jpeg" alt=""></p>

<div class="sarvey">
    <h3>1月8日の試合についてアンケートのご協力お願いします。</h3>
    <form action="write.php" method="post">
        <div class="form-item">お名前</div>
        <input type="text" name="name" class="box">

        <div class="form-item">年齢</div>
        <select name="age" id="" class="box">
            <option value="未選択">選択してください</option>
            <!-- for文の練習 -->
            <?php
                for($i =10; $i <= 80; $i+=10){
                    echo "<option value='{$i}'>{$i}代</option>";
                }
            ?>
        </select>
        <div class="form-item">お住まいのエリア</div>
        <!-- 配列の練習 -->
        <?php
        $areas = array('東京都', '神奈川県', '埼玉県', '千葉県', '東北エリア', '関西エリア', '東海エリア', 'その他');
        ?>
        <select name="areaCategory" class="box">
            <option value="未選択">選択してください</option>
            <?php
                foreach($areas as $area){
                    echo "<option value='{$area}'>{$area}</option>";
                }
            ?>
        </select>

        <div class="form-item">試合の満足度</div>
        <!-- 星５段階評価 -->
        <div class="rate-form">
            <?php
            for($g=1; $g<=5; $g++){
                echo "<input id='{$g}' type='radio' name='rate' value='{$g}'><label for='{$g}'>★</label>";
            }
            ?>
        </div>
        <div class="form-item">感想</div>
        <textarea name="body" class="box"></textarea>

        <p><input class="btn" type="submit" value="送信"></p>

    </form>
</div>

</div>
    
</body>
</html>