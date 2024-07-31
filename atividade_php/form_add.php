<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Meme</title>
</head>
<body>
    <form method='post' action='addMeme.php'>
        <label for=imagem>URL da imagem</label>
        <input type=text id=titulo required name=titulo>
        <br>
        <label for=texto>Texto</label>
        <input type=text id=texto required name=texto>
        <br>
        <input type=submit name=botao value='Adicionar'>
    </form>
</body>
</html>