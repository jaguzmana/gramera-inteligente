<?php
// Nombre del archivo donde se guardará el último valor
$archivo = 'ultimo_valor.txt';

// Variable global para almacenar el último valor
global $dato;

// Verifica si se ha enviado un dato a través del formulario POST
if (isset($_POST["dato"])) {
    $dato = $_POST["dato"];
    
    // Guarda el último valor en el archivo
    file_put_contents($archivo, $dato);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medición en vivo</title>
</head>
<body>
    <h1>Medición en Vivo</h1>
    <div id="ultimo_valor_section">
        <h2>Último Valor Leído:</h2>
        <span id="ultimo_valor"><?php echo $ultimo_valor; ?></span> gr
    </div>

    <script src="index.js"></script>
</body>
</html>