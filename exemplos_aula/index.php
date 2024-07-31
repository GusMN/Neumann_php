<link rel="stylesheet" href="style.css">

<?php

$db = new mysqli("localhost","root","","biblioteca");

$query = "select * from livros";

$livros = $db->query($query);
    

echo "<table>";
echo "<tr>
    <td>Título</td>
    <td>Autor</td>
    <td>Ano</td>
    <td>Id</td>
    <td>Ação</td>
</tr>";



    foreach($livros as $livro){
    echo"<tr>";
        echo "<td>{$livro['titulo']}</td>";
        echo "<td>{$livro['autor']}</td>";
        echo "<td>{$livro['ano']}</td>";
        echo "<td>{$livro['idLivro']}</td>";
        echo "<td><a href='delLivro.php?idLivro={$livro['idLivro']}'>Apagar</a>
    </td>";
    echo "</tr>";
    
}
echo "</table>";

echo "<a href='form_add.php'>Adicionar novo livro</a>";


?>