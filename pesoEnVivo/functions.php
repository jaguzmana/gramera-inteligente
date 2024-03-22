<?php
function recibirLecturaSensor() {
    $archivo = 'lectura_sensor.txt';

    if (isset($_POST["dato"])) {
        $dato = $_POST["dato"];
        
        file_put_contents($archivo, $dato);
    }
}
?>
