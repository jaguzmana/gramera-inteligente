async function obtenerIngredientesJSON() {
    try {
        const response = await fetch('../API/api.php?action=obtenerIngredientesJSON');
        const data = await response.json();
        return data.items;
    } catch (error) {
        console.error('Error:', error);
        throw error;
    }
}

async function obtenerIngredientePorIDJSON(id) {
    try {
        const response = await fetch(`../API/api.php?action=obtenerIngredientePorIDJSON&id=${id}`);
        const data = await response.json();
        return data.items[0];
    } catch (error) {
        console.error('Error:', error);
        throw error;
    }
}

async function obtenerDatoSensor() {
    try {
        const response = await fetch('../API/lectura_sensor.txt');
        const data = await response.text();
        return data;
    } catch (error) {
        console.error('Error al recuperar los datos:', error);
        throw error;
    }
}

async function agregarConsumo(datetime, amount, unit, ingredient_id) {
    try {
        const response = await fetch(`../API/api.php?action=agregarConsumo&datetime="${datetime}"&amount=${amount}&unit="${unit}"&ingredient_id=${ingredient_id}`);
        const data = response;
        alert("Consumo registrado exitosamente");
        console.log(data)
    } catch (error) {
        console.error('Error:', error);
        throw error;
    }
}

async function conversionUnidades(lecturaActual, ingrediente, unidades1, unidades2) {
    let resultado = 0;

    switch (unidades1) {
        case "gramos":
            switch (unidades2) {
                case "gramos":
                    resultado = lecturaActual;   
                    break;
                case "kilogramos":
                    resultado = lecturaActual / 1000;    
                    break;
                case "mililitros":
                    resultado = lecturaActual / ingrediente;['density'];        
                    break;
                case "litros":
                    resultado = lecturaActual / (1000 * ingrediente['density']);            
                    break;
                case "unidades":
                    resultado = lecturaActual;       
                    break;
                case "libras":
                    resultado = lecturaActual / 453.592;
                    break;
                case "onzas":
                    resultado = lecturaActual / 28.35;      
                    break;
                case "tazas":
                    resultado = lecturaActual / (ingrediente["density"] * 240);          
                    break;
                case "medias tazas":
                    resultado = lecturaActual / (ingrediente["density"] * 120);         
                    break;
                case "cucharadas": 
                    resultado = lecturaActual / (ingrediente["density"] * 15);        
                    break;
                case "cucharaditas":
                    resultado = lecturaActual / (ingrediente["density"] * 5);       
                    break;
                case "pizcas":
                    resultado = lecturaActual / 0.18;     
                    break;
                default:
                    break;
            }    
            break;
        case "kilogramos":
            if (unidades2 == "gramos") {
                resultado = lecturaActual * 1000;
            }
            break;
        case "mililitros":   
            if (unidades2 == "gramos") {
                resultado = lecturaActual * ingrediente["density"];
            }
            break;
        case "litros":
            if (unidades2 == "gramos") {
                resultado = lecturaActual * (1000 * ingrediente["density"]);
            }
            break;
        case "unidades":
            break;
        case "libras":
            if (unidades2 == "gramos") {
                resultado = lecturaActual * 453.592;
            }
            break;
        case "onzas":
            if (unidades2 == "gramos") {
                resultado = lecturaActual * 28.35;
            }
            break;
        case "tazas":
            if (unidades2 == "gramos") {
                resultado = lecturaActual * ingrediente["density"] * 240;
            }
            break;
        case "medias tazas":
            if (unidades2 == "gramos") {
                resultado = lecturaActual * ingrediente["density"] * 120;
            }
            break;
        case "cucharadas":
            if (unidades2 == "gramos") {
                resultado = lecturaActual * ingrediente["density"] * 15;
            }
            break;
        case "cucharaditas":
            if (unidades2 == "gramos") {
                resultado = lecturaActual * ingrediente["density"] * 5;
            }
            break;
        case "piscaz":
            if (unidades2 == "gramos") {
                resultado = lecturaActual * 0.18;
            }
            break;
        default:
            break;
    }

    return parseFloat(resultado).toFixed(3);
}

async function confirmarPeso() {
    console.log(resultadoGlobal);
    console.log(ingredienteIDGlobal);
    console.log(unidadIngredienteGlobal);

    // Obtener la fecha actual
    var fechaActual = new Date();

    // Obtener los componentes de la fecha
    var año = fechaActual.getFullYear();
    var mes = ('0' + (fechaActual.getMonth() + 1)).slice(-2); // Agregar 1 al mes ya que los meses se indexan desde 0
    var dia = ('0' + fechaActual.getDate()).slice(-2);
    var horas = ('0' + fechaActual.getHours()).slice(-2);
    var minutos = ('0' + fechaActual.getMinutes()).slice(-2);
    var segundos = ('0' + fechaActual.getSeconds()).slice(-2);

    // Formatear la fecha como DATETIME
    var fechaFormateada = año + '-' + mes + '-' + dia + ' ' + horas + ':' + minutos + ':' + segundos;
    console.log(fechaFormateada);

    await agregarConsumo(fechaFormateada, resultadoGlobal, unidadIngredienteGlobal, ingredienteIDGlobal);

}

