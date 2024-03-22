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
        const response = await fetch('lectura_sensor.txt');
        const data = await response.text();
        return data;
    } catch (error) {
        console.error('Error al recuperar los datos:', error);
        throw error;
    }
}

async function conversionUnidades(lecturaActual, ingrediente, unidades1, unidades2) {
    let resultado = 0;
    if (unidades1 == "gramos") {
        switch (unidades2) {
            case "gramos":
                resultado = lecturaActual;   
                break;
            case "kilogramos":
                resultado = lecturaActual / 1000;    
                break;
            case "mililitro":
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
    }

    return resultado;
}

async function main() {
    try {
        let ing = document.getElementById("ingrediente");
        let uni1 = document.getElementById("unidad-gastronomica-1");
        console.log(uni1.value);
        let uni2 = document.getElementById("unidad-gastronomica-2");
        console.log(uni2.value);
        
        if (ing.value != "none" && uni1.value != "none" && uni2.value != "none") {
            const ingrediente = await obtenerIngredientePorIDJSON(ing.value);
            console.log(ingrediente);

            const lecturaActual = await obtenerDatoSensor();

            let resultado = await conversionUnidades(lecturaActual, ingrediente, uni1.value, uni2.value)

            document.getElementById("dato_procesado").innerText = resultado;
        }
    } catch (error) {
        console.error('Error en main:', error);
    }
}

setInterval(main, 500);