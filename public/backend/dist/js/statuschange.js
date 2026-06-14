$(function () {
    // Tomo el token CSRF para poder hacer PATCH a Laravel de forma segura.
    const csrfToken = $('meta[name="csrf-token"]').attr('content');

    // Escucho los switches de estado de las tablas.
    $(document).on('change', '.toggle-class', function () {
        const checkbox = $(this);
        const url = checkbox.data('url');

        if (!url) {
            return;
        }

        $.ajax({
            // Uso PATCH porque solo estoy modificando una parte del registro: su estado.
            url: url,
            method: 'PATCH',
            dataType: 'json',
            data: {
                _token: csrfToken,
                activo: checkbox.is(':checked') ? 1 : 0
            },
            success: function (response) {
                // Si todo sale bien, actualizo el texto y el color del estado en pantalla.
                const label = checkbox.closest('.custom-control').find('.custom-control-label');

                label.text(response.activo ? 'Activo' : 'Inactivo');
                label.removeClass('activo inactivo').addClass(response.activo ? 'activo' : 'inactivo');

                if (response.message) {
                    console.log(response.message);
                }
            },
            error: function (xhr) {
                // Si falla, devuelvo el switch al estado anterior para no dejar la vista inconsistente.
                checkbox.prop('checked', !checkbox.is(':checked'));
                const label = checkbox.closest('.custom-control').find('.custom-control-label');

                label.text(checkbox.is(':checked') ? 'Activo' : 'Inactivo');
                label.removeClass('activo inactivo').addClass(checkbox.is(':checked') ? 'activo' : 'inactivo');

                Swal.fire({
                    icon: 'error',
                    title: 'No se pudo actualizar',
                    text: xhr.responseJSON?.message || 'Intenta nuevamente.'
                });
            }
        });
    });
});
