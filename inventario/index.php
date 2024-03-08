<?php
    $host = "localhost";
    $user = "root";
    $password = "samc2003";
    $db = "pesoPlumaDb";
    $con = new mysqli($host, $user, $password, $db);
    $sql = "SELECT * FROM Ingredient";
    $query = $con->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>php</title>
    <!--  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.2/css/dataTables.bootstrap5.css">
    <script defer src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script defer src="https://cdn.datatables.net/2.0.2/js/dataTables.js"></script>
    <script defer src="https://cdn.datatables.net/2.0.2/js/dataTables.bootstrap5.js"></script>
    <script defer src="./index.js"></script>
    <!--  -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <style>
        *{
            box-sizing: border-box;
            padding: 0%;
            margin: 0;
        }
        .contenedor{
            display: flex;
            justify-content: center;
            margin-top: 5vh;
        }.contenedor2{
            display: flex;
            flex-direction: column;
            align-items: center;
        }
    
    </style>
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
            <a class="nav-link" href="./../intex.php">Inicio</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="./../inventario/index.php">Inventario</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="./../consumo/index.php" aria-current="page">Informe de consumo</a>
        </li>
    </ul>
    <hr>
    <div class="contenedor2">
        <h2>Inventario</h2>
        <div class="row">
            <table id="tablaInventario" class="table table-bordered">
                <thead>
                  <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Ingrediente</th>
                    <th scope="col">Cantidad</th>
                    <th scope="col">Unidad</th>
                    <th scope="col">Densidad</th>
                    <th scope="col"> </th>
                    <th scope="col"> </th>
                  </tr>
                </thead>
                <tbody>
                <?php while ($r=$query->fetch_array()):?>
                    <tr>
                        <td><?php echo $r["ingredient_id"];?></td>
                        <td><?php echo $r["ingredient_name"];?></td>
                        <td><?php echo $r["ingredient_amount"];?></td>
                        <td><?php echo $r["ingredient_unit"];?></td>
                        <td><?php echo $r["ingredient_density"];?></td>
                        <td>
                            <a href="eliminar.php?id=<?php echo $r["ingredient_id"];?>" class="btn btn-outline-danger">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"></path>
                                    <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"></path>
                                </svg>
                                Eliminar
                            </a>
                        </td>
                        <td>
                            <a href="editarview.php?id=<?php echo $r["ingredient_id"];?>" class="btn btn-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                    <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325"></path>
                                </svg>
                            Editar
                            </a>
                        </td>
                    </tr>
                <?php endwhile;?>
                </tbody>
              </table>
        </div>
    </div>
    <div class="contenedor2">
        <h2 style="align-self: baseline;margin: 25px 140px;">Agregar</h2>
        <form class="container" action="agregar.php" method="post">
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="nombre-ingrediente" name="nombre-ingrediente" placeholder="">
            <label for="nombre-ingrediente">Nombre del ingrediente</label>
        </div>
        <div class="form-floating mb-3">
            <input type="number" class="form-control" id="cantidad-ingrediente" name="cantidad-ingrediente" placeholder="">
            <label for="cantidad-ingrediente">Cantidad del ingrediente</label>
        </div>
        <div class="form-floating">
            <select class="form-select" id="unidad-ingrediente" name="unidad-ingrediente" aria-label="Floating label select example">
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
            <input type="number" class="form-control" id="densidad-ingrediente" name="densidad-ingrediente" placeholder="">
            <label for="densidad-ingrediente">Densidad del ingrediente</label>
        </div>
        <button type="submit" class="btn btn-success">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check2" viewBox="0 0 16 16">
                <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0"/>
            </svg>
            Agregar
        </button>
        </form>    
    </div>
    <br>
</body>
</html>