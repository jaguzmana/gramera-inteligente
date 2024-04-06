<?php
include_once 'db.php';

class Recipe extends DB {
    function obtenerRecetas() {
        $query = $this->conectarDB()->query('SELECT * FROM recipe');

        return $query;
    }
}
?>