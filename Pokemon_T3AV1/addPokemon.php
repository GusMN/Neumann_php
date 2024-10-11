<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("location: index.php");
    exit();
}

// Conectar ao banco de dados
$db = new mysqli("localhost", "root", "", "pokemons_dataset");

if ($db->connect_error) {
    die("Erro de conexão: " . $db->connect_error);
}

// Verifique se o id_pessoa está na sessão
$id_pessoa = $_SESSION['id'];

// Verifique se o valor do pokedex_number foi enviado
if (!isset($_POST['pokedex_number'])) {
    die("Erro: Número da Pokédex não foi enviado.");
}

// Preparar a consulta de inserção com o id_pessoa e pokedex_number
$query = $db->prepare("INSERT INTO pessoa_pokemon (id_pessoa, pokedex_number) VALUES (?, ?)");
$query->bind_param("ii", $id_pessoa, $_POST['pokedex_number']);

// Executar a consulta e verificar erros
if (!$query->execute()) {
    die("Erro ao executar a consulta: " . $query->error);
} else {
    echo "Pokémon adicionado com sucesso!";
}

// Opcional: redirecionar de volta após a inserção
header("Location: index.php");
exit();
?>