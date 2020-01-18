

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

        // création de la route au clic sur un marqueur
        for (var e in poi){

            var e = L.marker([poi[e][0], poi[e][1]], {icon: greenIcon}).addTo(map).bindPopup("<a href='https://www.google.fr/maps/dir/@"+ $latitude +","+ $longitude +",16z/am=t/data=!3m1!4b1!4m14!4m13!1m5!1m1!1s0xd546327d191048b:0x87cb13fd6da4305c!2m2!1d" + poi[e][1] + "!2d"+ poi[e][0] + "!1m5!1m1!1s0xd546321109d64c9:0xf83a991e7f3bb7f4!2m2!1d" + poi[e][1] + "!2d"+ poi[e][0] + "!3e0' target='_blank'>test</a>"); // création marqueur et popup associée
            e.on("click", function (event) {
                var clickedMarker = event.layer;
                lat = event["latlng"]["lat"];
                long = event["latlng"]["lng"];
                L.Routing.control({ // création de la route au clic
                    waypoints: [
                        L.latLng([$latitude, $longitude]),
                        L.latLng(lat, long)
                    ],
                    routeWhileDragging: true

                }).addTo(map);
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
