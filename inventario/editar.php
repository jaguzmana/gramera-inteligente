<?php
    if(!empty($_POST)){
        if(isset($_POST["id-ingrediente"]) && isset($_POST["nombre-ingrediente"]) && isset($_POST["cantidad-ingrediente"]) && isset($_POST["unidad-ingrediente"]) && isset($_POST["densidad-ingrediente"])){
                $host = "localhost";
                $user = "root";
                $password = "samc2003";
                $db = "pesoPlumaDb";
                $con = new mysqli($host, $user, $password, $db);
                //$sql= "select * from estudiantes";
                //$query = $con->query($sql);
                $idingrediente = $_POST["id-ingrediente"];
                $nombreingrediente = $_POST["nombre-ingrediente"];
                $cantidadingrediente = $_POST["cantidad-ingrediente"];
                $unidadingrediente = $_POST["unidad-ingrediente"];
                $densidadingrediente = $_POST["densidad-ingrediente"];
                $sql = "UPDATE Ingredient SET ingredient_name = '$nombreingrediente', ingredient_amount = '$cantidadingrediente', ingredient_unit = '$unidadingrediente', ingredient_density = '$densidadingrediente' WHERE ingredient_id = '$idingrediente';";
                
                try {
                    $query = $con->query($sql);
                    print "<script>alert(\"Editado exitosamente.\");window.location='index.php';</script>";
                } catch (Exception $e){
                    $error = mysqli_error($con);
                    print "<script>alert(\"No se pudo Editar.\");window.location='index.php';</script>";
                }
        
        }
    }

?>