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
}

?>