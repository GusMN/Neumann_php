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
    
    //Tenho que testar---> "join pokemon on pessoa_pokemon.pokedex_number = pokemon.Pokedex_number" em algum lugar...
    $stmt = $db->prepare("select * from pessoa_pokemon where id_pessoa = ?");
    $stmt->bind_param("i",$_SESSION['id']);
    $stmt->execute();
    //Executa a consulta e armazena o resultado
    $resultado = $stmt->get_result();
    ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seus Pokemon</title>
    <link rel="stylesheet" type="text/css" href="style.css" /> 
</head>
<body>
    <div class='container'>
    <h1>Seus Pokemon</h1>
    <?php 
    if($resultado->num_rows == 0){
        echo "Você ainda não tem nenhum Pokemon :(";
        echo "<a href='form_addPokemon.php?'>Adicionar novo Pokemon</a>";
    } else {
        $pokemons = $resultado->fetch_all(MYSQLI_ASSOC);
        echo "<table border='1'>"; // Adicionei uma borda para facilitar a visualização
        echo "<tr>
            <th>Nome</th>
            <th>Attack</th>
            <th>Defense</th>
            <th>Type</th>
            <th>Legendary</th>
            <th>Ações</th> <!-- Para indicar que essa coluna é das ações -->
        </tr>";
        
        foreach($pokemons as $pkmn){
            echo "<tr>";
            echo "<td>{$pkmn['Name']}</td>";
            echo "<td>{$pkmn['Attack']}</td>";
            echo "<td>{$pkmn['Defense']}</td>";
            echo "<td>{$pkmn['Type']}</td>";
            echo "<td>{$pkmn['Is_legendary']}</td>";
            echo "<td>
        <a href='deletePokemon.php?Pokedex_number={$pkmn['Pokedex_number']}'>Apagar</a>
        <a href='form_editar_pokemon.php?Pokedex_number={$pkmn['Pokedex_number']}'>Editar</a>
        <a href='form_addPokemon.php?'>Adicionar novo Pokemon</a>;
            </td>";
            echo "</tr>";
        }
        
        echo "</table>"; // Fechando a tabela corretamente
    }