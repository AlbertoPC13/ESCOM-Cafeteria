$("form#formPDF").submit(function (e) {
    e.preventDefault();
    $.ajax({
        url: "http://localhost/tw/php/reporteAdmin.php",
        method: "post",
        data: $("form#formPDF").serialize(),
        cache: false,
        success: function (respAX) {
            let AX = JSON.parse(respAX);
            if (AX.mensaje === "error") {
                Swal.fire({
                    icon: 'error',
                    title: 'Reporte no generado',
                    text: 'El reporte diario no pudo ser generado en este momento',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Aceptar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.reload();
                    }
                });
            } else if (AX.mensaje === "ventas") {
                Swal.fire({
                    icon: 'success',
                    title: 'Reporte generado',
                    text: 'El reporte diario de ventas se ha generado',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Aceptar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location = "http://localhost/tw/php/ventasPDF.php";
                    }
                });

            }
            else if (AX.mensaje === "inventario") {
                Swal.fire({
                    icon: 'success',
                    title: 'Reporte generado',
                    text: 'El reporte diario de inventario se ha generado',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Aceptar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location = "http://localhost/tw/php/inventarioPDF.php";
                    }
                });

            }
        }
    });
});