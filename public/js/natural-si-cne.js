//input mask
$(":input").inputmask({placeholder: ''});

$("#cedula").inputmask("999999999", {placeholder: ''})
$(".telefonos").inputmask("99999999999",{placeholder: ''})
//input mask end

var cont = 0;

$("#telf").click(function () {

    cont++;

    telf =  "<div class=\"form-group\">"+
            "<label class=\"control-label col-md-3 col-sm-3 col-xs-12 \" for=\"last-name\"></label>"+
            "<div class=\"col-md-2 col-sm-2 col-xs-12\">"+
            "<input type=\"text\" id=\"telefonos\" name=\"telefono[]\" class=\"form-control col-md-7 col-xs-12 telefonos\"></div>"+
            "</div>";

    if ( cont <= 2 ) {

        $(telf).slideDown(300).insertAfter('#telfs');

        $(".telefonos").inputmask("99999999999",{placeholder: ''})
    }
})


var btn = '#guardar';

//cambia el data-target de guardar si registro = true para mostrar dialogo modal
if($('#registro').val()=='true'){
    $('#guardar').attr('id','btn').attr('data-target','.bs-example-modal-sm').attr('data-toggle','modal');
    btn = '#modal_guardar';
}

$("#evento").change(function () {
    var option = $('#evento option:selected').html().toString();

    if ( option != 'DESPACHO - GESTION SOCIAL') {
        $("#fecha_cont").hide();
    }else{
        $("#fecha_cont").show();
    }
})

$(btn).click(function () {

    $('#errores').html('');

    var url = 'guardar-ayuda';

    var registro = $('#registro').val();
    var fecha = $('#fecha').val();
    var nac = $('#nac').val();
    var cedula = $('#cedula').val();
    var nombres = $('#nombres').val();
    var apellidos = $('#apellidos').val();
    var fecha_nac = $('#fecha_nac').val();

    var genero = $('#genero_m').val();

    if($('#genero_f').prop('checked') == true){
        genero = $('#genero_f').val();
    }

    var direccion = $('#direccion').val();
    var edo_civil = $('#edo_civil').val();

    var tlfs = [];

    var cont = 0;

    $('.telefonos').each(function () {

        if ( $(this).val() != "" ) {

            tlfs.push($(this).val());

            cont++;
        }

    })

    var municipio = $('#municipio').val();
    var parroquia = $('#parroquia').val();
    var centro = $('#centro').val();
    var id_discapacidad = $('#discapacidad').val();
    var discap_detalle = $('#discap_detalle').val();
    var evento = $('#evento').val();
    var solicitud = $('#solicitud').val();
    var necesidad = $('#necesidad').val();
    var token = $('#token').val();

    $.ajax({
        url: url,
        headers: {'X-CSRF-TOKEN': token},
        type: 'POST',
        dataType: 'JSON',
        data: {
            registro: registro,
            fecha: fecha,
            nac: nac,
            cedula: cedula,
            nombres: nombres,
            apellidos: apellidos,
            fecha_nac: fecha_nac,
            genero: genero,
            direccion: direccion,
            edo_civil: edo_civil,
            telefonos: tlfs,
            municipio: municipio,
            parroquia: parroquia,
            centro: centro,
            id_discapacidad: id_discapacidad,
            discap_detalle: discap_detalle,
            evento: evento,
            solicitudes: solicitud,
            necesidad: necesidad
        },
        statusCode: {
            500: function () {
                $('#errores').html('ERROR. Favor Contactar al Dpto. de TECNOLOGIA E INFORMACION');

                $('#div_errores').fadeIn().delay(6000).fadeOut();
        },
            422: function (msj) {
                $.each(msj.responseJSON, function (k, v) {
                    $('#errores').html('');
                    $('#errores').append('<li>' + v + '</li>')
                });
                $('#div_errores').fadeIn().delay(6000).fadeOut();
            }},
        success:function (msj) {

            if(msj.resp == 'true') {
                $('#msj-datosP')
                    .attr('class','')
                    .addClass('col-md-6 col-sm-6 col-xs-12 col-md-offset-3 alert alert-success')
                    .html(msj.mensaje)
                    .fadeIn()
                    .delay(5000)
                    .fadeOut();

                $('.solicitante_id').val(msj.solicitante_id);

                $('#datos_discapacidad').removeClass('hidden').fadeIn(500);

                $('#datos_ayuda').removeClass('hidden').fadeIn(500);
            }else{
                $('#msjs')
                    .attr('class','')
                    .addClass('col-md-6 col-sm-6 col-xs-12 col-md-offset-3 alert alert-warning')
                    .html(msj.mensaje)
                    .fadeIn()
                    .delay(5000)
                    .fadeOut();
            }
        }
    });
})

$(function () {
    $.datepicker.setDefaults($.datepicker.regional["es"]);
    $("#fecha_nac").datepicker({
        minDate: '-100Y',
        firstDay: 1,
        changeMonth: true,
        changeYear: true
    });
});
