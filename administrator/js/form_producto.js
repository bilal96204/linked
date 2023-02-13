let inputsEtiquetas = document.querySelector('.inputsEtiquetas'); // etiquetas checked
let contenedorEtiquetas = document.querySelector(
    '.contenedorEtiquetas'
); // etiquetas disponibles
let botonEtiqueta = document.querySelector('.botonEtiqueta'); // boton para añadir etiquetas
let time; // variable para el timeout
let results = {};
let checked = {};

// deshabilitar boton de añadir etiqueta
botonEtiqueta.disabled = true;
//evento del input para buscar etiquetas
document
    .getElementById('inputEtiqueta')
    .addEventListener('keyup', function (e) {
        e.preventDefault();

        // deshabilitar boton de añadir etiqueta
        document.getElementById('inputEtiqueta').value == ''
            ? (botonEtiqueta.disabled = true)
            : (botonEtiqueta.disabled = false);

        if (e.keyCode >= 65 && e.keyCode <= 90) {
            clearTimeout(time);
            time = setTimeout(function () {
                submitForm(e, 'etiqueta');
            }, 500);
        }
    });
// funcion para buscar alergenos
function submitForm(evento, tipo_input) {
    let inputEtiqueta = document.getElementById('inputEtiqueta');

    inputEtiqueta.addEventListener('keyup', function () {
        if (inputEtiqueta.value == '') {
            contenedorEtiquetas.innerHTML = '';
            results = {};
        }
    });

    if (tipo_input == 'etiqueta' && inputEtiqueta.value.length > 0) {
        fetch(
            'ajax/fetch_form_producto.php?valor_input=' +
                inputEtiqueta.value +
                '&tipo_input=' +
                tipo_input +
                '&idProducto=' +
                1
        )
            .then((response) => response.json())
            .then((arrayEtiqueta) => {
                arrayEtiqueta.forEach((item) => {
                    if (item.nombre.includes(inputEtiqueta.value)) {
                        mostrarEtiquetas(
                            item,
                            contenedorEtiquetas,
                            evento
                        );
                    }
                });
            });
    }
}

// funcion para mostrar las etiquetas seleccionadas
function checkInput(item, input) {
    input.addEventListener('change', function (event) {
        if (event.target.checked) {
            checked[item.nombre] = event.target.checked;

            let etiqueta = document.createElement('input');
            let label = document.createElement('label');
            label.textContent = event.target.id;
            label.classList.add('m-1');

            etiqueta.value = item.idEtiqueta;
            etiqueta.name = 'etiquetaSeleccionada[]';
            etiqueta.type = 'hidden';

            inputsEtiquetas.appendChild(label);
            inputsEtiquetas.appendChild(etiqueta);
        } else {
            /* eliminar el label que coincide con el que no esta checked solo los labels que estan dentro del div inputsEtiquetas */
            let labels = inputsEtiquetas.querySelectorAll('label');
            let inputs = inputsEtiquetas.querySelectorAll('input');
            eliminarInputLabel(inputs, labels, event, item);
        }
    });
}

function mostrarEtiquetas(item, contenedor, evento) {
    // si existe el checkbox, no se crea
    if (checkboxExists(item.idEtiqueta)) {
        return;
    }

    // selectores
    let div = document.createElement('div');
    let label = document.createElement('label');
    let input = document.createElement('input');

    // añadir clases
    div.classList.add('form-check', 'd-flex');

    // añadir atributos
    label.setAttribute('for', item.nombre);
    input.setAttribute('type', 'checkbox');
    input.setAttribute('id', item.nombre);
    input.setAttribute('value', item.idEtiqueta);
    input.setAttribute('name', 'etiqueta[]');

    // añadir nombre al label
    label.innerHTML = item.nombre;

    // añadir al div
    div.appendChild(input);
    div.appendChild(label);

    // añadir al contenedor
    contenedor.appendChild(div);

    // almacenar los chekbox creados para no crear duplicados
    if (!results[item.idEtiqueta]) {
        results[item.idEtiqueta] = item;
    } else {
        return;
    }

    /* comprobar los estados de los inputs */
    if (checked[item.nombre]) {
        input.checked = true;
    }

    /* 
        comprueba si hay algun input dentro del contenedor
        si encuentra a alguno que coincida en la base de datos
        lo marca como checked
     */
    if (inputsEtiquetas.children.length > 0) {
        if (inputsEtiquetas.children[1].value == item.idEtiqueta) {
            input.checked = true;
        }
    }

    checkInput(item, input);
}

// comprobar si el checkbox existe
function checkboxExists(id) {
    const checkboxes = document.querySelectorAll(
        "input[type='checkbox']"
    );
    for (let i = 0; i < checkboxes.length; i++) {
        if (checkboxes[i].value == id) {
            return true;
        }
    }
    return false;
}

// funcion para eliminar los inputs y labels de los alergenos seleccionados
function eliminarInputLabel(inputs, labels, event, item) {
    labels.forEach((label) => {
        if (label.textContent == event.target.id) {
            label.remove();
        }
    });
    inputs.forEach((input) => {
        if (input.value == item.idEtiqueta) {
            input.remove();
        }
    });
}

document
    .getElementById('añadirEtiqueta')
    .addEventListener('click', function (e) {
        e.preventDefault();
        añadirEtiqueta();
    });

function añadirEtiqueta() {
    var etiquetaNormal =
        document.getElementById('inputEtiqueta').value;
    var etiquetaDepurada = etiquetaNormal.toLowerCase();
    var etiquetaDepurada = etiquetaNormal.replace('á', 'a');
    var etiquetaDepurada = etiquetaNormal.replace('é', 'e');
    var etiquetaDepurada = etiquetaNormal.replace('ú', 'u');
    var etiquetaDepurada = etiquetaNormal.replace('í', 'i');
    var etiquetaDepurada = etiquetaNormal.replace('ó', 'o');

    const xhttp = new XMLHttpRequest();
    xhttp.onload = function () {
        resultado = this.responseText;
        if (resultado == 'existe') {
            swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'La etiqueta ya existe',
            });
        } else {
            /* pasar de json a array */
            let etiqueta = JSON.parse(resultado);

            // creamos el input y el label dentro del contenedor
            let input = document.createElement('input');
            let label = document.createElement('label');
            label.textContent = etiqueta.nombre;

            input.value = etiqueta.idEtiqueta;
            input.name = 'etiquetaSeleccionada[]';
            input.type = 'hidden';

            inputsEtiquetas.appendChild(label);
            inputsEtiquetas.appendChild(input);

            swal.fire({
                icon: 'success',
                title: 'Etiqueta añadida',
                text: 'La etiqueta se ha añadido correctamente',
            });
        }
    };

    xhttp.open(
        'GET',
        'ajax/ajax_producto_añadir_etiqueta.php?etiqueta=' +
            etiquetaDepurada +
            '&etiquetaNormal=' +
            etiquetaNormal
    );

    xhttp.send();
}
