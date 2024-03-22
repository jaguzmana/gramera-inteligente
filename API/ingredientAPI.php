<?php
include_once 'ingredient.php';

class IngredientAPI extends Ingredient {

    function empaquetarDatos($res, $ingrediente, $ingredientes) {
        if($res->num_rows > 0) {
            while ($row = $res->fetch_assoc()){
    
                $item = array(
                    "id" => $row['ingredient_id'],
                    "amount" => $row['ingredient_amount'],
                    "name" => $row['ingredient_name'],
                    "density" => $row['ingredient_density'],
                    "unit" => $row['ingredient_unit']
                );
                array_push($ingredientes["items"], $item);
            }
        
            echo json_encode($ingredientes);
        } else {
            echo json_encode(array('mensaje' => 'No hay elementos'));
        }
    }

    function obtenerIngredientesJSON() {
        $ingrediente = new Ingredient();
        $ingredientes = array();
        $ingredientes["items"] = array();

        $res = $ingrediente->obtenerIngredientes();
        $this->empaquetarDatos($res, $ingrediente, $ingredientes);
    }

    function obtenerIngredientePorIDJSON($id) {
        $ingrediente = new Ingredient();
        $ingredientes = array();
        $ingredientes["items"] = array();

        $res = $ingrediente->obtenerIngredientePorID($id);
        $this->empaquetarDatos($res, $ingrediente, $ingredientes);
    }
}