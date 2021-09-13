$("form#formCompra").submit(function (e) {
    e.preventDefault();
    $.ajax({
        url: "http://localhost/tw/php/compra.php",
        method: "post",
        data: $("form#formCompra").serialize(),
        cache: false,
        success: function (respAX) {
            let AX = JSON.parse(respAX);
            if (AX.mensaje === "error") {
                Swal.fire({
                    icon: 'error',
                    title: 'Compra fallída',
                    text: 'La compra no pudo ser procesada en este momento',
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
                    title: 'Compra realizada con exito',
                    text: 'Puede consultar información de su pedido en la sección Pedidos',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Aceptar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location="../index.php";
                    }
                });

            }
        }
    });
});