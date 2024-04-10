<?php
include_once '../API/db.php';

if(!empty($_GET)) {
    $db = new DB();
    $con = $db->conectarDB();
    $id = $_GET["id"];

    $sql = "SELECT Ingredient.ingredient_name, Ingredient.ingredient_amount AS cantidad_disponible, Amount.amount_amount AS cantidad_requerida FROM Recipe JOIN Amount ON Recipe.recipe_id = Amount.recipe_id JOIN Ingredient ON Amount.ingredient_id = Ingredient.ingredient_id WHERE Recipe.recipe_id = $id GROUP BY Ingredient.ingredient_id HAVING cantidad_disponible < cantidad_requerida";

    $query = $con->query($sql);

    // Crear un arreglo para almacenar los resultados
    $resultados = array();

    // Recorrer los resultados y almacenarlos en el arreglo
    while ($r = $query->fetch_assoc()) {
        $resultados[] = $r;
    }

    // Convertir el arreglo a formato JSON
    $json_resultados = json_encode($resultados);

    // Imprimir el JSON resultante
    echo $json_resultados;
}
?>