<?php require('model.php'); ?>
<?php require('template.html'); ?>


<?php
        if(isset($_POST['comment'])){
          inputdb();
        }else{

        }


        if(isset($_REQUEST['page']) && is_numeric($_REQUEST['page'])){
            $page=$_REQUEST['page'];
        }else{
            $page=1;
        }
        $start=5*($page-1);
          outputdb();
        ?>

        <?php //コメント、時間を繰り返し表示 ?>
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
        <a href="comment.php?page=<?php print($page-1); ?>">前へ</a >
        <?php endif; ?>

        <?php
        //最終ページは表示コメント数／5の繰り上げで表示
        $counts=$db->query('SELECT COUNT(*) AS cnt FROM comments');
        $count=$counts->fetch();
        $max_page=ceil($count['cnt']/5);
        //現在のページ＜最終ページなら次ページを表示する
        if($page<$max_page):
        ?>
        <a href="comment.php?page=<?php print($page+1); ?>">次へ</a>
        <?php endif; ?>
