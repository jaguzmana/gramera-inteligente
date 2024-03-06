<?php 
    if(!empty($_GET)){
        $host = "localhost";
        $user = "root";
        $password = "samc2003";
        $db = "pesoPlumaDb";
        $con = new mysqli($host, $user, $password, $db);
        $sql = "DELETE FROM Ingredient WHERE ingredient_id = " . $_GET["id"];

        if($query != null){
            print "<script>alert('eliminado Exitosamente');window.location = 'index.php';</script>";
        }else{
            print "<script>alert('no se pudo mi perro');window.location = 'index.php';</script>";
        }
    }

?>

