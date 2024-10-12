<?php
// Inicia sessão
session_start();
// Verifica se a sessão foi criada
if(!isset($_SESSION['id'])){
    // Se não foi criada a sessão, redireciona para a página inicial
    header("location: index.php");
}

//Conexão com o banco de dados
$db = new mysqli("localhost", "root", "", "pokemons_dataset");
    
//Query de consulta
$stmt = $db->prepare("select * from pokemon");
$stmt->execute();
//Executa a consulta e armazena o resultado
$resultado = $stmt->get_result();

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bem Vindo</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
    <div class='container'>
    <h1>Espécies nativas de Kanto</h1>
    
    <?php

    echo "<a href='meus_pokemon.php'>Ver seus Pokemon</a>";

    if($resultado->num_rows == 0){
        echo "Não há pokemon cadastrados";
    } else {
        $pokemons = $resultado->fetch_all(MYSQLI_ASSOC);
        echo "<table border='1'>"; // Adicionei uma borda para facilitar a visualização
        echo "<tr>
            <th>Nome</th>
            <th>Attack</th>
            <th>Defense</th>
            <th>Type</th>
            <th>Legendary</th>
        </tr>";
        
        foreach($pokemons as $pkmn){
            echo "<tr>";
            echo "<td>{$pkmn['Name']}</td>";
            echo "<td>{$pkmn['Attack']}</td>";
            echo "<td>{$pkmn['Defense']}</td>";
            echo "<td>{$pkmn['Type']}</td>";
            echo "<td>{$pkmn['Is_legendary']}</td>";
            echo "</tr>";
        }
        
        echo "</table>"; // Fechando a tabela corretamente
    }
    ?>