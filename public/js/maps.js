function initMap() {
    var map = new google.maps.Map(document.getElementById('map'), {
        center: { lat: 42.69770050048828, lng: 23.32180404663086 },
        zoom: 14
    });

    var geocoder = new google.maps.Geocoder();

    var location = { lat: 42.69770050048828, lng: 23.32180404663086 };

    geocoder.geocode({ 'location': location }, function(results, status) {
        if (status === 'OK') {
            if (results[0]) {
                var address = results[0].formatted_address;
                document.getElementById('address').textContent = address;
            } else {
                document.getElementById('address').textContent = 'No results found';
            }
        } else {
            document.getElementById('address').textContent = 'Geocoder failed due to: ' + status;
        }
    });
    initMap();
}
