<?php

$db = new mysqli("localhost","root","","biblioteca");

$query = "insert into livros (titulo, autor, ano) values ('{$_POST['titulo']}','{$_POST['autor']}',{$_POST['ano']})";
 
$db->query($query);

header("location:index.php");

?>