<?php
include_once 'db.php';

class Amount extends DB {    
    function obtenerPasosPorID($id_receta) {
        $query = $this->conectarDB()->query("SELECT Amount.amount_id, Amount.amount_amount, Amount.amount_unit, Amount.amount_description, Ingredient.ingredient_name, Recipe.recipe_name, Ingredient.ingredient_id FROM Amount JOIN Ingredient ON Amount.ingredient_id = Ingredient.ingredient_id JOIN Recipe ON Amount.recipe_id = Recipe.recipe_id WHERE Recipe.recipe_id = '$id_receta'");

        return $query;
    }
}
?>