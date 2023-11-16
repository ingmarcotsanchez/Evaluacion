var usu_id = $('#usu_idx').val();

function init(){
    $("#evaInstitunal_form").on("submit",function(e){
        guardaryeditar(e);
    });

}

function guardaryeditar(e){
    //console.log("prueba");
    e.preventDefault();
    var formData = new FormData($("#evaInstitunal_form")[0]);
    //console.log(formData);
    $.ajax({
        url: "/Evaluacion/controller/institucional.php?opc=guardar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        
        success: function(data){
            console.log(data);

            Swal.fire({
                title: 'Correcto!',
                text: 'Se Registro Correctamente',
                icon: 'success',
                confirmButtonText: 'Aceptar'
                
            })
          //location.reload(55000);
        }
        
    });
    window.location = "/Evaluacion/views/inicio.php";
    
}

$(document).ready(function(){
    $('#eva_respuesta').select2({
        dropdownParent: $("#modalcrearUsuario")
    });


    select_respuesta();
});

function select_respuesta(){
    $.post("/Evaluacion/controller/institucional.php?opc=combo",function (data){
        $('#eva_respuesta').html(data);
    });
}

init();