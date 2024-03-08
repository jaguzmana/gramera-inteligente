// Función para cargar dinámicamente el último valor
function cargarUltimoValor() {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            document.getElementById("ultimo_valor").innerText = xhr.responseText;
        }
    };
    xhr.open("GET", "obtener_ultimo_valor.php", true);
    xhr.send();
}

// Actualiza el último valor leido cada 250 milisegundos
setInterval(cargarUltimoValor, 250);