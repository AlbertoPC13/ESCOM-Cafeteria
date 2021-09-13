$("form#formAgregar").submit(function (e) {
    var table = $('#example').DataTable();
    e.preventDefault();
    $.ajax({
        url: "http://localhost/tw/php/agregarProducto.php",
        method: "post",
        data: $("form#formAgregar").serialize(),
        cache: false,
        success: function (respAX) {
            Swal.fire({
                icon: 'success',
                title: 'Producto agregado',
                text: 'El producto se agregó con exito',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Aceptar'
            }).then((result) => {
                if (result.isConfirmed) {
                    $("#formAgregar")[0].reset();
                    var singleModalElem = document.querySelector('#modal1');
                    var instance = M.Modal.getInstance(singleModalElem);
                    instance.close();
                    table.ajax.reload(null,false);
                }
            });
        }
    });
});