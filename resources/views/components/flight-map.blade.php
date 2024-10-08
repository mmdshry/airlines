<!-- flight-map.blade.php -->

<div id="flight-map" style="height: 500px;"></div>

<script src="{{ asset('js/leaflet.js') }}"></script>
<link rel="stylesheet" href="{{ asset('css/leaflet.css') }}" />

<style>
    .custom-icon {
        background: none;
        border: none;
    }
    .custom-marker {
        position: relative;
        width: 40px;
        height: 40px;
    }
    .plane-emoji {
        position: absolute;
        top: 0;
        left: 0;
        font-size: 10px;
        z-index: 2;
    }
    .sender-image {
        position: absolute;
        bottom: 0;
        right: 0;
        width: 16px;
        height: 16px;
        object-fit: cover;
        z-index: 1;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const maxAltitude = 34000;
        const map = L.map('flight-map').setView([0, 0], 2);
        const flights = @json($flights);
        const planeMarkers = new Map();

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        function updateFlightPositions() {
            const now = Date.now();
            flights.forEach((flight, index) => {
                const { position, altitude } = calculatePlanePosition(flight, now);
                updateOrCreateMarker(flight, index, position, altitude, now);
            });
        }

        function updateOrCreateMarker(flight, index, position, altitude, now) {
            let marker = planeMarkers.get(index);
            if (marker) {
                marker.setLatLng(position);
                updatePopup(marker, flight, now, altitude); // Pass altitude to updatePopup
            } else {
                marker = createMarker(position, flight, now, altitude); // Pass altitude to createMarker
                planeMarkers.set(index, marker);
            }
        }

        function createMarker(position, flight, now, altitude) {
            const customIcon = L.divIcon({
                html: `
                    <div class="custom-marker">
                        <div class="plane-emoji">✈️</div>
                        <img src="${flight.sender.image}" alt="${flight.sender.name}" class="sender-image">
                    </div>
                `,
                className: 'custom-icon'
            });

            const marker = L.marker(position, { icon: customIcon }).addTo(map);
            marker.bindPopup(() => createPopupContent(flight, now, altitude)); // Pass altitude to popup content
            return marker;
        }

        function updatePopup(marker, flight, now, altitude) {
            if (marker.isPopupOpen()) {
                marker.setPopupContent(createPopupContent(flight, now, altitude)); // Pass altitude to popup content
            }
        }

        function createPopupContent(flight, now, altitude) {
            const { airplane, sender, capacity, origin, destination, departed_at, landed_at } = flight;
            const departureTime = new Date(departed_at);
            const landingTime = new Date(landed_at);
            const isCompleted = now >= landingTime;
            const capacityType = airplane.airplane.type === 'cargo' ? "Ton's" : 'Passengers';
            const status = isCompleted ? "Landed" : "Flying";
            const speed = isCompleted ? 0 : airplane.airplane.speed;

            // Include current altitude in durationInfo
            const durationInfo = isCompleted
                ? `Total flight time: ${formatDuration(landingTime - departureTime)}`
                : `Time to landing: ${formatDuration(landingTime - now)}`;

            return `
                <strong>Flight Info</strong><br>
                <img height="100" width="200" src="${airplane.airplane.image}" alt="${airplane.airplane.name}"><br>
                Airplane model: ${airplane.airplane.name}<br>
                Airline: ${sender.name}<br>
                Carrying: ${capacity} ${capacityType}<br>
                Origin: ${origin.name}<br>
                Destination: ${destination.name}<br>
                Speed : ${speed} km/h<br>
                Departed at: ${departed_at}<br>
                Expected at: ${landed_at}<br>
                Altitude: ${altitude} feet<br> <!-- Display current altitude -->
                ${durationInfo}<br>
                Status: ${status}<br>
            `;
        }

        function calculatePlanePosition(flight, now) {
            const { origin, destination, departed_at, landed_at } = flight;
            const totalFlightTime = new Date(landed_at) - new Date(departed_at);
            const timeElapsed = now - new Date(departed_at);
            const flightProgress = Math.min(timeElapsed / totalFlightTime, 1);

            // Calculate altitude
            let altitude = 0;
            if (flightProgress < 0.4) {
                // Climbing phase (first 40% of the flight)
                altitude = Math.round(flightProgress / 0.4 * maxAltitude);
            } else if (flightProgress > 0.6) {
                // Descending phase (last 40% of the flight)
                altitude = Math.round((1 - flightProgress) / 0.4 * maxAltitude);
            } else {
                // Cruising phase (between 40% and 60%)
                altitude = maxAltitude; // Maintain cruising altitude
            }

            if (flightProgress === 1) {
                return { position: [destination.latitude, destination.longitude], altitude: 0 };
            }

            return {
                position: [
                    origin.latitude + (destination.latitude - origin.latitude) * flightProgress,
                    origin.longitude + (destination.longitude - origin.longitude) * flightProgress
                ],
                altitude: altitude
            };
        }

        function formatDuration(milliseconds) {
            const totalSeconds = Math.floor(milliseconds / 1000);
            const hours = Math.floor(totalSeconds / 3600);
            const minutes = Math.floor((totalSeconds % 3600) / 60);
            const seconds = totalSeconds % 60;

            return `${hours}h ${minutes}m ${seconds}s`;
        }

        updateFlightPositions();
        setInterval(updateFlightPositions, 1000);
    });
</script>