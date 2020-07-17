<?php

try{
    $db=new PDO('mysql:dbname=keijiban1;host=127.0.0.1;charset=utf8','root','');


}catch(PDOException $e){
    echo 'DB接続エラー：'.$e->getMessage();
}

function inputdb(){
  //コメントをデータベースに登録
  global $db;
  $statement=$db->prepare('INSERT INTO comments SET comment=?, created_at=NOW()');
  $statement->execute(array($_POST['comment']));
}

function outputdb(){
  //コメントをデータベースから取り出し
  global $comments;
  global $db;
  global $start;
  $comments=$db->prepare('SELECT * FROM comments ORDER BY id DESC LIMIT ?,5');
  $comments->bindParam(1,$start,PDO::PARAM_INT);
  $comments->execute();
}

function countdb(){
  global $db;
  global $counts;
  $counts=$db->query('SELECT COUNT(*) AS cnt FROM comments');
}
?>
