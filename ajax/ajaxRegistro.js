$(document).ready(function () {
    console.log("aquitoy");
    $("#formRegistrar").validetta({
        bubblePosition: 'bottom',
        bubbleGapTop: 10,
        bubbleGapLeft: -3,
        validators: {
            regExp: {
                regname: {
                    pattern: /^[a-zA-Z]{1,45}$/,
                    errorMessage: 'No puede iniciar con numeros'
                }
            }
        },
        realTime: true,
        onValid: function () {
            event.preventDefault();
            console.log("aquitoy2");
            $.ajax({
                url: "../php/test.php",
                method: "post",
                data: $("form#formRegistrar").serialize(),
                //data:$("form#formLogin").serialize(),
                cache: false,
                success: function (respAX) {
                    let AX = JSON.parse(respAX);
                    
                    Swal.fire({
                        icon: 'success',
                        title: 'Registrado con exito',
                        text: 'El usuario '+AX.nombre+' se registró correctamente',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Aceptar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $("#formRegistrar")[0].reset();
                            window.location="../index.php";
                        }
                    });
                },
                error: function (respAX) {
                    let AX = JSON.parse(respAX);
                    Swal.fire({
                        icon: 'error',
                        title: 'No se pudo registrar el usuario',
                        text: 'El usuario  no se registró correctamente'
                    });
                }
            });
        }
    });
});