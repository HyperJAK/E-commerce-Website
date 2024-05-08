
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Google Map</title>
  <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
  <script>
    let map;
    let geocoder;
    let infowindow;
    let marker;

    function initMap() {
  map = new google.maps.Map(document.getElementById("map"), {
    zoom: 16,
    center: { lat: 33.83750, lng: 35.53639 },
    disableDefaultUI: true,
  });
  geocoder = new google.maps.Geocoder();
  infowindow = new google.maps.InfoWindow();

  map.addListener("click", (event) => {
    placeMarker(event.latLng);
  });

  const input = document.getElementById("address");
  const searchBox = new google.maps.places.SearchBox(input);
  map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

  map.addListener("bounds_changed", () => {
    searchBox.setBounds(map.getBounds());
  });
}

    function placeMarker(location) {
  if (marker) {
    marker.setMap(null);
  }

  marker = new google.maps.Marker({
    position: location,
    map: map,
    draggable: true,
  });

  google.maps.event.addListener(marker, 'dragend', function() {
        document.getElementById("latitude").value = marker.getPosition().lat();
        document.getElementById("longitude").value = marker.getPosition().lng();
        geocodeLatLng(geocoder, map, marker.getPosition(), infowindow);
    });

    document.getElementById("latitude").value = location.lat();
    document.getElementById("longitude").value = location.lng();
    geocodeLatLng(geocoder, map, location, infowindow);
}

    function geocodeAddress() {
      const address = document.getElementById("address").value;
      geocoder.geocode({ address: address }, (results, status) => {
        if (status === "OK") {
          map.setCenter(results[0].geometry.location);
          placeMarker(results[0].geometry.location);
        } else {
          alert("Geocode was not successful for the following reason: " + status);
        }
      });
    }

    function geocodeLatLng(geocoder, map, location, infowindow) {
      geocoder
        .geocode({ location: location })
        .then((response) => {
          if (response.results[0]) {
            map.setZoom(11);

            infowindow.setContent(response.results[0].formatted_address);
            infowindow.setPosition(location);
            infowindow.open(map);
          } else {
            window.alert("No results found");
          }
        })
        .catch((e) => window.alert("Geocoder failed due to: " + e));
    }

    window.initMap = initMap;
  </script>
  <style>
    #map {
      height: 100%;
      width: 100%;
    }

    html, body {
      height: 100%;
      margin: 0;
      padding: 0;
    }

    #floating-panel {
  display: flex;
  flex-direction: column;
        flex-wrap: nowrap;
  align-items: center;
  position: absolute;
  top: 5px;
  left: 50%;
  transform: translateX(-50%);
  width: 350px;
  z-index: 5;
  background-color: #fff;
  padding: 5px;
  border: 1px solid #999;
}

#floating-panel input,
#floating-panel button {
  margin-bottom: 5px;
}
  </style>
</head>
<body>
<div id="floating-panel">
    <label for="address">Search an address</label>
    <input id="address" type="text" placeholder="Enter address">
    <button onclick="geocodeAddress()">Search</button>
    <form action="{{ route('savemyLocation') }}" method="POST">
    @csrf
    <input type="hidden" name="latitude" id="latitude">
    <input type="hidden" name="longitude" id="longitude">
    <button type="submit">Save Location</button>
        <a type="button" href="{{route('createOrderView')}}" class="btn bg-info text-white">Go back</a>
</form>
  </div>

  <div id="map">

</div>
   <!-- <p>Latitude: <span id="latitude"></span>, Longitude: <span id="longitude"></span></p> -->
 <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDizYBmc_zcbULStgC3Z4UJHf_Pw-k8-dA&libraries=places&callback=initMap" async defer></script>
</body>


</html>
