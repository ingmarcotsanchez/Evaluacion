var usu_id = $('#usu_idx').val();

function init(){
    $("#insprofesor_form").on("submit",function(e){
        guardaryeditar(e);
    });

}

function guardaryeditar(e){
    //console.log("prueba");
    e.preventDefault();
    var formData = new FormData($("#insprofesor_form")[0]);
    //console.log(formData);
    $.ajax({
        url: "/Evaluacion/controller/insProfesor.php?opc=guardaryeditar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        
        success: function(data){
            console.log(data);
            $('#pregInsPro_data').DataTable().ajax.reload();
            $('#modalcrearInsProfesor').modal('hide');

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
    $('#pregInsPro_data').DataTable({
        "aProcessing": true,
        "aServerSide": true,
        dom: 'Bfrtip',
        buttons: [
            'excelHtml5',
            'csvHtml5',
        ],
        "ajax":{
            url:"/Evaluacion/controller/insProfesor.php?opc=listar",
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
    $('#insprofesor_form')[0].reset();
    $('#modalcrearInsProfesor').modal('show');
}

function editar(ppi_id){
    $.post("/Evaluacion/controller/insProfesor.php?opc=mostrar",{ppi_id:ppi_id},function (data){
        data = JSON.parse(data);
        //console.log(data);
        $('#ppi_id').val(data.ppi_id);
        $('#ppi_pregunta').val(data.ppi_pregunta);
    });
    $('#titulo_modal').html('Editar Pregunta');
    $('#modalcrearInsProfesor').modal('show');
}

function preact(ppi_id){
    $.post("/Evaluacion/controller/insProfesor.php?opc=activo",{ppi_id:ppi_id},function (data){
        $('#pregInsPro_data').DataTable().ajax.reload();

    });
}

function preina(ppi_id){
    $.post("/Evaluacion/controller/insProfesor.php?opc=inactivo",{ppi_id:ppi_id},function (data){
        $('#pregInsPro_data').DataTable().ajax.reload();
      
    });
}

function eliminar(ppi_id){
    Swal.fire({
        title: 'Eliminar!',
        text: 'Desea eleminar el Registro?',
        icon: 'error',
        showCancelButton: true,
        confirmButtonText: 'Aceptar',
        cancelButtonText: 'Cancelar',
    }).then((result)=>{
        if(result.value){
            $.post("/Evaluacion/controller/insProfesor.php?opc=eliminar",{ppi_id:ppi_id},function (data){
                $('#pregInsPro_data').DataTable().ajax.reload();
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

var usu_id = $('#usu_idx').val();

function init(){
    $("#insestudiante_form").on("submit",function(e){
        guardaryeditar(e);
    });

}

function guardaryeditar(e){
    //console.log("prueba");
    e.preventDefault();
    var formData = new FormData($("#insestudiante_form")[0]);
    //console.log(formData);
    $.ajax({
        url: "/Evaluacion/controller/insEstudiante.php?opc=guardaryeditar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        
        success: function(data){
            console.log(data);
            $('#pregInsEst_data').DataTable().ajax.reload();
            $('#modalcrearInsEstudiante').modal('hide');

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
    $('#pregInsEst_data').DataTable({
        "aProcessing": true,
        "aServerSide": true,
        dom: 'Bfrtip',
        buttons: [
            'excelHtml5',
            'csvHtml5',
        ],
        "ajax":{
            url:"/Evaluacion/controller/insEstudiante.php?opc=listar",
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
    $('#insestudiante_form')[0].reset();
    $('#modalcrearInsEstudiante').modal('show');
}

function editar(pei_id){
    $.post("/Evaluacion/controller/insEstudiante.php?opc=mostrar",{pei_id:pei_id},function (data){
        data = JSON.parse(data);
        //console.log(data);
        $('#pei_id').val(data.pei_id);
        $('#pei_pregunta').val(data.pei_pregunta);
    });
    $('#titulo_modal').html('Editar Pregunta');
    $('#modalcrearInsEstudiante').modal('show');
}

function preact(pei_id){
    $.post("/Evaluacion/controller/insEstudiante.php?opc=activo",{pei_id:pei_id},function (data){
        $('#pregInsEst_data').DataTable().ajax.reload();

    });
}

function preina(pei_id){
    $.post("/Evaluacion/controller/insEstudiante.php?opc=inactivo",{pei_id:pei_id},function (data){
        $('#pregInsEst_data').DataTable().ajax.reload();
      
    });
}

function eliminar(pei_id){
    Swal.fire({
        title: 'Eliminar!',
        text: 'Desea eleminar el Registro?',
        icon: 'error',
        showCancelButton: true,
        confirmButtonText: 'Aceptar',
        cancelButtonText: 'Cancelar',
    }).then((result)=>{
        if(result.value){
            $.post("/Evaluacion/controller/insEstudiante.php?opc=eliminar",{pei_id:pei_id},function (data){
                $('#pregInsEst_data').DataTable().ajax.reload();
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
    $('#modalInsProfesor').modal('show');
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
                PregInsProList = JSON.parse(json_object);

                console.log(PregInsProList)
                for (i = 0; i < PregInsProList.length; i++) {

                    var columns = Object.values(PregInsProList[i])

                    $.post("/Evaluacion/controller/insProfesor.php?opc=guardar_desde_excel",{
                        ppi_pregunta : columns[0],
                        estado : columns[1]
                    }, function (data) {
                        console.log(data);
                    });

                }
                /* TODO:Despues de subir la informacion limpiar inputfile */
                document.getElementById("upload").value=null;

                /* TODO: Actualizar Datatable JS */
                $('#pregInsPro_data').DataTable().ajax.reload();
                $('#modalInsProfesor').modal('hide');
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

init();