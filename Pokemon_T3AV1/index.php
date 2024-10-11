<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css" />
    <title>Pokedex Social</title>
</head>
<body>
    <div class='container'>
        <div class='box'>
            <h1>Bom dia!</h1>
            <form action='login.php' method='post'>
                <label>E-mail:</label>
                <input type='text' name='email' required>
                <label>Senha:</label>
                <input type='password' name='senha' required>
                <div class='grupo_botao'>
                    <input type='submit' name='botao' value='Acessar'>
                </div>
                <a href='form_adicionar_treinador.php'>Adicionar novo treinador</a>
                
            </form>
        </div>
    </div>
</body>
</html>