<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("location: index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Conectar ao banco de dados
    $db = new mysqli("localhost", "root", "", "pokemons_dataset");

    if ($db->connect_error) {
        die("Erro de conexão: " . $db->connect_error);
    }

    // Obter o número da Pokédex e o novo nome
    $pokedex_number = filter_var($_POST['pokedex_number'], FILTER_SANITIZE_NUMBER_INT);
    $name = filter_var($_POST['Name'], FILTER_SANITIZE_STRING);

    // Preparar a consulta de atualização (apenas o nome)
    $stmt = $db->prepare("UPDATE pokemon SET Name = ? WHERE Pokedex_number = ?");
    $stmt->bind_param("si", $name, $pokedex_number);

    // Executar a consulta
    if ($stmt->execute()) {
        if ($stmt->affected_rows > 0) {
            echo "Nome do Pokémon atualizado com sucesso!";
        } else {
            echo "Nenhum registro foi atualizado. Verifique se o Pokedex_number é válido.";
        }
    } else {
        echo "Erro ao atualizar o nome do Pokémon: " . $stmt->error;
    }

    // Fechar a conexão
    $db->close();

    // Redirecionar após a mensagem de sucesso
    header("Location: meus_pokemon.php");
    exit();
} else {
    echo "Método de requisição inválido.";
}
?>