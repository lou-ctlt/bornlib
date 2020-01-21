

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
        var i=0;


        var poi = [] ;
        for(var key in coordonnes){

            var value = coordonnes[key];
            var t="marker"+i;
            poi[t] = [key, coordonnes[key]];
            i++;
            }








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
