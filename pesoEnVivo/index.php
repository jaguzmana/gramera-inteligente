<?php
include_once '../API/ingredientAPI.php';

$ingredient = new IngredientAPI();
$res = $ingredient->obtenerIngredientes();

// TODO: Revisar las alertas 
?>

<!DOCTYPE html>
<html lang="es" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Medición en vivo</title>
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
                    <li><a class="text-white text-md" href="../receta/index.php">Receta</a></li>
                    <li><a class="text-white text-md" href="../inventario/index.php">Inventario</a></li>
                    <li><a class="text-white text-md" href="../consumo/index.php">Informe de Consumo</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main>
        <article class="flex flex items-center flex-row justify-beetween h-[400px] p-4">

        <div class="basis-1/4 flex flex-col justify-start h-full items-center border mr-4 rounded shadow">

            <h2 class="text-md font-bold mb-4 mt-4">
                Medición en Vivo
            </h2>

            <section>
                <h3 class="text-center">Lectura deseada:</h3>
                <p class="text-center"> <span id="lectura_deseada">0</span> <span id="unit1"></span></p>
            </section>

            <section class="pt-4">
                <h3 class="text-center">Lectura actual:</h3>
                <p class="text-center"> <span id="dato_procesado">0</span> <span id="unit2"></span></p>
            </section>

            <section class="pt-4">
                <h3 class="text-center text-md font-bold">Acción Requerida:</h3>
                <p class="text-center"> <span id="accion_requerida"></span></p>
            </section>
        </div>

        <section class="flex-auto h-full">
            <form action="index.php" method="post">

                <h3 class="text-lg border-b text-blue-700 border-blue-700 mb-3 font-bold">
                    Ingrediente:
                </h3>
                <select name="ingrediente" id="ingrediente" class="border border-gray-300 rounded mb-3">
                    <option value="none" selected disabled>Selecciona una opción</option>
                    <?php 
                        while ($row = $res->fetch_assoc()) {
                            echo "<option value=\"{$row['ingredient_id']}\">{$row['ingredient_name']}</option>";
                        }
                    ?>
                </select>

                <h3 class="text-lg border-b text-blue-700 border-blue-700 mb-3 font-bold">
                    Convertir de:
                </h3>

                <select name="unidad-gastronomica-1" id="unidad-gastronomica-1" class="border border-gray-300 rounded mb-3">
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
                <option value="cucharaditas">Cucharaditas</option>
                <option value="pizcas">Pizcas</option>
                </select>

                <h3 class="text-lg border-b text-blue-700 border-blue-700 mb-3 font-bold">
                    Cantidad deseada:
                </h3>
                <input value="0" min="0" class="border border-gray-300 rounded pl-1" type="number" name="" id="cantidad">

                <h3 class="text-lg border-b text-blue-700 border-blue-700 mb-3 pt-2 font-bold">
                    Convertir a:
                </h3>
                <select name="unidad-gastronomica-2" id="unidad-gastronomica-2" class="border border-gray-300 rounded">
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
                <option value="cucharaditas">Cucharaditas</option>
                <option value="pizcas">Pizcas</option>
                </select>
                <button onclick="confirmarPeso()" id="confirmar" class="bg-blue-700 text-white py-1 px-3 rounded hover:bg-blue-transition-colors block mt-6 shadow" disabled="disabled" type="submit">
                    Registrar Consumo
                </button>
            </form>
        </section>
    </article>
    </div>
    </main>
</body>
</html>