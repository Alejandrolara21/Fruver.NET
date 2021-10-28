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
    const imagenes = document.querySelector('.imageness');
    console.log(imagenes);
    // if(document.querySelectorAll('.ver_informacion')){
    //     const verProductos = document.querySelectorAll('.ver_informacion');
    //     verProductos.forEach(producto =>{
    //         producto.addEventListener('click',function(e){
    //             console.log(e.target.parentElement.id);
    //         });
    //     });
    // }
}
