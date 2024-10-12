<?php 
session_start();
if(!isset($_SESSION['id'])){
    header("location: index.php");
    exit();
}

// Conectar ao banco de dados
$db = new mysqli("localhost", "root", "", "pokemons_dataset");

if ($db->connect_error) {
    die("Erro de conexão: " . $db->connect_error);
}

// Verifique se um Pokémon foi selecionado para edição
$pokedex_number = null;
$pkmn = null;

if (isset($_POST['pokedex_number'])) {
    $pokedex_number = filter_var($_POST['pokedex_number'], FILTER_SANITIZE_NUMBER_INT);

    // Preparar consulta para buscar o Pokémon selecionado
    $stmt = $db->prepare("SELECT * FROM pokemon WHERE Pokedex_number = ?");
    $stmt->bind_param("i", $pokedex_number);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $pkmn = $resultado->fetch_assoc(); // Obter dados do Pokémon selecionado
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Pokemon</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
    <div class='container'>
        <div class='box'>
            <h1>Editar Nome do Pokémon</h1>

            <!-- Formulário para selecionar o Pokémon -->
            <form method="post" action="form_editPokemon.php">
                <label for="pokedex_number">Selecione o Pokémon:</label>
                <?php
                $query = "SELECT Name, Pokedex_number FROM pokemon";
                $result = $db->query($query);

                if ($result->num_rows > 0) {
                    echo "<select name='pokedex_number' required>";
                    echo "<option value='' disabled selected>Escolha um Pokémon</option>";
                    while ($poke = $result->fetch_assoc()) {
                        $selected = ($poke['Pokedex_number'] == $pokedex_number) ? "selected" : "";
                        echo "<option value='{$poke['Pokedex_number']}' {$selected}>{$poke['Name']}</option>";
                    }
                    echo "</select>";
                } else {
                    echo "Nenhum Pokémon encontrado.";
                }
                ?>
                <br>
                <input type="submit" value="Selecionar Pokémon">
            </form>

            <?php if ($pkmn): ?>
            <!-- Exibir formulário de edição se um Pokémon foi selecionado -->
            <form method="post" action="editPokemon.php">
                <input type="hidden" name="pokedex_number" value="<?php echo $pkmn['Pokedex_number']; ?>">
                <label for="Name">Novo nome do Pokémon:</label>
                <input type="text" name="Name" value="<?php echo htmlspecialchars($pkmn['Name']); ?>" required>
                <br>
                <input type="submit" value="Salvar mudanças">
            </form>
            <?php endif; ?>

            <a href='logout.php'>Sair</a>
            <a href='meus_pokemon.php'>Voltar</a>
        </div>
    </div>
</body>
</html>