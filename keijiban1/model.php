<?php
Class Db{
  private static $statement='INSERT INTO comments SET comment=?, created_at=NOW()';
  private static $comments='SELECT * FROM comments ORDER BY id DESC LIMIT ?,5';
  private static $counts='SELECT COUNT(*) AS cnt FROM comments';
  private static $pdo;
  public function __construct(){
    try{
      self::$pdo = new PDO('mysql:dbname=keijiban1;host=127.0.0.1;charset=utf8','root','root');

    }catch(PDOException $e){
      echo 'DB接続エラー：'.$e->getMessage();
    }
  }
  //コメントをデータベースに登録
  public static function inputdb(){
    $stmtI=self::$pdo->prepare(self::$statement);
    $stmtI->execute(array($_POST['comment']));
  }
  //データベースからコメント取り出し
  public static function outputdb($start){
    $stmtO=self::$pdo->prepare(self::$comments);
    $stmtO->bindParam(1,$start,PDO::PARAM_INT);
    $stmtO->execute();
    //コメント、時間を繰り返し表示
    while($comment=$stmtO->fetch()){
        print('<p>');
        print($comment['comment']);
        print('</p>');

        print('<time>');
        print($comment['created_at']);
        print('</time>');
        print('<hr>');
     }
  }
  //コメントの数を把握
  public static function countdb(){

    $stmtC=self::$pdo->query(self::$counts);
    $count=$stmtC->fetch();
    return $count;
}

}

?>
