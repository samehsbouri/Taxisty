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






/*
// *********** Old Code ********* /


document.addEventListener("DOMContentLoaded", function () {
    let map, userMarker;

    // Initialize the map (default: center on Tunisia)
    function initializeMap() {
        map = L.map('map-container').setView([36.8065, 10.1815], 13); // Default: Tunis, Tunisia
    
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
            maxZoom: 19,
        }).addTo(map);
    
        // Event listener for map clicks
        map.on('click', function (e) {
            const lat = e.latlng.lat;
            const lng = e.latlng.lng;
            // Update the destination input box
            document.getElementById('destination').value = `Lat: ${lat.toFixed(4)}, Lng: ${lng.toFixed(4)}`;
            // Optionally update or move the marker position
            updateUserMarker(lat, lng);
        });
    }
    
    // Function to update or add the marker at the new click location
    function updateUserMarker(lat, lng) {
        if (userMarker) {
            userMarker.setLatLng([lat, lng]);
        } else {
            // If no marker exists, create a new one
            userMarker = L.marker([lat, lng], { draggable: true })
                .addTo(map)
                .bindPopup('Selected location')
                .openPopup();
        }
        map.setView([lat, lng], map.getZoom()); // Optionally adjust zoom level here
    }
    

    // Add or update the user's location marker
    function addUserLocation(lat, lng) {
        if (userMarker) {
            userMarker.setLatLng([lat, lng]).openPopup();
        } else {
            userMarker = L.marker([lat, lng], { icon: createRedMarker() })
                .addTo(map)
                .bindPopup('You are here!')
                .openPopup();
        }
        map.setView([lat, lng], 15); // Center map on user's location
    }

    // Create a red marker for the user's location
    function createRedMarker() {
        return L.icon({
            iconUrl: 'https://cdn-icons-png.flaticon.com/512/252/252025.png', // Red marker icon
            iconSize: [32, 32], // Size of the icon
            iconAnchor: [16, 32], // Point of the icon which will correspond to marker's location
            popupAnchor: [0, -32], // Point from which the popup should open relative to the iconAnchor
        });
    }

    // Fetch user's current location and reverse geocode to get the city name
    function fetchCurrentLocation() {
        if ('geolocation' in navigator) {
            navigator.geolocation.getCurrentPosition(
                (position) => {
                    const { latitude, longitude } = position.coords;
                    document.getElementById('votreposition').value = `Lat: ${latitude}, Lng: ${longitude}`;
                    addUserLocation(latitude, longitude);

                    // Reverse geocoding to get the city name
                    getDetailedLocation(latitude, longitude);
                },
                (error) => {
                    console.log('Geolocation failed. Trying IP geolocation...');
                    getLocationByIP(); // Fallback to IP-based location
                }
            );
        } else {
            console.log('Geolocation is not supported. Trying IP geolocation...');
            getLocationByIP(); // Fallback to IP-based location
        }
    }

    // Reverse geocoding to get more detailed address from coordinates
    function getDetailedLocation(lat, lng) {
        const apiKey = 'b175a585167e4d7894de3532f333810b'; // Replace with your OpenCage API key
        const url = `https://api.opencagedata.com/geocode/v1/json?q=${lat},${lng}&key=${apiKey}`;

        fetch(url)
            .then(response => response.json())
            .then(data => {
                console.log('Reverse Geocoding Response:', data); // Debugging: Log full response

                if (data.results && data.results.length > 0) {
                    const result = data.results[0].components;
                    const city = result.city || result.town || result.village || result.country || "Unknown location";
                    const road = result.road || result.pedestrian || "Street not available";
                    const postcode = result.postcode || "Postcode not available";
                    const formattedAddress = `${road}, ${city}, ${postcode}`;

                    // Set the city or road as the default location in the input field
                    document.getElementById('destination').value = formattedAddress;
                } else {
                    document.getElementById('destination').value = "Unknown location";
                }
            })
            .catch((error) => {
                console.error('Error getting location details:', error);
                document.getElementById('destination').value = "Error fetching location details";
            });
    }

    // Fallback to IP-based geolocation (ipinfo.io API)
    function getLocationByIP() {
        fetch('https://ipinfo.io?token=f2cdca6a56e2d5') // Use your own IPInfo token or any IP-based geolocation service
            .then(response => response.json())
            .then(data => {
                console.log('IP Geolocation Response:', data); // Log IP geolocation data
                const location = data.city || data.region || data.country || "Unknown location";
                document.getElementById('destination').value = location; // Show location in the input field
                const [lat, lng] = data.loc.split(','); // Data format: 'latitude,longitude'
                addUserLocation(lat, lng); // Center map on IP location
            })
            .catch((error) => {
                console.error('Error fetching IP-based location:', error);
                document.getElementById('destination').value = "Unable to determine location";
            });
    }

    // Geocode location name to coordinates and move the map there
    function geocodeLocation(locationName) {
        const apiKey = 'b175a585167e4d7894de3532f333810b'; // Replace with your OpenCage API key
        const url = `https://api.opencagedata.com/geocode/v1/json?q=${encodeURIComponent(locationName)}&key=${apiKey}`;

        fetch(url)
            .then((response) => response.json())
            .then((data) => {
                if (data.results && data.results.length > 0) {
                    const { lat, lng } = data.results[0].geometry;
                    map.setView([lat, lng], 15); // Center map on the location
                    L.marker([lat, lng]).addTo(map).bindPopup(`Location: ${locationName}`).openPopup();
                } else {
                    alert('Location not found. Please try again.');
                }
            })
            .catch((error) => {
                console.error('Geocoding error:', error);
                alert('Unable to find location. Please try again.');
            });
    }

    // Set up the input for typing locations
    document.getElementById('destination').addEventListener('keypress', function (e) {
        if (e.key === 'Enter') {
            e.preventDefault(); // Prevent form submission
            const locationName = this.value;
            geocodeLocation(locationName);
        }
    });

    // Initialize map and fetch user's location on page load
    initializeMap();
    fetchCurrentLocation();
});


*/