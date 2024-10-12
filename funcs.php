<?php
//XSSを防止する対応（ echoする場所で使用！それ以外はNG ）XSS＝クロスサイトスクリプティング
function h($str){
    return htmlspecialchars($str, ENT_QUOTES);
}

//DB接続関数：db_conn()
function db_conn(){   
try {
    $db_name = "gs_db";    //データベース名
    $db_id   = "root";      //アカウント名
    $db_pw   = "";          //パスワード：XAMPPはパスワード無し or MAMPはパスワード”root”に修正してください。
    $db_host = "localhost"; //DBホスト→　ローカル環境ならlocalhost、さくらサーバだったらさくらの名前に変更
    // dbnameやid,pw,dbホスト名を変数に変更したもの（↓）これにより、上記$~を変えるだけで下記内をいじる必要はなく安全性が高い
    return new PDO('mysql:dbname='.$db_name.';charset=utf8;host='.$db_host, $db_id, $db_pw);
 } catch (PDOException $e) {
     exit('DB Connection Error:'.$e->getMessage());
 } 
 }
// 上記(insert.phpからコピペしたもの)解説↓
//  $pdo = new PDO('mysql:dbname='〜の部分、一部だけ変更
// →「return new PDO('mysql:dbname='.〜」にする「&pdo =」を「return」にする




//SQLエラー関数：sql_error($stmt)
function sql_error($stmt){
    $error = $stmt->errorInfo();
    exit("SQLError:".$error[2]);
}  




//リダイレクト関数: redirect($file_name)
function redirect($file_name){
    header("Location: ".$file_name);
    exit();
    }






