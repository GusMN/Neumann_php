<?php 
session_start();
if (!isset($_SESSION['id'])) {
    header("location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Pokemon</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class ='container'>
        <div class='box'>
<h1>Adicione novo Pokemon aqui!</h1>
    <form method='post' action='addPokemon.php'>
        <label for="pokedex_number">Pokemon:</label>
        
        <?php
        // Conectar ao banco de dados
        $db = new mysqli("localhost", "root", "", "pokemons_dataset");

        if ($db->connect_error) {
            die("Erro de conexão: " . $db->connect_error);
        }

        // Consulta para buscar todos os pokémon
        $query = "SELECT pokemon.Name, pokemon.Pokedex_number FROM pokemon";
        $result = $db->query($query);

        if ($result->num_rows > 0) {
            echo "<select name='pokedex_number'>";
            while ($poke = $result->fetch_assoc()) {
                echo "<option value='{$poke['Pokedex_number']}'>{$poke['Name']}</option>";
            }
            echo "</select>";
        } else {
            echo "Nenhum Pokémon encontrado.";
        }

        // Fechar a conexão com o banco de dados
        $db->close();
        ?>
        <br>
        <input type="submit" name="botao" value="Adicionar">
    </form>
    </div>
</div>
</body>
</html>
