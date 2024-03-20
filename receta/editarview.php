<?php
    if(!empty($_GET)){
        $host = "localhost";
        $user = "root";
        $password = "samc2003";
        $db = "pesoPlumaDb";
        $con = new mysqli($host, $user, $password, $db);
        $id = $_GET["id"];
        $sql = "SELECT * FROM Recipe WHERE recipe_id = " . $id;

        $query = $con->query($sql);
        $r=$query->fetch_array();
        
        $nombre = $r["recipe_name"];
        $sql2 = "SELECT Amount.amount_id, Amount.amount_amount, Amount.amount_unit, Amount.amount_description, Ingredient.ingredient_name, Recipe.recipe_name FROM Amount JOIN Ingredient ON Amount.ingredient_id = Ingredient.ingredient_id JOIN Recipe ON Amount.recipe_id = Recipe.recipe_id WHERE Recipe.recipe_name = '$nombre';"; 
        $query2 = $con->query($sql2);

        $sql3 = "SELECT * FROM Ingredient ORDER BY ingredient_name";
        $query3 = $con->query($sql3);
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
        }.contenedor2{
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
        <form class="container" action="editarNombreReceta.php" method="post">
        <div style="display: none">
            <input type="text" id="id-receta" name="id-receta" placeholder="" value="<?php echo $r["recipe_id"];?>">
            <label for="id-receta"></label>
        </div>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="nombre-receta" name="nombre-receta" placeholder="" value="<?php echo $r["recipe_name"];?>">
            <label for="nombre-receta">Nombre de la receta</label>
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
    <hr>
    <div class="contenedor2">
        <h2>Paso a Paso</h2>
        <div class="row">
            <table id="tablaRecetas" class="table table-bordered">
                <thead>
                  <tr>
                    <th scope="col">id</th>
                    <th scope="col">Ingrediente</th>
                    <th scope="col">Cantidad del ingrediente</th>
                    <th scope="col">Unidad</th>
                    <th scope="col">Descripcion</th>
                    <th scope="col"> </th>
                  </tr>
                </thead>
                <tbody>
                <?php while ($x=$query2->fetch_array()):?>
                    <tr>
                        <td><?php echo $x["amount_id"];?></td>
                        <td><?php echo $x["ingredient_name"];?></td>
                        <td><?php echo $x["amount_amount"];?></td>
                        <td><?php echo $x["amount_unit"];?></td>
                        <td><?php echo $x["amount_description"];?></td>
                        <td>
                            <a href="eliminarPaso.php?id=<?php echo $x["amount_id"];?>" class="btn btn-outline-danger">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"></path>
                                    <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"></path>
                                </svg>
                                Eliminar
                            </a>
                        </td>
                    </tr>
                <?php endwhile;?>
                </tbody>
              </table>
        </div>
    </div>
    <div class="contenedor">
        <h2>Agregar paso</h2>
        <form class="container" action="agregarPasoPaso.php" method="post">
        <div class="form-floating">
            <select class="form-select" id="paso-receta-ingrediente-id" name="paso-receta-ingrediente-id" aria-label="Floating label select example">
                <?php while ($y=$query3->fetch_array()):?>
                    <option value="<?php echo $y["ingredient_id"];?>"><?php echo $y["ingredient_name"];?></option>
                <?php endwhile;?>
            </select>
            <label for="paso-receta-ingrediente-id">Ingrediente</label>
        </div>
        <br>
        <div class="form-floating mb-3">
            <input type="number" step="any" class="form-control" id="paso-receta-cantidad-ingrediente" name="paso-receta-cantidad-ingrediente" placeholder="" value="<?php echo $r["ingredient_density"];?>">
            <label for="paso-receta-cantidad-ingrediente">Cantidad del ingrediente</label>
        </div>
        <div class="form-floating">
            <select class="form-select" id="paso-receta-unidad-ingrediente" name="paso-receta-unidad-ingrediente" aria-label="Floating label select example">
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
        <div class="mb-3">
            <label for="paso-receta-descripcion" class="form-label">Example textarea</label>
            <textarea class="form-control" id="paso-receta-descripcion" name="paso-receta-descripcion" rows="3"></textarea>
        </div>
        <div style="display: none" class="form-floating mb-3">
            <input type="number" step="any" class="form-control" value="<?php echo $id;?>" id="paso-receta-receta-id" name="paso-receta-receta-id" placeholder="" value="<?php echo $r["ingredient_density"];?>">
            <label for="paso-receta-receta-id"></label>
        </div>
        <button type="submit" class="btn btn-success">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check2" viewBox="0 0 16 16">
                <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0"/>
            </svg>
            Aplicar
        </button>
        </form>    
    </div> 
    <br>
</body>
</html>