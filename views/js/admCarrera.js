var usu_id = $('#usu_idx').val();

function init(){
    $("#carrera_form").on("submit",function(e){
        guardaryeditar(e);
    });

}

function guardaryeditar(e){
    //console.log("prueba");
    e.preventDefault();
    var formData = new FormData($("#carrera_form")[0]);
    //console.log(formData);
    $.ajax({
        url: "/Evaluacion/controller/carrera.php?opc=guardaryeditar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        
        success: function(data){
            console.log(data);
            $('#carrera_data').DataTable().ajax.reload();
            $('#modalcrearCarrera').modal('hide');

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

    $('#carrera_data').DataTable({
        "aProcessing": true,
        "aServerSide": true,
        dom: 'Bfrtip',
        buttons: [
            'excelHtml5',
            'csvHtml5',
        ],
        "ajax":{
            url:"/Evaluacion/controller/carrera.php?opc=listar",
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
    $('#titulo_modal').html('Nueva Carrera');
    $('#carrera_form')[0].reset();
    $('#modalcrearCarrera').modal('show');
}

function editar(car_id){
    $.post("/Evaluacion/controller/carrera.php?opc=mostrar",{car_id:car_id},function (data){
        data = JSON.parse(data);
        //console.log(data);
        $('#car_id').val(data.car_id);
        $('#car_snies').val(data.car_snies);
        $('#car_nombre').val(data.car_nombre);
        $('#car_tipo').val(data.car_tipo).trigger('change');
        $('#car_sede').val(data.car_sede).trigger('change');
    });
    $('#titulo_modal').html('Editar Carrera');
    $('#modalcrearCarrera').modal('show');
}

function caract(car_id){
    $.post("/Evaluacion/controller/carrera.php?opc=activo",{car_id:car_id},function (data){
        $('#carrera_data').DataTable().ajax.reload();
       // data = JSON.parse(data);
    });
}

function carina(car_id){
    $.post("/Evaluacion/controller/carrera.php?opc=inactivo",{car_id:car_id},function (data){
        $('#carrera_data').DataTable().ajax.reload();
       // data = JSON.parse(data);
    });
}


function eliminar(car_id){
    Swal.fire({
        title: 'Eliminar!',
        text: 'Desea eleminar el Registro?',
        icon: 'error',
        showCancelButton: true,
        confirmButtonText: 'Aceptar',
        cancelButtonText: 'Cancelar',
    }).then((result)=>{
        if(result.value){
            $.post("/Evaluacion/controller/carrera.php?opc=eliminar",{car_id:car_id},function (data){
                $('#carrera_data').DataTable().ajax.reload();
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

$(document).on("click", "#btnplantilla", function () {
    $('#modalCarrera').modal('show');
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
                CarreraList = JSON.parse(json_object);

                console.log(CarreraList)
                for (i = 0; i < CarreraList.length; i++) {

                    var columns = Object.values(CarreraList[i])

                    $.post("/Evaluacion/controller/carrera.php?opc=guardar_desde_excel",{
                        car_snies : columns[0],
                        car_nombre : columns[1],
                        car_tipo : columns[2],
                        car_sede : columns[3],
                        estado : columns[4]
                    }, function (data) {
                        console.log(data);
                    });

                }
                /* TODO:Despues de subir la informacion limpiar inputfile */
                document.getElementById("upload").value=null;

                /* TODO: Actualizar Datatable JS */
                $('#carrera_data').DataTable().ajax.reload();
                $('#modalCarrera').modal('hide');
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