let pasoActual = 0;

async function main() {
    try {
        console.log(pasoActual);
        const selectReceta = document.getElementById("receta");
        const botonAdministrar = document.getElementById("administrar-recetas");
        const botonConfirmar = document.getElementById("confirmar");
        const conteoPaso = document.getElementById("paso-receta");
        
        // botonConfirmar.classList.remove('bg-blue-700');
        // botonConfirmar.classList.add('bg-gray-500');

        if (selectReceta.value != 'none') {
            selectReceta.disabled = true;
            botonAdministrar.classList.remove('bg-blue-700');
            botonAdministrar.classList.add('bg-gray-500');

            const pasosReceta = await obtenerPasosPorIDJSON(selectReceta.value);
            conteoPaso.innerText = `(${pasoActual + 1}/${pasosReceta.length})`;

            // Variable global
            window.tamanoPasos = pasosReceta.length;

            // Lectura Sensor
            const lecturaSensor = await obtenerDatoSensor();

            // Obtener objetos DOM
            const ingActual = document.getElementById('ing_receta');
            const cantidadIng = document.getElementById('cantidad_ing');
            const unidadIng = document.getElementById('unidad_ing');
            const descripcionIng = document.getElementById('description');

            // Asignar valores en los objetos
            ingActual.innerText = pasosReceta[pasoActual]['nombre_ingrediente'];
            cantidadIng.innerText = pasosReceta[pasoActual]['amount'];
            unidadIng.innerText = pasosReceta[pasoActual]['unit'];
            descripcionIng.innerText = pasosReceta[pasoActual]['description'];
            
            // Obtener informacion del ingrediente
            const ingID = pasosReceta[pasoActual]['id_ingrediente'];
            const ingrediente = await obtenerIngredientePorIDJSON(ingID);
            window.ingredienteGlobal = ingrediente;
            
            let cantidadIngGramos = await conversionUnidades(pasosReceta[pasoActual]['amount'], ingrediente, pasosReceta[pasoActual]['unit'], 'gramos');
            
            document.getElementById('lectura_deseada').innerText = cantidadIngGramos;
            document.getElementById('dato_procesado').innerText = parseFloat(lecturaSensor).toFixed(3);

            if ((lecturaSensor >= cantidadIngGramos*0.98) && (lecturaSensor <= cantidadIngGramos*1.02)) {
                //console.log("Valor dentro del rango")
                // Creando variables globales
                // TODO: Verificar el tipo de unidad en la que se guarda el ingrediente en la tabla.
                window.resultadoGlobal = parseFloat(lecturaSensor).toFixed(3);
                window.ingredienteIDGlobal = ingID;
                window.unidadIngredienteGlobal = 'gramos'; //pasosReceta[pasoActual]['unit'];
                window.resultadoGlobalGramos = cantidadIngGramos;

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
                if (lecturaSensor < cantidadIngGramos*0.98) {
                    console.log("Agrege más ingrediente");
                    document.getElementById("accion_requerida").innerText = "Agrege más ingrediente";
                    beep();
                } else if (lecturaSensor > cantidadIngGramos*1.02) {
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

function siguientePaso() {
    if (pasoActual < tamanoPasos - 1) {
        pasoActual++;
        confirmarPeso();
    } else {
        confirmarPeso(); // ultimo ingrediente
        alert("Receta finalizada!")
        pasoActual = 0;
        location.reload();
    }
}

setInterval(main, 800);