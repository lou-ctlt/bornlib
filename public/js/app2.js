(function () {

    /* Toggle pour le popage du formulaire de la page Home : START */
    // console.log("toto");
    let form_pop = document.querySelector("#form_pop");
    let form_pop_button = document.querySelector("#form_pop_button");
    form_pop_button.addEventListener("click", function(){form_pop.classList.toggle('d-none')});
    /* Toggle pour le popage du formulaire de la page Home : END */

    /* Fonction pour afficher la photo uploadé par l'utilisateur : START */
    let profile_photo = document.querySelector("#profile_photo");
    let electric_terminal_photo = document.querySelector("#profile_photo");
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
})()
