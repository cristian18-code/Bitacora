

    function mostrarIncidencia(element) {

        var reporte = element.value;
        var llamada = "mostrarIncidencia";
        $.ajax({
            url: './sistema/logica/peticiones_ajax.php',
            type: 'POST',
            dataType: 'json',
            cache: false,
            data: {reporte, llamada},
            async: false,
            success: function(){

            },
            error: function( jqXHR, textStatus, errorThrown) { // Si el servidor no envia una respuesta se 
                                                        // ejecutara alguna de las siguientes alertas de acuerdo error
                if (jqXHR.status === 0) {

                alert('Not connect: Verify Network.');

                } else if (jqXHR.status == 404) {

                alert('Requested page not found [404]');

                } else if (jqXHR.status == 500) {

                alert('Internal Server Error [500].');

                } else if (textStatus === 'parsererror') {

                alert('Error de análisis JSON solicitado.');

                } else if (textStatus === 'timeout') {

                alert('Time out error.');

                } else if (textStatus === 'abort') {

                alert('Ajax request aborted.');

                } else {

                alert('Uncaught Error: ' + jqXHR.responseText);

                }
            }
        });
    }