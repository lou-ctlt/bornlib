// function pour gérer les obligations de remplissage de champs
// pour le formulaires des infos complémentaires
if($("#car").is(':checked') && empty($("#license"))){
    $( '@error("license-plate"<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror').insertAfter( "#licence-plate" );
    event.preventDefault();
} 