// function pour gérer les obligations de remplissage de champs
// pour le formulaires des infos complémentaires
$('#car').click(function(){
    if($(this).is(':checked')){
        $('#license_plate').prop('required', true);
    }
})