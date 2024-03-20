<?php
    if(!empty($_POST)){
        if(isset($_POST["nombre-receta"])){
                $host = "localhost";
                $user = "root";
                $password = "samc2003";
                $db = "pesoPlumaDb";
                $con = new mysqli($host, $user, $password, $db);
        
                $nombrereceta = $_POST["nombre-receta"];
                $sql = "INSERT INTO Recipe (recipe_name) VALUES ('$nombrereceta');";
                
                try {
                    $query = $con->query($sql);
                    print "<script>alert(\"Agregado exitosamente.\");window.location='index.php';</script>";
                } catch (Exception $e){
                    $error = mysqli_error($con);
                    print "<script>alert('Error al agregar: $error');window.location = 'index.php';</script>";                }
        
        }
    }

?>
