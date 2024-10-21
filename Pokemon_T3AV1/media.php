<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nédia</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class='container'>
    <div class='box'></div>
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

// Obter o ID da pessoa logada
$id_pessoa = $_SESSION['id'];

// Consulta para calcular a média de Attack e Defense dos Pokémon que o usuário possui
$query = "
    SELECT AVG(pokemon.Attack) AS avg_attack, AVG(pokemon.Defense) AS avg_defense
    FROM pessoa_pokemon
    INNER JOIN pokemon ON pessoa_pokemon.pokedex_number = pokemon.Pokedex_number
    WHERE pessoa_pokemon.id_pessoa = ?
";

$stmt = $db->prepare($query);
$stmt->bind_param("i", $id_pessoa);
$stmt->execute();
$result = $stmt->get_result();
$averages = $result->fetch_assoc();

if ($averages) {
    echo "<h2>Médias dos Pokémon do usuário:</h2>";
    echo "<p>Média de Attack: " . number_format($averages['avg_attack'], 2) . "</p>";
    echo "<p>Média de Defense: " . number_format($averages['avg_defense'], 2) . "</p>";
} else {
    echo "Nenhum Pokémon encontrado para este usuário.";
}

// Fechar conexão
$db->close();
?>
        </div>
    </div>
</body>
</html>
