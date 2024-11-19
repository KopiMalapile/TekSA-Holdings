function initMap() {
    // Create the map centered around South Africa
    const map = new google.maps.Map(document.getElementById("map"), {
        zoom: 7,
        center: { lat: -25.7479, lng: 28.2293 } // Centered near Centurion
    });

    // Define the locations with names, coordinates, and custom icon
    const locations = [
        { 
            position: { lat: -25.8450, lng: 28.1948 }, 
            title: "Teksa Holdings - 11 Pieter Street, Technopark, Centurion" 
        },
        { 
            position: { lat: -25.9875, lng: 28.2251 }, 
            title: "Teksa Holdings Main Office - 10 Tasman Cres, Olifantsfontein, 1692" 
        },
        { 
            position: { lat: -25.4755, lng: 31.0022 }, 
            title: "Teksa Holdings - 2 Leadwood St, West Acres, Mbombela, 1211" 
        }
    ];

    // Red marker icon
    const redMarkerIcon = {
        url: "http://maps.google.com/mapfiles/ms/icons/red-dot.png" // Red marker icon URL
    };

    // Add markers for each location with the red icon
    locations.forEach((location) => {
        new google.maps.Marker({
            position: location.position,
            map: map,
            title: location.title,
            icon: redMarkerIcon
        });
    });
}

// Initialize the map when the window loads
window.onload = initMap;
