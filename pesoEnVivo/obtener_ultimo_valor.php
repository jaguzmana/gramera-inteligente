<?php
// Nombre del archivo donde se guarda el último valor
$archivo = 'ultimo_valor.txt';

// Verifica si el archivo existe
if (file_exists($archivo)) {
    // Lee el contenido del archivo
    $ultimo_valor = file_get_contents($archivo);
} else {
    $ultimo_valor = "No hay valor almacenado aún";
}

// Devuelve el último valor como respuesta
echo $ultimo_valor;
?>