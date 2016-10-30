// $('#search').click( function() {
// 		    // Obtenemos la dirección y la asignamos a una variable
// 		    var address = $('#address').val();
// 		    // Creamos el Objeto Geocoder
// 		    var geocoder = new google.maps.Geocoder();
// 		    // Hacemos la petición indicando la dirección e invocamos la función
// 		    // geocodeResult enviando todo el resultado obtenido
// 		    geocoder.geocode({ 'address': address}, geocodeResult);
// 		});

function geocodeResult(results, status) {
    // Verificamos el estatus
    if (status == 'OK') {
        // Si hay resultados encontrados, centramos y repintamos el mapa
        // esto para eliminar cualquier pin antes puesto
        var mapOptions = {
            center: results[0].geometry.location,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            zoom: 14,
            streetViewControl: false, // Todo en false para que no pueda
            overviewMapControl: false, // user el street view y esas cosas
            rotateControl: false,  // solo un mapa sencillo
            mapTypeControl: false,
            panControl: false,
        };
        map = new google.maps.Map($("#map").get(0), mapOptions);
        // fitBounds acercará el mapa con el zoom adecuado de acuerdo a lo buscado
        map.fitBounds(results[0].geometry.viewport);
        // Dibujamos un marcador con la ubicación del primer resultado obtenido
        // var markerOptions = { position: results[0].geometry.location }
        // var marker = new google.maps.Marker(markerOptions);
        // marker.setMap(map);
    } else {
        // En caso de no haber resultados o que haya ocurrido un error
        // lanzamos un mensaje con el error
        alert("Geocoding no tuvo éxito debido a: " + status);
    }
};

function initMap() {

    var jsonDeLaBase = {
        ubicacionDefault: { lat: -34.7741908, lng: -58.2670426 },
        Remiserias: [{ lat: -34.772015, lng: -58.264468 }, { lat: -34.773216, lng: -58.270884 }, { lat: -34.776670, lng: -58.274574 }]

    }
    if (map.mapTypeId != undefined) return;

    map = new google.maps.Map(document.getElementById('map'), {
        center: jsonDeLaBase.ubicacionDefault,
        zoom: 14,
        streetViewControl: false, // Todo en false para que no pueda
        overviewMapControl: false, // user el street view y esas cosas
        rotateControl: false,  // solo un mapa sencillo
        mapTypeControl: false,
        panControl: false,
    });
    // Create the search box and link it to the UI element.
    var input = document.getElementById('pac-input');
    var searchBox = new google.maps.places.SearchBox(input);
    map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
    $('#pac-input').css('display', 'block'); // problema ! se ve el textbox antes de que se muestre el mapa


    map.addListener('bounds_changed', function () {
        searchBox.setBounds(map.getBounds());
    });

    // for (var i = 0; i < jsonDeLaBase.Remiserias.length; i++) {
    //  var remiseria= jsonDeLaBase.Remiserias[i];
    //  var remo = new google.maps.Marker({
    //      position: remiseria,
    //      map: map,
    //      title: 'otro string!'
    //    });
    //  var infoWindow = new google.maps.InfoWindow({map: map,
    //    content:"<h3>Ubicacion Centrar</h3><p>Debería ir alguna data.</p>" // Deberiamos llenar esto con data que viene de la base sobre la remiseria
    //  });
    //  remo.addListener(remo, 'click', function() { // hace cualquier cosa 
    //        infoWindow.open(map,remo); //ow
    //      });

    // }


    // if (navigator.geolocation) {
    //      var currentLocation=navigator.geolocation.getCurrentPosition(function (position){

    //      });
    //   } else {
    //     alert("La geoUbicacion no esta habilitada en este navegador.");
    //   }

    var markers = [];
    searchBox.addListener('places_changed', function () {
        var places = searchBox.getPlaces();

        if (places.length == 0) {
            return;
        }

        // para cada lugar ,obtener la ubicacion,icono y demas. Codigo util para setear ubicaciones de 
        //varias remiserias
        var bounds = new google.maps.LatLngBounds();
        places.forEach(function (place) {
            //   var icon = {
            //     url: place.icon,
            //     size: new google.maps.Size(71, 71),
            //     origin: new google.maps.Point(0, 0),
            //     anchor: new google.maps.Point(17, 34),
            //     scaledSize: new google.maps.Size(25, 25)
            //   };

            //   // crear una marca para cada lugar encontrado
            //   markers.push(new google.maps.Marker({
            //     map: map,
            //     icon: icon,
            //     title: place.name,
            //     position: place.geometry.location
            //   }));

            if (place.geometry.viewport) {
                // agregar viewport
                bounds.union(place.geometry.viewport);
            } else {
                bounds.extend(place.geometry.location);
            }
        });
        map.fitBounds(bounds);
    });
    var marcadores = [];
    google.maps.event.addListener(map, "rightclick", function (e) {

        //latitud y longitud estan disponibles en el evento
        var latLng = e.latLng;
        marcadores.forEach(function (marker) {
            marker.setMap(null);
        });
        var searchBox = $('#pac-input');
        var markerOptions = { position: latLng }
        var marker = new google.maps.Marker(markerOptions);
        marker.setMap(map);
        marcadores.push(marker);

        map.setCenter(latLng);
        var geocoder = new google.maps.Geocoder();
        geocodeLatLng(geocoder, map, latLng);
        //$('#address').val();


    });
    function geocodeLatLng(geocoder, map, latLng) {// <--infowindow-->) {
        var latlng = latLng;
        $('#coordenadas').val("Lat:" + latLng.lat().toString() + ",Lng:" + latLng.lng().toString());
        geocoder.geocode({ 'location': latlng }, function (results, status) {
            if (status === google.maps.GeocoderStatus.OK) {
                if (results[0]) {

                    $('#psformulariousuariomodel-direccion').val(results[0].formatted_address);
                    $('#pac-input').val(results[1].formatted_address);
                    //map.setZoom(11);
                    //var marker = new google.maps.Marker({
                    //  position: latlng,
                    //  map: map
                    //});
                    // infowindow.setContent(results[1].formatted_address);
                    // infowindow.open(map, marker);
                } else {
                    window.alert('No results found');
                }
            } else {
                window.alert('Geocoder failed due to: ' + status);
            }
        });
    }

};