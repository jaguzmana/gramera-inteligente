<!DOCTYPE html>
<html lang="es" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Página Principal</title>
</head>
<body class="h-full">
    <main class="h-full">
        <header class="w-full flex h-[200px] justify-center items-center bg-blue-700">
            <h1 class="font-bold text-[50px] text-white" >PesoPluma - Menú</h1>
        </header>

        <div class="flex items-center flex-col justify-around h-[475px]">
            <a class="p-5 rounded shadow font-bold text-white bg-blue-700 w-60 text-center" href="pesoEnVivo\index.php">
                Medición en Vivo
            </a>
            <a class="p-5 rounded shadow font-bold text-white bg-blue-700 w-60 text-center" href="receta\index.php">
                Receta
            </a>
            <a class="p-5 rounded shadow font-bold text-white bg-blue-700 w-60 text-center" href="inventario\index.php">
                Inventario
            </a>
            <a class="p-5 rounded shadow font-bold text-white bg-blue-700 w-60 text-center" href="consumo\index.php">
                Informe de Consumo
            </a>
        </div>
    </main>
</body>
</html>