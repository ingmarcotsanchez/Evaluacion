var usu_id = $('#usu_idx').val();

function init(){
    $("#autoevaluacion_form").on("submit",function(e){
        guardaryeditar(e);
    });
}

function evaluar($mat_id){
    console.log($mat_id);
    window.open('../mntAutEstudiante.php?mat_id='+mat_id+'','_blank');
}



$(document).ready(function(){
    $('#autoevaluacion_data').DataTable({
        "aProcessing": true,
        "aServerSide": true,
        dom: 'Bfrtip',
        buttons: [
            'excelHtml5',
            'csvHtml5',
        ],
        "ajax":{
            url:"/Evaluacion/controller/matriculas.php?opc=matriculas",
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

function evaluar(mat_id){
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


init();
