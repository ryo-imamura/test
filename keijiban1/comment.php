<?php
      require('model.php');
      require('template.html');



        if(isset($_POST['comment'])){
          print('投稿しました<br>');
          $db=new Db;
          $db->inputdb();
        }else{

        }

        if(isset($_REQUEST['page']) && is_numeric($_REQUEST['page'])){
            $page=$_REQUEST['page'];
        }else{
            $page=1;
        }
        $db=new Db;
        $db->outputdb(5*($page-1));

        ////２ページ目以降なら前のページを表示する（１ページ目は表示しない）
        if($page>=2){

        print('<a href="comment.php?page='.($page-1).'">前へ</a >');
        }

        //最終ページは表示コメント数／5の繰り上げで表示
        $db=new Db;
        $max_page=ceil($db->countdb()['cnt']/5);

        //現在のページ＜最終ページなら次ページを表示する
        if($page<$max_page){
        print('<a href="comment.php?page='.($page+1).'">次へ</a>');
        }

?>