function beep() {
    var snd = new Audio("data:audio/wav;base64,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qJrx4KOQjahZxWbcZgztj2c49nKmkId44S71j0c8eV9yDK6uPRzx5X18eDvjvQ6yKo9ZSS6l//8elePK/Lf//IInrOF/FvDoADYAGBMGb7FtErm5MXMlmPAJQVgWta7Zx2go+8xJ0UiCb8LHHdftWyLJE0QIAIsI+UbXu67dZMjmgDGCGl1H+vpF4NSDckSIkk7Vd+sxEhBQMRU8j/12UIRhzSaUdQ+rQU5kGeFxm+hb1oh6pWWmv3uvmReDl0UnvtapVaIzo1jZbf/pD6ElLqSX+rUmOQNpJFa/r+sa4e/pBlAABoAAAAA3CUgShLdGIxsY7AUABPRrgCABdDuQ5GC7DqPQCgbbJUAoRSUj+NIEig0YfyWUho1VBBBA//uQZB4ABZx5zfMakeAAAAmwAAAAF5F3P0w9GtAAACfAAAAAwLhMDmAYWMgVEG1U0FIGCBgXBXAtfMH10000EEEEEECUBYln03TTTdNBDZopopYvrTTdNa325mImNg3TTPV9q3pmY0xoO6bv3r00y+IDGid/9aaaZTGMuj9mpu9Mpio1dXrr5HERTZSmqU36A3CumzN/9Robv/Xx4v9ijkSRSNLQhAWumap82WRSBUqXStV/YcS+XVLnSS+WLDroqArFkMEsAS+eWmrUzrO0oEmE40RlMZ5+ODIkAyKAGUwZ3mVKmcamcJnMW26MRPgUw6j+LkhyHGVGYjSUUKNpuJUQoOIAyDvEyG8S5yfK6dhZc0Tx1KI/gviKL6qvvFs1+bWtaz58uUNnryq6kt5RzOCkPWlVqVX2a/EEBUdU1KrXLf40GoiiFXK///qpoiDXrOgqDR38JB0bw7SoL+ZB9o1RCkQjQ2CBYZKd/+VJxZRRZlqSkKiws0WFxUyCwsKiMy7hUVFhIaCrNQsKkTIsLivwKKigsj8XYlwt/WKi2N4d//uQRCSAAjURNIHpMZBGYiaQPSYyAAABLAAAAAAAACWAAAAApUF/Mg+0aohSIRobBAsMlO//Kk4soosy1JSFRYWaLC4qZBYWFRGZdwqKiwkNBVmoWFSJkWFxX4FFRQWR+LsS4W/rFRb/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////VEFHAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAU291bmRib3kuZGUAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAMjAwNGh0dHA6Ly93d3cuc291bmRib3kuZGUAAAAAAAAAACU=");  
    snd.play();
}

async function main() {
    try {
        let ing = document.getElementById("ingrediente");
        let uni1 = document.getElementById("unidad-gastronomica-1");
        //console.log(uni1.value);
        let uni2 = document.getElementById("unidad-gastronomica-2");
        //console.log(uni2.value);
        let cantidadDeseada = document.getElementById("cantidad")
        //console.log(cantidad.value)

        if (ing.value != "none" && uni1.value != "none" && uni2.value != "none") {
            const ingrediente = await obtenerIngredientePorIDJSON(ing.value);
            //console.log(ingrediente);

            const lecturaActual = await obtenerDatoSensor();

            let resultado = await conversionUnidades(lecturaActual, ingrediente, uni1.value, uni2.value);
            let resultadoCD = await conversionUnidades(cantidadDeseada.value, ingrediente, uni1.value, uni2.value);

            document.getElementById("dato_procesado").innerText = resultado;
            document.getElementById("lectura_deseada").innerText = resultadoCD;
            
            // Creando variables globales
            window.resultadoGlobal = resultado;
            window.ingredienteIDGlobal = ing.value;
            window.unidadIngredienteGlobal = uni2.value;

            let botonConfirmar = document.getElementById("confirmar");
            if ((resultado >= resultadoCD*0.98) && (resultado <= resultadoCD*1.02)) {
                //console.log("Valor dentro del rango")
                botonConfirmar.disabled = false;
                botonConfirmar.classList.remove('bg-gray-500');
                botonConfirmar.classList.add('bg-blue-700');
                document.getElementById("accion_requerida").innerText = "Ninguna";
            } else {
                //console.log("Valor fuera del rango");
                botonConfirmar.disabled = true;
                botonConfirmar.classList.remove('bg-blue-700');
                botonConfirmar.classList.add('bg-gray-500');

                // Alarmas
                if (resultado < resultadoCD*0.98) {
                    console.log("Agrege más ingrediente");
                    document.getElementById("accion_requerida").innerText = "Agrege más ingrediente";
                    beep();
                } else if (resultado > resultadoCD*1.02) {
                    console.log("Retire cantidad del ingrediente");
                    document.getElementById("accion_requerida").innerText = "Retire cantidad del ingrediente";
                    beep();
                }
            }
        }
    } catch (error) {
        console.error('Error en main:', error);
    }
}

setInterval(main, 650);