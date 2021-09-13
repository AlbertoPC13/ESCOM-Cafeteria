$("form#formUploadFile").submit(function (e) {
    e.preventDefault();
    var formData = new FormData($("form#formUploadFile")[0]);
    $.ajax({
        url: "http://localhost/tw/php/archivo.php",
        method: "post",
        data: formData,
        cache: false,
        contentType: false, //Importante colocar siempre que se pretenda enviar un archivo al servidor
        processData: false, //Importante colocar siempre que se pretenda enviar un archivo al servidor
        success: function (respAX) {
            let AX = JSON.parse(respAX);
            if (AX.mensaje === "error") {
                Swal.fire({
                    icon: 'error',
                    title: 'Ups!',
                    text: 'No se pudo realizar la recarga de saldo',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Aceptar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location = "http://localhost/tw/index.php";
                    }
                });
            } else {
                Swal.fire({
                    icon: 'success',
                    title: 'Recarga realizada',
                    text: 'Espera la aprobación por parte de la cafetería a través de tu correo',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Aceptar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location = "http://localhost/tw/index.php";
                    }
                });

            }
        }
    });
});