$('#gemail').on('input',function(e){
    $("#formPersonal").addClass("hidden");
    $("#formRegistros").addClass("hidden");
    $("#formCargos").addClass("hidden");
    $("#save").addClass("hidden");
});

$('#generate').click(function(){
        toastr.clear();
        $.ajax({
            method: "POST",
            data: {"Email":$('#gemail').val()},
            url:  "/web/app_dev.php/registro/buscar-email",
            dataType: 'json',
            success: function(data)
            {
                if(data)
                {
                    $("#formPersonal").removeClass("hidden");
                    $("#formRegistros").removeClass("hidden");
                    $("#formCargos").removeClass("hidden");
                    $("#save").removeClass("hidden");
                }
                else
                {
                    toastr.error("El usuario no se encuentra registrado o esta inactivo.", "Error", {
                                "timeOut": "0",
                                "extendedTImeout": "0"
                             });
                    $("#formPersonal").addClass("hidden");
                    $("#formRegistros").addClass("hidden");
                    $("#formCargos").addClass("hidden");
                    $("#save").addClass("hidden");
                }
            }
        });
});