$(document).ready(function () {
    $("#formLogin").validetta({
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
            $.ajax({
                url: "http://localhost/tw/php/inicio.php",
                method: "post",
                data: $("form#formLogin").serialize(),
                //data:$("form#formLogin").serialize(),
                cache: false,
                success: function (respAX) {
                    console.log(respAX);
                    let AX = JSON.parse(respAX);
                    console.log(AX.IdUsuario);
                    if (AX.mensaje === "error") {
                        Swal.fire({
                            icon: 'error',
                            title: 'No  pudo iniciar el usuario',
                            text: 'El usuario  no existe',
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'Aceptar'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                //window.location="http://localhost/tw/index.php";
                            }
                        });
                    } else {
                        Swal.fire({
                            icon: 'success',
                            title: 'Accedió correctamente',
                            text: 'El usuario inició sesión',
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'Aceptar'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $("#formLogin")[0].reset();
                                var singleModalElem = document.querySelector('#modal1');
                                var instance = M.Modal.getInstance(singleModalElem);
                                instance.close();
                                //alert(AX.IdUsuario);
                                if (AX.IdUsuario == 1) {
                                    window.location = "http://localhost/tw/php/admin.php";
                                } else if (AX.IdUsuario == 2) {
                                    window.location = "http://localhost/tw/php/cocina.php";
                                }
                                else {
                                    window.location.reload();
                                }
                            }
                        });

                    }


                },
                error: function () {
                    Swal.fire({
                        icon: 'error',
                        title: 'No  pudo iniciar el usuario',
                        text: 'Error de servidor'
                    });
                }
            });
        }
    });


    $(".boton").on('click', function () {
        let formulario = $(this).parents('form:first');
        event.preventDefault();
        $.ajax({
            url: "http://localhost/tw/php/agregar.php",
            method: "post",
            data: formulario.serialize(),
            //data:$("form#formLogin").serialize(),
            cache: false,
            success: function (respAX) {
                console.log(respAX)
                let AX = JSON.parse(respAX);
                if (AX.mensaje === "error") {
                    Swal.fire({
                        icon: 'error',
                        title: 'Ups!',
                        text: 'El prodcuto no se pudo agregar al carrito de compras',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Aceptar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            //window.location="http://localhost/tw/index.php";
                        }
                    });
                } else {
                    Swal.fire({
                        icon: 'success',
                        title: 'Producto agregado',
                        text: 'El producto se agregó a su carrito de compras',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Aceptar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            formulario.get(0).reset();
                        }
                    });

                }


            },
            error: function () {
                Swal.fire({
                    icon: 'error',
                    title: 'ERROR',
                    text: 'Error de servidor'
                });
            }
        });
    });

    $("#Recuperar").click('click', function () {
        var singleModalElem = document.querySelector('#modal1');
        var instance = M.Modal.getInstance(singleModalElem);
        instance.close();

    });

    $("#formRecuperar").validetta({
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
            $.ajax({
                url: "http://localhost/tw/php/recuperacionCorreo.php",
                method: "post",
                data: $("form#formRecuperar").serialize(),
                //data:$("form#formLogin").serialize(),
                cache: false,
                success: function (respAX) {
                    console.log(respAX)
                    let AX = JSON.parse(respAX);
                    if (AX.mensaje === "error") {
                        Swal.fire({
                            icon: 'error',
                            title: 'No  pudo enviar el correo el usuario',
                            text: 'El correo  no existe',
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'Aceptar'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                //window.location="http://localhost/tw/index.php";
                            }
                        });
                    } else {
                        Swal.fire({
                            icon: 'success',
                            title: 'Correo enviado',
                            text: 'Se le enviará un email de recuperación',
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'Aceptar'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $("#formRecuperar")[0].reset();
                                var singleModalElem = document.querySelector('#modal2');
                                var instance = M.Modal.getInstance(singleModalElem);
                                instance.close();

                            }
                        });

                    }


                },
                error: function () {
                    Swal.fire({
                        icon: 'error',
                        title: 'No  pudo enviar el correo',
                        text: 'Error de servidor'
                    });
                }
            });
        }
    });
});
