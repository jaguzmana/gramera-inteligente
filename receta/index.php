<?php
include_once '../API/recipe.php';

$recipe = new Recipe();
$res = $recipe->obtenerRecetas();

/* 
    TODO: 
    - Solo se pueden eliminar recetas sin pasos.
*/
?>

<!DOCTYPE html>
<html lang="es" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Modo Receta</title>
    <script defer src="index.js"></script>
    <script defer src="../funcionesJS/funciones.js"></script>
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
                    <li><a class="text-white text-md" href="../pesoEnVivo/index.php">Medición en Vivo</a></li>
                    <li><a class="text-white text-md" href="../inventario/index.php">Inventario</a></li>
                    <li><a class="text-white text-md" href="../consumo/index.php">Informe de Consumo</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main>
        <article class="flex flex items-center flex-row justify-beetween h-[420px] p-4">

        <div class="basis-1/4 flex flex-col justify-start h-full items-center border mr-4 rounded shadow">

            <h2 class="text-md font-bold mb-4 mt-4">
                Medición en Vivo
            </h2>

            <section>
                <h3 class="text-center">Lectura deseada:</h3>
                <p class="text-center"> <span id="lectura_deseada">0</span> gramos</p>
            </section>

            <section class="pt-4">
                <h3 class="text-center">Lectura actual:</h3>
                <p class="text-center"> <span id="dato_procesado">0</span> gramos</p>
            </section>

            <section class="pt-4">
                <h3 class="text-center text-md font-bold">Acción Requerida:</h3>
                <p class="text-center"> <span id="accion_requerida"></span> </p>
            </section>
        </div>

        <div class="basis-1/4 flex flex-col justify-start h-full items-center border mr-4 rounded shadow">
            <h2 class="text-md font-bold mb-4 mt-4">
                Paso Receta <span id="paso-receta"> </span>
            </h2>

            <section>
                <h3 class="text-center">Ingrediente:</h3>
                <p class="text-center"> <span id="ing_receta">0</span> </p>
            </section>

            <section class="pt-4">
                <h3 class="text-center">Cantidad</h3>
                <p class="text-center"> <span id="cantidad_ing">0</span> <span id="unidad_ing"></span> </p>
            </section>

            <section class="pt-4">
                <h3 class="text-center text-md font-bold">Descripción:</h3>
                <p class="text-center"> <span id="description"></span> </p>
            </section>
        </div>

        <section class="flex-auto h-full">
            <form action="index.php" method="post">

                <h3 class="text-lg border-b text-blue-700 border-blue-700 mb-3 font-bold">
                    Receta:
                </h3>
                <select name="receta" id="receta" class="border border-gray-300 rounded mb-3">
                    <option value="none" selected disabled>Selecciona una opción</option>
                    <?php 
                        while ($row = $res->fetch_assoc()) {
                            echo "<option value=\"{$row['recipe_id']}\">{$row['recipe_name']}</option>";
                        }
                    ?>
                </select>
                <a id="administrar-recetas" href="http://localhost/gramera-inteligente/receta/administrar.php" class="block bg-blue-700 text-white py-1 px-3 rounded hover:bg-blue-transition-colors block mb-3 shadow w-44 text-center">
                    Administrar Recetas
                </a>   
                
                <button onclick="siguientePaso()" id="confirmar" class="bg-gray-500 text-white py-1 px-3 rounded hover:bg-blue-transition-colors block mt-3 shadow" disabled="disabled" type="button">
                    Registrar Consumo
                </button>

            </form>
        </section>
    </article>
    </div>
    </main>
</body>
</html>