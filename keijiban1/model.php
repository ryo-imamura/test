<?php

try{
    $db=new PDO('mysql:dbname=keijiban1;host=127.0.0.1;charset=utf8','root','');

    function inputdb(){
      
    }

    function outputdb(){

    }
}catch(PDOException $e){
    echo 'DB接続エラー：'.$e->getMessage();
}


?>
