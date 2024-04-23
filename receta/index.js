let pasoActual = 0;

async function validarIngRecetaPorIDJSON(id) {
    try {
        const response = await fetch(`validarIngReceta.php?id=${id}`);
        const data = await response.json();
        return data;
    } catch (error) {
        console.error('Error:', error);
        throw error;
    }
}

async function main() {
    try {
        //console.log(pasoActual);
        const selectReceta = document.getElementById("receta");
        const botonAdministrar = document.getElementById("administrar-recetas");
        const botonConfirmar = document.getElementById("confirmar");
        const conteoPaso = document.getElementById("paso-receta");

        if (selectReceta.value != 'none') {
            const listaIngNoCantidad = await validarIngRecetaPorIDJSON(selectReceta.value);
            //console.log(listaIngNoCantidad.length);

            if (listaIngNoCantidad.length == 0) {
                // Deshabilitar boton selección receta y administrar recetas.
                selectReceta.disabled = true;
                botonAdministrar.classList.remove('bg-blue-700');
                botonAdministrar.classList.add('bg-gray-500');
                botonAdministrar.href = "";
                botonAdministrar.classList.add('pointer-events-none');

                // Obtener pasos
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
                const unidades1 = document.getElementById('unidades-1');
                const unidades2 = document.getElementById('unidades-2');

                // Asignar valores en los objetos
                ingActual.innerText = pasosReceta[pasoActual]['nombre_ingrediente'];
                cantidadIng.innerText = pasosReceta[pasoActual]['amount'];
                unidadIng.innerText = pasosReceta[pasoActual]['unit'];
                descripcionIng.innerText = pasosReceta[pasoActual]['description'];
                
                // Obtener informacion del ingrediente
                const ingID = pasosReceta[pasoActual]['id_ingrediente'];
                const ingrediente = await obtenerIngredientePorIDJSON(ingID);
                window.ingredienteGlobal = ingrediente;

                if (pasosReceta[pasoActual]['unit'] != 'unidades') {
                    let cantidadIngGramos = await conversionUnidades(pasosReceta[pasoActual]['amount'], ingrediente, pasosReceta[pasoActual]['unit'], ingrediente['unit']);

                    document.getElementById('lectura_deseada').innerText = cantidadIngGramos;
                    document.getElementById('dato_procesado').innerText = parseFloat(lecturaSensor).toFixed(3);
                    unidades1.innerText = ingrediente['unit'];
                    unidades2.innerText = ingrediente['unit'];

                    if ((lecturaSensor >= cantidadIngGramos*0.98) && (lecturaSensor <= cantidadIngGramos*1.02)) {
                        //console.log("Valor dentro del rango")
                        // Creando variables globales
                        window.resultadoGlobal = parseFloat(lecturaSensor).toFixed(3);
                        window.ingredienteIDGlobal = ingID;
                        window.unidadIngredienteGlobal = ingrediente['unit'];
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
                            //console.log("Agrege más ingrediente");
                            document.getElementById("accion_requerida").innerText = "Agrege más ingrediente";
                            beep();
                        } else if (lecturaSensor > cantidadIngGramos*1.02) {
                            //console.log("Retire cantidad del ingrediente");
                            document.getElementById("accion_requerida").innerText = "Retire cantidad del ingrediente";
                            beep();
                        }
                    }   
                } else {
                    // Caso ingrediente en unidades
                    botonConfirmar.disabled = false;
                    botonConfirmar.classList.remove('bg-gray-500');
                    botonConfirmar.classList.add('bg-blue-700');
                    document.getElementById("accion_requerida").innerText = "Ninguna";
                    
                    document.getElementById('lectura_deseada').innerText = pasosReceta[pasoActual]['amount'];
                    document.getElementById('dato_procesado').innerText = pasosReceta[pasoActual]['amount'];
                    unidades1.innerText = ingrediente['unit'];
                    unidades2.innerText = ingrediente['unit'];

                    window.resultadoGlobal = pasosReceta[pasoActual]['amount'];
                    window.ingredienteIDGlobal = ingID;
                    window.unidadIngredienteGlobal = ingrediente['unit'];
                    window.resultadoGlobalGramos = pasosReceta[pasoActual]['amount'];
                }
            } else {
                alert("No hay suficiente cantidad de ingredientes para realizar la receta.");
                location.reload();
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