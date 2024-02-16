
var usu_id = $('#usu_idx').val();

function init(){
    $("#instructor_form").on("submit",function(e){
        guardaryeditar(e);
    });
}

function guardaryeditar(e){
    e.preventDefault();
    var formData = new FormData($("#instructor_form")[0]);
    $.ajax({
        url: "../../controllers/instructorControllers.php?op=guardaryeditar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function(data){

            $('#instructor_data').DataTable().ajax.reload();
            $('#modalmantenimiento').modal('hide');

            Swal.fire({
                title: 'Correcto!',
                text: 'Se Registro Correctamente',
                icon: 'success',
                confirmButtonText: 'Aceptar'
            })
        }
    });
}

$(document).ready(function(){
    $('#instructorSexo').select2({
        dropdownParent: $('#modalmantenimiento')
    });

    $('#instructor_data').DataTable({
        "aProcessing": true,
        "aServerSide": true,
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
        ],
        "ajax":{
            url:"../../controllers/instructorControllers.php?op=listar",
            type:"post"
        },
        "bDestroy": true,
        "responsive": true,
        "bInfo":true,
        "iDisplayLength": 10,
        "order": [[ 0, "desc" ]],
        "language": {
            "sProcessing":     "Procesando...",
            "sLengthMenu":     "Mostrar _MENU_ registros",
            "sZeroRecords":    "No se encontraron resultados",
            "sEmptyTable":     "Ningún dato disponible en esta tabla",
            "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix":    "",
            "sSearch":         "Buscar:",
            "sUrl":            "",
            "sInfoThousands":  ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst":    "Primero",
                "sLast":     "Último",
                "sNext":     "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        },
    });

});

function editar(inst_id){
    $.post("../../controllers/instructorControllers.php?op=mostrar",{instructorId : inst_id}, function (data) {
        data = JSON.parse(data);
        $('#instructorId').val(data.instructorId);
        $('#instructorNombre').val(data.instructorNombre);
        $('#instructorApellidoPaterno').val(data.instructorApellidoPaterno);
        $('#instructorApellidoMaterno').val(data.instructorApellidoMaterno);
        $('#instructorCorreo').val(data.instructorCorreo);
        $('#instructorSexo').val(data.instructorSexo).trigger('change');
        $('#instructorTelefono').val(data.instructorTelefono);
    });
    $('#lbltitulo').html('Editar Registro');
    $('#modalmantenimiento').modal('show');
}

function eliminar(inst_id){
    swal.fire({
        title: "Eliminar!",
        text: "Desea Eliminar el Registro?",
        icon: "error",
        confirmButtonText: "Si",
        showCancelButton: true,
        cancelButtonText: "No",
    }).then((result) => {
        if (result.value) {
            $.post("../../controllers/instructorControllers.php?op=eliminar",{instructorId : inst_id}, function (data) {
                $('#instructor_data').DataTable().ajax.reload();

                Swal.fire({
                    title: 'Correcto!',
                    text: 'Se Elimino Correctamente',
                    icon: 'success',
                    confirmButtonText: 'Aceptar'
                })
            });
        }
    });
}

function nuevo(){
    $('#instructoId').val('');
    $('#instructoSexo').val('').trigger('change');
    $('#lbltitulo').html('Nuevo Registro');
    $('#instructor_form')[0].reset();
    $('#modalmantenimiento').modal('show');
}

init();
