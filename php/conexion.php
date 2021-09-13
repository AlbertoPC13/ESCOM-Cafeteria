<?php

$link = 'mysql:host=localhost;dbname=tw;charset=utf8';
$usuario ='root';
$pass = '';

try{
    $pdo = new PDO($link,$usuario,$pass);
}
catch(PDOException $e){
    print "¡Error!: " . $e->getMessage() . "<br/r>";
}

