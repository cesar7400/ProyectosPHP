//subir foto servidor
$('#nuevaImagen').change(function(){
    //comprobar que no este vacio el array de la imagen
    if(this.files[0] != null){
        var imagen = this.files[0];
        //validar formato de la imagen
        if(imagen["type"] !="image/jpeg" && imagen["type"] !="image/png"){
            $("#nuevaImagen").val("");
            swal({
                title: "Error al subir la imagen",
                text: "La imagen debe de estar en formato JPG ó PNG",
                showConfirmButton: true,
                type: "error",
                confirmButtonText: "Cerrar"
            });
        }else if(imagen["size"] > 2097152){
            $("#nuevaImagen").val("");
            swal({
                title: "Error al subir la imagen",
                text: "La imagen no debe pesar más de 2MB",
                showConfirmButton: true,
                type: "error",
                confirmButtonText: "Cerrar"
            });
        }else{
            var datosImagen = new FileReader;
            datosImagen.readAsDataURL(imagen);
            $(datosImagen).on("load",function(event){
                var rutaImagen = event.target.result;
                $(".previsualizar").attr("src",rutaImagen);
            })
        }
    }
})