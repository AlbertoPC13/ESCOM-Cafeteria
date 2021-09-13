
function aceptar(id) {
    let formulario = $(id);
    console.log(id);
    event.preventDefault();
    $.ajax({
        url: "http://localhost/tw/php/cargar.php",
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
                    text: 'No  pudo hacer la recarga',
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
                    title: 'Recarga realizada',
                    text: 'La carga se realizó con exito',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Aceptar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        let iden = '#' + $(id).attr("id") + 'tr';

                        console.log(iden);
                        $(iden).remove();
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
}
function cancelar(id) {
    let formulario = $(id);
    console.log(id);
    $.ajax({
        url: "http://localhost/tw/php/cancelar.php",
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
                    text: 'No se pudo cancelar',
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
                    title: 'Recarga cancelada',
                    text: 'La cancelación se realizó con exito',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Aceptar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        let iden = '#' + $(id).attr("id") + 'tr';
                        console.log(iden);
                        $(iden).remove();
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
}