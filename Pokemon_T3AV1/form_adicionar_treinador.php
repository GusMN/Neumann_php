<?php 
if(isset($_POST['botao'])){
        
    //Sanitiza as variáveis recebidas
    $email = filter_var($_POST['email'],FILTER_SANITIZE_EMAIL);
    $senha = htmlspecialchars($_POST['senha']);

    //Conecta com o banco
    $db = new mysqli('localhost','root','','pokemons_dataset');
    
    //Gera uma variável criptografada
    $password_hash = password_hash($_POST['senha'],PASSWORD_BCRYPT);
    
    //Prepara a query
    $stmt = $db->prepare("insert into pessoa (email,senha) values (?,?)");
    
    /* Insere as variáveis de forma segura
    ss é String String
    https://www.php.net/manual/pt_BR/mysqli-stmt.bind-param.php
    */
    $stmt->bind_param("ss",$email,$password_hash);

    //Executa
    $stmt->execute();

    //Redireciona
    header("location: index.php");
}  
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar treinador</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
    <div class='container'>
        <div class='box'>
            <h1>Adicionar treinador</h1>
            <form method='post' action='form_adicionar_treinador.php'>
                <label>E-mail:</label>
                <input type='text' name='email' required>
                <label>Senha:</label>
                <input type='password' name='senha' required>
                <div class='grupo_botao'>
                    <input type='submit' name='botao' value='Adicionar'>
                </div>
                <a href='index.php'>Voltar</a>
            </form>
        </div>
    </div>
</body>
</html>

