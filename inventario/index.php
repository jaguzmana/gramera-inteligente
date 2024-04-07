<?php
include_once '../API/ingredient.php';

$ingredient = new Ingredient();
$res = $ingredient->obtenerIngredientes();

$ingredientes_array = array();

// Obtener cada fila de resultado y agregarla al array
while ($row = $res->fetch_assoc()) {
    $ingredientes_array[] = $row;
}

// Número de resultados por página
$resultados_por_pagina = 6;

// Número total de recetas
$total_ingredientes = count($ingredientes_array);

// Número total de páginas
$total_paginas = ceil($total_ingredientes / $resultados_por_pagina);

// Obtener la página actual
if (!isset($_GET['pagina'])) {
    $pagina_actual = 1;
} else {
    $pagina_actual = $_GET['pagina'];
}

// Calcular el índice de inicio para la consulta SQL
$indice_inicio = ($pagina_actual - 1) * $resultados_por_pagina;

// Obtener las recetas para la página actual
$ingredientes_pagina = array_slice($ingredientes_array, $indice_inicio, $resultados_por_pagina);
?>

<!DOCTYPE html>
<html lang="es" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Modo Inventario</title>
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
            
            <div class="flex flex-col items-center flex-auto">
                <h2 class="font-bold pb-1">Inventario</h2>
                <table class="min-w-full divide-y divide-gray-200 border rounded">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider text-center">ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Ingrediente</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Cantidad</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Unidad</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Densidad</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Editar</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Eliminar</th>
                            <!-- Agrega más encabezados aquí si es necesario -->
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php foreach ($ingredientes_pagina as $ingrediente): ?>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-center"><?php echo $ingrediente['ingredient_id']; ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-center"><?php echo $ingrediente["ingredient_name"]; ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-center"><?php echo $ingrediente['ingredient_amount']; ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-center"><?php echo $ingrediente["ingredient_unit"]; ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-center"><?php echo $ingrediente["ingredient_density"]; ?></td>
                            <!-- Agrega más columnas aquí si es necesario -->
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-center">
                                <div class="flex justify-center">
                                    <a href="editarIngrediente.php?id=<?php echo $ingrediente["ingredient_id"];?>" class="flex justify-center items-center bg-blue-700 text-white rounded shadow p-1 w-8 h-8">
                                    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.779 17.779 4.36 19.918 6.5 13.5m4.279 4.279 8.364-8.643a3.027 3.027 0 0 0-2.14-5.165 3.03 3.03 0 0 0-2.14.886L6.5 13.5m4.279 4.279L6.499 13.5m2.14 2.14 6.213-6.504M12.75 7.04 17 11.28"/>
                                    </svg>
                                    </a>
                                </div>
                            </td>


                            <td class="px-6 py-4 whitespace-nowrap text-sm text-center">
                                <div class="flex justify-center">
                                    <a href="eliminar.php?id=<?php echo $ingrediente["ingredient_id"];?>" class="flex justify-center items-center bg-red-700 text-white rounded shadow p-1 w-8 h-8">
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
                    <a href="?pagina=<?php echo $i; ?>" class="mx-1 px-3 py-1 bg-blue-700 text-white rounded hover:bg-blue-500"><?php echo $i; ?></a>
                    <?php endfor; ?>
                </div>
            </div>

            <div class="flex flex-col basis-1/4 pl-4">
                <h2 class="text-center font-bold pb-1">Agregar Ingrediente</h2>
                <form action="agregar.php" method="post">
                    <h3 class="text-lg border-b text-blue-700 border-blue-700 mb-3 font-bold w-full">
                        Nombre:
                    </h3>
                    <input type="text" name="nombre-ingrediente" id="nombre-ingrediente" class="px-1 border rounded w-full">

                    <h3 class="text-lg border-b text-blue-700 border-blue-700 mb-3 font-bold w-full mt-1">
                        Cantidad:
                    </h3>
                    <input type="number" id="cantidad-ingrediente" name="cantidad-ingrediente" class="border rounded w-full px-1" value="0">

                    <h3 class="text-lg border-b text-blue-700 border-blue-700 mb-3 font-bold w-full mt-1">
                        Unidad:
                    </h3>
                    <select class="block border rounded mb-1 w-full" id="unidad-ingrediente" name="unidad-ingrediente" aria-label="Floating label select example">
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

                    <h3 class="text-lg border-b text-blue-700 border-blue-700 mb-3 font-bold w-full mt-1">
                        Densidad:
                    </h3>
                    <input type="number" name="densidad-ingrediente" id="densidad-ingrediente" class="border rounded w-full px-1" step="any" value="0">

                    <button type="submit" class="block bg-blue-700 text-white py-1 px-3 rounded hover:bg-blue-transition-colors w-26 mt-3 shadow">Agregar</button>
                </form>
            </div>

        </article>
    </main>
</body>
</html>