

$(function () {

    // à l'aide de l'API ipapi on récupère les coordonnées GPS de l'utilisateur

    $.getJSON('https://ipapi.co/json/', function (data) {
        // initialisation de la map

        var osmUrl = "https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png",
            osmAttrib = '&copy; <a href="https://www.openstreetmap.org">OpenStreetMap</a>',
            osm = L.tileLayer(osmUrl, { maxZoom: 18, attribution: osmAttrib });

        // géolocalisation pour centrer la map

        var latitude = data.latitude;
        var longitude = data.longitude;


        // initialisation de la map centrée sur la géolocalisation
        let map = L.map("mapid").setView([latitude, longitude], 12).addLayer(osm);

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
        var i=0;

        var poi = [] ;
        for(var key in coordonnes){

            var value = coordonnes[key];
            var t="marker"+i;
            poi[t] = [key, coordonnes[key]];
            i++;
        };

        // création de la fonction permettant de créer les marqueurs et routes associées depuis la géolocalisation
        var boucle_geolocalisation = function(){
            for (var e in poi){

                var element = L.marker([poi[e][1], poi[e][0]], {icon: greenIcon}).addTo(map).bindPopup(); // création marqueur et popup associée

                element.on("click", function (event) {
                    var clickedMarker = event.layer;
                    lat = event["latlng"]["lat"];
                    long = event["latlng"]["lng"];
                    // création du lien vers google maps dans la popup avec les coordonnées
                    this._popup.setContent("<a href='https://www.google.fr/maps/dir/"+ latitude +","+ longitude +"/" + lat + ","+ long + "/data=!4m2!4m1!3e0' target='_blank'>test</a>")


                    L.Routing.control({ // création de la route au clic
                        waypoints: [
                            L.latLng([latitude, longitude]),
                            L.latLng(lat, long)
                        ],
                        routeWhileDragging: true
                    }).addTo(map);

                });
            };

        };
        // création de la route au clic sur un marqueur

        // présence des popup => peut créer 2 rou plus routes, essayer de sortir l'itinéraire de la map? enclencher la route via un bouton dans la popup? ne pas poser de marqueur lors du clic
        for (var e in poi){

            var e = L.marker([poi[e][0], poi[e][1]], {icon: greenIcon}).addTo(map).bindPopup("<b>Hello world!</b><br>I am a popup."); // création marqueur et popu associée
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

                // fonction pour actualiser la map toute les X secondes/minutes:
                function refreshMap() {
                    $.ajax({
                        url: "/home",
                        method: "GET",
                        success: function(){
                            e.remove();
                            L.marker([poi[e][0], poi[e][1]], {icon: greenIcon}).addTo(map).bindPopup("<b>Hello world!</b><br>I am a popup.");
                        }
                    });
                }; setInterval(refreshMap, 2000);

            });


        }

        boucle_geolocalisation();




        // fonction de recherche pour recentrer la map sur un point autre que l'actuel
        var input = document.querySelector("#recherche");
        var button = document.querySelector("#recherche_button");

        button.addEventListener("click", ()=>{
            var input_value = input.value;
            var input_modif = input_value.replace(/ /g, "+");
            // requete AJAX pour consulter l'API afin de récupérer les coordonnées GPS
            $.ajax({
                url: "https://api-adresse.data.gouv.fr/search/?q="+input_modif,
                method: "GET",
                success: function (data) {

                    longitude1 = data.features["0"].geometry.coordinates["0"]; // on récupère latitude et longitude
                    latitude1 = data.features["0"].geometry.coordinates["1"];
                    map.remove();marker.remove();
                    map = L.map("mapid").setView([latitude1, longitude1], 12).addLayer(osm);
                    marker = L.marker([latitude1, longitude1]).addTo(map);
                    var recentrer = document.querySelector("#localisation");

                    // fonction pour recentrer sur la géolocalisation
                    recentrer.addEventListener("click", function(){
                        map.remove();
                        map = L.map("mapid").setView([latitude, longitude], 12).addLayer(osm);
                        marker = L.marker([latitude, longitude]).addTo(map);
                        boucle_geolocalisation();
                    });


                    // fonction pour recréer les marqueurs après remove de la map
                for (var e in poi){

                    var element = L.marker([poi[e][1], poi[e][0]], {icon: greenIcon}).addTo(map).bindPopup();

                    element.on("click", function (event) {

                        var clickedMarker = event.layer;
                        lat = event["latlng"]["lat"];
                        long = event["latlng"]["lng"];
                        // création du lien vers google maps dans la popup avec les coordonnées
                        this._popup.setContent("<a href='https://www.google.fr/maps/dir/"+ latitude1 +","+ longitude1 +"/" + lat + ","+ long + "/data=!4m2!4m1!3e0' target='_blank'>test</a>");
                        // création de la route au clic
                        L.Routing.control({
                            waypoints: [
                                L.latLng([latitude1, longitude1]),
                                L.latLng(lat, long)
                                ],
                                routeWhileDragging: true
                            }).addTo(map);
                        });
                    }
                },
                error: function (errors) {
                    console.log(errors);
                }
            });
        });

    });

});

// route auto au clic entre 2 marqueurs
