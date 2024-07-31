<?php

$db = new mysqli("localhost","root","","memes");

$query = "delete from meme where id = {$_GET['id']}";
 
$db->query($query);

header("location:index.php");

?>