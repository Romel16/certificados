var usu_id = $('#usu_idx').val();

$(document).ready(function(){
    $.post("../../controllers/usuarioControllers.php?op=mostrar", { usuarioId : usu_id }, function (data) {
        data = JSON.parse(data);
        $('#usuarioNombre').val(data.usuarioNombre);
        $('#usuarioApellidoPaterno').val(data.usuarioApellidoPaterno);
        $('#usuarioApellidoMaterno').val(data.usuarioApellidoMaterno);
        $('#usuarioCorreo').val(data.usuarioCorreo);
        $('#usuarioTelefono').val(data.usuarioTelefono);
        $('#usuarioPassword').val(data.usuarioPassword);
        $('#usuarioSexo').val(data.usuarioSexo).trigger("change");
    });
});


$(document).on("click","#btnactualizar", function(){

    $.post("../../controllers/usuarioControllers.php?op=update_perfil", { 
        usuarioId : usu_id,
        usuarioNombre : $('#usuarioNombre').val(),
        usuarioApellidoPaterno : $('#usuarioApellidoPaterno').val(),
        usuarioApellidoMaterno : $('#usuarioApellidoMaterno').val(),
        usuarioPassword : $('#usuarioPassword').val(),
        usuarioSexo : $('#usuarioSexo').val(),
        usuarioTelefono : $('#usuarioTelefono').val()
     }, function (data) {
    });

    Swal.fire({
        title: 'Correcto!',
        text: 'Se actualizo Correctamente',
        icon: 'success',
        confirmButtonText: 'Aceptar'
    })
});