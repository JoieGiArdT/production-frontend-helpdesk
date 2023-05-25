function init() {

}

$(document).ready(function () {
    var tick_id = getUrlParameter('ID');
    listardetalle(tick_id);
    console.log(tick_id);

    /* TODO: inicializamos input de estrellas */
    $('#tick_estre').on('rating.change', function () {
        console.log($('#tick_estre').val());
    });
    $('#pregunta1_estre').rating({
        showCaption: false
    });

    $('#pregunta2_estre').rating({
        showCaption: false
    });

    $('#pregunta3_estre').rating({
        showCaption: false
    });

});

function listardetalle(tick_id) {
    /* TODO: Mostra detalle de ticket */
    $.post("../../controller/ticket.php?op=mostrar", { tick_id: tick_id }, function (data) {
        data = JSON.parse(data);
        $('#lblestado').val(data.tick_estado_texto);
        $('#lblnomusuario').val(data.usu_nom + ' ' + data.usu_ape);
        $('#lblfechcrea').val(data.fech_crea);
        $('#lblnomidticket').val(data.tick_id);
        $('#cat_nom').val(data.cat_nom);
        $('#cats_nom').val(data.cats_nom);
        $('#tick_titulo').val(data.tick_titulo);
        $('#prio_nom').val(data.prio_nom);
        $('#lblfechcierre').val(data.fech_cierre);

        if (data.tick_estado_texto == 'Abierto') {
            window.open('http://localhost:80/HelpDesk/', '_self');
        } else {
            if (data.tick_estre == null) {

            } else {
                $('#panel1').hide();
            }
        }
    });
}

/* TODO: Obtener ID de la Url */
var getUrlParameter = function getUrlParameter(sParam) {
    var sPageURL = decodeURIComponent(window.location.search.substring(1)),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : sParameterName[1];
        }
    }
};

/* TODO:Guardar Informacion de estrella del ticket */
$(document).on("click", "#btnguardar_encuesta", function () {
    var tick_id = getUrlParameter('ID');
    var tick_coment = $('#tick_coment').val();
    var pregunta1_estre = $('#pregunta1_estre').val();
    var pregunta2_estre = $('#pregunta2_estre').val();
    var pregunta3_estre = $('#pregunta3_estre').val();

    $.post("../../controller/ticket.php?op=encuesta", {
        tick_id: tick_id,
        tick_coment: tick_coment,
        pregunta1_estre: pregunta1_estre,
        pregunta2_estre: pregunta2_estre,
        pregunta3_estre: pregunta3_estre
    }, function (data) {
        console.log(data);
        $('#panel1').hide();
        swal("Correcto!", "Gracias por su Tiempo", "success");
    });
});
