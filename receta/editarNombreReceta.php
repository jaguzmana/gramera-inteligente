<?php
    if(!empty($_POST)){
        if(isset($_POST["id-receta"]) && isset($_POST["nombre-receta"])){
                $host = "localhost";
                $user = "root";
                $password = "";
                $db = "pesoPlumaDb";
                $con = new mysqli($host, $user, $password, $db);
                
                $idreceta = $_POST["id-receta"];
                $nombrereceta = $_POST["nombre-receta"];

                $sql = "UPDATE Recipe SET recipe_name = '$nombrereceta' WHERE recipe_id = '$idreceta';";
                
                try {
                    $query = $con->query($sql);
                    print "<script>alert(\"Editado exitosamente.\");window.location='editarview.php?id=$idreceta';</script>";
                } catch (Exception $e){
                    $error = mysqli_error($con);
                    print "<script>alert('Error al editar: $error');window.location = 'editarview.php?id=$idreceta';</script>";                
                }
        
        }
    }

?>