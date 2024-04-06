<?php
include_once '../API/db.php';

    if(!empty($_POST)){
        if(isset($_POST["nombre-receta"])){
                $db = new DB();
                $con = $db->conectarDB();
        
                $nombrereceta = $_POST["nombre-receta"];
                $sql = "INSERT INTO Recipe (recipe_name) VALUES ('$nombrereceta');";
                
                try {
                    $query = $con->query($sql);
                    print "<script>alert(\"Agregado exitosamente.\");window.location='administrar.php';</script>";
                } catch (Exception $e){
                    $error = mysqli_error($con);
                    print "<script>alert('Error al agregar: $error');window.location = 'administrar.php';</script>";                }
        
        }
    }

?>
