<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>ブックマークアプリ</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <style>div{padding: 10px;font-size:16px;}</style>
  <style>
        body {
            background-image: url('img/img1.png'); /* 画像パスを指定 */
            background-size: cover; /* 画像を全体にフィットさせる */
            background-position: center center; /* 画像を中央に配置 */
            background-repeat: no-repeat; /* 画像を繰り返さない */
            height: 100vh; /* ビューポートの高さを100%に設定 */
            margin: 0; /* 余白をなくす */
        }
        .jumbotron {
            background-color: rgba(255, 255, 255, 0.8); /* 背景を少し透明にしてテキストを読みやすくする */
            padding: 20px;
            border-radius: 10px;
        }
    </style>

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
<form method="POST" action="insert.php">
  <div class="jumbotron">
   <fieldset>
    <legend>ブック登録</legend>
     <label>TITLE：<input type="text" name="title"></label><br>
     <label>URl：<input type="text" name="url"></label><br>
     <!-- <label>年齢：<input type="text" name="age"></label><br> -->
     <label><textArea name="comment" rows="10" cols="40"></textArea></label><br>
     <label>DATE：<input type="text" name="indate"></label><br>

     <input type="submit" value="送信">
    </fieldset>
  </div>
</form>
<!-- Main[End] -->


</body>
</html>
