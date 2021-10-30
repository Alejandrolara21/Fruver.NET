arrayImagenesProductos = [];

document.addEventListener('DOMContentLoaded', function() {
    imagenesProducto();
    verProducto();
});

function imagenesProducto(){
    if(document.querySelectorAll('.boton_form_imagen')){
        const botonesFormulario = document.querySelectorAll('.boton_form_imagen');

        botonesFormulario.forEach(boton =>{
            boton.addEventListener('click',e =>{
                console.log(e);
                nombreImagen = e.target.id;
                const imagen = document.querySelector(`[data-imagenProducto="${nombreImagen}"]`);
                
                if(confirm('¿Seguro que quieres eliminar la imagen?')){
                    imagen.classList.add('hidden');
                    boton.classList.add('hidden');

                    arrayImagenesProductos = [...arrayImagenesProductos,nombreImagen];
                    agregarArrayImagenes(arrayImagenesProductos);
                }

            });
        }); 
    }
}

function agregarArrayImagenes(array){
    const divImagenes = document.querySelector('.imagenes_eliminadas');
    while(divImagenes.firstChild){
        divImagenes.removeChild(divImagenes.firstChild);
    }

    array.forEach(elemento =>{
        let elementoImagenes = document.createElement('INPUT');
        elementoImagenes.setAttribute("name",`imagen[]`);
        elementoImagenes.setAttribute("value",`${elemento}`);
        divImagenes.appendChild(elementoImagenes);
    });
}

function verProducto(){
    if(document.querySelectorAll('.ver_informacion')){
        const imagenes = document.querySelector('.imagenes-productos').textContent;
        const jsonImagenes = JSON.parse(imagenes);

        const datosProductos = document.querySelector('.datos-productos').textContent;
        const jsonProductos = JSON.parse(datosProductos);

        const iconosInfo = document.querySelectorAll('.ver_informacion');

        iconosInfo.forEach(iconoInfo => {
            iconoInfo.addEventListener('click',function(e){
                referenciaProducto = iconoInfo.dataset.producto;
                datosProductos = [];
                datosImagen = [];
                jsonProductos.forEach(producto =>{
                    if(producto.referencia === referenciaProducto){
                        console.log("Producto encontrado");
                    }
                });

                jsonImagenes.forEach(imagen =>{
                    if(imagen.referencia === referenciaProducto){
                        console.log("Imagen encontrada");
                    }
                });
            });
        });
    }
}
