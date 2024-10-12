<?php
//1. POSTデータ取得
$title   = $_POST["title"];
$url  = $_POST["url"];
$comment = $_POST["comment"];
// $age    = $_POST["age"];
// $indate = $_POST["indate"];


//2. DB接続します（funcs.phpの、//DB接続関数：db_conn()にコピペする箇所）

//*** function化(funcs.php)する！  *****************
// (STEP1)function db_conn(){}で、try以下ピンク色の}までパッケージ化する。function用の}は一番下に配置してtry~を囲む

// function db_conn(){   
// try {
    // $db_name = "gs_db3";    //データベース名
    // $db_id   = "root";      //アカウント名
    // $db_pw   = "";          //パスワード：XAMPPはパスワード無し or MAMPはパスワード”root”に修正してください。
    // $db_host = "localhost"; //DBホスト→　ローカル環境ならlocalhost、さくらサーバだったらさくらの名前に変更
    // dbnameやid,pw,dbホスト名を変数に変更したもの（↓）これにより、上記$~を変えるだけで下記内をいじる必要はなく安全性が高い
    // $pdo = new PDO('mysql:dbname='.$db_name.';charset=utf8;host='.$db_host, $db_id, $db_pw);
// } catch (PDOException $e) {
    // exit('DB Connection Error:'.$e->getMessage());
// } 
// }

// 次にfunction db_conn(){}でパッケージしたもの（上）を、下記&pdo変数で上の関数が実行されるようになる
// $pdo = db_conn();
// ↓
// 上記をまるっと短縮すると、下記になる(STEP2)

include("funcs.php");  //外部ファイル読み込み
$pdo = db_conn();

//３．データ登録SQL作成（function化しない。funcs.phpには特にコピペしない）
$stmt = $pdo->prepare("INSERT INTO gs_bm_table(title,url,comment,indate)VALUES(:title,:url,:comment,sysdate())");
// SQLに値を埋め込む時は、必ずbindValueという関数を通す
$stmt->bindValue(':title',   $title,   PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':url',  $url,  PDO::PARAM_STR);  //STR（文字の場合 PDO::PARAM_STR)
// $stmt->bindValue(':age',    $age,    PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':comment', $comment, PDO::PARAM_STR);  //STR（文字の場合 PDO::PARAM_STR)
$status = $stmt->execute(); //実行 true or false


//４．データ登録処理後（2箇所、funcs.phpの//SQLエラー関数：sql_error($stmt)&リダイレクト関数にコピペする箇所）
if($status==false){
    //*** function化する！SQLエラー関数*****************
    // function sql_error($stmt){
        // $error = $stmt->errorInfo();
        // exit("SQLError:".$error[2]);
    // }  
    // （注1）上記コメントアウトをfuncs.phpの「//SQLエラー関数：sql_error($stmt)」にコピペ
    sql_error($stmt);  
}else{
    //*** function化する：リダイレクト関数！*****************
    //  function redirect($file_name){
        // header("Location: ".$file_name);
        // exit();
        // }
    // （注2）else以下、上記コメントアウトをfuncs.phpの「//リダイレクト関数: redirect($file_name)」にコピペ

        redirect("index.php");   //index.phpにリダイレクトする
}
?>
