<?php
include_once 'db.php';

class Ingredient extends DB {
    function obtenerIngredientes() {
        $query = $this->conectarDB()->query('SELECT * FROM ingredient');

        return $query;
    }
    
    function obtenerIngredientePorID($id) {
        $query = $this->conectarDB()->query("SELECT * FROM ingredient WHERE ingredient_id = $id");

        return $query;
    }
    
    function agregarConsumoIngrediente($cantidad_usada, $id_ingrediente) {
        $query = $this->conectarDB()->query("UPDATE Ingredient SET ingredient_amount = ingredient_amount - $cantidad_usada WHERE ingredient_id = $id_ingrediente");

        return $query;
    }
}

?>