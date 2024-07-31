<?php

$db = new mysqli("localhost","root","","biblioteca");

$query = "insert into livros (titulo, autor, ano) values ('{$POST['titulo']}','{$POST['autor']}',{$POST['ano']})";
 
$db->query($query);

header("location:index.php");

?>