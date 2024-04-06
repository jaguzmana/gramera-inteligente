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
            document.getElementById("unit1").innerText = uni2.value;
            document.getElementById("unit2").innerText = uni2.value;
            
            // Creando variables globales
            window.resultadoGlobal = resultado;
            window.ingredienteIDGlobal = ing.value;
            window.unidadIngredienteGlobal = uni2.value;
            window.ingredienteGlobal = ingrediente;
            window.resultadoGlobalGramos = resultado;

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

setInterval(main, 800);