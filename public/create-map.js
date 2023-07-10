function initMap() {
  console.log('here................................')
  var oldLat = $('#pac-lat').val();
  var oldLng = $('#pac-lng').val();
  var oldPlaceId = $('#pac-place-id').val();
  latValue = 24.7194646;
  lngValue = 46.6865207;
  if (oldLat) {
    latValue = Number(oldLat);
  }
  if (oldLng) {
    lngValue = Number(oldLng);
  }
  // console.log(typeof latValue,latValue, typeof lngValue,lngValue);
  const map = new google.maps.Map(document.getElementById("map"), {
    center: { lat:  latValue, lng: lngValue },
    zoom: 17,
    mapTypeControl: false,
  });
  console.log(map);
  const card = document.getElementById("pac-card");
  const input = document.getElementById("pac-input");
  const biasInputElement = document.getElementById("use-location-bias");
  const strictBoundsInputElement = document.getElementById("use-strict-bounds");
  const options = {
    fields: ["formatted_address", "geometry", "name", "place_id"],
    strictBounds: false,
    types: ["establishment"],
  };

  map.controls[google.maps.ControlPosition.TOP_LEFT].push(card);

  const autocomplete = new google.maps.places.Autocomplete(input, options);

  // Bind the map's bounds (viewport) property to the autocomplete object,
  // so that the autocomplete requests use the current map bounds for the
  // bounds option in the request.
  autocomplete.bindTo("bounds", map);

  const infowindow = new google.maps.InfoWindow();
  const infowindowContent = document.getElementById("infowindow-content");

  infowindow.setContent(infowindowContent);

  const marker = new google.maps.Marker({
    // position: {lat:24.7194646 , lng:46.6865207},
    map,
    anchorPoint: new google.maps.Point(0, -29),
    draggable: true,
    animation: google.maps.Animation.DROP
  });

  (function (marker, data) {
    google.maps.event.addListener(marker, "click", function (e) {

        infoWindow.setContent(data.description);
        infoWindow.open(map, marker);
    });

    var geocoder = geocoder = new google.maps.Geocoder();
    google.maps.event.addListener(marker, "dragend", function (e) {
        var lat, lng, address;
        geocoder.geocode({ 'latLng': marker.getPosition() }, function (results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                lat = marker.getPosition().lat();
                lng = marker.getPosition().lng();
                address = results[0].formatted_address;
                $('#pac-lat').val(lat);
                $('#pac-lng').val(lng);
                $('#pac-place-id').val(results[0].place_id);
                $('#pac-input').val(results[0].formatted_address);
            }
        });
    });
})(marker, data);


  map.setZoom(17);
  marker.setPosition(new google.maps.LatLng(latValue, lngValue));
  marker.setVisible(true);


  autocomplete.addListener("place_changed", () => {
    infowindow.close();
    marker.setVisible(false);

    const place = autocomplete.getPlace();
      console.log(place.name,place.place_id);
    if (!place.geometry || !place.geometry.location) {
      // User entered the name of a Place that was not suggested and
      // pressed the Enter key, or the Place Details request failed.
      window.alert("No details available for input: '" + place.name + "'");
      return;
    }

    // If the place has a geometry, then present it on a map.
    if (place.geometry.viewport) {
      map.fitBounds(place.geometry.viewport);

    } else {
      map.setCenter(place.geometry.location);
      map.setZoom(17);
    }

    $('#pac-lat').val(place.geometry['location'].lat());
    $('#pac-lng').val(place.geometry['location'].lng());
    $('#pac-place-id').val(place.place_id);
  //   console.log(place.place_id);
    marker.setPosition(place.geometry.location);
    marker.setVisible(true);
    infowindowContent.children["place-name"].textContent = place.name;
    infowindowContent.children["place-address"].textContent =
      place.formatted_address;
    infowindow.open(map, marker);
  });

  // Sets a listener on a radio button to change the filter type on Places
  // Autocomplete.
  function setupClickListener(id, types) {
    const radioButton = document.getElementById(id);

    radioButton.addEventListener("click", () => {
      autocomplete.setTypes(types);
      input.value = "";
    });
  }

  biasInputElement.addEventListener("change", () => {
    if (biasInputElement.checked) {
      autocomplete.bindTo("bounds", map);
    } else {
      // User wants to turn off location bias, so three things need to happen:
      // 1. Unbind from map
      // 2. Reset the bounds to whole world
      // 3. Uncheck the strict bounds checkbox UI (which also disables strict bounds)
      autocomplete.unbind("bounds");
      autocomplete.setBounds({ east: 180, west: -180, north: 90, south: -90 });
      strictBoundsInputElement.checked = biasInputElement.checked;
    }

    input.value = "";
  });
  strictBoundsInputElement.addEventListener("change", () => {
    autocomplete.setOptions({
      strictBounds: strictBoundsInputElement.checked,
    });
    if (strictBoundsInputElement.checked) {
      biasInputElement.checked = strictBoundsInputElement.checked;
      autocomplete.bindTo("bounds", map);
    }

    input.value = "";
  });

      // Add a click listener for each marker, and set up the info window.
    marker.addListener("click", ({ domEvent, latLng }) => {
      const { target } = domEvent;

      infoWindow.close();
      infoWindow.setContent(marker.title);
      infoWindow.open(marker.map, marker);
    });
}

window.initMap = initMap;