<?php require('dbconnect.php'); ?>
<!DOCTYPE HTML PUBLIC"-//W3C//DTD HTML 4.01 Transitional//EN">
<HTML>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>掲示板１</title>
</head>
<body>
    <main>
        <h2>掲示板１</h2>
        <form action="" method="post">
            <p>コメント入力</p>
            <textarea name="comment" cols="50" rows="5" placeholder="良識あるコメントを心がけて書き込むようにしてください"></textarea><br>
            <button type="submit">投稿する</button>
        </form>
        <hr size="2" color="black">
        <?php

        if(isset($_POST['comment'])){
            print('投稿しました');
            //コメントをデータベースに登録
            $statement=$db->prepare('INSERT INTO comments SET comment=?, created_at=NOW()');
            $statement->execute(array($_POST['comment']));
        }else{
            
        }

        
        //コメントをデータベースから取り出し
        if(isset($_REQUEST['page']) && is_numeric($_REQUEST['page'])){
            $page=$_REQUEST['page'];
        }else{
            $page=1;
        }
        $start=5*($page-1);
        $comments=$db->prepare('SELECT * FROM comments ORDER BY id DESC LIMIT ?,5');
        $comments->bindParam(1,$start,PDO::PARAM_INT);
        $comments->execute();
        ?>

        <?php while($comment=$comments->fetch()): ?>
            <p>
                <?php print($comment['comment']) ?>
            </p>
            <time><?php print($comment['created_at']); ?></time>
            <hr>
        <?php endwhile; ?>
        
        <?php
        ////２ページ目以降なら前のページを表示する（１ページ目は表示しない）
        if($page>=2):
         ?>
        <a href="index.php?page=<?php print($page-1); ?>">前へ</a >
        <?php endif; ?>
        
        <?php
        //最終ページは表示コメント数／5の繰り上げで表示
        $counts=$db->query('SELECT COUNT(*) AS cnt FROM comments');
        $count=$counts->fetch();
        $max_page=ceil($count['cnt']/5);
        //現在のページ＜最終ページなら次ページを表示する
        if($page<$max_page):
        ?>
        <a href="index.php?page=<?php print($page+1); ?>">次へ</a>
        <?php endif; ?>

    </main>
</body>
</html>

