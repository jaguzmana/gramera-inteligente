<?php 
    if(!empty($_GET)){
        $host = "localhost";
        $user = "root";
        $password = "samc2003";
        $db = "pesoPlumaDb";
        $con = new mysqli($host, $user, $password, $db);
        $sql = "DELETE FROM Amount WHERE amount_id = " . $_GET["id"];

        try {
            $query = $con->query($sql);
            print "<script>alert('Eliminado Exitosamente');window.location = 'index.php';</script>";
        } catch (Exception $e){
            $error = mysqli_error($con);
            print "<script>alert('Error al eliminar: $error');window.location = 'index.php';</script>";
        }

    }

?>

