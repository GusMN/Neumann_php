<?php

$db = new mysqli("localhost","root","","biblioteca");

$query = "delete from livros where idLivro = {$_GET['idLivro']}";
 
$db->query($query);

header("location:index.php");

?>