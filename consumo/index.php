<?php
include_once '../API/db.php';

$db = new DB();
$con = $db->conectarDB();

if(!empty($_POST)){
    if(isset($_POST["fecha-inicial"]) && isset($_POST["fecha-final"])){
    
        $fechainicial = $_POST["fecha-inicial"];
        $fechafinal = $_POST["fecha-final"];
        $sql = "SELECT Consume.consume_date, Consume.consume_amount, Consume.consume_unit, Ingredient.ingredient_name FROM Consume JOIN Ingredient ON Consume.ingredient_id = Ingredient.ingredient_id WHERE Consume.consume_date between '$fechainicial' and '$fechafinal' ORDER BY Consume.consume_date DESC";
    }
}else{
    $sql = "SELECT Consume.consume_date, Consume.consume_amount, Consume.consume_unit, Ingredient.ingredient_name FROM Consume JOIN Ingredient ON Consume.ingredient_id = Ingredient.ingredient_id ORDER BY Consume.consume_date DESC";
}

$res = $con->query($sql); 

$consumos_array = array();

// Obtener cada fila de resultado y agregarla al array
while ($row = $res->fetch_assoc()) {
    $consumos_array[] = $row;
}

// Número de resultados por página
$resultados_por_pagina = 6;

// Número total de recetas
$total_consumos = count($consumos_array);

// Número total de páginas
$total_paginas = ceil($total_consumos / $resultados_por_pagina);

// Obtener la página actual
if (!isset($_GET['pagina'])) {
    $pagina_actual = 1;
} else {
    $pagina_actual = $_GET['pagina'];
}

// Calcular el índice de inicio para la consulta SQL
$indice_inicio = ($pagina_actual - 1) * $resultados_por_pagina;

// Obtener las recetas para la página actual
$consumos_pagina = array_slice($consumos_array, $indice_inicio, $resultados_por_pagina);
?>

<!DOCTYPE html>
<html lang="es" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Modo Informe de Consumo</title>
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
                    <li><a class="text-white text-md" href="../inventario/index.php">Inventario</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main>        
        <article class="flex flex-row justify-beetween p-4">
            
            <div class="flex flex-col items-center flex-auto">
                <h2 class="font-bold pb-1">Informe de Consumo</h2>
                <table class="min-w-full divide-y divide-gray-200 border rounded">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Ingrediente</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Cantidad</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Unidad</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Fecha</th>
                            <!-- Agrega más encabezados aquí si es necesario -->
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php foreach ($consumos_pagina as $consumo): ?>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-center"><?php echo $consumo['ingredient_name']; ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-center"><?php echo $consumo["consume_amount"]; ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-center"><?php echo $consumo['consume_unit']; ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-center"><?php echo $consumo["consume_date"]; ?></td>
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
                <h2 class="text-center font-bold pb-1">Filtros</h2>
                <form action="index.php" method="post">
                    <h3 class="text-lg border-b text-blue-700 border-blue-700 mb-3 font-bold w-full">
                        Fecha inicial
                    </h3>
                    <input type="date" name="fecha-inicial" id="fecha-inicial" class="px-1 border rounded w-full">

                    <h3 class="text-lg border-b text-blue-700 border-blue-700 mb-3 font-bold w-full mt-1">
                        Fecha final
                    </h3>
                    <input type="date" id="fecha-final" name="fecha-final" class="border rounded w-full px-1" value="0">

                    <button type="submit" class="block bg-blue-700 text-white py-1 px-3 rounded hover:bg-blue-transition-colors w-26 mt-3 shadow">Buscar</button>
                </form>
            </div>

        </article>
    </main>
</body>
</html>