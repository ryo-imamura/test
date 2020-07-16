<?php require('model.php');
      require('template.html');



        if(isset($_POST['comment'])){
          print('投稿しました');
          //inputdb();
          //コメントをデータベースに登録
          $statement=$db->prepare('INSERT INTO comments SET comment=?, created_at=NOW()');
          $statement->execute(array($_POST['comment']));
        }else{

        }


        if(isset($_REQUEST['page']) && is_numeric($_REQUEST['page'])){
            $page=$_REQUEST['page'];
        }else{
            $page=1;
        }
        $start=5*($page-1);
        //outputdb();
        //コメントをデータベースから取り出し
        $comments=$db->prepare('SELECT * FROM comments ORDER BY id DESC LIMIT ?,5');
        $comments->bindParam(1,$start,PDO::PARAM_INT);
        $comments->execute();

        //コメント、時間を繰り返し表示
        while($comment=$comments->fetch()){
            print('<p>');
            print($comment['comment']);
            print('</p>');

            print('<time>');
            print($comment['created_at']);
            print('</time>');
            print('<hr>');
         }


        ////２ページ目以降なら前のページを表示する（１ページ目は表示しない）
        if($page>=2){

        print('<a href="comment.php?page='.($page-1).'">前へ</a >');
        }

        //最終ページは表示コメント数／5の繰り上げで表示
        $counts=$db->query('SELECT COUNT(*) AS cnt FROM comments');
        $count=$counts->fetch();
        $max_page=ceil($count['cnt']/5);
        //現在のページ＜最終ページなら次ページを表示する
        if($page<$max_page){
        print('<a href="comment.php?page='.($page+1).'">次へ</a>');
        }

?>
