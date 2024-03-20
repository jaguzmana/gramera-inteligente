<?php
include 'connect_to_db.php';
include 'functions.php';

$conn = conectarDB();

if (isset($conn)) {
    #echo "DB funciona";
}

// if(isset($_POST["unidad-gastronomica-1"]) and isset($_POST["unidad-gastronomica-2"])) {
//     $sel1 = $_POST["unidad-gastronomica-1"];
//     $sel2 = $_POST["unidad-gastronomica-2"];

//     if ($sel1 != "none" and $sel2 != "none") {
//         manejarUltimoValor($sel1, $sel2);
//     }
// }

manejarUltimoValor();

?>

<!DOCTYPE html>
<html lang="es" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Medición en vivo</title>
</head>
<body class="h-full">
    <script src="index.js"></script>

    <header>
        <div class="bg-blue-700 flex h-16 w-full shadow justify-around items-center">
            <h1 class="basis-1/4 text-white text-xl font-bold text-center">
                PesoPluma
            </h1>
            <nav class="flex-auto">
                <ul class="flex justify-around">
                    <li><a class="text-white text-md" href="../index.html">Inicio</a></li>
                    <li><a class="text-white text-md" href="">Receta</a></li>
                    <li><a class="text-white text-md" href="">Inventario</a></li>
                    <li><a class="text-white text-md" href="">Informe de Consumo</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main class="p-12">
        <article class="flex flex items-center flex-row justify-beetween h-[400px]">

        <div class="basis-1/4 flex flex-col justify-start h-full items-center">
            <h2 class="text-md font-bold m-4">
                Medición en Vivo
            </h2>

            <section>
                <h3>Lectura actual:</h3>
                <p> <span id="ultimo_valor"><?php echo $ultimo_valor; ?></span> </p>
            </section>
        </div>

        <section class="flex-auto h-full">
            <h3 class="text-lg border-b text-blue-700 border-blue-700 mb-3 font-bold">
                Convertir de:
            </h3>
                <form action="index.php" method="post">
                    <select name="unidad-gastronomica-1" id="unidad-gastronomica-1" class="border border-gray-300 rounded">
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

                    <h3 class="text-lg border-b text-blue-700 border-blue-700 mb-3 pt-2 font-bold">
                        A:
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
                    <button class="bg-blue-700 text-white py-1 px-3 rounded hover:bg-indigo-transition-colors block mt-3 shadow-md" type="submit">
                        Confirmar
                    </button>
                </form>
        </section>
    </article>
    </div>
    </main>
</body>
</html>