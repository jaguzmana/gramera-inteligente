<?php
include_once 'ingredientAPI.php';
include_once 'amountAPI.php';
include_once 'consume.php';

if(isset($_GET['action'])) {    
    switch ($_GET['action']) {
        case 'obtenerIngredientesJSON':
            $ingredientAPI = new IngredientAPI();
            $ingredientAPI->obtenerIngredientesJSON();
            break;
        case 'obtenerIngredientePorIDJSON':
            $ingredientAPI = new IngredientAPI();
            $ingredientAPI->obtenerIngredientePorIDJSON($_GET['id']);
            break;
        case 'agregarConsumo':
            $consume = new Consume();
            // Obtener el cuerpo de la solicitud HTTP
            $datosJSON = file_get_contents("php://input");
    
            // Decodificar el JSON recibido
            $datos = json_decode($datosJSON, true);
    
            $consume->agregarConsumo($_GET['datetime'], $_GET['amount'], $_GET['unit'], $_GET['ingredient_id']);
            break;
        case 'obtenerPasosPorID':
            $amount = new amountAPI();
            $amount->obtenerPasosPorIDJSON($_GET['recipe_id']);
            break;
        case 'agregarConsumoIngrediente':
            $ingredient = new IngredientAPI();
            $ingredient->agregarConsumoIngrediente($_GET['cantidad_usada'], $_GET['id_ingrediente']);
            break;
        default:
            echo json_encode(array('error' => 'Acción no válida'));
            break;
    }
} else {
    echo json_encode(array('error' => 'No se proporcionó ninguna acción'));
}
?>