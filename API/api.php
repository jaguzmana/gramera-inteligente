<?php
include_once 'ingredientAPI.php';
include_once 'consume.php';

if(isset($_GET['action'])) {
    $ingredientAPI = new IngredientAPI();
        
    switch ($_GET['action']) {
        case 'obtenerIngredientesJSON':
            $ingredientAPI->obtenerIngredientesJSON();
            break;
        case 'obtenerIngredientePorIDJSON':
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
        default:
            echo json_encode(array('error' => 'Acción no válida'));
            break;
    }
} else {
    echo json_encode(array('error' => 'No se proporcionó ninguna acción'));
}
?>