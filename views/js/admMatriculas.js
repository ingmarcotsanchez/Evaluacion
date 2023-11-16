var usu_id = $('#usu_idx').val();

function init(){
    $("#matricula_form").on("submit",function(e){
        guardaryeditar(e);
    });

}

function guardaryeditar(e){
    //console.log("prueba");
    e.preventDefault();
    var formData = new FormData($("#matricula_form")[0]);
    //console.log(formData);
    $.ajax({
        url: "/Evaluacion/controller/matriculas.php?opc=guardaryeditar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        
        success: function(data){
            console.log(data);
            $('#matricula_data').DataTable().ajax.reload();
            $('#modalcrearMatricula').modal('hide');

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
    $('#mat_id').select2({
        dropdownParent: $('#modalcrearMatricula')
    });

    combo_materias();

    $('#usu_id').select2({
        dropdownParent: $('#modalcrearMatricula')
    });

    combo_estudiantes();
    combo_profesores();

    $('#matricula_data').DataTable({
        "aProcessing": true,
        "aServerSide": true,
        dom: 'Bfrtip',
        buttons: [
            'excelHtml5',
            'csvHtml5',
        ],
        "ajax":{
            url:"/Evaluacion/controller/matriculas.php?opc=listar",
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
    $('#titulo_modal').html('Nueva Matericula');
    $('#matricula_form')[0].reset();
    $('#modalcrearMatricula').modal('show');
}

function evaluar(mat_id){
    console.log(mat_id);
    //window.open('../mntAutEstudiante.php?mat_id='+mat_id+'','_blank');
}

function editar(matr_id){
    $.post("/Evaluacion/controller/matriculas.php?opc=mostrar",{matr_id:matr_id},function (data){
        data = JSON.parse(data);
        //console.log(data);
        $('#matr_id').val(data.matr_id);
        $('#mat_id').val(data.mat_id).trigger('change');
        $('#usu_id_est').val(data.usu_id_est).trigger('change');
        $('#grupo').val(data.grupo);
        $('#usu_id_pro').val(data.usu_id_pro).trigger('change');
    });
    $('#titulo_modal').html('Editar Matricula');
    $('#modalcrearMatricula').modal('show');
}

function eliminar(matr_id){
    Swal.fire({
        title: 'Eliminar!',
        text: 'Desea eleminar el Registro?',
        icon: 'error',
        showCancelButton: true,
        confirmButtonText: 'Aceptar',
        cancelButtonText: 'Cancelar',
    }).then((result)=>{
        if(result.value){
            $.post("/Evaluacion/controller/matriculas.php?opc=eliminar",{matr_id:matr_id},function (data){
                $('#matricula_data').DataTable().ajax.reload();
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

function combo_materias(){
    $.post("/Evaluacion/controller/asignatura.php?opc=combo", function (data) {
        $('#mat_id').html(data);
    });
}
function combo_estudiantes(){
    $.post("/Evaluacion/controller/usuario.php?opc=combo_estudiantes", function (data) {
        $('#usu_id_est').html(data);
    });
}
function combo_profesores(){
    $.post("/Evaluacion/controller/usuario.php?opc=combo_profesores", function (data) {
        $('#usu_id_pro').html(data);
    });
}
$(document).on("click", "#btnplantilla", function () {
    $('#modalMatricula').modal('show');
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
                MatriculaList = JSON.parse(json_object);

                console.log(MatriculaList)
                for (i = 0; i < MatriculaList.length; i++) {

                    var columns = Object.values(MatriculaList[i])

                    $.post("/Evaluacion/controller/matriculas.php?opc=guardar_desde_excel",{
                        mat_id : columns[0],
                        usu_id_est : columns[1],
                        matr_grupo : columns[2],
                        usu_id_pro : columns[3]
                        
                    }, function (data) {
                        console.log(data);
                    });

                }
                /* TODO:Despues de subir la informacion limpiar inputfile */
                document.getElementById("upload").value=null;

                /* TODO: Actualizar Datatable JS */
                $('#matricula_data').DataTable().ajax.reload();
                $('#modalMatricula').modal('hide');
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