// function pour gérer les obligations de remplissage de champs
// pour le formulaires des infos complémentaires
$('#car').click(function(){
    if($(this).is(':checked')){
        $('<span class="text-danger font-italic" id="car_note">Mention obligatoire</span>').insertAfter($('#license_plate'));
        $('#license_plate').prop('required', true);
    }else if($(this).is(':not(:checked)')){
        $('#car_note').remove();
        $('#license_plate').prop('required', false);
    }
})

$('#terminal').click(function(){
    if($(this).is(':checked')){
        $('<span class="text-danger font-italic" id="terminal_note">Mention obligatoire</span>').insertAfter($('#electric_terminal_photo'));
        $('#electric_terminal_photo').prop('required', true);
    }else if($(this).is(':not(:checked)')){
        $('#terminal_note').remove();
        $('#electric_terminal_photo').prop('required', false);
    }
})


//Fonction pour afficher la photo qu'on va uploader
//Photo de profil:
$('#profile_photo').click( function () {
    function readURL(input) {
        if(input.files && input.files[0]){
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#img_profile_photo').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
            $("#img_profile_photo").show();
        }
    }
    $("#profile_photo").change(function() {
    readURL(this);
    });
})


//Photo du terminal
$('#electric_terminal_photo').click( function () {
    function readURL(input) {
        if(input.files && input.files[0]){
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#img_electric_terminal_photo').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
            $("#img_electric_terminal_photo").show();
        }
    }
    $("#electric_terminal_photo").change(function() {
    readURL(this);
    });
})



// Faire poper une alert comme si le mail c'était envoyé
$('#sendmail').click(function(){
    alert('Votre message est envoyé ! Nous traiterons votre demande dans les plus bref délais.');
});
