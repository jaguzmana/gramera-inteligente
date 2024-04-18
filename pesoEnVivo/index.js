async function main() {
    try {
        let ing = document.getElementById("ingrediente");
        let uni1 = document.getElementById("unidad-gastronomica-1");
        //console.log(uni1.value);
        let uni2 = document.getElementById("unidad-gastronomica-2");
        //console.log(uni2.value);
        let cantidadDeseada = document.getElementById("cantidad");
        //console.log(cantidad.value)

        if (ing.value != "none" && uni1.value != "none" && uni2.value != "none") {
            const ingrediente = await obtenerIngredientePorIDJSON(ing.value);
            const unidadIng = ingrediente['unit'];
            //console.log(ingrediente);

            if (unidadIng != 'unidades') {
                // Validar si hay suficiente cantidad del ingrediente
                let cantidadDeseadaGramos = await conversionUnidades(cantidadDeseada.value, ingrediente, uni1.value, unidadIng);
                
                if (cantidadDeseadaGramos <= parseFloat(ingrediente['amount'])) {
                    const lecturaActual = await obtenerDatoSensor();
                    let resultado = await conversionUnidades(lecturaActual, ingrediente, unidadIng, uni2.value);
                    let resultadoCD = await conversionUnidades(cantidadDeseada.value, ingrediente, uni1.value, uni2.value);
        
                    document.getElementById("dato_procesado").innerText = resultado;
                    document.getElementById("lectura_deseada").innerText = resultadoCD;
                    document.getElementById("unit1").innerText = uni2.value;
                    document.getElementById("unit2").innerText = uni2.value;
                    
                    // Creando variables globales
                    window.resultadoGlobal = resultado;
                    window.ingredienteIDGlobal = ing.value;
                    window.unidadIngredienteGlobal = uni2.value;
                    window.ingredienteGlobal = ingrediente;
                    window.resultadoGlobalGramos = parseFloat(lecturaActual).toFixed(3);
        
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
                            //console.log("Agrege más ingrediente");
                            document.getElementById("accion_requerida").innerText = "Agrege más ingrediente";
                            beep();
                        } else if (resultado > resultadoCD*1.02) {
                            //console.log("Retire cantidad del ingrediente");
                            document.getElementById("accion_requerida").innerText = "Retire cantidad del ingrediente";
                            beep();
                        }
                    }
                } else {
                    alert("No hay suficiente cantidad del ingrediente.");
                    location.reload();
                }
            } else {
                if (cantidadDeseada.value <= 0) {
                    document.getElementById("accion_requerida").innerText = "La cantidad debe ser mayor a 0";
                    document.getElementById("confirmar").disabled = true;
                    document.getElementById("confirmar").classList.remove('bg-blue-700');
                    document.getElementById("confirmar").classList.add('bg-gray-500');
                } else {
                    document.getElementById("accion_requerida").innerText = "Ninguna";
                    document.getElementById("confirmar").disabled = false;
                    document.getElementById("confirmar").classList.add('bg-blue-700');
                    document.getElementById("confirmar").classList.remove('bg-gray-500');
                }
                document.getElementById("dato_procesado").innerText = cantidadDeseada.value;
                document.getElementById("lectura_deseada").innerText = cantidadDeseada.value;
                document.getElementById("unit1").innerText = unidadIng;
                document.getElementById("unit2").innerText = unidadIng;
                uni1.value = unidadIng;
                uni2.value = unidadIng;

                window.resultadoGlobal = cantidadDeseada.value;
                window.ingredienteIDGlobal = ingrediente['id'];
                window.unidadIngredienteGlobal = unidadIng;
                window.resultadoGlobalGramos = cantidadDeseada.value;
            }
        }
    } catch (error) {
        console.error('Error en main:', error);
    }
}

setInterval(main, 800);