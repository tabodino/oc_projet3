/**
 * Created by Stef et JM on 12/05/2016.
 */

// Fonction datapicker
$(function() {
    $( "#visitor_birthday" ).datepicker({
        dateFormat: "yy-mm-dd",
        changeMonth: true,
        changeYear: true,
        maxDate: 0,
        yearRange: '1910:yy'
    }).datepicker("option", $.datepicker.regional["fr"]);
    $( "#visitor_ticket_dateReservation" ).datepicker({
        dateFormat: "yy-mm-dd",
        minDate: 0
    });

    $.datepicker.regional['fr'] = {
        monthNames: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],
        monthShortNames: ['Janv', 'Fev', 'Mars', 'Avr', 'Mai', 'Juin', 'Juil', 'Aout', 'Sept', 'Oct', 'Nov', 'Dec'],
        monthMinNames: ['Janv', 'Fev', 'Mars', 'Avr', 'Mai', 'Juin', 'Juil', 'Aout', 'Sept', 'Oct', 'Nov', 'Dec'],
        dayNames: ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'],
        dayNamesShort: ['lu', 'ma', 'me', 'je', 've', 'sa', 'di'],
        dayNamesMin: ['lu', 'ma', 'me', 'je', 've', 'sa', 'di'],
        firstDay: 1
    };
    $.datepicker.setDefaults($.datepicker.regional['fr']);
});

// Récupération et affichage du pays cliqué
$('ul#listcom li').on('click', function(){
    alert('click');
    id = $(this).attr('id');
    alert(id);
    console.log(id);
    $('#listcom').hide();
});

// Autocompletion pays
$('#visitor_country').on('click', function(){

    response = "#listcom";

    $('#visitor_country').on('keyup', function(){

        if ($(this).val().length >= 2) {
            console.log("keyup > 2 sur le champ country" + $(this).val());

            word = $(this).val();
            console.log("resultat non serialisé : "+word);

            autocomplete(response, word);
            $(response).show();
        }

        if ($(this).val().length == 0) {
            $(response).hide();
            $("#visitor_country").show();
        }

    });
});


// Fonction ajax en jquery
function autocomplete(response, word)
{

    console.log(word);

    $.ajax({
        url: 'http://localhost/oc_projet3/web/app_dev.php/test/'+word,
        type: 'POST',
        data: word,
        cache: true,
        success: function(html) {
            //$("#visitor_country").hide();
            $(response).empty().append(html);
        }
    });
}

