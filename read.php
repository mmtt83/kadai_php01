<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php
//ファイルを開く 'r'ファイルを読み込みのみでオープンする
$file = fopen('./data/data.txt', 'r');

$ary_date = [];
$ary_age = [];
$ary_areaCategory = [];
$ary_rate = [];
$ary_body = [];


//ファイル内容を１行ずつ読み込んで出力
//配列を作成して、出力データを入れ込む
while($str = fgets($file)){
    // echo nl2br($str);
    $str_base = nl2br($str);
    //explode関数:文字列を配列に変換する
    $ary_base = explode("/", $str_base);

    //var_dump($ary_base);

    $ary_age[] = $ary_base[1];
    $ary_areaCategory[] = $ary_base[2];
    $ary_rate[] = $ary_base[3];
    $ary_body[] = $ary_base[4];
    
    //var_dump($ary_body);
}



//グラフ用のデータの計算

//年齢の割合
$count_age = array_count_values($ary_age);
$all_age = count($ary_age)/100;
$teens_age = $count_age["10"]/$all_age;
$twenties_age = $count_age["20"]/$all_age; 
$thirties_age = $count_age["30"]/$all_age; 
$forties_age = $count_age["40"]/$all_age; 
$fifties_age = $count_age["50"]/$all_age; 
$sixties_age = $count_age["60"]/$all_age; 
$seventies_age = $count_age["70"]/$all_age; 
$eighties_age = $count_age["80"]/$all_age; 

//住んでるエリアの割合 '東京都', '神奈川県', '埼玉県', '千葉県', '東北エリア', '関西エリア', '東海エリア', 'その他'
$count_area = array_count_values($ary_areaCategory);
$all_area = count($ary_areaCategory)/100;
$tokyo = $count_area['東京都']/$all_area;
$kanagawa = $count_area['神奈川県']/$all_area;
$saitama = $count_area['埼玉県']/$all_area;
$chiba = $count_area['千葉県']/$all_area;
$tohoku = $count_area['東北エリア']/$all_area;
$kannsai = $count_area['関西エリア']/$all_area;
$toukai = $count_area['東海エリア']/$all_area;
$sonota = $count_area['その他']/$all_area;

//評価の割合
$count_rate = array_count_values($ary_rate);
$all_rate = count($ary_rate)/100;
$oneStar = $count_rate[1]/$all_rate;
$twoStar = $count_rate[2]/$all_rate;
$threeStar = $count_rate[3]/$all_rate;
$fourStar = $count_rate[4]/$all_rate;
$fiveStar = $count_rate[5]/$all_rate;


//感想


// $input_array = array();
// while($input_line = fgets($file)){
//     array_push($input_array, $input_line);
//     echo $input_array;
// }

//ファイルを閉じる
fclose($file);

?>

<div class="main_read">
    <h1>アンケート結果</h1>

    <div class="menue">
            <p><a href="/php01_kadai/data/data.txt" target="_blank">投票データを見る</a></p>
            <p><a href="post.php">アンケート回答画面に戻る</a></p>
        </div>

    <div class="result">
        <h2>年齢の割合</h2>
        <canvas id="pieChart01"></canvas>

        <h2>回答者の住んでいるエリア</h2>
        <canvas id="barChart01"></canvas>

        <h2>試合の満足度</h2>
        <canvas id="barChart02"></canvas>

        <h2>感想</h2>
        <p class="kanso"><?php
                $array_body = $ary_body;
                foreach($array_body as $value){
                    echo $value;
                    //echo "\n"; //※※出来なかったところ：データが改行してくれなかった。。。
                    echo "<br>";
                }
            ?></p>

        <div class="menue">
            <p><a href="/php01_kadai/data/data.txt" target="_blank">投票データを見る</a></p>
            <p><a href="post.php">アンケート回答画面に戻る</a></p>
        </div>
    </div>
</div>

<!-- chart.js CDN -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js" integrity="sha512-TW5s0IT/IppJtu76UbysrBH9Hy/5X41OTAbQuffZFU6lQ1rdcLHzpU5BzVvr/YFykoiMYZVWlr/PX1mDcfM9Qg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>

//年齢の割合：円グラフ
var ctx = document.getElementById('pieChart01');
var myChart = new Chart(ctx, {
  type: 'pie',
  data: {
    labels: ['10代', '20代', '30代', '40代', '50代', '60代', '70代', '80代'],
    datasets: [{
      data: [
            <?= $teens_age ?>,
            <?= $twenties_age ?>,
            <?= $thirties_age ?>,
            <?= $forties_age ?>,
            <?= $fifties_age ?>,
            <?= $sixties_age ?>,
            <?= $seventies_age ?>,
            <?= $eighties_age ?>,
            ],
      backgroundColor: ['#FFBE0B', '#FB5607', '#FF006E', '#8338EC', '#3A86FF', '#fdfcdc', '#00afb9', '#3d348b'],
      weight: 100,
    }],
  },
});

//住んでいるエリアの割合
var ctx2 = document.getElementById('barChart01');
var myBarChart = new Chart(ctx2, {
    type: 'bar',
    data: {
        labels: ['東京都','神奈川県','埼玉県','千葉県','東北エリア','関西エリア','東海エリア','その他'],
        datasets: [{
            data: [
                <?= $tokyo ?>,
                <?= $kanagawa ?>,
                <?= $saitama ?>,
                <?= $chiba ?>,
                <?= $tohoku ?>,
                <?= $kannsai ?>,
                <?= $toukai ?>,
                <?= $sonota ?>,
            ],
        
        backgroundColor: ['#FFBE0B', '#FB5607', '#FF006E', '#8338EC', '#3A86FF', '#fdfcdc', '#00afb9', '#3d348b'],
        weight: 100,
        }],
    },
    options: {
         legend: { // ※※できていないところ：凡例を非表示にしたいのに出来ない。
            display: false
         }
    }

});


//試合の満足度の割合
var ctx3 = document.getElementById('barChart02');
var myBarChart2 = new Chart(ctx3, {
    type: 'bar',
    data: {
        labels: ['★★★★★','★★★★','★★★','★★','★'],
        datasets: [{
            data: [
                <?= $oneStar ?>,
                <?= $twoStar ?>,
                <?= $threeStar ?>,
                <?= $fourStar ?>,
                <?= $fiveStar ?>,
            ],
        label: "満足度５段階評価",
        backgroundColor: ['#ffd60a'],
        weight: 100,
        }],
    },
    options: {
      indexAxis: 'y'
    }
});

//試合の満足度の割合

</script>

</body>
</html>