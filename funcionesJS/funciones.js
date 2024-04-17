async function obtenerPasosPorIDJSON(recipe_id) {
    try {
        const response = await fetch(`../API/api.php?action=obtenerPasosPorID&recipe_id=${recipe_id}`);
        const data = await response.json();
        return data.items;
    } catch (error) {
        console.error('Error:', error);
        throw error;
    }
}

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

function agregarConsumo(datetime, amount, unit, ingredient_id) {
    try {
        const response = fetch(`../API/api.php?action=agregarConsumo&datetime="${datetime}"&amount=${amount}&unit="${unit}"&ingredient_id=${ingredient_id}`);
        const data = response;
        console.log(data);
        alert("Consumo registrado exitosamente");
    } catch (error) {
        console.error('Error:', error);
        throw error;
    }
}

function agregarConsumoIngrediente(cantidad_usada, id_ingrediente) {
    try {
        const response = fetch(`../API/api.php?action=agregarConsumoIngrediente&cantidad_usada=${cantidad_usada}&id_ingrediente=${id_ingrediente}`);
        const data = response;
        console.log(data);
    } catch (error) {
        console.error('Error:', error);
        throw error;
    }
}

async function conversionUnidades(lecturaActual, ingrediente, unidades1, unidades2) {
    
    const conversion = {
        "gramos": {
            "gramos": 1,
            "kilogramos": 1 / 1000,
            "mililitros": 1 / ingrediente.density,
            "litros": 1 / (1000 * ingrediente.density),
            "libras": 1 / 453.592,
            "onzas": 1 / 28.35,
            "tazas": 1 / (ingrediente.density * 236.588),
            "medias tazas": 1 / (ingrediente.density * 118.294),
            "cucharadas": 1 / (ingrediente.density * 14.799),
            "cucharaditas": 1 / (ingrediente.density * 4.9325),
            "pizcas": 1 / 0.625
        },
        "kilogramos": {
            "gramos": 1000,
            "kilogramos": 1,
            "mililitros": ingrediente.density * 1000,
            "litros": ingrediente.density / 1000,
            "libras": 2.20462,
            "onzas": 35.274,
            "tazas": (1000 / ingrediente.density) / 236.588,
            "medias tazas": (1000 / ingrediente.density) / 118.294,
            "cucharadas": (1000 / ingrediente.density) / 14.799,
            "cucharaditas": (1000 / ingrediente.density) / 4.9325,
            "pizcas": 1000 / 0.625
        },
        "mililitros": {
            "gramos": ingrediente.density,
            "kilogramos": 0.001 * ingrediente.density,
            "mililitros": 1,
            "litros": 1 / 1000,
            "libras": ingrediente.density * 1 / 453.592,
            "onzas": 1 / ingrediente.density * 1 / 28.3495,
            "tazas": 1 / 236.588,
            "medias tazas": 1 / 118.294,
            "cucharadas": 1 / 14.799,
            "cucharaditas": 1 / 4.9325
        },
        "litros": {
            "gramos": 1000 * ingrediente.density,
            "kilogramos": ingrediente.density / 1000,
            "mililitros": 1000,
            "litros": 1,
            "libras": (ingrediente.density / 1000) * 1 / 0.453592,
            "onzas": (ingrediente.density / 1000) * (1 / 28.3495),
            "tazas": 4.22675,
            "medias tazas": 2.1133,
            "cucharadas": 67.628,
            "cucharaditas": 202.884
        },
        "libras": {
            "gramos": 453.592,
            "kilogramos": 0.453592,
            "mililitros": 453.592 / ingrediente.density,
            "litros": (453.592 / ingrediente.density) / 1000,
            "libras": 1,
            "onzas": 16,
            "tazas": (453.592 / ingrediente.density) / 236.588,
            "medias tazas": (453.592 / ingrediente.density) / 118.294,
            "cucharadas": (453.592 / ingrediente.density) / 14.799,
            "cucharaditas": (453.592 / ingrediente.density) / 4.9325,
            "pizcas": 1 / 0.001375
        },
        "onzas": {
            "gramos": 28.3495,
            "kilogramos": 1 / 35.27396,
            "mililitros": 28.3495 / ingrediente.density,
            "litros": 28.3495 / (ingrediente.density * 1000),
            "libras": 1 / 16,
            "onzas": 1,
            "tazas": 28.3495 / (ingrediente.density * 236.588),
            "medias tazas": 128.3495 / (ingrediente.density * 118.294),
            "cucharadas": 28.3495 / (ingrediente.density * 14.799),
            "cucharaditas": 28.3495 / (ingrediente.density * 4.9325),
            "pizcas": 1 / 0.019685
        },
        "tazas": {
            "gramos": ingrediente.density * 236.588,
            "kilogramos": (ingrediente.density * 236.588) / 1000,
            "mililitros": 236.588,
            "litros": 0.236588,
            "unidades": 1,
            "libras": (236.588 * ingrediente.density) / 453.592,
            "onzas": (236.588 * ingrediente.density) / 28.3495,
            "tazas": 1,
            "medias tazas": 0.5,
            "cucharadas": (236.588 * ingrediente.density) / 14.799,
            "cucharaditas": (236.588 * ingrediente.density) / 4.9325
        },
        "medias tazas": {
            "gramos": ingrediente.density * 118.294,
            "kilogramos": (ingrediente.density * 118.294) / 1000,
            "mililitros": 118.294,
            "litros": 0.118294,
            "unidades": 1,
            "libras": (118.294 * ingrediente.density) / 453.592,
            "onzas": (118.294 * ingrediente.density) / 28.3495,
            "tazas": 2,
            "medias tazas": 1,
            "cucharadas": (118.294 * ingrediente.density) / 14.799,
            "cucharaditas": (118.294 * ingrediente.density) / 4.9325
        },
        "cucharadas": {
            "gramos": ingrediente.density * 14.799,
            "kilogramos": (ingrediente.density * 14.799) / 1000,
            "mililitros": 14.799,
            "litros": 0.014799,
            "unidades": 1,
            "libras": (14.799 * ingrediente.density) / 453.592,
            "onzas": (14.799 * ingrediente.density) / 28.3495,
            "tazas": 14.799 / 236.588,
            "medias tazas":14.799 / 118.294,
            "cucharadas": 1,
            "cucharaditas": 14.799 / 4.9325
        },
        "cucharaditas": {
            "gramos":  ingrediente.density * 4.9325,
            "kilogramos": (ingrediente.density * 4.9325) / 1000,
            "mililitros": 4.9325,
            "litros": 0.0049325,
            "libras": (4.9325 * ingrediente.density) / 453.592,
            "onzas": (4.9325 * ingrediente.density) / 28.3495,
            "tazas": 4.9325 / 236.588,
            "medias tazas": 4.9325 / 118.294,
            "cucharadas": 4.9325 / 14.799,
            "cucharaditas": 1
        },
        "pizcas": {
            "gramos": 0.625,
            "libras": 0.001375,
            "onzas": 0.019685
        }
    };

    return parseFloat(lecturaActual * conversion[unidades1][unidades2]).toFixed(3);
}

