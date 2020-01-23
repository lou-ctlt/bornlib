

$(function () {

    // à l'aide de l'API IPapi on récupère les coordonnées GPS de l'utilisateur

    $.getJSON('https://ipapi.co/json/', function (data) {

        // géolocalisation pour centrer la map
        var latitude = data.latitude;
        var longitude = data.longitude;

        // initialisation de la map
        var osmUrl = "https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png",
            osmAttrib = '&copy; <a href="https://www.openstreetmap.org">OpenStreetMap</a>',
            osm = L.tileLayer(osmUrl, { maxZoom: 18, attribution: osmAttrib });
        let map = L.map("mapid").setView([latitude, longitude], 12).addLayer(osm);

        // déclaration des icones utilisés pour les marqueurs
        var greenIcon = L.icon({
            iconUrl: 'css/images/leaf-green.png',
            shadowUrl: 'css/images/leaf-shadow.png',

            iconSize:     [38, 95], // size of the icon
            shadowSize:   [50, 64], // size of the shadow
            iconAnchor:   [22, 94], // point of the icon which will correspond to marker's location
            shadowAnchor: [4, 62],  // the same for the shadow
            popupAnchor:  [-3, -76] // point from which the popup should open relative to the iconAnchor
        });
        var redIcon = L.icon({
            iconUrl: 'css/images/leaf-red.png',
            shadowUrl: 'css/images/leaf-shadow.png',

            iconSize:     [38, 95], // size of the icon
            shadowSize:   [50, 64], // size of the shadow
            iconAnchor:   [22, 94], // point of the icon which will correspond to marker's location
            shadowAnchor: [4, 62],  // the same for the shadow
            popupAnchor:  [-3, -76] // point from which the popup should open relative to the iconAnchor
        });

        // création d'un marqueur sur la map à l'emplacement de géolocalisation
        var marker = L.marker([latitude, longitude]).addTo(map);

        // boucle pour récupérer les coordonnées GPS
        var i=0;
        var poi = [] ;
        for(var key in coordonnes){

            var value = coordonnes[key];
            var t="marker"+i;
            poi[t] = [key, coordonnes[key]]; // latitude/longitude
            i++;
        };

        /* Rafraichissement de la BDD pour les réservations START */
        var d = new Date,
            dformat = [d.getMonth()+1,
               d.getDate(),
               d.getFullYear()].join('/')+' '+
              [d.getHours(),
               d.getMinutes(),
               d.getSeconds()].join(':');
        x = 1;

        while(x <= Object.keys(updated_at).length){
            var date_updated = new Date(updated_at[x]); /* On prend l'update_at de la bdd pour faire le calcul et mettre a jour les reservations */
            resultat = d - date_updated;
            resultat = resultat - 3600000; // On soustrait 2h
            // console.log(date_updated);
            // console.log(d);
            if(resultat > 0){

                let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                // debugger;
                $.ajaxSetup({
                    headers:
                    { 'X-CSRF-TOKEN': token }
                });

                var request;

                request = $.ajax({ // On fait l'update de reserve_car en ajax
                    url: "/finreservation",
                    method: "POST",
                    data:
                    {
                        x:x
                    },
                    datatype: "json"
                });
                request.done(function(msg) {
                    $("#result").html(msg);
                });
                request.fail(function(jqXHR, textStatus) {
                    $("#result").html("Request failed: " + textStatus);
                });
            }
            x++;
        }
         /* Rafraichissement de la BDD pour les réservations END */

        // création de la fonction permettant de créer les marqueurs et routes associées depuis la géolocalisation
        var boucle_marqueur_route = function(latitude_depart, longitude_depart){
            let n = 1;
            for (var e in poi){

                var date_updated = new Date(updated_at[n]);/* On prend l'update_at de la bdd pour créer des marqueurs adapté aux reservations */
                    resultat = d - date_updated;
                    resultat = resultat - 7200000;

                if(resultat > 0){
                    var element = L.marker([poi[e][1], poi[e][0]], {icon: greenIcon, time:resultat}).addTo(map).bindPopup(); // création marqueur et popup associée
                }
                else{
                    var element = L.marker([poi[e][1], poi[e][0]], {icon: redIcon, time:resultat}).addTo(map).bindPopup();
                }


                element.on("click", function (event) {
                    lat = event["latlng"]["lat"];
                    long = event["latlng"]["lng"];


                    let idform = lat.toString(); // On se débrouille pour donné un ID dynamique pour le reserve_form
                    idform = idform.replace(".", "");

                    // création du lien vers google maps dans la popup avec les coordonnées
                    if(this.options.time > 0){
                        this._popup.setContent( // création du lien vers google maps dans la popup avec les coordonnées
                                                                                "<form class='toto' id='reserve_form" + idform + "' method='post' action='reservation'>" +  // et d'un formulaire pour l'update de la réservation si la voiture n'est pas réservé
                                                                                    "<button type='submit' class='mt-2 btn btn-info' id='reserve_born' name='reserve_born' value='reserve_born'>Réserver</button>" +
                                                                                "</form>" +
                                                                                "<br><a href='https://www.google.fr/maps/dir/"+ latitude_depart +","+ longitude_depart +"/" + lat + ","+ long + "/data=!4m2!4m1!3e0' target='_blank'>Lien vers Google Maps</a>");

                    }
                    else{
                        this._popup.setContent("<span style='color:tomato;'>Cette borne est actellement réservée.<span>");
                    }


                    L.Routing.control({ // création de la route au clic
                        waypoints: [
                            L.latLng([latitude_depart, longitude_depart]),
                            L.latLng(lat, long)
                        ],
                        routeWhileDragging: true
                    }).addTo(map);
                    let lien = "https://www.google.fr/maps/dir/"+ latitude_depart +","+ longitude_depart +"/" + lat + ","+ long + "/data=!4m2!4m1!3e0'";
                    let reserve_form = document.querySelector("#reserve_form" + idform + ""); // On récupère le form dynamiquement

                    if(reserve_form){
                        reserve_form.addEventListener("submit", function (e) {
                            let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content'); // On met le token pour le form
                            e.preventDefault ? e.preventDefault() : (e.returnValue = false); // On block l'envoi du formulaire

                            confirmation = window.prompt("Etes-vous sûr de vouloir réserver cette borne ? \n Attention, cette action bloque cette borne pour vous et empêche toutes autres réservations pendant 2 heures.\n Ecrivez 'ok' si vous êtes sur !");

                            if(confirmation === "ok"){
                                $(document).ready(function(){

                                    $.ajaxSetup({
                                        headers:
                                        { 'X-CSRF-TOKEN': token } // On met le token pour le form
                                    });

                                    var request;

                                    request = $.ajax({ // On fait l'envoi du form par requette ajax
                                        url: "/reservation",
                                        method: "POST",
                                        data:
                                        {
                                            lat : lat,
                                            long : long,
                                            lien : lien
                                        },
                                        datatype: "json"
                                    });

                                    request.done(function(msg) {
                                        document.location.reload(true);
                                    });

                                    request.fail(function(jqXHR, textStatus) {
                                        $("#result").html("Request failed: " + textStatus);
                                    });
                                });
                            }
                        });
                    }
                });
            n++;
            };
        };
        // création de la route au clic sur un marqueur depuis la position géolocalisée
        boucle_marqueur_route(latitude, longitude);

        // fonction pour recentrer sur la map depuis la position géolocalisée
        var recentrer = document.querySelector("#localisation");

        recentrer.addEventListener("click", function(){
        map.remove();
        map = L.map("mapid").setView([latitude, longitude], 12).addLayer(osm);
        marker = L.marker([latitude, longitude]).addTo(map);
        boucle_marqueur_route(latitude, longitude);
        });
        // fonction de recherche pour recentrer la map sur un point autre que l'actuel
        var input = document.querySelector("#recherche");
        var button = document.querySelector("#recherche_button");

        button.addEventListener("click", ()=>{
            var input_value = input.value;
            var input_modif = input_value.replace(/ /g, "+");
            // requete AJAX pour consulter l'API afin de récupérer les coordonnées GPS
            $.ajax({
                url: "/home2",
                method: "GET",
                data:
                {
                    adresse : input_modif,
                 },
                success: function (data) {
                    toto = JSON.parse(data);
                    longitude1 = toto['0']; // on récupère latitude et longitude
                    latitude1 = toto["1"];
                    map.remove();marker.remove();
                    map = L.map("mapid").setView([latitude1, longitude1], 12).addLayer(osm);
                    marker = L.marker([latitude1, longitude1]).addTo(map);

                    // appel de la fonction pour recréer les marqueurs/routes après
               boucle_marqueur_route(latitude1, longitude1);
                },
                error: function (errors) {
                    console.log(errors);
                }
            });
        });
    });

});
