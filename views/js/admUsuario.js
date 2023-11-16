var usu_id = $('#usu_idx').val();

function init(){
    $("#usuario_form").on("submit",function(e){
        guardaryeditar(e);
    });

}

function guardaryeditar(e){
    //console.log("prueba");
    e.preventDefault();
    var formData = new FormData($("#usuario_form")[0]);
    //console.log(formData);
    $.ajax({
        url: "/Evaluacion/controller/usuario.php?opc=guardaryeditar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        
        success: function(data){
            console.log(data);
            $('#usuario_data').DataTable().ajax.reload();
            $('#modalcrearUsuario').modal('hide');

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
    $('#per_id').select2({
        dropdownParent: $("#modalcrearUsuario")
    });
    $('#rol_id').select2({
        dropdownParent: $('#modalcrearUsuario')
    });
    $('#car_id').select2({
        dropdownParent: $('#modalcrearUsuario')
    });


    select_periodo();
    select_rol();
    select_carrera();

    $('#usuario_data').DataTable({
        "aProcessing": true,
        "aServerSide": true,
        dom: 'Bfrtip',
        buttons: [
            'excelHtml5',
            'csvHtml5',
        ],
        "ajax":{
            url:"/Evaluacion/controller/usuario.php?opc=listar",
            type:"post"
        },
        "bDestroy": true,
        "responsive": true,
        "bInfo":true,
        "iDisplayLength": 15,
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

function nuevo(){
    $('#titulo_modal').html('Nuevo Usuario');
    $('#usuario_form')[0].reset();
    $('#modalcrearUsuario').modal('show');
}

function usuact(usu_id){
    $.post("/Evaluacion/controller/usuario.php?opc=activo",{usu_id:usu_id},function (data){
        $('#usuario_data').DataTable().ajax.reload();
       // data = JSON.parse(data);
    });
}

function usuina(usu_id){
    $.post("/Evaluacion/controller/usuario.php?opc=inactivo",{usu_id:usu_id},function (data){
        $('#usuario_data').DataTable().ajax.reload();
       // data = JSON.parse(data);
    });
}


function editar(usu_id){
    $.post("/Evaluacion/controller/usuario.php?opc=mostrar",{usu_id:usu_id},function (data){
        data = JSON.parse(data);
        //console.log(data);
        $('#usu_id').val(data.usu_id);
        $('#usu_usuario').val(data.usu_usuario);
        $('#usu_clave').val(data.usu_clave);
        $('#usu_nombre').val(data.usu_nombre);
        $('#usu_apellidos').val(data.usu_apellidos);
        $('#usu_email').val(data.usu_email);
        $('#car_id').val(data.car_id).trigger('change');
        $('#usu_pensum').val(data.usu_pensum);
        $('#rol_id').val(data.rol_id).trigger('change');
        $('#usu_direccion').val(data.usu_direccion);
        $('#usu_tel').val(data.usu_tel);
        $('#per_id').val(data.per_id).trigger('change');
        $('#usu_sede').val(data.usu_sede).trigger('change');
    });
    $('#titulo_modal').html('Editar Usuario');
    $('#modalcrearUsuario').modal('show');
}

function eliminar(usu_id){
    Swal.fire({
        title: 'Eliminar!',
        text: 'Desea eleminar el Registro?',
        icon: 'error',
        showCancelButton: true,
        confirmButtonText: 'Aceptar',
        cancelButtonText: 'Cancelar',
    }).then((result)=>{
        if(result.value){
            $.post("/Evaluacion/controller/usuario.php?opc=eliminar",{usu_id:usu_id},function (data){
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

function select_periodo(){
    $.post("/Evaluacion/controller/periodos.php?opc=combo",function (data){
        $('#per_id').html(data);
    });
}

function select_rol(){
    $.post("/Evaluacion/controller/rol.php?opc=combo",function (data){
        $('#rol_id').html(data);
    });
}

function select_carrera(){
    $.post("/Evaluacion/controller/carrera.php?opc=combo",function (data){
        $('#car_id').html(data);
    });
}

$(document).on("click", "#btnplantilla", function () {
    $('#modalUsuario').modal('show');
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
                UsuarioList = JSON.parse(json_object);

                console.log(UsuarioList)
                for (i = 0; i < UsuarioList.length; i++) {

                    var columns = Object.values(UsuarioList[i])

                    $.post("/Evaluacion/controller/usuario.php?opc=guardar_desde_excel",{
                        usu_usuario : columns[0],
                        usu_clave : columns[1],
                        usu_nombre : columns[2],
                        usu_apellidos : columns[3],
                        usu_email : columns[4],
                        car_id : columns[5],
                        usu_pensum : columns[6],
                        rol_id : columns[7],
                        usu_direccion : columns[8],
                        usu_tel : columns[9],
                        per_id : columns[10],
                        usu_sede : columns[11],
                        estado : columns[12]
                    }, function (data) {
                        console.log(data);
                    });

                }
                /* TODO:Despues de subir la informacion limpiar inputfile */
                document.getElementById("upload").value=null;

                /* TODO: Actualizar Datatable JS */
                $('#usuario_data').DataTable().ajax.reload();
                $('#modalUsuario').modal('hide');
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