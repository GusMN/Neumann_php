<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exemplo</title>
</head>
<body>
    
<?php
    $frutas = array("Maçã", "Amora", "Uva");
    $frutas[] = "Abacaxi";
    $frutas[] = "Melão";
    foreach ($frutas as $fruta){
    echo $fruta."<br>";
    }
?>

</body>
</html>