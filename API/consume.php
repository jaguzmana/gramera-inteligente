<?php

class Consume extends DB {
    function agregarConsumo($datetime, $amount, $unit, $ingredient_id) {
        $query = $this->conectarDB()->query("INSERT INTO Consume (consume_date, consume_amount, consume_unit, ingredient_id) VALUES
        ($datetime, $amount, $unit, $ingredient_id)");

        return $query;
    }
}

?>