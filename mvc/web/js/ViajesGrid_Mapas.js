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

function getRemiserias(Ubicacion) {
    var selected = marcadores[0];
    remos = [{ lat: -34.772015, lng: -58.264468 }, { lat: -34.773216, lng: -58.270884 }, { lat: -34.776670, lng: -58.274574 }];
    for (var i = 0; i < remos.length; i++) {
        var remiseria = remos[i];
        var remo = new google.maps.Marker({
            position: remiseria,
            map: map,
            title: 'otro string!' //otra info
        });
        infoWindow = new google.maps.InfoWindow({
            content: "<h3>Ubicacion Centrar</h3><p>Debería ir alguna data.</p>" // Deberiamos llenar esto con data que viene de la base sobre la remiseria
        });
        remo.addListener('click', function (event) { // hace cualquier cosa 
            //infoWindow.setPosition(event.latLng)
            infoWindow.open(map, this)//ow
        });
        remo.setMap(map);

    }
}

function initMap(isindex) {

    var jsonDeLaBase = {
        ubicacionDefault: { lat: -34.7741908, lng: -58.2670426 },
        Remiserias: [{ lat: -34.772015, lng: -58.264468 }, { lat: -34.773216, lng: -58.270884 }, { lat: -34.776670, lng: -58.274574 }]

    }
    if (map.mapTypeId != undefined && !isindex) return;
    map = new google.maps.Map(document.getElementById('map'), {
        zoom: 14,
        streetViewControl: false, // Todo en false para que no pueda
        overviewMapControl: false, // user el street view y esas cosas
        rotateControl: false,  // solo un mapa sencillo
        mapTypeControl: false,
        panControl: false,
    });
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function (position) {
            var geolocate = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
            var marker = new google.maps.Marker(geolocate);
            marker.setMap(map);
            map.setCenter(geolocate);

        })
    }
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


    // if (navigator.geolocation) { navigator para obenter la geolocalizacion por html5 y no por la api
    //      var currentLocation=navigator.geolocation.getCurrentPosition(function (position){

    //      });
    //   } else {
    //     alert("La geoUbicacion no esta habilitada en este navegador.");
    //   }

    markers = [];
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
    marcadores = [];

    if (isindex) {

        directionsService = new google.maps.DirectionsService();
        directionsDisplay = new google.maps.DirectionsRenderer({ 'draggable': true })
        service = new google.maps.DistanceMatrixService();

        directionsDisplay.addListener('directions_changed', function () {
            var distanciaInt = Math.round((directionsDisplay.getDirections().routes[0].legs[0].distance.value) / 1000);
            distanceElement = $('#viajesgridmodel-distancia').val(distanciaInt);

        });
        directionsDisplay.setMap(map);
        google.maps.event.addListener(map, "rightclick", function (e) {

            //latitud y longitud estan disponibles en el evento
            var latLng = e.latLng;

            var markerOptions = { position: latLng }
            var marker = new google.maps.Marker(markerOptions);

            marcadores.push(marker); // coloco la ubicacion del click en el array, despues decido que hacer si
            var distance;
            if (marcadores.length >= 2) {
                var geocoder = new google.maps.Geocoder();
                geocodeLatLng(geocoder, map, marcadores[0].position, '#viajesgridmodel-origen', '#origencoordenada');
                geocodeLatLng(geocoder, map, marcadores[1].position, '#viajesgridmodel-destino', '#destinocoordenada');

                if (marcadores.length > 2)
                    marcadores = marcadores.splice(1, 2);

                marcadores[0].setMap(null); // borra el marcador, poniendo visible=false tambien funciona, // TODO: encontrar manera de borrarlo de memoria
                //la siguiente linea es inutil, encontre otras maneras mas piolas de caalcular distancia por otros servicios
                // distance = google.maps.geometry.spherical.computeDistanceBetween(marcadores[0].position, marcadores[1].position).toFixed(2);
                var request = {
                    origin: marcadores[0].position,
                    destination: marcadores[1].position,
                    travelMode: google.maps.TravelMode.DRIVING
                };

                directionsService.route(request, function (response, status) {
                    if (status == google.maps.DirectionsStatus.OK) {
                        directionsDisplay.setDirections(response); // por defecto setea A y B
                        //document.getElementById('distance').innerHTML = response.rows[0].elements[0].distance.text + ' km';
                    } else {
                        alert("Algo anda mal y no andubo ):");
                    }
                });

                //dejo el codigo por las dudas 
                //service.getDistanceMatrix({ // quiza no sea necesario esto !
                //    origins: [marcadores[0].position],
                //    destinations: [marcadores[1].position],
                //    travelMode: google.maps.TravelMode.DRIVING,
                //    unitSystem: google.maps.UnitSystem.METRIC,
                //    avoidHighways: false,
                //    avoidTolls: false
                //}, function (response, status) {
                //    if (status == google.maps.DistanceMatrixStatus.OK && response.rows[0].elements[0].status != "ZERO_RESULTS") {
                //        var distance = response.rows[0].elements[0].distance.text;
                //        var duration = response.rows[0].elements[0].duration.text;

                //    } else {
                //        alert("Algo anda mal y no andubo ):");
                //    }
                //});
            } else {
                marker.setMap(map);
            }
        });

    } else {
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
    }

    function geocodeLatLng(geocoder, map, latLng, direccion, direccionCoordenada) {// <--infowindow-->) {
        var latlng = latLng;
        $(direccionCoordenada).val("Lat:" + latLng.lat().toString() + ",Lng:" + latLng.lng().toString());
        geocoder.geocode({ 'location': latlng }, function (results, status) {
            if (status === google.maps.GeocoderStatus.OK) {
                if (results[0]) {

                    $(direccion).val(results[0].formatted_address);
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

function calculateDistanceAndStuff(latLng) {
    service.getDistanceMatrix({
        origins: [marcadores[0].position],
        destinations: [marcadores[1].position],
        travelMode: google.maps.TravelMode.DRIVING,
        unitSystem: google.maps.UnitSystem.METRIC,
        avoidHighways: false,
        avoidTolls: false
    }, function (response, status) {
        if (status == google.maps.DistanceMatrixStatus.OK && response.rows[0].elements[0].status != "ZERO_RESULTS") {
            distance = response.rows[0].elements[0].distance.text;

        } else {
            alert("Algo anda mal y no andubo ):");
        }
    });
}