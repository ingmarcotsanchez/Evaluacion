var usu_id = $('#usu_idx').val();

function init(){
    $("#evaestudiante_form").on("submit",function(e){
        guardaryeditar(e);
    });

}

function guardaryeditar(e){
    //console.log("prueba");
    e.preventDefault();
    var formData = new FormData($("#evaestudiante_form")[0]);
    //console.log(formData);
    $.ajax({
        url: "/Evaluacion/controller/evaEstudiante.php?opc=guardaryeditar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        
        success: function(data){
            console.log(data);
            $('#pregEvaEst_data').DataTable().ajax.reload();
            $('#modalcrearEvaEstudiante').modal('hide');

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
    $('#pregEvaEst_data').DataTable({
        "aProcessing": true,
        "aServerSide": true,
        dom: 'Bfrtip',
        buttons: [
            'excelHtml5',
            'csvHtml5',
        ],
        "ajax":{
            url:"/Evaluacion/controller/evaEstudiante.php?opc=listar",
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
    $('#titulo_modal').html('Nueva Pregunta');
    $('#evaestudiante_form')[0].reset();
    $('#modalcrearEvaEstudiante').modal('show');
}

function editar(pea_id){
    $.post("/Evaluacion/controller/evaEstudiante.php?opc=mostrar",{pea_id:pea_id},function (data){
        data = JSON.parse(data);
        //console.log(data);
        $('#pea_id').val(data.pea_id);
        $('#pea_pregunta').val(data.pea_pregunta);
    });
    $('#titulo_modal').html('Editar Pregunta');
    $('#modalcrearEvaEstudiante').modal('show');
}

function preact(pea_id){
    $.post("/Evaluacion/controller/evaEstudiante.php?opc=activo",{pea_id:pea_id},function (data){
        $('#pregEvaEst_data').DataTable().ajax.reload();
     
    });
}

function preina(pea_id){
    $.post("/Evaluacion/controller/evaEstudiante.php?opc=inactivo",{pea_id:pea_id},function (data){
        $('#pregEvaEst_data').DataTable().ajax.reload();
      
    });
}

function eliminar(pea_id){
    Swal.fire({
        title: 'Eliminar!',
        text: 'Desea eleminar el Registro?',
        icon: 'error',
        showCancelButton: true,
        confirmButtonText: 'Aceptar',
        cancelButtonText: 'Cancelar',
    }).then((result)=>{
        if(result.value){
            $.post("/Evaluacion/controller/evaEstudiante.php?opc=eliminar",{pea_id:pea_id},function (data){
                $('#pregEvaEst_data').DataTable().ajax.reload();
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
    $('#modalEvaEstudiante').modal('show');
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
                PregEvaEstList = JSON.parse(json_object);

                console.log(PregEvaEstList)
                for (i = 0; i < PregEvaEstList.length; i++) {

                    var columns = Object.values(PregEvaEstList[i])

                    $.post("/Evaluacion/controller/evaEstudiante.php?opc=guardar_desde_excel",{
                        pea_pregunta : columns[0],
                        estado : columns[1]
                    }, function (data) {
                        console.log(data);
                    });

                }
                /* TODO:Despues de subir la informacion limpiar inputfile */
                document.getElementById("upload").value=null;

                /* TODO: Actualizar Datatable JS */
                $('#pregEvaEst_data').DataTable().ajax.reload();
                $('#modalEvaEstudiante').modal('hide');
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