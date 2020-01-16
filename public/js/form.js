// function pour gérer les obligations de remplissage de champs
// pour le formulaires des infos complémentaires
$('#car').click(function(event){
    if($(this).is(':checked')){
        $("<span class='require_note' id='car_note'>Mention obligatoire</span>").insertAfter($('#license_plate'));
        $('#license_plate').prop('required', true);
    }else if($(this).is(':not(:checked)')){
        $("#car_note").remove();
        $('#license_plate').prop('required', false);
    }
})


$('#terminal').click(function(){
    if($(this).is(':checked')){
        $("<span class='require_note' id='terminal_note'>Mention obligatoire</span>").insertAfter($('#electric_terminal_photo'));
        $('#electric_terminal_photo').prop('required', true);
    }else if($(this).is(':not(:checked)')){
        $("#terminal_note").remove();
        $('#electric_terminal_photo').prop('required', false);
    }
})

//Fonction pour obliger l'utilisateur à cocher au moins une case
$('form').submit(function(event){
    if($('#car').is(":not(:checked)") && $('#termninal').is(":not(:checked)")){
        event.preventDefault();  
    }
})

