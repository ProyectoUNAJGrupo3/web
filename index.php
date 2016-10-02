<!DOCTYPE html>
<html>
  <head>
    <style type="text/css">
      html, body { height: 100%; margin: 0; padding: 0; }
      #map { height: 30%;
      		width: 30%; }
      .controls {
		  margin-top: 10px;
		  border: 1px solid transparent;
		  border-radius: 2px 0 0 2px;
		  box-sizing: border-box;
		  -moz-box-sizing: border-box;
		  height: 32px;
		  outline: none;
		  box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
		}
		#pac-input {
		  background-color: #fff;
		  font-family: Roboto;
		  font-size: 15px;
		  font-weight: 300;
		  margin-left: 12px;
		  padding: 0 11px 0 13px;
		  text-overflow: ellipsis;
		  width: 300px;
		}

		#pac-input:focus {
		  border-color: #4d90fe;
		}

		.pac-container {
		  font-family: Roboto;
		}

		#type-selector {
		  color: #fff;
		  background-color: #4d90fe;
		  padding: 5px 11px 0px 11px;
		}

		#type-selector label {
		  font-family: Roboto;
		  font-size: 13px;
		  font-weight: 300;
		}

    </style>
            <script async defer
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDMVbdR-TGis783bW9rB9tZUJXVXsIRzkQ&callback=initMap&libraries=places&callback=initAutocomplete">
    </script>
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDMVbdR-TGis783bW9rB9tZUJXVXsIRzkQ&callback=initMap"></script> -->
  </head>
  <body>
    <div id="map" class="container"></div>

    <script type="text/javascript">

		var map;

		function initMap() {
			var jsonDeLaBase= {
				ubicacionDefault:{lat:-34.7741908,lng: -58.2670426},
				Remiserias: [{lat:-34.772015, lng:-58.264468},{lat:-34.773216,lng: -58.270884},{lat:-34.776670,lng: -58.274574}]

			}


			map = new google.maps.Map(document.getElementById('map'), {
		    center: jsonDeLaBase.ubicacionDefault,
		    zoom: 14,
			streetViewControl:false, // Todo en false para que no pueda
			overviewMapControl:false, // user el street view y esas cosas
			rotateControl:false ,  // solo un mapa sencillo
			mapTypeControl:false,
			panControl:false,
		  });

		var image = new google.maps.MarkerImage("https://www.creare.co.uk/wp-content/uploads/2013/08/marker.png", null, null, null, new google.maps.Size(40,52));
		marker = new google.maps.Marker({
		    position: jsonDeLaBase.ubicacionDefault,
			icon:image,
		    map: map,
		    title: 'un string!'
		  });

		// for (var i = 0; i < jsonDeLaBase.Remiserias.length; i++) {
		// 	var remiseria= jsonDeLaBase.Remiserias[i];
		// 	var remo = new google.maps.Marker({
		// 	    position: remiseria,
		// 	    map: map,
		// 	    title: 'otro string!'
		// 	  });
		// 	var infoWindow = new google.maps.InfoWindow({map: map,
		// 		content:"<h3>Ubicacion Centrar</h3><p>Debería ir alguna data.</p>" // Deberiamos llenar esto con data que viene de la base sobre la remiseria
		// 	});
		// 	remo.addListener(remo, 'click', function() { // hace cualquier cosa 
		//   			infoWindow.open(map,remo); //ow
		//   		});

		// }


		// if (navigator.geolocation) {
		//      var currentLocation=navigator.geolocation.getCurrentPosition(function (position){

		//      });
		//   } else {
		//     alert("La geoUbicacion no esta habilitada en este navegador.");
		//   }

		};

  
		// $('#search').click( function() {
		//     // Obtenemos la dirección y la asignamos a una variable
		//     var address = $('#address').val();
		//     // Creamos el Objeto Geocoder
		//     var geocoder = new google.maps.Geocoder();
		//     // Hacemos la petición indicando la dirección e invocamos la función
		//     // geocodeResult enviando todo el resultado obtenido
		//     geocoder.geocode({ 'address': address}, geocodeResult);
		// });
		 
		// function geocodeResult(results, status) {
		//     // Verificamos el estatus
		//     if (status == 'OK') {
		//         // Si hay resultados encontrados, centramos y repintamos el mapa
		//         // esto para eliminar cualquier pin antes puesto
		//         var mapOptions = {
		//             center: results[0].geometry.location,
		//             mapTypeId: google.maps.MapTypeId.ROADMAP
		//         };
		//         map = new google.maps.Map($("#map_canvas").get(0), mapOptions);
		//         // fitBounds acercará el mapa con el zoom adecuado de acuerdo a lo buscado
		//         map.fitBounds(results[0].geometry.viewport);
		//         // Dibujamos un marcador con la ubicación del primer resultado obtenido
		//         var markerOptions = { position: results[0].geometry.location }
		//         var marker = new google.maps.Marker(markerOptions);
		//         marker.setMap(map);
		//     } else {
		//         // En caso de no haber resultados o que haya ocurrido un error
		//         // lanzamos un mensaje con el error
		//         alert("Geocoding no tuvo éxito debido a: " + status);
		//     }
		// };


    </script>
    <div><input type="text" maxlength="100" id="address" placeholder="Dirección" /> <input type="button" id="search" value="Buscar" /></div><br/>
     <input id="pac-input" class="controls" type="text" placeholder="Busca tu partido / barrio ">
    <script type="text/javascript">
    		$('#search').click( function() {
		    // Obtenemos la dirección y la asignamos a una variable
		    var address = $('#address').val();
		    // Creamos el Objeto Geocoder
		    var geocoder = new google.maps.Geocoder();
		    // Hacemos la petición indicando la dirección e invocamos la función
		    // geocodeResult enviando todo el resultado obtenido
		    geocoder.geocode({ 'address': address}, geocodeResult);
		});
		 
		function geocodeResult(results, status) {
		    // Verificamos el estatus
		    if (status == 'OK') {
		        // Si hay resultados encontrados, centramos y repintamos el mapa
		        // esto para eliminar cualquier pin antes puesto
		        var mapOptions = {
		            center: results[0].geometry.location,
		            mapTypeId: google.maps.MapTypeId.ROADMAP,
    		    	zoom: 14,
					streetViewControl:false, // Todo en false para que no pueda
					overviewMapControl:false, // user el street view y esas cosas
					rotateControl:false ,  // solo un mapa sencillo
					mapTypeControl:false,
					panControl:false,
		        };
		        map = new google.maps.Map($("#map").get(0), mapOptions);
		        // fitBounds acercará el mapa con el zoom adecuado de acuerdo a lo buscado
		        map.fitBounds(results[0].geometry.viewport);
		        // Dibujamos un marcador con la ubicación del primer resultado obtenido
		        var markerOptions = { position: results[0].geometry.location }
		        var marker = new google.maps.Marker(markerOptions);
		        marker.setMap(map);
		    } else {
		        // En caso de no haber resultados o que haya ocurrido un error
		        // lanzamos un mensaje con el error
		        alert("Geocoding no tuvo éxito debido a: " + status);
		    }
		};

		function initAutocomplete() {
			var jsonDeLaBase= {
				ubicacionDefault:{lat:-34.7741908,lng: -58.2670426},
				Remiserias: [{lat:-34.772015, lng:-58.264468},{lat:-34.773216,lng: -58.270884},{lat:-34.776670,lng: -58.274574}]

			}


			map = new google.maps.Map(document.getElementById('map'), {
		    center: jsonDeLaBase.ubicacionDefault,
		    zoom: 14,
			streetViewControl:false, // Todo en false para que no pueda
			overviewMapControl:false, // user el street view y esas cosas
			rotateControl:false ,  // solo un mapa sencillo
			mapTypeControl:false,
			panControl:false,
		  });
		  // Create the search box and link it to the UI element.
		  var input = document.getElementById('pac-input');
		  var searchBox = new google.maps.places.SearchBox(input);
		  map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

		  // Bias the SearchBox results towards current map's viewport.
		  map.addListener('bounds_changed', function() {
		    searchBox.setBounds(map.getBounds());
		  });

		  var markers = [];
		  // [START region_getplaces]
		  // Listen for the event fired when the user selects a prediction and retrieve
		  // more details for that place.
		  searchBox.addListener('places_changed', function() {
		    var places = searchBox.getPlaces();

		    if (places.length == 0) {
		      return;
		    }

		    // Clear out the old markers.
		    markers.forEach(function(marker) {
		      marker.setMap(null);
		    });
		    markers = [];

		    // For each place, get the icon, name and location.
		    var bounds = new google.maps.LatLngBounds();
		    places.forEach(function(place) {
		      var icon = {
		        url: place.icon,
		        size: new google.maps.Size(71, 71),
		        origin: new google.maps.Point(0, 0),
		        anchor: new google.maps.Point(17, 34),
		        scaledSize: new google.maps.Size(25, 25)
		      };

		      // Create a marker for each place.
		      markers.push(new google.maps.Marker({
		        map: map,
		        icon: icon,
		        title: place.name,
		        position: place.geometry.location
		      }));

		      if (place.geometry.viewport) {
		        // Only geocodes have viewport.
		        bounds.union(place.geometry.viewport);
		      } else {
		        bounds.extend(place.geometry.location);
		      }
		    });
		    map.fitBounds(bounds);
		  });
		  var marcadores= [];
		  google.maps.event.addListener(map, "click", function (e) {

		    //lat and lng is available in e object
		    var latLng = e.latLng;
		    marcadores.forEach(function(marker) {
		      marker.setMap(null);
		    });
	         var markerOptions = { position: latLng }
		     var marker = new google.maps.Marker(markerOptions);
		    marker.setMap(map);
		     marcadores.push(marker);

		    map.setCenter(latLng);
		     //$('#address').val();


		});

		  // [END region_getplaces]
		}


    </script>




  </body>
</html>