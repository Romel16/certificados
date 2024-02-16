var canvas = document.getElementById('canvas');
var ctx = canvas.getContext('2d');

/* Inicializamos la imagen */
var image = new Image();
var imageqr = new Image();

$(document).ready(function(){
    var curd_id = getUrlParameter('detallecursoId');

    $.post("../../controllers/usuarioControllers.php?op=mostrar_curso_detalle", { detallecursoId : curd_id }, function (data) {
        data = JSON.parse(data);
        console.log(data);

        /* Ruta de la Imagen */
        image.src = data.cursoImagen;
        /* Dimensionamos y seleccionamos imagen */
        image.onload = function() {
            ctx.drawImage(image, 0, 0, canvas.width, canvas.height);
            /* Definimos tamaño de la fuente */
            ctx.font = '40px Arial';
            ctx.textAlign = "center";
            ctx.textBaseline = 'middle';
            var x = canvas.width / 2;
            ctx.fillText(data.usuarioNombre+' '+ data.usuarioApellidoPaterno+' '+data.usuarioApellidoMaterno, x, 250);

            ctx.font = '30px Arial';
            ctx.fillText(data.cursoNombre, x, 320);

            ctx.font = '18px Arial';
            ctx.fillText(data.instructorNombre+' '+ data.instructorApellidoPaterno+' '+data.instructorApellidoMaterno, x, 420);
            ctx.font = '15px Arial';
            ctx.fillText('Instructor', x, 450);

            ctx.font = '15px Arial';
            ctx.fillText('Fecha de Inicio : '+data.cursoFechaInicio+' / '+'Fecha de Finalización : '+data.cursoFechaFin+'', x, 490);

            /* Ruta de la Imagen */
            imageqr.src = "../../public/qr"+detallecursoId+".png";
            imageqr.src = "../../public/qr"+detallecursoId+".jpg";
            /* Dimensionamos y seleccionamos imagen */
            imageqr.onload = function() {
                ctx.drawImage(imageqr, 400, 500, 100, 100);
            } 
            $('#cur_descrip').html(data.cursoDescripcion);

        };

    });

});

$(document).on("click","#btnpng", function(){
    let lblpng = document.createElement('a');
    lblpng.download = "Certificado.png";
    lblpng.href = canvas.toDataURL();
    lblpng.click();
});

$(document).on("click","#btnpdf", function(){
    var imgData = canvas.toDataURL('image/png');
    var doc = new jsPDF('l', 'mm');
    doc.addImage(imgData, 'PNG', 30, 15);
    doc.save('Certificado.pdf');
});

var getUrlParameter = function getUrlParameter(sParam) {
    var sPageURL = decodeURIComponent(window.location.search.substring(1)),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : sParameterName[1];
        }
    }
};
