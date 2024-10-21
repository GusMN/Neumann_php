<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php
if (isset($_POST['search_email'])) {
    // Sanitiza o valor recebido
    $search_email = filter_var($_POST['search_email'], FILTER_SANITIZE_EMAIL);
    
    // Conectar ao banco de dados
    $db = new mysqli("localhost", "root", "", "pokemons_dataset");
    
    if ($db->connect_error) {
        die("Erro de conexão: " . $db->connect_error);
    }

    // Preparar a consulta para buscar treinadores pelo e-mail
    $stmt = $db->prepare("SELECT * FROM pessoa WHERE email LIKE ?");
    $search_param = "%" . $search_email . "%"; // Permite busca parcial
    $stmt->bind_param("s", $search_param);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        echo "<h2>Resultados da Pesquisa:</h2>";
        echo "<table border='1'>";
        echo "<tr><th>ID</th><th>Email</th></tr>";
        
        while ($treinador = $resultado->fetch_assoc()) {
            echo "<tr>";
            echo "<td>{$treinador['id_pessoa']}</td>";
            echo "<td>{$treinador['email']}</td>";
            echo "</tr>";
        }
        
        echo "</table>";
    } else {
        echo "Nenhum treinador encontrado com esse e-mail.";
    }

    // Fechar a conexão
    $stmt->close();
    $db->close();
}
?>

<div class='container'>
    <div class='box'>
    <form method="post" action="pesquisa.php">
            <label for="search_email">Pesquisar por E-mail:</label>
            <input type="email" name="search_email" id="search_email" required>
            <input type="submit" value="Pesquisar">
    </form>
    </div>
</div>
</body>
</html>

