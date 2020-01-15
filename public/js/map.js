

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
        let map = L.map("mapid").setView([$latitude, $longitude], 11).addLayer(osm);

console.log(coordonnes);
var m=0;




        // création marqueurs sur la map
        var marker = L.marker([$latitude, $longitude]).addTo(map);
        var marker2 = L.marker([44.797574, -0.615349]).addTo(map);
        var i=0;


        var poi = [] ;
        for(var key in coordonnes){
            console.log(i);
            var value = coordonnes[key];
            var t="marker"+i;
            poi[t] = [key, coordonnes[key]];
            i++;
            }


        var popup = L.popup();


        // création de la route au clic sur un marqueur
        for (var e in poi){
            console.log(poi[e]);
            var e = L.marker([poi[e][0], poi[e][1]]).addTo(map);
            e.on("click", function (event) {
                var clickedMarker = event.layer;
                console.log(event)
                lat = event["latlng"]["lat"];
                long = event["latlng"]["lng"];
                L.Routing.control({
                    waypoints: [
                        L.latLng([$latitude, $longitude]),
                        L.latLng(lat, long)
                    ],
                    routeWhileDragging: true,
                    geocoder: L.Control.Geocoder.nominatim()
                }).addTo(map);

                console.log("toto");
            });


        }





        // fonction de recherche pour recentrer la map sur un point autre que l'actuel (EN COURS)
        var input = document.querySelector("#recherche");
        var button = document.querySelector("#recherche_button");

        button.addEventListener("click", ()=>{
                //console.log(input.value);
        });


    });


});

// route auto au clic entre 2 marqueurs







