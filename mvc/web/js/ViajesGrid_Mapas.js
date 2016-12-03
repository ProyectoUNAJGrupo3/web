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
	if (status == 'OK')
	{
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
	} else
	{
		// En caso de no haber resultados o que haya ocurrido un error
		// lanzamos un mensaje con el error
		alert("Geocoding no tuvo éxito debido a: " + status);
	}
};
var remoMarks = [];
function clearRemo() {
	for (var i = 0; i < remoMarks.length; i++)
	{
		remoMarks[i].setMap(null);
	}
	remoMarks = [];

}
var prevMarker = undefined;
function getRemiserias(Ubicacion) {
	clearRemo()

	var selected = marcadores[0];
	remos = [{
		AgenciaID: 45,
		Nombre: 'Remis Quilmes',
		Telefono: 42545443,
		DireccionCoordenada: { lat: -34.7744885, lng: -58.2536508 },
		infoAgencia: ' Borrachos vamos mas rapido',
		Tarifa: {
			ID: 7,
			PrecioKM: 15,

		}

	},
        {
        	AgenciaID: 54,
        	Nombre: 'Remis Estrella',
        	Telefono: 434343400,
        	DireccionCoordenada: { lat: -34.78031000000001, lng: -58.270884 },
        	infoAgencia: ' A la velocidad de la luuuuuuz',
        	Tarifa: {
        		ID: 5,
        		PrecioKM: 13,

        	}

        },
        {
        	AgenciaID: 63,
        	Nombre: "Remis Colombia",
        	Telefono: 42102222,
        	DireccionCoordenada: { lat: -34.776670, lng: -58.289105800000016 },
        	infoAgencia: " Te llevamos a tu casa y te vendemos frula",
        	Tarifa: {
        		ID: 9,
        		PrecioKM: 8,
        	}
        }];
	var infoWindow;
	for (var i = 0; i < remos.length; i++)
	{

		var remo = new google.maps.Marker({
			position: remos[i].DireccionCoordenada,
			map: map,
			title: remos[i].Nombre,//otra info
			animation: google.maps.Animation.DROP
		});
		remo.Agencia = remos[i];

		remo.addListener('click', function (event) { // hace cualquier cosa
			//infoWindow.setPosition(event.latLng)
			if (infoWindow)
				infoWindow.close();
			if (prevMarker != undefined && prevMarker != this)
			{
				prevMarker.setAnimation(null);
				prevMarker.setIcon('http://maps.google.com/mapfiles/marker.png');
			} else if (prevMarker == this)
			{
				$('#btn-solcitar-remis')[0].disabled = true;
				$('#importeTotal').val('');

				prevMarker = undefined;
				this.setAnimation(null);
				this.setIcon('http://maps.google.com/mapfiles/marker.png');
				return;
			}
			this.setAnimation(google.maps.Animation.BOUNCE);
			this.setIcon('http://maps.google.com/mapfiles/marker_orange.png');
			var importe = this.Agencia.Tarifa.PrecioKM * (distance.value / 1000);
			$('#idAgencia').val(this.Agencia.AgenciaID);
			$('#idTarifa').val(this.Agencia.Tarifa.ID);
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
	if (navigator.geolocation && !isindex)
	{
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

		if (places.length == 0)
		{
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

			if (place.geometry.viewport)
			{
				// agregar viewport
				bounds.union(place.geometry.viewport);
			} else
			{
				bounds.extend(place.geometry.location);
			}
		});
		map.fitBounds(bounds);
	});
	marcadores = [];

	if (isindex)
	{ // puto el que lo lee
		directionsService = new google.maps.DirectionsService();
		directionsDisplay = new google.maps.DirectionsRenderer({ 'draggable': true })
		service = new google.maps.DistanceMatrixService();

		directionsDisplay.addListener('directions_changed', function () {
			distanceElement = $('#distancia').val((directionsDisplay.getDirections().routes[0].legs[0].distance.value / 1000).toFixed(1) + " Km");
			var data =directionsDisplay.getDirections().routes[0].legs[0];
			setPanelData(data);

		});

		directionsDisplay.setMap(map);
		google.maps.event.addListener(map, "rightclick", function (e) {

			//latitud y longitud estan disponibles en el evento
			if (marcadores.length == 2)
			{
				window.alert("Ya tenes elegidos dos ubicaciones, arrastra los iconitos para cambiar la direccion. El segundo click anda medio mal.")
				return;
			}
			var latLng = e.latLng;

			var markerOptions = { position: latLng }
			var marker = new google.maps.Marker(markerOptions);

			marcadores.push(marker); // coloco la ubicacion del click en el array, despues decido que hacer si
			var distance;
			if (marcadores.length >= 2)
			{
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
					if (status == google.maps.DirectionsStatus.OK)
					{
						var utilData = response.routes[0].legs[0];
						setPanelData(utilData);
						directionsDisplay.setDirections(response); // por defecto setea A y B
						//document.getElementById('distance').innerHTML = response.rows[0].elements[0].distance.text + ' km';
					} else
					{
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
			} else
			{
				var geocoder = new google.maps.Geocoder();
				geocodeLatLng(geocoder, map, latLng);
				marker.setMap(map);
			}
		});
	} else
	{
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
		if (isindex)
		{
			$('#origencoordenada').val("Lat:" + latLng.lat().toString() + ",Lng:" + latLng.lng().toString());


			geocoder.geocode({ 'location': latlng }, function (results, status) {
				if (status === google.maps.GeocoderStatus.OK)
				{
					if (results[0])
					{
						$('#origenTexto').val(results[0].formatted_address);
					}
					else
					{
						window.alert('No results found');
					}
				} else
				{
					window.alert('Geocoder failed due to: ' + status);

				}
			});
		}

		else
		{
			$('#coordenadas').val("Lat:" + latLng.lat().toString() + ",Lng:" + latLng.lng().toString());
			$('#altacliente_coordenada').val("Lat:" + latLng.lat().toString() + ",Lng:" + latLng.lng().toString());
			geocoder.geocode({ 'location': latlng }, function (results, status) {
				if (status === google.maps.GeocoderStatus.OK)
				{
					if (results[0])
					{

						$('#psformulariousuariomodel-direccion').val(results[0].formatted_address);
						$('#altacliente_direccion').val(results[0].formatted_address);
						$('#pac-input').val(results[1].formatted_address);
						//map.setZoom(11);
						//var marker = new google.maps.Marker({
						//  position: latlng,
						//  map: map
						//});
						// infowindow.setContent(results[1].formatted_address);
						// infowindow.open(map, marker);
					} else
					{
						window.alert('No results found');
					}
				} else
				{
					window.alert('Geocoder failed due to: ' + status);
				}
			});
		}
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
		if (status == google.maps.DistanceMatrixStatus.OK && response.rows[0].elements[0].status != "ZERO_RESULTS")
		{
			distance = response.rows[0].elements[0].distance.text;

		} else
		{
			alert("Algo anda mal y no andubo ):");
		}
	});
};

function getCoord(stringCoord) {

    var array = stringCoord.split(",");
    var initIndex = array[0].indexOf("-") >= 0 ? array[0].indexOf("-") : array[0].indexOf(" ");
    var lat = Number(array[0].substring(initIndex, array[0].length));
    initIndex = array[1].indexOf("-") >= 0 ? array[1].indexOf("-") : array[1].indexOf(" ");
    var lng = Number(array[1].substring(initIndex, array[1].length));
    return { lat: lat, lng: lng };
};
function initializeCenteredMap(StringCoord) {
	if (StringCoord != null && StringCoord != ""){
		    var latLng = getCoord(StringCoord);
		    console.log(latLng);
		    initMap(true);
			var marker = new google.maps.Marker({ position: latLng });
	        marcadores.push(marker);
		    map.setCenter(latLng);
		    marker.setMap(map);
	}
	else{
		    initMap(false);

	}

}

function hearTheEvent(canal) {
    var pusher = new Pusher('e8fe2051103b337d6497');

    var channel = pusher.subscribe(canal.toString());


    channel.bind('solicitudNueva', function (notification) {
        $.notify.addStyle('remisYA2', {
            html: "<div><span data-notify-text/></div>",
            classes: {
                base: {
                    "font-weight": " bold",
                    "white-space": "wrap",
                    "background-color": "#D9EDF7",
                    "color": "#3A87AD",
                    "padding": "10px 12px 10px 12px",
                    "height": "100px",
                    "width": "200px",
                    "padding-left": "25px",
                    "margin": "10px 0 0 10px",
                    "border-radius": "10px",
                    "background-position": "3px 10px",
                    "background-repeat": "no-repeat",
                    "background-image": "url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAUCAYAAACNiR0NAAAABmJLR0QA/wD/AP+gvaeTAAAACXBIWXMAAAsTAAALEwEAmpwYAAAAB3RJTUUH3QYFAhkSsdes/QAAA8dJREFUOMvVlGtMW2UYx//POaWHXg6lLaW0ypAtw1UCgbniNOLcVOLmAjHZolOYlxmTGXVZdAnRfXQm+7SoU4mXaOaiZsEpC9FkiQs6Z6bdCnNYruM6KNBw6YWewzl9z+sHImEWv+vz7XmT95f/+3/+7wP814v+efDOV3/SoX3lHAA+6ODeUFfMfjOWMADgdk+eEKz0pF7aQdMAcOKLLjrcVMVX3xdWN29/GhYP7SvnP0cWfS8caSkfHZsPE9Fgnt02JNutQ0QYHB2dDz9/pKX8QjjuO9xUxd/66HdxTeCHZ3rojQObGQBcuNjfplkD3b19Y/6MrimSaKgSMmpGU5WevmE/swa6Oy73tQHA0Rdr2Mmv/6A1n9w9suQ7097Z9lM4FlTgTDrzZTu4StXVfpiI48rVcUDM5cmEksrFnHxfpTtU/3BFQzCQF/2bYVoNbH7zmItbSoMj40JSzmMyX5qDvriA7QdrIIpA+3cdsMpu0nXI8cV0MtKXCPZev+gCEM1S2NHPvWfP/hL+7FSr3+0p5RBEyhEN5JCKYr8XnASMT0xBNyzQGQeI8fjsGD39RMPk7se2bd5ZtTyoFYXftF6y37gx7NeUtJJOTFlAHDZLDuILU3j3+H5oOrD3yWbIztugaAzgnBKJuBLpGfQrS8wO4FZgV+c1IxaLgWVU0tMLEETCos4xMzEIv9cJXQcyagIwigDGwJgOAtHAwAhisQUjy0ORGERiELgG4iakkzo4MYAxcM5hAMi1WWG1yYCJIcMUaBkVRLdGeSU2995TLWzcUAzONJ7J6FBVBYIggMzmFbvdBV44Corg8vjhzC+EJEl8U1kJtgYrhCzgc/vvTwXKSib1paRFVRVORDAJAsw5FuTaJEhWM2SHB3mOAlhkNxwuLzeJsGwqWzf5TFNdKgtY5qHp6ZFf67Y/sAVadCaVY5YACDDb3Oi4NIjLnWMw2QthCBIsVhsUTU9tvXsjeq9+X1d75/KEs4LNOfcdf/+HthMnvwxOD0wmHaXr7ZItn2wuH2SnBzbZAbPJwpPx+VQuzcm7dgRCB57a1uBzUDRL4bfnI0RE0eaXd9W89mpjqHZnUI5Hh2l2dkZZUhOqpi2qSmpOmZ64Tuu9qlz/SEXo6MEHa3wOip46F1n7633eekV8ds8Wxjn37Wl63VVa+ej5oeEZ/82ZBETJjpJ1Rbij2D3Z/1trXUvLsblCK0XfOx0SX2kMsn9dX+d+7Kf6h8o4AIykuffjT8L20LU+w4AZd5VvEPY+XpWqLV327HR7DzXuDnD8r+ovkBehJ8i+y8YAAAAASUVORK5CYII=)"
                }
            }
        });
        console.log(notification.message);
        $.notify("Llego una nueva solicitud, revisa la pestaña web... ", {style:"remisYA2",autoHide: false });

    });
}