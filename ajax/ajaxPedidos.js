$("form#formPedido").submit(function (e) {
    e.preventDefault();
    console.log("aquitoy2");
    $.ajax({
        url: "http://localhost/tw/php/operacionesCocina.php",
        method: "post",
        data: $("#formPedido").serialize(),
        cache: false,
        success: function (respAX) {
            let AX = JSON.parse(respAX);
            if (AX.mensaje === "error") {
                Swal.fire({
                    icon: 'error',
                    title: 'Operación fallída',
                    text: 'La operación realizada no tuvo exito',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Aceptar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.reload();
                    }
                });
            } else {
                Swal.fire({
                    icon: 'success',
                    title: 'Operación con exito',
                    text: 'La operación realizata tuvo exito',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Aceptar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.reload();
                    }
                });

            }
        }
    });
});