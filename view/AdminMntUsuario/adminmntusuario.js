
var usu_id = $('#usu_idx').val();

function init(){
    $("#usuario_form").on("submit",function(e){
        guardaryeditar(e);
    });
}

function guardaryeditar(e){
    e.preventDefault();
    var formData = new FormData($("#usuario_form")[0]);
    $.ajax({
        url: "../../controllers/usuarioControllers.php?op=guardaryeditar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function(data){

            $('#usuario_data').DataTable().ajax.reload();
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
    $('#usuarioSexo').select2({
        dropdownParent: $('#modalmantenimiento')
    });

    $('#usuarioRolId').select2({
        dropdownParent: $('#modalmantenimiento')
    });

    $('#usuario_data').DataTable({
        "aProcessing": true,
        "aServerSide": true,
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
        ],
        "ajax":{
            url:"../../controllers/usuarioControllers.php?op=listar",
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

function editar(usu_id){
    $.post("../../controllers/usuarioControllers.php?op=mostrar",{usuarioId : usu_id}, function (data) {
        /* onsole.log(data); */
        data = JSON.parse(data);
        $('#usuarioId').val(data.usuarioId);
        $('#usuarioNombre').val(data.usuarioNombre);
        $('#usuarioApellidoPaterno').val(data.usuarioApellidoPaterno);
        $('#usuarioApellidoMaterno').val(data.usuarioApellidoMaterno);
        $('#usuarioCorreo').val(data.usuarioCorreo);
        $('#usuarioPassword').val(data.usuarioPassword);
        $('#usuarioSexo').val(data.usuarioSexo).trigger('change');
        $('#usuarioRolId').val(data.usuarioRolId).trigger('change');
        $('#usuarioTelefono').val(data.usuarioTelefono);
        /* $('#usuarioDni').val(data.usuarioDni); */
    });
    $('#lbltitulo').html('Editar Registro');
    $('#modalmantenimiento').modal('show');
}

function eliminar(usu_id){
    swal.fire({
        title: "Eliminar!",
        text: "Desea Eliminar el Registro?",
        icon: "error",
        confirmButtonText: "Si",
        showCancelButton: true,
        cancelButtonText: "No",
    }).then((result) => {
        if (result.value) {
            $.post("../../controllers/usuarioControllers.php?op=eliminar",{usuarioId : usu_id}, function (data) {
                $('#usuario_data').DataTable().ajax.reload();

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
    $('#usu_id').val('');
    $('#usu_sex').val('').trigger('change');
    $('#rol_id').val('').trigger('change');
    $('#lbltitulo').html('Nuevo Registro');
    $('#usuario_form')[0].reset();
    $('#modalmantenimiento').modal('show');
}

$(document).on("click", "#btnplantilla", function () {
    $('#modalplantilla').modal('show');
});

var ExcelToJSON = function() {
    this.parseExcel = function(file) {
        var reader = new FileReader();

        reader.onload = function(e) {
            var data = e.target.result;
            var workbook = XLSX.read(data, {
                type: 'binary'
            });
            //TODO: Recorrido a todas las pestañas
            workbook.SheetNames.forEach(function(sheetName) {
                // Here is your object
                var XL_row_object = XLSX.utils.sheet_to_row_object_array(workbook.Sheets[sheetName]);
                var json_object = JSON.stringify(XL_row_object);
                UserList = JSON.parse(json_object);

                console.log(UserList)
                for (i = 0; i < UserList.length; i++) {

                    var columns = Object.values(UserList[i])

                    $.post("../../controllers/usuarioControllers.php?op=guardar_desde_excel",{
                        usuarioNombre : columns[0],
                        usuarioApellidoPaterno : columns[1],
                        usuarioApellidoMaterno : columns[2],
                        usuarioCorreo : columns[3],
                        usuarioPassword : columns[4],
                        usuarioSexo : columns[5],
                        usuarioTelefono :columns[6],
                        usuarioRolId : columns[7]/* ,
                        usuarioDni :columns[8] */
                    }, function (data) {
                        console.log(data);
                    });

                }
                /* TODO:Despues de subir la informacion limpiar inputfile */
                document.getElementById("upload").value=null;

                /* TODO: Actualizar Datatable JS */
                $('#usuario_data').DataTable().ajax.reload();
                $('#modalplantilla').modal('hide');
            })
        };
        reader.onerror = function(ex) {
            console.log(ex);
        };

        reader.readAsBinaryString(file);
    };
};

function handleFileSelect(evt) {
    var files = evt.target.files; // FileList object
    var xl2json = new ExcelToJSON();
    xl2json.parseExcel(files[0]);
}

document.getElementById('upload').addEventListener('change', handleFileSelect, false);

init();
