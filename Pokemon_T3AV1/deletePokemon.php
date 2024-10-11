<?php 
session_start();
if(!isset($_SESSION['id'])){
    header("location: index.php");
}

    if(isset($_GET)){
        //Conexão com o banco de dados
        $db = new mysqli("localhost", "root", "", "pokemons_dataset");
        
        $Pokedex_number = filter_var($_GET['Pokedex_number'],FILTER_SANITIZE_NUMBER_INT);
        
        $stmt = $db->prepare("delete from pokemon where Pokedex_number = ?");
        
        $stmt->bind_param("i",$Pokedex_number);
        
        $stmt->execute();

        header("location:lista_pokemon.php");
    }
?>