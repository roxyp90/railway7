$(function () {
    // Escucho cualquier formulario con clase delete-form para confirmar antes de borrar.
    $(document).on('submit', '.delete-form', function (event) {
        event.preventDefault();

        const form = this;

        // Si el usuario confirma, el form sigue su curso y el controlador elimina en la BD.
        Swal.fire({
            title: '¿Estás seguro?',
            text: 'Este registro se eliminará definitivamente.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });
});
