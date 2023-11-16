$(document).on("click","#btnInstitucional",function(){
    window.open("/Evaluacion/views/fpdf/certificado_institucional.php");
    reload();
});

$(document).ready(function(){
    $.post("/Evaluacion/controller/pazysalvo.php?opc=mostrar_Ins", { usu_id : usu_id }, function (data) {
        data = JSON.parse(data);
        $('#usu_id').val(data.usu_id);
        $('#eva_pregunta').val(data.eva_pregunta);
        $('#eva_respuesta').val(data.eva_respuesta);
        $('#eva_estado').val(data.eva_estado);
    });
});

$(document).ready(function(){
    $.post("/Evaluacion/controller/pazysalvo.php?opc=mostrar_Aut", { auto_id : auto_id }, function (data) {
        data = JSON.parse(data);
        $('#usu_id').val(data.usu_id);
        $('#mat_id').val(data.mat_id);
        $('#eva_pregunta').val(data.eva_pregunta);
        $('#eva_respuesta').val(data.eva_respuesta);
        $('#eva_estado').val(data.eva_estado);
    });
});


