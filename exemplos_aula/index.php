<link rel="stylesheet" href="style.css">

<?php

$db = new mysqli("localhost","root","","biblioteca");

$livros = $db->query($query);
    

echo "<table>";
echo "<tr>
    <td>Título</td>
    <td>Autor</td>
    <td>Ano</td>
    <td>Id</td>
</tr>";


foreach($livros as $livro){
echo"<tr>";
    echo "<td>{$livro['titulo']}</td>";
    echo "<td>{$livro['autor']}</td>";
    echo "<td>{$livro['ano']}</td>";
    echo "<td>{$livro['idLivro']}</td>";
echo "</tr>";
    
}

?>