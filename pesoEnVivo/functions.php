<?php
function manejarUltimoValor() {
    // Nombre del archivo donde se guardará el último valor
    $archivo = 'ultimo_valor.txt';

    // Variable global para almacenar el último valor
    global $dato, $ultimo_valor;

    // Verifica si se ha enviado un dato a través del formulario POST
    if (isset($_POST["dato"])) {
        $dato = $_POST["dato"];
        
        // Guarda el último valor en el archivo
        file_put_contents($archivo, $dato);
    }
}
?>
