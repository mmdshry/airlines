<div id="map" style="height: 500px;"></div>

<script src="{{ asset('js/leaflet.js') }}"></script>
<link rel="stylesheet" href="{{ asset('css/leaflet.css') }}" />

<script>
    document.addEventListener('DOMContentLoaded', function() {
        let map = L.map('map').setView([0, 0], 2);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        let airports = @json($airports);

        airports.forEach(function(airport) {
            var marker = L.marker([airport.latitude, airport.longitude]).addTo(map);

            var popupContent = `
                <strong>${airport.name}</strong><br>
                Airline: ${airport.airline.name}<br>
                Owner: ${airport.airline.user.name}
            `;

            marker.bindPopup(popupContent);
        });
    });
</script>