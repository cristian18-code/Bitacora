

    function mostrarIncidencia(element) {

        var reporte = element.value;
        var llamada = "mostrarIncidencia";
        $('#tipo_incidencia').empty();
        $.ajax({
            url: './sistema/logica/peticiones_ajax.php',
            type: 'POST',
            dataType: 'html',
            cache: false,
            data: {reporte, llamada},
            async: false,
            success: function(data){
                $('#tipo_incidencia').append('<option value="" hidden>Selecciona una opcion</option>');
                $('#tipo_incidencia').append(data);
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

    $(document).ready(function(){

        /* Envio de formulario para crear ticket*/
        $("#btnEnviar").on('click', function(){

            var parametros = new FormData($("#formTicket")[0]);
            var btnEnviar = $("#btnEnviar");
            $.ajax({
                data:parametros,
                url:"./sistema/logica/registrarTicket.php",
                type:"POST",
                contentType:false,
                processData:false,
                beforeSend: function(){
                    btnEnviar.val("Enviando"); // Para input de tipo button
                    btnEnviar.attr("disabled","disabled");
                },
                success: function(data){
                    btnEnviar.val("Enviado"); // Para input de tipo button
                    $(".alerta").append(data);
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
        });

        /* Envio de formulario para envio de respuesta*/
        $("#btn_enviarRespuesta").on('click', function(){

            var parametros = new FormData($("#formRespuesta")[0]);
            var btnEnviar = $("#btn_enviarRespuesta");
            $.ajax({
                data:parametros,
                url:"./sistema/logica/enviarRespuesta.php",
                type:"POST",
                contentType:false,
                processData:false,
                beforeSend: function(){
                    btnEnviar.val("Enviando"); // Para input de tipo button
                    btnEnviar.attr("disabled","disabled");
                },
                success: function(data){
                    btnEnviar.val("Enviado"); // Para input de tipo button
                    $(".alerta").append(data);
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
            // Nos permite cancelar el envio del formulario   
        });
    });