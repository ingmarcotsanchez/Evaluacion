var usu_id = $('#usu_idx').val();

function init(){
    $("#rinsestudiante_form").on("submit",function(e){
        guardaryeditar(e);
    });

}

function guardaryeditar(e){
    //console.log("prueba");
    e.preventDefault();
    var formData = new FormData($("#rinsestudiante_form")[0]);
    //console.log(formData);
    $.ajax({
        url: "/Evaluacion/controller/rinsEstudiante.php?opc=guardaryeditar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        
        success: function(data){
            console.log(data);
            $('#RespInsEst_data').DataTable().ajax.reload();
            $('#modalcrearRInsEstudiante').modal('hide');

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
    $('#pei_id').select2({
        dropdownParent: $('#modalcrearRInsEstudiante')
    });

    combo_preguntas();

    $('#respInsEst_data').DataTable({
        "aProcessing": true,
        "aServerSide": true,
        dom: 'Bfrtip',
        buttons: [
            'excelHtml5',
            'csvHtml5',
        ],
        "ajax":{
            url:"/Evaluacion/controller/rinsEstudiante.php?opc=listar",
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
    $('#titulo_modal').html('Nueva Respuesta');
    $('#rinsestudiante_form')[0].reset();
    $('#modalcrearRInsEstudiante').modal('show');
}

function editar(rei_id){
    $.post("/Evaluacion/controller/rinsEstudiante.php?opc=mostrar",{rei_id:rei_id},function (data){
        data = JSON.parse(data);
        //console.log(data);
        $('#rei_id').val(data.rei_id);
        $('pei_id').val(data.pei_id);
        $('#rei_respuesta').val(data.rei_respuesta);
    });
    $('#titulo_modal').html('Editar Respuesta');
    $('#modalcrearRInsEstudiante').modal('show');
}

function preact(rei_id){
    $.post("/Evaluacion/controller/rinsEstudiante.php?opc=activo",{rei_id:rei_id},function (data){
        $('#respInsEst_data').DataTable().ajax.reload();
     
    });
}

function preina(rei_id){
    $.post("/Evaluacion/controller/rinsEstudiante.php?opc=inactivo",{rei_id:rei_id},function (data){
        $('#respInsEst_data').DataTable().ajax.reload();
      
    });
}

function eliminar(rei_id){
    Swal.fire({
        title: 'Eliminar!',
        text: 'Desea eleminar el Registro?',
        icon: 'error',
        showCancelButton: true,
        confirmButtonText: 'Aceptar',
        cancelButtonText: 'Cancelar',
    }).then((result)=>{
        if(result.value){
            $.post("/Evaluacion/controller/rinsEstudiante.php?opc=eliminar",{rei_id:rei_id},function (data){
                $('#respInsEst_data').DataTable().ajax.reload();
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

function combo_preguntas(){
    $.post("/Evaluacion/controller/insEstudiante.php?opc=combo", function (data) {
        $('#pei_id').html(data);
    });
}

$(document).on("click", "#btnplantilla", function () {
    $('#modalRInsEstudiante').modal('show');
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
                RespInsEstList = JSON.parse(json_object);

                console.log(RespInsEstList)
                for (i = 0; i < RespInsEstList.length; i++) {

                    var columns = Object.values(RespInsEstList[i])

                    $.post("/Evaluacion/controller/rinsEstudiante.php?opc=guardar_desde_excel",{
                        pei_id : columns[0],
                        rei_respuesta : columns[1],
                        estado : columns[2]
                    }, function (data) {
                        console.log(data);
                    });

                }
                /* TODO:Despues de subir la informacion limpiar inputfile */
                document.getElementById("upload").value=null;

                /* TODO: Actualizar Datatable JS */
                $('#respInsEst_data').DataTable().ajax.reload();
                $('#modalRInsEstudiante').modal('hide');
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