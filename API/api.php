<?php
include_once 'ingredientAPI.php';

if(isset($_GET['action'])) {
    $ingredientAPI = new IngredientAPI();
        
    switch ($_GET['action']) {
        case 'obtenerIngredientesJSON':
            $ingredientAPI->obtenerIngredientesJSON();
            break;
        case 'obtenerIngredientePorIDJSON':
            $ingredientAPI->obtenerIngredientePorIDJSON($_GET['id']);
            break;
        default:
            echo json_encode(array('error' => 'Acción no válida'));
            break;
    }
} else {
    echo json_encode(array('error' => 'No se proporcionó ninguna acción'));
}
?>