var usu_id = $('#usu_idx').val();

$(document).ready(function(){
    $.post("/Evaluacion/controller/usuario.php?opc=mostrar", { usu_id : usu_id }, function (data) {
        data = JSON.parse(data);
        $('#usu_nombre').val(data.usu_nombre);
        $('#usu_apellidos').val(data.usu_apellidos);
        $('#usu_email').val(data.usu_email);
        $('#usu_clave').val(data.usu_clave);
        $('#usu_direccion').val(data.usu_direccion);
        $('#usu_tel').val(data.usu_tel);
    });
});



$(document).on("click","#btnactualizar", function(){

    $.post("/Evaluacion/controller/usuario.php?opc=editPerfil", { 
        //info_id : info_id,
        usu_nombre : $('#usu_nombre').val(),
        usu_apellidos : $('#usu_apellidos').val(),
        usu_email : $('#usu_email').val(),
        usu_clave : $('#usu_clave').val(),
        usu_direccion : $('#usu_direccion').val(),
        usu_tel : $('#usu_tel').val()
     }, function (data) {
    });
    Swal.fire({
        title: 'Correcto!',
        text: 'Se actualizo Correctamente',
        icon: 'success',
        confirmButtonText: 'Aceptar'
    })


});

