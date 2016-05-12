/**
 * Created by Stef et JM on 12/05/2016.
 */

// Fonction datapicker
$(function() {
    $( "#visitor_birthday" ).datepicker();
    $( "#visitor_ticket_dateReservation" ).datepicker();
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

