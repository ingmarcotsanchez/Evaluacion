var usu_id = $('#usu_idx').val();

function init(){
    $("#asignatura_form").on("submit",function(e){
        guardaryeditar(e);
    });

}

function guardaryeditar(e){
    //console.log("prueba");
    e.preventDefault();
    var formData = new FormData($("#asignatura_form")[0]);
    //console.log(formData);
    $.ajax({
        url: "/Evaluacion/controller/asignatura.php?opc=guardaryeditar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        
        success: function(data){
            console.log(data);
            $('#asignatura_data').DataTable().ajax.reload();
            $('#modalcrearAsignatura').modal('hide');

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
    $('#car_id').select2({
        dropdownParent: $('#modalcrearAsignatura')
    });

    combo_carreras();

    $('#asignatura_data').DataTable({
        "aProcessing": true,
        "aServerSide": true,
        dom: 'Bfrtip',
        buttons: [
            'excelHtml5',
            'csvHtml5',
        ],
        "ajax":{
            url:"/Evaluacion/controller/asignatura.php?opc=listar",
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
    $('#titulo_modal').html('Nueva Materia');
    $('#asignatura_form')[0].reset();
    $('#modalcrearAsignatura').modal('show');
}

function editar(mat_id){
    $.post("/Evaluacion/controller/asignatura.php?opc=mostrar",{mat_id:mat_id},function (data){
        data = JSON.parse(data);
        //console.log(data);
        $('#mat_id').val(data.mat_id);
        $('#car_id').val(data.car_id).trigger('change');
        $('#mat_codigo').val(data.mat_codigo);
        $('#mat_nombre').val(data.mat_nombre);
    });
    $('#titulo_modal').html('Editar Materia');
    $('#modalcrearAsignatura').modal('show');
}

function eliminar(mat_id){
    Swal.fire({
        title: 'Eliminar!',
        text: 'Desea eleminar el Registro?',
        icon: 'error',
        showCancelButton: true,
        confirmButtonText: 'Aceptar',
        cancelButtonText: 'Cancelar',
    }).then((result)=>{
        if(result.value){
            $.post("/Evaluacion/controller/asignatura.php?opc=eliminar",{mat_id:mat_id},function (data){
                $('#asignatura_data').DataTable().ajax.reload();
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

function combo_carreras(){
    $.post("/Evaluacion/controller/carrera.php?opc=combo", function (data) {
        $('#car_id').html(data);
    });
}

$(document).on("click", "#btnplantilla", function () {
    $('#modalAsignatura').modal('show');
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
                AsignaturaList = JSON.parse(json_object);

                console.log(AsignaturaList)
                for (i = 0; i < AsignaturaList.length; i++) {

                    var columns = Object.values(AsignaturaList[i])

                    $.post("/Evaluacion/controller/asignatura.php?opc=guardar_desde_excel",{
                        car_id : columns[0],
                        mat_codigo : columns[1],
                        mat_nombre : columns[2]
                    }, function (data) {
                        console.log(data);
                    });

                }
                /* TODO:Despues de subir la informacion limpiar inputfile */
                document.getElementById("upload").value=null;

                /* TODO: Actualizar Datatable JS */
                $('#asignatura_data').DataTable().ajax.reload();
                $('#modalAsignatura').modal('hide');
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