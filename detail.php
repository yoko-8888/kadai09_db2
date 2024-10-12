<?php
$id = $_GET["id"];

//１．PHP
//select.phpのPHPコードをマルっとコピーしてきます。2~20行目を下記に貼り付け
//※SQLとデータ取得の箇所を修正します。

//【重要】
//insert.phpを修正（関数化）してからselect.phpを開く！！
include("funcs.php");
$pdo = db_conn();

//２．データ登録SQL作成
// 「$sql = "SELECT * FROM テーブル名";」を下記に変更、WHEREから追加
$sql = "SELECT * FROM gs_bm_table WHERE id=:id";
$stmt = $pdo->prepare($sql);
// 下記も、追加(insert.phpから情報コピペ)
$stmt->bindValue(':id',    $id,    PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute();

//３．データ表示
$values = "";
if($status==false) {
  sql_error($stmt);
}

//全データ取得
// $values =  $stmt->fetchAll(PDO::FETCH_ASSOC); //PDO::FETCH_ASSOC[カラム名のみで取得できるモード]
// 上記コードを下記に変更（１レコードだけ更新するの意味）
$v =  $stmt->fetch(); 
// $json = json_encode($values,JSON_UNESCAPED_UNICODE);

?>

<!--
２．HTML
以下にindex.phpのHTMLをまるっと貼り付ける！
理由：入力項目は「登録/更新」はほぼ同じ画面になるからです。
※form要素 input type="hidden" name="id" を１項目追加（非表示項目）
※form要素 action="update.php"に変更
※input要素 value="ここに変数埋め込み"
-->

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>ブックマークアプリ</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <style>div{padding: 10px;font-size:16px;}</style>
</head>
<body>

<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
    <div class="navbar-header"><a class="navbar-brand" href="select.php">データ一覧</a></div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<!-- <form method="POST" action="insert.php"> -->
<!-- 上記65行目「insert.php」を「update.php」に変更 更新の方に飛ばすため-->
<form method="POST" action="update.php">
  <div class="jumbotron">
   <fieldset>
    <legend>更新</legend>
    <!-- 末尾にvalue="~~~[属性] ?>"を追加-->
     <label>TITLE：<input type="text" name="title" value="<?=$v["title"]?>"></label><br>
     <label>URl：<input type="text" name="url" value="<?=$v["url"]?>"></label><br>
     <!-- <label>年齢：<input type="text" name="age" value="<?=$v["age"]?>"></label><br> -->
     <!-- textAreaタグの間に、<?=$v["カラム"]?> を入れる-->
     <label><textArea name="comment" rows="10" cols="40"><?=$v["comment"]?></textArea></label><br>

     <!-- 下記76行目追加 -->
    <input type="hidden" name="id" value="<?=$v["id"]?>">
     <input type="submit" value="送信">
    </fieldset>
  </div>
</form>
<!-- Main[End] -->


</body>
</html>



