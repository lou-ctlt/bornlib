

$(function () {

    // à l'aide de l'API ipapi afficher un paragraphe avec l'adresse IP de l'utilisateur ainsi que son code postal et/ou sa ville

    $.getJSON('https://ipapi.co/json/', function (data) {
        // initialisation de la map

        var osmUrl = "https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png",
            osmAttrib = '&copy; <a href="https://www.openstreetmap.org">OpenStreetMap</a>',
            osm = L.tileLayer(osmUrl, { maxZoom: 18, attribution: osmAttrib });

        // géolocalisation pour centrer la map

        var $latitude = data.latitude;
        var $longitude = data.longitude;


        let map = L.map("mapid").setView([$latitude, $longitude], 12).addLayer(osm);

        var greenIcon = L.icon({
            iconUrl: 'css/images/leaf-green.png',
            shadowUrl: 'css/images/leaf-shadow.png',

            iconSize:     [38, 95], // size of the icon
            shadowSize:   [50, 64], // size of the shadow
            iconAnchor:   [22, 94], // point of the icon which will correspond to marker's location
            shadowAnchor: [4, 62],  // the same for the shadow
            popupAnchor:  [-3, -76] // point from which the popup should open relative to the iconAnchor
        });





        // création marqueurs sur la map
        var marker = L.marker([$latitude, $longitude]).addTo(map);
        var marker2 = L.marker([44.797574, -0.615349]).addTo(map);
        var i=0;


        var poi = [] ;
        for(var key in coordonnes){

            var value = coordonnes[key];
            var t="marker"+i;
            poi[t] = [key, coordonnes[key]];
            i++;
            }


    /* Rafraichissement de la BDD pour les réservations START */


    var d = new Date,
    dformat = [d.getMonth()+1,
               d.getDate(),
               d.getFullYear()].join('/')+' '+
              [d.getHours(),
               d.getMinutes(),
               d.getSeconds()].join(':');


    x = 1;

    while(x < Object.keys(updated_at).length){
        var date_updated = new Date(updated_at[x]);/* On prend l'update_at de la bdd pour  */
        resultat = d - date_updated;
        resultat = resultat - 5400000;// On soustrait 1h30 (30min + une heure car notre site est 1heure en retard dans la BDD)

        console.log(x);
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





        // création de la route au clic sur un marqueur
        let n = 0;
        // présence des popup => peut créer 2 rou plus routes, essayer de sortir l'itinéraire de la map? enclencher la route via un bouton dans la popup? ne pas poser de marqueur lors du clic
        for (var e in poi){

            var e = L.marker([poi[e][0], poi[e][1]], {icon: greenIcon, id:n}).addTo(map).bindPopup("<b>Hello world!</b><br>I am a popup.<br>" +// création marqueur et popu associée
                                                                                                "<form class='toto' id='reserve_form" + n + "' method='post' action='reservation'>" +  // et d'un formulaire pour l'update de la réservation
                                                                                                    "<button type='submit' class='mt-2 btn btn-info' id='reserve_car' name='reserve_car' value='reserve_car'>Réserver</button>" +
                                                                                                "</form>");


            e.on("click", function (event) {
                var clickedMarker = event.layer;

                lat = event["latlng"]["lat"];
                long = event["latlng"]["lng"];
                L.Routing.control({ // création de la route au clic
                    waypoints: [
                        L.latLng([$latitude, $longitude]),
                        L.latLng(lat, long)
                    ],
                    routeWhileDragging: true,
                    geocoder: L.Control.Geocoder.nominatim()
                }).addTo(map);


                let reserve_form = document.querySelector("#reserve_form" + (this.options.id) + ""); // On récupère le form dynamiquement


                reserve_form.addEventListener("submit", function (e) {

                    let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content'); // On met le token pour le form
                    e.preventDefault ? e.preventDefault() : (e.returnValue = false); // On block l'envoi du formulaire


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
                                long : long
                            },
                            datatype: "json"
                        });

                        request.done(function(msg) {
                            $("#result").html(msg);
                        });

                        request.fail(function(jqXHR, textStatus) {
                            $("#result").html("Request failed: " + textStatus);
                        });
                    });
                });

            });

        n++;
        }






        // fonction de recherche pour recentrer la map sur un point autre que l'actuel (EN COURS)
        var input = document.querySelector("#recherche");
        var button = document.querySelector("#recherche_button");
        console.log(newcoordonnes);
        button.addEventListener("click", ()=>{
            map.remove();
            map = L.map("mapid").setView([newcoordonnes["0"], newcoordonnes["1"]], 12).addLayer(osm);
        });


    });


});

// route auto au clic entre 2 marqueurs







