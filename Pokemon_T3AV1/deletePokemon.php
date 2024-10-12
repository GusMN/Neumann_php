<?php 
session_start();
if(!isset($_SESSION['id'])){
    header("location: index.php");
    exit();
}

// Verificar se o parâmetro Pokedex_number foi passado na URL
if (isset($_GET['Pokedex_number'])) {
    // Conectar ao banco de dados
    $db = new mysqli("localhost", "root", "", "pokemons_dataset");
    
    if ($db->connect_error) {
        die("Erro de conexão: " . $db->connect_error);
    }

    // Sanitizar o valor de Pokedex_number
    $Pokedex_number = filter_var($_GET['Pokedex_number'], FILTER_SANITIZE_NUMBER_INT);
    
    // Preparar a consulta de exclusão
    $stmt = $db->prepare("DELETE FROM pokemon WHERE Pokedex_number = ?");
    
    if ($stmt === false) {
        die("Erro na preparação da consulta: " . $db->error);
    }

    // Vincular o parâmetro e executar a consulta
    $stmt->bind_param("i", $Pokedex_number);

    if ($stmt->execute()) {
        // Verificar se alguma linha foi afetada (excluída)
        if ($stmt->affected_rows > 0) {
            echo "Pokémon excluído com sucesso!";
        } else {
            echo "Nenhum Pokémon encontrado com o número da Pokédex fornecido.";
        }
    } else {
        echo "Erro ao excluir o Pokémon: " . $stmt->error;
    }

    // Fechar o statement e a conexão com o banco de dados
    $stmt->close();
    $db->close();

    // Redirecionar de volta à página meus_pokemon.php
    header("Location: meus_pokemon.php");
    exit();
} else {
    echo "Nenhum Pokémon foi selecionado para exclusão.";
}
?>