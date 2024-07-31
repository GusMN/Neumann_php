

<?php

$db = new mysqli("localhost","root","","memes");

$query = "select * from meme";

$meme = $db->query($query);
    

echo "<table>";
echo "<tr>
    <td>imagem</td>    
    <td>texto</td>
    <td>id</td>
    <td>ação</td>
</tr>";


    foreach($meme as $m){
        echo "<tr>";
       echo "<td><figure> <img src='{$m['imagem']}'> </figure></td>";
        echo "<td>{$m['texto']}</td>";
        echo "<td>{$m['id']}</td>";
        echo "<a href='delMeme.php?id={$m['id']}'>Apagar</a>";
        echo "</tr>";
    }
    
    
echo "</table>";

echo "<a href='form_add.php'>Adicionar novo meme</a>";

    
?>