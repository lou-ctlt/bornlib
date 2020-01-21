(function () {

    /* Toggle pour le popage du formulaire de la page Home : START */
    // console.log("toto");
    let form_pop = document.querySelector("#form_pop");
    let form_pop_button = document.querySelector("#form_pop_button");
    form_pop_button.addEventListener("click", function(){form_pop.classList.toggle('d-none')});
    /* Toggle pour le popage du formulaire de la page Home : END */

    /* Suppression du compte START */
    let suppr_compte = document.querySelector("#suppr_compte");
    let suppr_confirm = document.querySelector("#suppr_confirm");
    suppr_compte.addEventListener("click", function () {
        validation_suppr = prompt("Etes-vous sur de vouloir supprimer votre compte ? \n Toutes vos données seront définitevement perdus ! \n Tapez 'Je supprime mon compte' pour valider !");
        if(validation_suppr === "Je supprime mon compte"){
            suppr_confirm.insertAdjacentHTML("afterbegin", "<button class='btn btn-danger'>SUPPRESSION</button>");
        }
    })
    /* Suppression du compte END */


    /* Fonction pour afficher la photo uploadé par l'utilisateur : START */
    let profile_photo = document.querySelector("#profile_photo");
    let electric_terminal_photo = document.querySelector("#electric_terminal_photo");
    profile_photo.addEventListener("click", function () {
        function readURL(input) {
            if (input.files && input.files[0]) {
              var reader = new FileReader();
              reader.onload = function(e) {
                $('#img_profile_photo').attr('src', e.target.result);
              }
              reader.readAsDataURL(input.files[0]);
            }
          }
          $("#profile_photo").change(function() {
          readURL(this);
          });
    })
    electric_terminal_photo.addEventListener("click", function () {
        function readURL(input) {
            if (input.files && input.files[0]) {
              var reader = new FileReader();
              reader.onload = function(e) {
                $('#img_electric_terminal_photo').attr('src', e.target.result);
              }
              reader.readAsDataURL(input.files[0]);
            }
          }
          $("#electric_terminal_photo").change(function() {
          readURL(this);
          });
    })
    /* Fonction pour afficher la photo uploadé par l'utilisateur : END */

    $('.car').click(function(){
        $("<span class='require_note' id='car_note' style='color: tomato;'>Mention obligatoire</span>").insertAfter($('#license_plate'));
        $('#license_plate').prop('required', true);
    })
    $('.nocar').click(function(){
        $("#car_note").remove();
        $('#license_plate').prop('required', false);
    })
})()
