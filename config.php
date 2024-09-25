<?php

use function PHPSTORM_META\expectedArguments;

$dsn="mysql:dbname=rehper;host=localhost";
$user ="root";
$password="samet123";

try{
    $db=new PDO($dsn,$user,$password);
    //echo "baglandı";
}catch(PDOException $e){
    echo "baglantı saglanamadı".$e->getMessage();

}


?>