<?php
include_once '../API/db.php';

    if(!empty($_GET)){
        $db = new DB();
        $con = $db->conectarDB();
        $sql = "DELETE FROM Ingredient WHERE ingredient_id = " . $_GET["id"];

        try {
            $query = $con->query($sql);
            print "<script>alert('Eliminado Exitosamente');window.location = 'index.php';</script>";
        } catch (Exception $e){
            $error = mysqli_error($con);
            print "<script>alert('Error al eliminar: $error');window.location = 'index.php';</script>";
        }

    }

?>

