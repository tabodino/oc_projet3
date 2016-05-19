/**
 * Created by Stef et JM on 12/05/2016.
 */

// Fonction datapicker
$(function() {
    $( "#visitor_birthday" ).datepicker({
        dateFormat: "yy-mm-dd",
        changeMonth: true,
        changeYear: true,
        yearRange: '1910:yy'


    });
    $( "#visitor_ticket_dateReservation" ).datepicker({
        dateFormat: "yy-mm-dd",
        minDate: 0
    });

    $.datepicker.regional['fr'] = {
        closeText: 'Fermer',
        prevText: 'Précédent',
        nextText: 'Suivant',
        currentText: 'Aujourd\'hui',
        monthNames: ['janvier', 'février', 'mars', 'avril', 'mai', 'juin',
            'juillet', 'août', 'septembre', 'octobre', 'novembre', 'décembre'],
        monthNamesShort: ['janv.', 'févr.', 'mars', 'avril', 'mai', 'juin',
            'juil.', 'août', 'sept.', 'oct.', 'nov.', 'déc.'],
        dayNames: ['dimanche', 'lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi'],
        dayNamesShort: ['dim.', 'lun.', 'mar.', 'mer.', 'jeu.', 'ven.', 'sam.'],
        dayNamesMin: ['D','L','M','M','J','V','S'],
        weekHeader: 'Sem.',
        dateFormat: 'dd/mm/yy',
        firstDay: 1,
        isRTL: false,
        showMonthAfterYear: false,
        yearSuffix: ''
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

