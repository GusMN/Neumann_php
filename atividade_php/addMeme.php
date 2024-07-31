<?php

$db = new mysqli("localhost","root","","memes");

$query = "insert into meme (imagem, texto) values ('{$_POST['imagem']}','{$_POST['texto']}";
 
$db->query($query);

header("location:index.php");

?>