var usu_id = $('#usu_idx').val();

$(document).ready(function(){
    $.post("../../controllers/usuarioControllers.php?op=mostrar", { usuarioId : usu_id }, function (data) {
        data = JSON.parse(data);
        $('#usu_nom').val(data.usu_nom);
        $('#usu_apep').val(data.usu_apep);
        $('#usu_apem').val(data.usu_apem);
        $('#usu_correo').val(data.usu_correo);
        $('#usu_telf').val(data.usu_telf);
        $('#usu_pass').val(data.usu_pass);
        $('#usu_sex').val(data.usu_sex).trigger("change");
    });
});


$(document).on("click","#btnactualizar", function(){

    $.post("../../controllers/usuarioControllers.php?op=update_perfil", { 
        usuarioId : usu_id,
        usuarioNombre : $('#usu_nom').val(),
        usuarioApellidoPaterno : $('#usu_apep').val(),
        usuarioApellidoMaterno : $('#usu_apem').val(),
        usuarioPassword : $('#usu_pass').val(),
        usuarioSexo : $('#usu_sex').val(),
        usuarioTelefono : $('#usu_telf').val()
     }, function (data) {
    });

    Swal.fire({
        title: 'Correcto!',
        text: 'Se actualizo Correctamente',
        icon: 'success',
        confirmButtonText: 'Aceptar'
    })
});