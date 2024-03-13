<?php
include 'connect_to_db.php';
include 'functions.php';

$conn = conectarDB();

if (isset($conn)) {
    echo "DB funciona";
}

manejarUltimoValor();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medición en vivo</title>
</head>
<body>
    <script src="index.js"></script>
    
    <div class=page>
    <header>
        <div class="header-container">
            <h1>PesoPluma</h1>
            <nav>
                <ul>
                    <li><a href="">Inicio</a></li>
                    <li><a href="">Inventario</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <article>
        <h2>Medición en Vivo</h2>
        <section>
            <h3>Lectura actual:</h3>
            <p><span id="ultimo_valor"><?php echo $ultimo_valor; ?></span></p>
        </section>

        <section>
            <h3>Convertir de:</h3>
                <form action="" method="post">
                    <label for="unidad-gastronomica-1">Unidad Gastronomica</label>
                    <select name="" id="">
                        <option value=""></option>
                    </select>

                    <label for="unidad-gastronomica-2"></label>
                </form>

                <h3>A:</h3>
                <form action="" method="post">
                    <label for="unidad-gastronomica-1">Unidad Gastronomica</label>
                    <select name="" id="">
                        <option value=""></option>
                    </select>

                    <label for="unidad-gastronomica-2"></label>
                </form>

                <button type="submit">Confirmar</button>
        </section>
    </article>
    </div>
</body>
</html>