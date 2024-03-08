<?php
    if(!empty($_POST)){
        if(isset($_POST["nombre-ingrediente"]) && isset($_POST["cantidad-ingrediente"]) && isset($_POST["unidad-ingrediente"]) && isset($_POST["densidad-ingrediente"])){
                $host = "localhost";
                $user = "root";
                $password = "samc2003";
                $db = "pesoPlumaDb";
                $con = new mysqli($host, $user, $password, $db);
        
                $nombreingrediente = $_POST["nombre-ingrediente"];
                $cantidadingrediente = $_POST["cantidad-ingrediente"];
                $unidadingrediente = $_POST["unidad-ingrediente"];
                $densidadingrediente = $_POST["densidad-ingrediente"];
                $sql = "INSERT INTO Ingredient (ingredient_name, ingredient_amount, ingredient_unit, ingredient_density) VALUES ('$nombreingrediente', '$cantidadingrediente', '$unidadingrediente', '$densidadingrediente');";
                
                try {
                    $query = $con->query($sql);
                    print "<script>alert(\"Agregado exitosamente.\");window.location='index.php';</script>";
                } catch (Exception $e){
                    $error = mysqli_error($con);
                    print "<script>alert('Error al agregar: $error');window.location = 'index.php';</script>";                }
        
        }
    }

?>
