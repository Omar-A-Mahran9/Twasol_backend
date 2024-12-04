var mapLat = parseFloat($("[name='lat']").val()) || 24.670901225994893;
var mapLng = parseFloat($("[name='lng']").val()) || 46.69853286769418;
var marker;
var googleMap;
var currentPosition;
var geocoder;
let mapProp;



function myMap() {
    geocoder = new google.maps.Geocoder();
    mapProp = { center: { lat: mapLat, lng: mapLng }, zoom: 15};
    googleMap = new google.maps.Map(document.getElementById("googleMap"), mapProp);

    marker = new google.maps.Marker({
        position: mapProp.center,
        animation: google.maps.Animation.BOUNCE
    });
    marker.setMap(googleMap);

    mapOnClick();
    addMapSearch();
}

function getCurrentPos()
{
    if (navigator.geolocation) {

    navigator.geolocation.getCurrentPosition(function(position) {
        mapLat = position.coords.latitude;
        mapLng = position.coords.longitude;

        marker.setPosition({ lat: mapLat, lng: mapLng});
        googleMap.setCenter(marker.getPosition());
        geocoder.geocode( {'location': marker.getPosition()}, function(results, status) {
            if (status == 'OK') {
                writeMarkedAddress();
            } else {
                console.log('Geocode was not successful for the following reason: ' + status);
            }
        });

    });
    }
}

function mapOnClick() {

    googleMap.addListener("click", (mapsMouseEvent) => {
        let clickedAddress = mapsMouseEvent.latLng.toJSON();
        marker.setPosition(clickedAddress);
        writeMarkedAddress();
    });
}

function writeMarkedAddress() {

    geocoder.geocode( {'location': marker.getPosition()}, function(results, status) {

        if (status === 'OK') {
            $("[name='lat']").val(marker.getPosition().lat());
            $("[name='lng']").val(marker.getPosition().lng());
            $("[name='clinic_address'],#location_inp").val(results[0].formatted_address);
        } else {
            console.log('Geocode was not successful for the following reason: ' + status);
        }
    });
}


function addMapSearch() {
// Create the search box and link it to the UI element.
const input = document.getElementById("pac-input");
const searchBox = new google.maps.places.SearchBox(input);

googleMap.controls[google.maps.ControlPosition.TOP_CENTER].push(input);
// Bias the SearchBox results towards current googleMap's viewport.
googleMap.addListener("bounds_changed", () => {
    searchBox.setBounds(googleMap.getBounds());
});

let markers = [];

// Listen for the event fired when the user selects a prediction and retrieve
// more details for that place.
searchBox.addListener("places_changed", () => {
    const places = searchBox.getPlaces();
console.log("CHANGED");
    if (places.length == 0) {
        return;
    }

    // Clear out the old markers.
    markers.forEach((marker) => {
        marker.setMap(null);
    });
    markers = [];

    // For each place, get the icon, name and location.
    const bounds = new google.maps.LatLngBounds();



    places.forEach((place) => {
        if (!place.geometry || !place.geometry.location) {
        console.log("Returned place contains no geometry");
        return;
        }

        const icon = {
        url: place.icon,
        size: new google.maps.Size(71, 71),
        origin: new google.maps.Point(0, 0),
        anchor: new google.maps.Point(17, 34),
        scaledSize: new google.maps.Size(25, 25),
        };

        // Create a marker for each place.
        markers.push(
        new google.maps.Marker({
            googleMap,
            icon,
            title: place.name,
            position: place.geometry.location,
        })
        );
        if (place.geometry.viewport) {
        // Only geocodes have viewport.
        bounds.union(place.geometry.viewport);
        } else {
        bounds.extend(place.geometry.location);
        }
    });
    googleMap.fitBounds(bounds);
});
}

