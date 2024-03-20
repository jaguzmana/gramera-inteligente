<?php
    $host = "localhost";
    $user = "root";
    $password = "samc2003";
    $db = "pesoPlumaDb";
    $con = new mysqli($host, $user, $password, $db);

    if(!empty($_POST)){
        if(isset($_POST["fecha-inicial"]) && isset($_POST["fecha-final"])){
        
            $fechainicial = $_POST["fecha-inicial"];
            $fechafinal = $_POST["fecha-final"];
            $sql = "SELECT Consume.consume_date, Consume.consume_amount, Consume.consume_unit, Consume.consume_description, Ingredient.ingredient_name FROM Consume JOIN Ingredient ON Consume.ingredient_id = Ingredient.ingredient_id WHERE Consume.consume_date between '$fechainicial' and '$fechafinal';";
        }
    }else{
        $sql = "SELECT Consume.consume_date, Consume.consume_amount, Consume.consume_unit, Consume.consume_description, Ingredient.ingredient_name FROM Consume JOIN Ingredient ON Consume.ingredient_id = Ingredient.ingredient_id";
    }

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
        }#tablaConsumo{
            width: 900px;
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
    <div class="contenedor2">
        <h2 style="margin: 20px 0px;">Informe de consumo</h2>
        <div class="row">
            <table id="tablaConsumo" class="table table-bordered">
                <thead>
                  <tr>
                    <th scope="col">Ingrediente</th>
                    <th scope="col">Cantidad</th>
                    <th scope="col">Unidad</th>
                    <th scope="col">Fecha</th>
                    <th scope="col">Descripcion</th>
                  </tr>
                </thead>
                <tbody>
                <?php while ($r=$query->fetch_array()):?>
                    <tr>
                        <td><?php echo $r["ingredient_name"];?></td>
                        <td><?php echo $r["consume_amount"];?></td>
                        <td><?php echo $r["consume_unit"];?></td>
                        <td><?php echo $r["consume_date"];?></td>
                        <td><?php echo $r["consume_description"];?></td>
                    </tr>
                <?php endwhile;?>
                </tbody>
              </table>
        </div>
    </div>
    <div class="contenedor2">
        <h2 style="align-self: baseline;margin: 25px 140px;">Filtros</h2>
        <form class="container" action="index.php" method="post">
            <div class="form-floating mb-3">
                <input type="date" class="form-control" id="fecha-inicial" name="fecha-inicial" placeholder="">
                <label for="fecha-inicial">Fecha inicial</label>
            </div>
            <div class="form-floating mb-3">
                <input type="date" class="form-control" id="fecha-final" name="fecha-final" placeholder="">
                <label for="fecha-final">Fecha final</label>
            </div>
            <button type="submit" class="btn btn-primary">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                </svg>
                Buscar
        </button>
        </form>    
    </div>
    <br>
</body>
</html>