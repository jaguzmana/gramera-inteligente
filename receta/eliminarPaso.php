<?php
include_once '../API/db.php';

    if(!empty($_GET)){
        $id_receta = $_GET["id_receta"];
        $db = new DB();
        $con = $db->conectarDB();
        $sql = "DELETE FROM Amount WHERE amount_id = " . $_GET["id"];

        try {
            $query = $con->query($sql);
            print "<script>alert('Eliminado Exitosamente');window.location = 'editarReceta.php?id=$id_receta';</script>";
        } catch (Exception $e){
            $error = mysqli_error($con);
            print "<script>alert('Error al eliminar: $error');window.location = 'editarReceta.php';</script>";
        }

    }

?>

