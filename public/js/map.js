

$(function () {

    // à l'aide de l'API ipapi afficher un paragraphe avec l'adresse IP de l'utilisateur ainsi que son code postal et/ou sa ville

    $.getJSON('https://ipapi.co/json/', function (data) {


            var $latitude = data.latitude;
            var $longitude = data.longitude;

                osmUrl = "https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png",
                osmAttrib = '&copy; <a href="https://www.openstreetmap.org">OpenStreetMap</a>',
            osm = L.tileLayer(osmUrl, { maxZoom: 18, attribution: osmAttrib });

            let map = L.map("mapid").setView([$latitude, $longitude], 11).addLayer(osm);
            var lat;
            var long;


            var marker = L.marker([$latitude, $longitude]).addTo(map);
            var marker2 = L.marker([44.797574, -0.615349]).addTo(map);
            var i=0;
            var test = [];
            for(var key in coordonnes)
            {
                test.push("marker_" + i);
              i++;

            }
            console.log(test);
            i=0;
            for(var key in coordonnes)

              var value = coordonnes[key];

              L.marker([value, coordonnes[key]]).addTo(map);

            }
            //     let i = 0;
            //     coordonnes.forEach(borne => {
            //     var marker_i = L.marker([borne->, borne_longitude]).addTo(map);
            // });
            var popup = L.popup();

            marker2.addEventListener("click", (e)=>{
                console.log(e);
                lat = e["latlng"]["lat"];
                long = e["latlng"]["lng"];
                L.Routing.control({
                    waypoints: [
                        L.latLng([$latitude, $longitude]),
                        L.latLng(lat, long)
                    ],
                    routeWhileDragging: true,
                    geocoder: L.Control.Geocoder.nominatim()
            }).addTo(map);


            })


            });

            var coor = coordonnes;
            console.log(coor);
});

// route auto au clic entre 2 marqueurs







