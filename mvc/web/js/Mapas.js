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
var remoMarks = [];
function clearRemo() {
    for (var i = 0; i < remoMarks.length; i++) {
        remoMarks[i].setMap(null);
    }
    remoMarks = [];

}
var prevMarker = undefined;

function setRemiserias(RemoJson) {
    clearRemo();

    var selected = marcadores[0];
    //el ajax debería estar aca
    var infoWindow;
    for (var i = 0; i < RemoJson.length; i++) {
        if (RemoJson[i].DireccionCoordenada == null) continue;
        //RemoJson[i].Tarifa = {
        //    PrecioKM: 5
        //};
        var remo = new google.maps.Marker({
            position: getCoord(RemoJson[i].DireccionCoordenada),
            map: map,
            title: RemoJson[i].Nombre,//otra info
            animation: google.maps.Animation.DROP
        });
        remo.Agencia = RemoJson[i];

        remo.addListener('click', function (event) { // hace cualquier cosa
            //infoWindow.setPosition(event.latLng)
            if (infoWindow)
                infoWindow.close();
            if (prevMarker != undefined && prevMarker != this) {
                prevMarker.setAnimation(null);
                prevMarker.setIcon('http://maps.google.com/mapfiles/marker.png');
            } else if (prevMarker == this) {
                $('#btn-solcitar-remis')[0].disabled = true;
                $('#importeTotal').val('');

                prevMarker = undefined;
                this.setAnimation(null);
                this.setIcon('http://maps.google.com/mapfiles/marker.png');
                return;
            }
            this.setAnimation(google.maps.Animation.BOUNCE);
            this.setIcon('http://maps.google.com/mapfiles/marker_orange.png');
            var importe = Number(this.Agencia.Tarifa.PrecioKM) * (distance.value / 1000);
            $('#idAgencia').val(this.Agencia.AgenciaID);
            $('#idTarifa').val(this.Agencia.Tarifa.TarifaID);
            $('#btn-solcitar-remis')[0].disabled = false;
            $('#importeTotal').val('$' + importe.toFixed(2).toString());
            infoWindow = new google.maps.InfoWindow({
                content: "<div class='colorBlack'><h3>" + this.Agencia.Nombre + "</h3><p>" + this.Agencia.infoAgencia + "</p> </div>"
            });

            infoWindow.open(map, this)//ow
            prevMarker = this;
        });
        remo.setIcon('http://maps.google.com/mapfiles/marker.png');
        //remo.setMap(map);
        remoMarks.push(remo);

    }
}
var distance;
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

    if (isindex) { // puto el que lo lee
        directionsService = new google.maps.DirectionsService();
        directionsDisplay = new google.maps.DirectionsRenderer({ 'draggable': true })
        service = new google.maps.DistanceMatrixService();

        directionsDisplay.addListener('directions_changed', function () {
            remoButton = $('#btn-ver-remiserias')[0];
            remoButton.disabled = false;
            var data = directionsDisplay.getDirections().routes[0].legs[0];
            var distanceElement = $('#distancia');
            distance = data.distance;
            distanceElement[0].innerText = 'Distancia : ' + data.distance.text;
            distanceElement.show();
            $('#FieldDistance').val((data.distance.value / 1000).toString());
            if (prevMarker) { // significa que hay una remiseria elejida, tenemos que recalcular toda la gilada

                var importe = prevMarker.Agencia.Tarifa.PrecioKM * (distance.value / 1000);
                $('#importeTotal').val('$' + importe.toFixed(2).toString());

            }
            setPanelData(data);

        });

        directionsDisplay.setMap(map);
        google.maps.event.addListener(map, "rightclick", function (e) {

            //latitud y longitud estan disponibles en el evento
            if (marcadores.length == 2) {
                window.alert("Ya tenes elegidos dos ubicaciones, arrastra los iconitos para cambiar la direccion. El segundo click anda medio mal.")
                return;
            }
            var latLng = e.latLng;

            var markerOptions = { position: latLng }
            var marker = new google.maps.Marker(markerOptions);

            marcadores.push(marker); // coloco la ubicacion del click en el array, despues decido que hacer si
            var distance;
            if (marcadores.length >= 2) {
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
                        var utilData = response.routes[0].legs[0];
                        setPanelData(utilData);
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
                var geocoder = new google.maps.Geocoder();
                geocodeLatLng(geocoder, map, latLng);
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
    function setPanelData(data) { // esta funcion tenia mil cosas y las fui acomodando en otras funciones, quedo re pete con dos lineas.
        $('#destinocoordenada').val("Lat:" + data.end_location.lat().toString() + ",Lng:" + data.end_location.lng().toString());
        $('#destinoTexto').val(data.end_address);
        $('#origencoordenada').val("Lat:" + data.start_location.lat().toString() + ",Lng:" + data.start_location.lng().toString());
        $('#origenTexto').val(data.start_address);

    }



    function geocodeLatLng(geocoder, map, latLng) {// <--infowindow-->) {
        var latlng = latLng;
        if (isindex) {
            $('#origencoordenada').val("Lat:" + latLng.lat().toString() + ",Lng:" + latLng.lng().toString());


            geocoder.geocode({ 'location': latlng }, function (results, status) {
                if (status === google.maps.GeocoderStatus.OK) {
                    if (results[0]) {
                        $('#origenTexto').val(results[0].formatted_address);
                    }
                    else {
                        window.alert('No results found');
                    }
                } else {
                    window.alert('Geocoder failed due to: ' + status);

                }
            });
        }

        else {
            $('#coordenadas').val("Lat:" + latLng.lat().toString() + ",Lng:" + latLng.lng().toString());
            geocoder.geocode({ 'location': latlng }, function (results, status) {
                if (status === google.maps.GeocoderStatus.OK) {
                    if (results[0]) {
                        if ($('#direccionAgencia').length >= 1) $('#direccionAgencia').val(results[0].formatted_address);
                        else $('#psformulariousuariomodel-direccion').val(results[0].formatted_address);
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
    }

};
function doTheAjax() {
    var id = "agencia seleccionada"; // le pega al controlador piola con la data bien, tengo que armar bien esto con el otro codigo de agencia.
    $('#LoadingBlocker').show();
    $.get({
        url: 'index.php?r=rest%2Fsearch',
        dataType: "json",
        data: {
            data: id
        },
        success: function (data) {
            $('#LoadingBlocker').hide();

            var info = JSON.parse(data);
            setRemiserias(info);
        }
    });
}

function getCoord(stringCoord) {

    var array = stringCoord.split(",");
    var initIndex = array[0].indexOf("-") >= 0 ? array[0].indexOf("-") : array[0].indexOf(" ");
    var lat = Number(array[0].substring(initIndex, array[0].length));
    initIndex = array[1].indexOf("-") >= 0 ? array[1].indexOf("-") : array[1].indexOf(" ");
    var lng = Number(array[1].substring(initIndex, array[1].length));
    return { lat: lat, lng: lng };
}

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
function setCenter(StringCoord) {
    var latLng = getCoord(StringCoord);
    console.log(latLng);
    map.setCenter(latLng);
}

function doThePush(socketInfo) {

    if (socketInfo == "") return;
    var splitedData = socketInfo.split(";");
    if (splitedData.length != 2 || splitedData[0]=="") return;
    var pusher = new Pusher('e8fe2051103b337d6497');

    var channel = pusher.subscribe(splitedData[0].toString());


    channel.bind(splitedData[1], function (notification) {
        $.notify.addStyle('remisYA', {
            html: "<div><span data-notify-text/></div>",
            classes: {
                base: {
                    "font-weight": " bold",
                    "white-space": "wrap",
                    "background-color": "#DFF0D8",
                    "color": "#468847",
                    "padding": "10px 12px 10px 12px",
                    "height": "100px",
                    "width": "200px",
                    "padding-left": "25px",
                    "margin": "10px 0 0 10px",
                    "border-radius": "10px",
                    "background-position": "3px 10px",
                    "background-repeat": "no-repeat",
                    "background-image": "url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAUCAYAAACNiR0NAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAutJREFUeNq0lctPE0Ecx38zu/RFS1EryqtgJFA08YCiMZIAQQ4eRG8eDGdPJiYeTIwHTfwPiAcvXIwXLwoXPaDxkWgQ6islKlJLSQWLUraPLTv7Gme32zoF9KSTfLO7v53vZ3d/M7/fIth+IO6INt2jjoA7bjHCJoAlzCRw59YwHYjBnfMPqAKWQYKjGkfCJqAF0xwZjipQtA3MxeSG87VhOOYegVrUCy7UZM9S6TLIdAamySTclZdYhFhRHloGYg7mgZv1Zzztvgud7V1tbQ2twYA34LJmF4p5dXF1KTufnE+SxeJtuCZNsLDCQU0+RyKTF27Unw101l8e6hns3u0PBalORVVVkcaEKBJDgV3+cGM4tKKmI+ohlIGnygKX00rSBfszz/n2uXv81wd6+rt1orsZCHRdr1Imk2F2Kob3hutSxW8thsd8AXNaln9D7CTfA6O+0UgkMuwVvEFFUbbAcrkcTA8+AtOk8E6KiQiDmMFSDqZItAzEVQviRkdDdaFgPp8HSZKAEAL5Qh7Sq2lIJBJwv2scUqkUnKoZgNhcDKhKg5aH+1IkcouCAdFGAQsuWZYhOjwFHQ96oagWgRoUov1T9kRBEODAwxM2QtEUl+Wp+Ln9VRo6BcMw4ErHRYjH4/B26AlQoQQTRdHWwcd9AH57+UAXddvDD37DmrBBV34WfqiXPl61g+vr6xA9zsGeM9gOdsNXkgpEtTwVvwOklXLKm6+/p5ezwk4B+j6droBs2CsGa/gNs6RIxazl4Tc25mpTgw/apPR1LYlNRFAzgsOxkyXYLIM1V8NMwyAkJSctD1eGVKiq5wWjSPdjmeTkiKvVW4f2YPHWl3GAVq6ymcyCTgovM3FzyRiDe2TaKcEKsLpJvNHjZgPNqEtyi6mZIm4SRFyLMUsONSSdkPeFtY1n0mczoY3BHTLhwPRy9/lzcziCw9ACI+yql0VLzcGAZbYSM5CCSZg1/9oc/nn7+i8N9p/8An4JMADxhH+xHfuiKwAAAABJRU5ErkJggg==)"
                }
            }
        });
        console.log(notification.message);
        $.notify("Se confirmo tu remis, estara llegando en unos minutos", { style: "remisYA", autoHide: false });

    });
}