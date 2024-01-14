<?php include("../../templates/header.php"); ?>


<style>
    body {
        margin-top: 30px; 
    }

    #map-container {
        margin-top: 20px;
    }

    #map {
        height: 700px; 
    }

    .leaflet-bar {
        background-color: #f8f8f8;
        border: 1px solid #ddd;
    }

    .leaflet-bar a {
        background-color: #fff;
        color: #333;
    }

    .leaflet-bar a:hover {
        background-color: #ddd;
    }

    h1 {
        margin-bottom: 20px;
        font-size: 36px;
        font-weight: bold;
        color: #333;
        text-align: center;
    }
</style>

<br/>
<h1>Explora el Mapa</h1>

<div id="map-container">
    <div id="map"></div>
</div>

<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
<link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />

<script>
    function initMap() {
        var defaultCoordinates = [27.3375, -112.2691];
        var map = L.map('map').setView(defaultCoordinates, 10);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        L.marker(defaultCoordinates).addTo(map);

        var searchControl = L.Control.geocoder({
            collapsed: true,
            placeholder: "Buscar ubicación...",
            geocoder: L.Control.Geocoder.nominatim(),
            defaultMarkGeocode: false
        }).addTo(map);
    }

    initMap();
</script>

<?php include("../../templates/footer.php"); ?>











