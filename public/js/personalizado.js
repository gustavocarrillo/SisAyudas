$(function () {
    $.datepicker.setDefaults($.datepicker.regional["es"]);
    $("#fecha").datepicker({
        firstDay: 1
    });
});

/** Ayudas Naturales **/
var btn = '#guardar';

//cambia el data-target de guardar si registro = true para mostrar dialogo modal
if($('#registro').val()=='true'){
    $('#guardar').attr('id','btn').attr('data-target','.bs-example-modal-sm').attr('data-toggle','modal');
    btn = '#modal_guardar';
}

$(btn).click(function () {

    $('#errores').html('');
    var url = '';

    //define a que url sera enviado el form
    if($('#tipo').val() == 'cne') {
        url = 'guardar-ayuda';
    }else {
        url = 'guardar-ayuda-nocne';
    }

    var registro = $('#registro').val();
    var fecha = $('#fecha').val();
    var nac = $('#nac').val();
    var cedula = $('#cedula').val();
    var nombres = $('#nombres').val();
    var apellidos = $('#apellidos').val();
    var direccion = $('#direccion').val();
    var tlfs = $('#telefonos').val();
    var municipio = $('#municipio').val();
    var parroquia = $('#parroquia').val();
    var centro = $('#centro').val();
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
            direccion: direccion,
            telefonos: tlfs,
            municipio: municipio,
            parroquia: parroquia,
            centro: centro,
            evento: evento,
            solicitudes: solicitud,
            necesidad: necesidad
        },
        statusCode: { 500: function () {
                    $('#msj-success')
                        .attr('class','')
                        .addClass('col-md-6 col-sm-6 col-xs-12 col-md-offset-3 alert alert-danger')
                        .html('ERROR: No se pudo completar la operación')
                        .fadeIn()
                        .delay(3000)
                        .fadeOut();
        },
                    422: function (msj) {
                    $.each(msj.responseJSON, function (k, v) {
                        $('#errores').append('<li>' + v + '</li>')
                    });
                    $('#div_errores').fadeIn().delay(3000).fadeOut();
        }},
        success:function (msj) {

            if(msj.resp == 'true') {
                $('#msj-success')
                    .attr('class','')
                    .addClass('col-md-6 col-sm-6 col-xs-12 col-md-offset-3 alert alert-success')
                    .html(msj.mensaje)
                    .fadeIn()
                    .delay(5000)
                    .fadeOut();
            }else{
                $('#msj-success')
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
/** /Ayudas Naturales **/

/** Ayudas Institucionales **/
$('#guardar_inst').click(function () {
    var fecha = $('#fecha').val();
    var tipo_reg = $('#tipo_reg').val();
    var condigo_rif = $('#codigo_rif').val();
    var nombre = $('#nombre').val();
    var direccion = $('#direccion').val();
    var tlfs = $('#telefonos').val();
    var municipio = $('#municipio').val();
    var parroquia = $('#parroquia').val();
    var evento = $('#evento').val();
    var solicitud = $('#solicitud').val();
    var necesidad = $('#necesidad').val();
    var token = $('#token').val();

    $.ajax({
        url: 'guardar-ayuda-inst',
        headers: {'X-CSRF-TOKEN': token},
        type: 'POST',
        dataType: 'JSON',
        data: {
            fecha: fecha,
            tipo_reg: tipo_reg,
            codigo_rif: condigo_rif,
            nombre: nombre,
            direccion: direccion,
            telefonos: tlfs,
            municipio: municipio,
            parroquia: parroquia,
            evento: evento,
            solicitud: solicitud,
            necesidad: necesidad
        },
        statusCode: { 500: function () {
            $('#msj-success')
                .attr('class','')
                .addClass('col-md-6 col-sm-6 col-xs-12 col-md-offset-3 alert alert-danger')
                .html('ERROR: No se pudo completar la operación')
                .fadeIn()
                .delay(3000)
                .fadeOut();
        },
            422: function (msj) {
                $.each(msj.responseJSON, function (k, v) {
                    $('#errores').append('<li>' + v + '</li>')
                });
                $('#div_errores').fadeIn().delay(3000).fadeOut();
            }},
        success:function (msj) {

            if(msj.resp == 'true') {
                $('#msj-success')
                    .attr('class','')
                    .addClass('col-md-6 col-sm-6 col-xs-12 col-md-offset-3 alert alert-success')
                    .html(msj.mensaje)
                    .fadeIn()
                    .delay(5000)
                    .fadeOut();
            }else{
                $('#msj-success')
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

/** Envio de clave **/
$('#desbloq').click(function () {
    
    var clave = $('#clave').val();
    var token = $('#token').val();

    $.ajax({
        url: 'desbloq',
        headers: {'X-CSRF-TOKEN': token},
        type: 'POST',
        dataType: 'JSON',
        data: {
            clave: clave
        },
        success:function (msj) {
            var resp = msj.msj;

            if(resp == 'true'){
                $('#div_clave').remove();
                $('#campos_ayuda').fadeIn();

                //permite el que select sea renderizado correctamente
                $(".select2_group").select2({});
            }else {
                $('#msj-clave').html('Clave Erronea').fadeIn().delay(3000).fadeOut();
            }
        }
    });
})
/** /Envio de clave **/

$(document).ready(function() {
    $(".select2_group").select2({});
});


