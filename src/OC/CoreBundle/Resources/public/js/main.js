/**
 * Created by Stef et JM on 12/05/2016.
 */

// Fonction datapicker
$(function() {
    $( "#visitor_birthday" ).datepicker();
    $( "#visitor_ticket_dateReservation" ).datepicker();
});

// Autocompletion pays
$('#visitor_country').on('click', function(){
    response = "#listcom";
    console.log("click sur le champ country");
    $('#visitor_country').on('keyup', function(){

        if ($(this).val().length >= 2) {
            console.log("keyup > 2 sur le champ country" + $(this).val());
            s = $(this).serialize();
            word = $(this).val();
            console.log("resultat non serialisé : "+word);
            console.log("resultat serialisé : "+s);
            autocomplete(response, s, word);
            $(response).show();
        }

        if ($(this).val().length == 0) {
            $(response).hide();
        }

    });
});

// Fonction ajax en jquery
function autocomplete(response, s, word)
{
    console.log("dans la fonction autocomplete");
    console.log(s);
    console.log(word);
    country = s.split('=');
    $.ajax({
        url: 'http://localhost/oc_projet3/web/app_dev.php/test/'+word,
        type: 'POST',
        data: word,
        cache: true,
        success: function(html) {
            $("#visitor_country").replaceWith(html);
            $(response).empty().append(html);
        }
    });
}