function confirmarPeso() {
    // Obtener la fecha actual
    const fechaActual = new Date();

    // Formatear la fecha como DATETIME
    const fechaFormateada = fechaActual.toISOString().slice(0, 19).replace('T', ' ');
    
    agregarConsumo(fechaFormateada, resultadoGlobal, unidadIngredienteGlobal, ingredienteIDGlobal);
    agregarConsumoIngrediente(resultadoGlobalGramos, ingredienteIDGlobal);
}

function beep() {
    var snd = new Audio("data:audio/wav;base64,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qJrx4KOQjahZxWbcZgztj2c49nKmkId44S71j0c8eV9yDK6uPRzx5X18eDvjvQ6yKo9ZSS6l//8elePK/Lf//IInrOF/FvDoADYAGBMGb7FtErm5MXMlmPAJQVgWta7Zx2go+8xJ0UiCb8LHHdftWyLJE0QIAIsI+UbXu67dZMjmgDGCGl1H+vpF4NSDckSIkk7Vd+sxEhBQMRU8j/12UIRhzSaUdQ+rQU5kGeFxm+hb1oh6pWWmv3uvmReDl0UnvtapVaIzo1jZbf/pD6ElLqSX+rUmOQNpJFa/r+sa4e/pBlAABoAAAAA3CUgShLdGIxsY7AUABPRrgCABdDuQ5GC7DqPQCgbbJUAoRSUj+NIEig0YfyWUho1VBBBA//uQZB4ABZx5zfMakeAAAAmwAAAAF5F3P0w9GtAAACfAAAAAwLhMDmAYWMgVEG1U0FIGCBgXBXAtfMH10000EEEEEECUBYln03TTTdNBDZopopYvrTTdNa325mImNg3TTPV9q3pmY0xoO6bv3r00y+IDGid/9aaaZTGMuj9mpu9Mpio1dXrr5HERTZSmqU36A3CumzN/9Robv/Xx4v9ijkSRSNLQhAWumap82WRSBUqXStV/YcS+XVLnSS+WLDroqArFkMEsAS+eWmrUzrO0oEmE40RlMZ5+ODIkAyKAGUwZ3mVKmcamcJnMW26MRPgUw6j+LkhyHGVGYjSUUKNpuJUQoOIAyDvEyG8S5yfK6dhZc0Tx1KI/gviKL6qvvFs1+bWtaz58uUNnryq6kt5RzOCkPWlVqVX2a/EEBUdU1KrXLf40GoiiFXK///qpoiDXrOgqDR38JB0bw7SoL+ZB9o1RCkQjQ2CBYZKd/+VJxZRRZlqSkKiws0WFxUyCwsKiMy7hUVFhIaCrNQsKkTIsLivwKKigsj8XYlwt/WKi2N4d//uQRCSAAjURNIHpMZBGYiaQPSYyAAABLAAAAAAAACWAAAAApUF/Mg+0aohSIRobBAsMlO//Kk4soosy1JSFRYWaLC4qZBYWFRGZdwqKiwkNBVmoWFSJkWFxX4FFRQWR+LsS4W/rFRb/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////VEFHAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAU291bmRib3kuZGUAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAMjAwNGh0dHA6Ly93d3cuc291bmRib3kuZGUAAAAAAAAAACU=");  
    snd.play();
}