<?php
    if(!empty($_GET)){
        $host = "localhost";
        $user = "root";
        $password = "samc2003";
        $db = "pesoPlumaDb";
        $con = new mysqli($host, $user, $password, $db);
        $sql = "SELECT * FROM Ingredient WHERE ingredient_id = " . $_GET["id"];

        try {
            $query = $con->query($sql);
            $r=$query->fetch_array();
        } catch (Exception $e){
            $error = mysqli_error($con);
            print "<script>alert('Error al editar: $error');window.location = 'index.php';</script>";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <style>
        *{
            box-sizing: border-box;
            padding: 0%;
            margin: 0;
        }
        .contenedor{
            display: flex;
            flex-direction: column;
            align-items: center;
        }
    
    </style>
    <title>Editar Ingrediente</title>
</head>
<body>
    <br>
    <ul class="nav justify-content-center">
        <li class="nav-item">
            <a class="nav-link" href="./../pesoEnVivo/index.php">Medicion en vivo</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="./../receta/index.php">Recetas</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="./../index.php">Inicio</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="./../inventario/index.php">Inventario</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="./../consumo/index.php" aria-current="page">Informe de consumo</a>
        </li>
    </ul>
    <hr>
    <div class="contenedor">
        <h2>Editar</h2>
        <form class="container" action="editar.php" method="post">
        <div style="display: none">
            <input type="text" id="id-ingrediente" name="id-ingrediente" placeholder="" value="<?php echo $r["ingredient_id"];?>">
            <label for="id-ingrediente"></label>
        </div>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="nombre-ingrediente" name="nombre-ingrediente" placeholder="" value="<?php echo $r["ingredient_name"];?>">
            <label for="nombre-ingrediente">Nombre del ingrediente</label>
        </div>
        <div class="form-floating mb-3">
            <input type="number" step="any" class="form-control" id="cantidad-ingrediente" name="cantidad-ingrediente" placeholder="" value="<?php echo $r["ingredient_amount"];?>">
            <label for="cantidad-ingrediente">Cantidad del ingrediente</label>
        </div>
        <div class="form-floating">
            <select class="form-select" id="unidad-ingrediente" name="unidad-ingrediente" aria-label="Floating label select example">
                <option selected><?php echo $r["ingredient_unit"];?></option>
                <option value="gramos">gramos</option>
                <option value="kilogramos">kilogramos</option>
                <option value="mililitros">mililitros</option>
                <option value="litros">litros</option>
                <option value="unidades">unidades</option>
                <option value="libras">libras</option>
                <option value="onzas">onzas</option>
                <option value="tazas">tazas</option>
                <option value="medias tazas">medias tazas</option>
                <option value="cucharadas">cucharadas</option>
                <option value="cucharaditas">cucharaditas</option>
                <option value="pizcas">pizcas</option>
            </select>
            <label for="unidad-ingrediente">Unidad</label>
        </div>
        <br>
        <div class="form-floating mb-3">
            <input type="number" step="any" class="form-control" id="densidad-ingrediente" name="densidad-ingrediente" placeholder="" value="<?php echo $r["ingredient_density"];?>">
            <label for="densidad-ingrediente">Densidad del ingrediente</label>
        </div>
        <button type="submit" class="btn btn-success">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check2" viewBox="0 0 16 16">
                <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0"/>
            </svg>
            Aplicar
        </button>
        <a href="index.php" class="btn btn-outline-danger">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293z"/>
            </svg>
            Cancelar
        </a>
        </form>    
    </div> 
    <br>
</body>
</html>