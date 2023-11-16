var usu_id = $('#usu_idx').val();

$(document).ready(function(){

    $.post("/Evaluacion/controller/usuario.php?opc=total_Profesores", { usu_id : usu_id }, function (data) {
        data = JSON.parse(data);
        $('#lbltotalProfesores').html(data.total);
    });

    $.post("/Evaluacion/controller/usuario.php?opc=total_estudiantes", { usu_id : usu_id }, function (data) {
        data = JSON.parse(data);
        $('#lbltotalEstudiantes').html(data.total);
    });

    $.post("/Evaluacion/controller/usuario.php?opc=total_activos", { usu_id : usu_id }, function (data) {
        data = JSON.parse(data);
        $('#lbltotalActivos').html(data.total);
    });

    $.post("/Evaluacion/controller/usuario.php?opc=total_inactivos", { usu_id : usu_id }, function (data) {
        data = JSON.parse(data);
        $('#lbltotalInactivos').html(data.total);
    });

    $.post("/Evaluacion/controller/carrera.php?opc=total_carreras", { usu_id : usu_id }, function (data) {
        data = JSON.parse(data);
        $('#lbltotalCarreras').html(data.total);
    });

    $.post("/Evaluacion/controller/institucional.php?opc=total_evaluaciones_institucionales", { usu_id : usu_id }, function (data) {
        data = JSON.parse(data);
        $('#lbltotalEvaEstudiantes').html(data.total);
    });

    $.post("/Evaluacion/controller/institucional.php?opc=total_evaluaciones_auto", { usu_id : usu_id }, function (data) {
        data = JSON.parse(data);
        $('#lbltotalEvaProfesores').html(data.total);
    });
    
    
});


