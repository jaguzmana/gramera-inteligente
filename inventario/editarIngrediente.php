<?php
include_once '../API/db.php';

    if(!empty($_GET)){
        $db = new DB();
        $con = $db->conectarDB();
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
<html lang="es" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Editar Ingrediente</title>
</head>
<body class="h-full">
    <header>
        <div class="bg-blue-700 flex h-16 w-full shadow justify-around items-center">
            <h1 class="basis-1/4 text-white text-xl font-bold text-center">
                PesoPluma
            </h1>
            <nav class="flex-auto">
                <ul class="flex justify-around">
                    <li><a class="text-white text-md" href="../index.php">Inicio</a></li>
                    <li><a class="text-white text-md" href="../receta/index.php">Receta</a></li>
                    <li><a class="text-white text-md" href="../pesoEnVivo/index.php">Medición en Vivo</a></li>
                    <li><a class="text-white text-md" href="../consumo/index.php">Informe de Consumo</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main>        
        <article class="flex flex-row justify-beetween p-4">
            <div class="flex flex-col flex-auto pl-4">
                <h2 class="text-center font-bold pb-1">Editar Ingrediente</h2>
                <form action="editar.php" method="post">
                <div style="display: none">
                    <input type="text" id="id-ingrediente" name="id-ingrediente" placeholder="" value="<?php echo $r["ingredient_id"];?>">
                    <label for="id-ingrediente"></label>
                </div>

                    <h3 class="text-lg border-b text-blue-700 border-blue-700 mb-3 font-bold w-full">
                        Nombre:
                    </h3>
                    <input type="text" name="nombre-ingrediente" id="nombre-ingrediente" class="px-1 border rounded w-full" value="<?php echo $r["ingredient_name"];?>">

                    <h3 class="text-lg border-b text-blue-700 border-blue-700 mb-3 font-bold w-full mt-1">
                        Cantidad:
                    </h3>
                    <input type="number" step="any" id="cantidad-ingrediente" name="cantidad-ingrediente" class="border rounded w-full px-1" value="<?php echo $r["ingredient_amount"];?>">

                    <h3 class="text-lg border-b text-blue-700 border-blue-700 mb-3 font-bold w-full mt-1">
                        Unidad:
                    </h3>
                    <select class="block border rounded mb-1 w-full" id="unidad-ingrediente" name="unidad-ingrediente" aria-label="Floating label select example">
                    <option selected><?php echo $r["ingredient_unit"];?></option>
                    <option value="gramos">Gramos</option>
                    <option value="mililitros">Mililitros</option>
                    <option value="unidades">Unidades</option>
                    </select>

                    <h3 class="text-lg border-b text-blue-700 border-blue-700 mb-3 font-bold w-full mt-1">
                        Densidad (g/mL):
                    </h3>
                    <input type="number" name="densidad-ingrediente" id="densidad-ingrediente" class="border rounded w-full px-1" step="any" value="<?php echo $r["ingredient_density"];?>">

                    <button type="submit" class="bg-blue-700 text-white py-1 px-3 rounded hover:bg-blue-transition-colors w-26 mt-3 shadow">Guardar</button>
                    <a href="index.php" class="bg-red-700 text-white py-[5px] px-3 rounded w-26 mt-3 shadow">Cancelar</a>
                </form>
            </div>

        </article>
    </main>
</body>
</html>