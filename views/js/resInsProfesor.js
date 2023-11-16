var usu_id = $('#usu_idx').val();

function init(){
    $("#rinsprofesor_form").on("submit",function(e){
        guardaryeditar(e);
    });

}

function guardaryeditar(e){
    //console.log("prueba");
    e.preventDefault();
    var formData = new FormData($("#rinsprofesor_form")[0]);
    //console.log(formData);
    $.ajax({
        url: "/Evaluacion/controller/rinsProfesor.php?opc=guardaryeditar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        
        success: function(data){
            console.log(data);
            $('#RespInsPro_data').DataTable().ajax.reload();
            $('#modalcrearRInsProfesor').modal('hide');

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
    $('#ppi_id').select2({
        dropdownParent: $('#modalcrearRInsProfesor')
    });

    combo_preguntas();

    $('#respInsPro_data').DataTable({
        "aProcessing": true,
        "aServerSide": true,
        dom: 'Bfrtip',
        buttons: [
            'excelHtml5',
            'csvHtml5',
        ],
        "ajax":{
            url:"/Evaluacion/controller/rinsProfesor.php?opc=listar",
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
    $('#rinsprofesor_form')[0].reset();
    $('#modalcrearRInsProfesor').modal('show');
}

function editar(rpi_id){
    $.post("/Evaluacion/controller/rinsProfesor.php?opc=mostrar",{rpi_id:rpi_id},function (data){
        data = JSON.parse(data);
        //console.log(data);
        $('#rpi_id').val(data.rei_id);
        $('ppi_id').val(data.ppi_id);
        $('#rpi_respuesta').val(data.rpi_respuesta);
    });
    $('#titulo_modal').html('Editar Respuesta');
    $('#modalcrearRInsEstudiante').modal('show');
}

function preact(rpi_id){
    $.post("/Evaluacion/controller/rinsProfesor.php?opc=activo",{rpi_id:rpi_id},function (data){
        $('#respInsPro_data').DataTable().ajax.reload();
     
    });
}

function preina(rpi_id){
    $.post("/Evaluacion/controller/rinsProfesor.php?opc=inactivo",{rpi_id:rpi_id},function (data){
        $('#respInsPro_data').DataTable().ajax.reload();
      
    });
}

function eliminar(rpi_id){
    Swal.fire({
        title: 'Eliminar!',
        text: 'Desea eleminar el Registro?',
        icon: 'error',
        showCancelButton: true,
        confirmButtonText: 'Aceptar',
        cancelButtonText: 'Cancelar',
    }).then((result)=>{
        if(result.value){
            $.post("/Evaluacion/controller/rinsProfesor.php?opc=eliminar",{rpi_id:rpi_id},function (data){
                $('#respInsPro_data').DataTable().ajax.reload();
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
    $.post("/Evaluacion/controller/insProfesor.php?opc=combo", function (data) {
        $('#ppi_id').html(data);
    });
}

$(document).on("click", "#btnplantilla", function () {
    $('#modalRInsProfesor').modal('show');
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
                RespInsProList = JSON.parse(json_object);

                console.log(RespInsProList)
                for (i = 0; i < RespInsProList.length; i++) {

                    var columns = Object.values(RespInsProList[i])

                    $.post("/Evaluacion/controller/rinsProfesor.php?opc=guardar_desde_excel",{
                        ppi_id : columns[0],
                        rpi_respuesta : columns[1],
                        estado : columns[2]
                    }, function (data) {
                        console.log(data);
                    });

                }
                /* TODO:Despues de subir la informacion limpiar inputfile */
                document.getElementById("upload").value=null;

                /* TODO: Actualizar Datatable JS */
                $('#respInsPro_data').DataTable().ajax.reload();
                $('#modalRInsProfesor').modal('hide');
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