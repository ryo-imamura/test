<?php

try{
    $db=new PDO('mysql:dbname=keijiban1;host=127.0.0.1;charset=utf8','root','');

}catch(PDOException $e){
    echo 'DB接続エラー：'.$e->getMessage();
}

function inputdb(){
  print('投稿しました');
  //コメントをデータベースに登録
  $statement=$db->prepare('INSERT INTO comments SET comment=?, created_at=NOW()');
  $statement->execute(array($_POST['comment']));
}

function outputdb(){
  //コメントをデータベースから取り出し
  $comments=$db->prepare('SELECT * FROM comments ORDER BY id DESC LIMIT ?,5');
  $comments->bindParam(1,$start,PDO::PARAM_INT);
  $comments->execute();
}
?>
