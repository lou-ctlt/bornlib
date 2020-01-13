let osmUrl = "http://c.tile.stamen.com/watercolor/{z}/{x}/{y}.jpg",
    osmAttrib = '&copy; <a href="https://www.openstreetmap.org">OpenStreetMap</a>',
    osm = L.tileLayer(osmUrl, { maxZoom: 18, attribution: osmAttrib });

let map = L.map("map").setView([44.845423, -0.570373], 11).addLayer(osm);

let marker = L.marker([44.845423, -0.570373]).addTo(map);
