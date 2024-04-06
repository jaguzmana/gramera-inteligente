<?php
include_once 'amount.php';

class AmountAPI extends Amount {

    function empaquetarDatos($res, $cantidad, $cantidades) {
        if($res->num_rows > 0) {
            while ($row = $res->fetch_assoc()){
    
                $item = array(
                    "id" => $row['amount_id'],
                    "amount" => $row['amount_amount'],
                    "unit" => $row['amount_unit'],
                    "description" => $row['amount_description'],
                    "nombre_ingrediente" => $row['ingredient_name'],
                    "recipe_name" => $row['recipe_name'],
                    "id_ingrediente" => $row['ingredient_id']
                );
                array_push($cantidades["items"], $item);
            }
        
            echo json_encode($cantidades);
        } else {
            echo json_encode(array('mensaje' => 'No hay elementos'));
        }
    }

    function obtenerPasosPorIDJSON($id_receta) {
        $cantidad = new Amount();
        $cantidades = array();
        $cantidades["items"] = array();

        $res = $cantidad->obtenerPasosPorID($id_receta);
        $this->empaquetarDatos($res, $cantidad, $cantidades);
    }
}