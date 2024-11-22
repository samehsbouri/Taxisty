// new code *********************** //

document.addEventListener("DOMContentLoaded", function () {
    let map, userMarker, mapInitialized = false;

    // DOM Elements
    const openMapBtn = document.getElementById("open-map-btn");
    const closeMapBtn = document.getElementById("close-map-btn");
    const mapModal = document.getElementById("map-modal");
    const destination = document.getElementById("destination");

    // Initialize the map (inside the modal)
    function initializeMap() {
        if (!mapInitialized) {
            map = L.map("map-container").setView([36.8065, 10.1815], 13); // Default: Tunis, Tunisia

            L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
                attribution:
                    '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
                maxZoom: 19,
            }).addTo(map);

            // Event listener for map clicks
            // Event listener for map clicks with reverse geocoding to fetch street names
map.on("click", function (e) {
    const lat = e.latlng.lat;
    const lng = e.latlng.lng;
    getDetailedLocationMap(lat, lng); // Fetch and display the street name
    updateUserMarker(lat, lng);
});

// Function to conduct reverse geocoding and update 'destination'
function getDetailedLocationMap(lat, lng) {
    const apiKey = 'b175a585167e4d7894de3532f333810b'; // Use your actual OpenCage API key
    const url = `https://api.opencagedata.com/geocode/v1/json?q=${lat}+${lng}&key=${apiKey}`;

    fetch(url)
        .then(response => response.json())
        .then(data => {
            if (data.results && data.results.length > 0) {
                const details = data.results[0].components;
                
                // Build address string more dynamically based on available data.
                let addressParts = [];
                if (details.road) {
                    addressParts.push(details.road);
                    if (details.house_number) {
                        addressParts.push(details.house_number);
                    }
                } else {
                    addressParts.push("Unnamed Road");
                }
                if (details.postcode) {
                    addressParts.push(details.postcode);
                }
                if (details.city) {
                    addressParts.push(details.city);
                } else if (details.village) {
                    addressParts.push(details.village);
                }
                if (details.state) {
                    addressParts.push(details.state);
                }
                if (details.country) {
                    addressParts.push(details.country);
                }

                const address = addressParts.join(", ");
                document.getElementById('destination').value = address;

            } else {
                document.getElementById('destination').value = "Location not found";
            }
        })
        .catch(error => {
            console.error('Reverse Geocoding error:', error);
            document.getElementById('destination').value = "Failed to obtain address";
        });
}


            // Add user's location marker
            fetchCurrentLocation();
            mapInitialized = true;
        }
    }

    // Open modal and initialize the map
    openMapBtn.addEventListener("click", function () {
        mapModal.style.display = "block";
        initializeMap();
    });
    destination.addEventListener("click", function () {
        mapModal.style.display = "block";
        initializeMap();
    });
    // Close modal
    closeMapBtn.addEventListener("click", function () {
        mapModal.style.display = "none";
    });

    // Close modal when clicking outside the modal content
    window.addEventListener("click", function (e) {
        if (e.target === mapModal) {
            mapModal.style.display = "none";
        }
    });

    // Existing map functionality (unchanged)
    function updateUserMarker(lat, lng) {
        if (userMarker) {
            userMarker.setLatLng([lat, lng]);
        } else {
            userMarker = L.marker([lat, lng], { draggable: true })
                .addTo(map)
                .bindPopup("Selected location")
                .openPopup();
        }
        map.setView([lat, lng], map.getZoom());
    }
    function getDetailedLocationlocation(lat, lng) {
        const apiKey = 'b175a585167e4d7894de3532f333810b'; // Use your actual OpenCage API key
        const url = `https://api.opencagedata.com/geocode/v1/json?q=${lat}+${lng}&key=${apiKey}`;
    
        fetch(url)
            .then(response => response.json())
            .then(data => {
                if (data.results && data.results.length > 0) {
                    const details = data.results[0].components;
                    
                    // Build address string more dynamically based on available data.
                    let addressParts = [];
                    if (details.road) {
                        addressParts.push(details.road);
                        if (details.house_number) {
                            addressParts.push(details.house_number);
                        }
                    } else {
                        addressParts.push("Unnamed Road");
                    }
                    if (details.postcode) {
                        addressParts.push(details.postcode);
                    }
                    if (details.city) {
                        addressParts.push(details.city);
                    } else if (details.village) {
                        addressParts.push(details.village);
                    }
                    if (details.state) {
                        addressParts.push(details.state);
                    }
                    if (details.country) {
                        addressParts.push(details.country);
                    }
    
                    const address = addressParts.join(", ");
                    document.getElementById('destination').value = address;

                    document.getElementById('votreposition').value = address;
    
                } else {
                    document.getElementById('votreposition').value = "Location not found";
                    document.getElementById('destination').value = "Location not found";
                }
            })
            .catch(error => {
                console.error('Reverse Geocoding error:', error);
                document.getElementById('votreposition').value = "Failed to obtain address";
                document.getElementById('destination').value = "Failed to obtain address";
            });
    }

    function fetchCurrentLocation() {
        if ("geolocation" in navigator) {
            navigator.geolocation.getCurrentPosition(
                (position) => {
                    const { latitude, longitude } = position.coords;
                    getDetailedLocationlocation(latitude, longitude);
                
                    addUserLocation(latitude, longitude);

 
                },
                (error) => {
                    console.log("Geolocation failed. Trying IP geolocation...");
                }
            );
        }
    }

    function addUserLocation(lat, lng) {
        if (userMarker) {
            userMarker.setLatLng([lat, lng]).openPopup();
        } else {
            userMarker = L.marker([lat, lng], {
                icon: createRedMarker(),
            })
                .addTo(map)
                .bindPopup("You are here!")
                .openPopup();

            }
        map.setView([lat, lng], 15);
    }

    function createRedMarker() {
        return L.icon({
            iconUrl: "https://cdn-icons-png.flaticon.com/512/252/252025.png",
            iconSize: [32, 32],
            iconAnchor: [16, 32],
            popupAnchor: [0, -32],
        });
    }
    
});
