<?php
include_once '../API/db.php';

    if(!empty($_POST)){
        if(isset($_GET["id"]) && isset($_POST["nombre-receta"])){
                $db = new DB();
                $con = $db->conectarDB();
                
                $idreceta = $_GET["id"];
                $nombrereceta = $_POST["nombre-receta"];

                $sql = "UPDATE Recipe SET recipe_name = '$nombrereceta' WHERE recipe_id = '$idreceta';";
                
                try {
                    $query = $con->query($sql);
                    print "<script>alert(\"Editado exitosamente.\");window.location='editarReceta.php?id=$idreceta';</script>";
                } catch (Exception $e){
                    $error = mysqli_error($con);
                    print "<script>alert('Error al editar: $error');window.location = 'editarReceta.php?id=$idreceta';</script>";                
                }
        
        }
    }

?>