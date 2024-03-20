<?php
    if(!empty($_POST)){
        if(isset($_POST["paso-receta-ingrediente-id"]) && isset($_POST["paso-receta-cantidad-ingrediente"]) && isset($_POST["paso-receta-unidad-ingrediente"]) && isset($_POST["paso-receta-descripcion"]) && isset($_POST["paso-receta-receta-id"])){
                $host = "localhost";
                $user = "root";
                $password = "samc2003";
                $db = "pesoPlumaDb";
                $con = new mysqli($host, $user, $password, $db);
        
                $pasoRecetaIngredienteId = $_POST["paso-receta-ingrediente-id"];
                $pasoRecetaRecetaId = $_POST["paso-receta-receta-id"];
                $pasoRecetaCantidadIngrediente = $_POST["paso-receta-cantidad-ingrediente"];
                $pasoRecetaUnidadIngrediente = $_POST["paso-receta-unidad-ingrediente"];
                $pasoRecetaDescripcion = $_POST["paso-receta-descripcion"];
                $sql = "INSERT INTO Amount (amount_amount, amount_unit, amount_description, ingredient_id, recipe_id) VALUES ('$pasoRecetaCantidadIngrediente', '$pasoRecetaUnidadIngrediente', '$pasoRecetaDescripcion', '$pasoRecetaIngredienteId', '$pasoRecetaRecetaId');";
                
                try {
                    $query = $con->query($sql);
                    print "<script>alert(\"Agregado exitosamente.\");window.location='editarview.php?id=$pasoRecetaRecetaId';</script>";
                } catch (Exception $e){
                    $error = mysqli_error($con);
                    print "<script>alert(\"Error al agregar: $error \");window.location='editarview.php?id=$pasoRecetaRecetaId';</script>";
                }
        
        }
    }

?>
