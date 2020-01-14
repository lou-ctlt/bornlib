(function () { // Fonction anonyme pour le popage du formulaire de la page Home
    console.log("toto");
    form_pop = document.querySelector("#form_pop");
    form_pop_button = document.querySelector("#form_pop_button");
    form_pop_button.addEventListener("click", function(){form_pop.classList.toggle('d-none')});
})()
