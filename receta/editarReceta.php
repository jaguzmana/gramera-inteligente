<?php
include_once '../API/db.php';

    if(!empty($_GET)){
        $db = new DB();
        $con = $db->conectarDB();
        $id = $_GET["id"];
        $sql = "SELECT * FROM Recipe WHERE recipe_id = " . $id;

        $query = $con->query($sql);
        $r=$query->fetch_array();
        
        $nombre = $r["recipe_name"];
        $sql2 = "SELECT Amount.amount_id, Amount.amount_amount, Amount.amount_unit, Amount.amount_description, Ingredient.ingredient_name, Recipe.recipe_name FROM Amount JOIN Ingredient ON Amount.ingredient_id = Ingredient.ingredient_id JOIN Recipe ON Amount.recipe_id = Recipe.recipe_id WHERE Recipe.recipe_name = '$nombre';"; 
        $query2 = $con->query($sql2);

        $sql3 = "SELECT * FROM Ingredient ORDER BY ingredient_name";
        $query3 = $con->query($sql3);

        $pasos_array = array();

        // Obtener cada fila de resultado y agregarla al array
        while ($row = $query2->fetch_assoc()) {
            $pasos_array[] = $row;
        }

        // Número de resultados por página
        $resultados_por_pagina = 6;

        // Número total de recetas
        $total_pasos = count($pasos_array);

        // Número total de páginas
        $total_paginas = ceil($total_pasos / $resultados_por_pagina);

        // Obtener la página actual
        if (!isset($_GET['pagina'])) {
            $pagina_actual = 1;
        } else {
            $pagina_actual = $_GET['pagina'];
        }

        // Calcular el índice de inicio para la consulta SQL
        $indice_inicio = ($pagina_actual - 1) * $resultados_por_pagina;

        // Obtener las recetas para la página actual
        $pasos_pagina = array_slice($pasos_array, $indice_inicio, $resultados_por_pagina);
    }
?>

<!DOCTYPE html>
<html lang="es" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Administrar Recetas</title>
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
                    <li><a class="text-white text-md" href="">Receta</a></li>
                    <li><a class="text-white text-md" href="">Inventario</a></li>
                    <li><a class="text-white text-md" href="">Informe de Consumo</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main>
        <h2 class="text-center py-3 text-md font-bold">Editar Recetas</h2>
        
        <article class="flex flex-row justify-beetween p-4">
            
            <div class="flex flex-col items-center flex-auto">
                <h2 class="font-bold pb-1">Pasos Receta</h2>
                <table class="min-w-full divide-y divide-gray-200 border rounded">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider text-center">ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Ingrediente</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Cantidad</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Unidad</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Descripción</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Eliminar</th>
                            <!-- Agrega más encabezados aquí si es necesario -->
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                    <?php foreach ($pasos_pagina as $paso):?>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-center"><?php echo $paso["amount_id"];?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-center"><?php echo $paso["ingredient_name"];?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-center"><?php echo $paso["amount_amount"];?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-center"><?php echo $paso["amount_unit"];?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-center"><?php echo $paso["amount_description"];?></td>

                            <td class="px-6 py-4 whitespace-nowrap text-sm text-center">
                                <div class="flex justify-center">
                                    <a href="eliminarPaso.php?id=<?php echo $paso["amount_id"];?>&id_receta=<?php echo $id;?>" class="flex justify-center items-center bg-red-700 text-white rounded shadow p-1 w-8 h-8">
                                    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z"/>
                                    </svg>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <div class="flex justify-center mt-4">
                    <?php for ($i = 1; $i <= $total_paginas; $i++): ?>
                    <a href="?pagina=<?php echo $i; ?>&id=<?php echo $id;?>" class="mx-1 px-3 py-1 bg-blue-700 text-white rounded hover:bg-blue-500"><?php echo $i; ?></a>
                    <?php endfor; ?>
                </div>
            </div>

            <div class="flex flex-col basis=1/4 pl-4">
                <h2 class="text-center font-bold pb-1">Edición</h2>
                <form action="editarNombreReceta.php?id=<?php echo $id?>" method="post">
                    <h3 class="text-lg border-b text-blue-700 border-blue-700 mb-3 font-bold w-full">
                        Editar Nombre Receta:
                    </h3>
                    <input type="text" name="nombre-receta" id="nombre-receta" class="border rounded w-full px-1" value="<?php echo $r["recipe_name"];?>">
                    <button type="submit" class="bg-blue-700 text-white py-1 px-3 rounded hover:bg-blue-transition-colors w-26 mt-3 shadow">Guardar</button>

                    <a href="administrar.php" class="bg-red-700 text-white py-[5px] px-3 rounded w-26 mt-3 shadow">Cancelar</a>
                </form>

                <form action="agregarPasoPaso.php" method="post" class="pt-3">
                    <h3 class="text-lg border-b text-blue-700 border-blue-700 mb-3 font-bold w-full">
                        Agregar Paso Receta:
                    </h3>

                    <label for="paso-receta-ingrediente-id" class="font-bold">Ingrediente</label>
                    <select class="block border rounded mb-1 w-full" id="paso-receta-ingrediente-id" name="paso-receta-ingrediente-id" aria-label="Floating label select example">
                        <option value="none" selected disabled>Selecciona una opción</option>
                        <?php while ($y=$query3->fetch_array()):?>
                            <option value="<?php echo $y["ingredient_id"];?>"><?php echo $y["ingredient_name"];?></option>
                        <?php endwhile;?>
                     </select>

                     <label for="paso-receta-cantidad-ingrediente" class="font-bold block">Cantidad</label>
                    <input type="number" class="border rounded w-full px-1" id="paso-receta-cantidad-ingrediente" name="paso-receta-cantidad-ingrediente" placeholder="" value="0">

                    <label class="font-bold block" for="paso-receta-unidad-ingrediente">Unidad</label>
                    <select class="block border rounded mb-1 w-full" id="paso-receta-unidad-ingrediente" name="paso-receta-unidad-ingrediente" aria-label="Floating label select example">
                    <option value="none" selected disabled>Selecciona una opción</option>
                    <option value="gramos">Gramos</option>
                    <option value="kilogramos">Kilogramos</option>
                    <option value="mililitros">Mililitros</option>
                    <option value="litros">Litros</option>
                    <option value="unidades">Unidades</option>
                    <option value="libras">Libras</option>
                    <option value="onzas">Onzas</option>
                    <option value="tazas">Tazas</option>
                    <option value="medias tazas">Medias Tazas</option>
                    <option value="cucharadas">Cucharadas</option>
                    <option value="pizcas">Pizcas</option>
                </select>

                <label for="paso-receta-descripcion" class="font-bold mt-1">Descripción</label>
                <textarea class="rounded w-full border px-1" id="paso-receta-descripcion" name="paso-receta-descripcion" rows="3"></textarea>

                <div style="display: none" class="form-floating mb-3">
                <label for="paso-receta-receta-id"></label>
                <input type="number" step="any" class="form-control" value="<?php echo $id;?>" id="paso-receta-receta-id" name="paso-receta-receta-id">
                 </div>

                    <button type="submit" class="bg-blue-700 text-white py-1 px-3 rounded hover:bg-blue-transition-colors w-26 mt-3 shadow">Guardar</button>
                </form>
            </div>

        </article>
    </main>
</body>
</html>