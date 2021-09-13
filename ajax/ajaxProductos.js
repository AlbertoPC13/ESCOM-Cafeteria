
var id;
var table;
$(document).ready(function () {
    table = $('#example').DataTable();
    

    $('#example tbody').on( 'click', 'td', function () {
        id= table.cell( this ).data();
    }); 
});
$('button#eliminar').on( 'click', function () {
    if(id){
    Swal.fire({
        icon: 'warning',
        title: 'Eliminar',
        text: 'Desea eliminar el producto con id: '+id+' ?',
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'Aceptar'
    }).then((result) => {
        if (result.isConfirmed) {
            event.preventDefault();
            $.ajax({
                url: "http://localhost/tw/php/eliminarProducto.php",
                method: "post",
                data: {id: id},
                cache: false,
                success: function (respAX) {
                    id='';
                    table.ajax.reload(null,false);
                }});
        }
    });
}else{
    Swal.fire({
        icon: 'error',
        title: 'Error',
        text: 'Debes seleccionar un id',
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'Aceptar'
    });
}
});