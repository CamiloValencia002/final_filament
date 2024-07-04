<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nueva Solicitud de Transporte</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }
        .card-title {
            color: #007bff;
            font-weight: bold;
        }
        #map_initial, #map_finally {
            height: 300px;
            width: 100%;
            margin-bottom: 20px;
            border-radius: 10px;
        }
        .form-label {
            font-weight: 600;
            color: #495057;
        }
        .btn-success {
            background-color: #28a745;
            border: none;
            transition: all 0.3s;
        }
        .btn-success:hover {
            background-color: #218838;
            transform: translateY(-2px);
        }
        .input-group-text {
            background-color: #007bff;
            color: white;
            border: none;
        }
    </style>
</head>
<body>
    <div class="container mt-5 mb-5">
        <div class="card mx-auto shadow-lg">
            <div class="card-body p-5">
                <h2 class="card-title text-center text-success mb-5"><i class="fas fa-truck me-2"></i>Nueva Solicitud de Transporte</h2>
                <form action="{{ route('procesar.formulario') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <div class="mb-4">
                                <label for="point_initial" class="form-label"><i class="fas fa-map-marker-alt me-2"></i>Punto Inicial</label>
                                <input type="text" class="form-control" id="point_initial" name="point_initial" required>
                            </div>
                            <div id="map_initial" class="mb-4"></div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="mb-4">
                                <label for="point_finally" class="form-label"><i class="fas fa-flag-checkered me-2"></i>Punto Final</label>
                                <input type="text" class="form-control" id="point_finally" name="point_finally" required>
                            </div>
                            <div id="map_finally" class="mb-4"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <div class="mb-4">
                                <label for="carge_type" class="form-label"><i class="fas fa-box me-2"></i>Tipo de Carga</label>
                                <input type="text" class="form-control" id="carge_type" name="carge_type" required>
                            </div>
                            <div class="mb-4">
                                <label for="size" class="form-label"><i class="fas fa-ruler me-2"></i>Tamaño</label>
                                <input type="text" class="form-control" id="size" name="size">
                            </div>
                            <div class="mb-4">
                                <label for="weight" class="form-label"><i class="fas fa-weight-hanging me-2"></i>Peso</label>
                                <input type="text" class="form-control" id="weight" name="weight" required>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="mb-4">
                                <label for="description" class="form-label"><i class="fas fa-align-left me-2"></i>Descripción</label>
                                <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                            </div>
                            <div class="mb-4">
                                <label for="comment" class="form-label"><i class="fas fa-comment me-2"></i>Comentario</label>
                                <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
                            </div>
                            <div class="mb-4">
                                <label for="price" class="form-label"><i class="fas fa-dollar-sign me-2"></i>Precio</label>
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input type="number" class="form-control" id="price" name="price" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-12">
                            <button type="submit" class="btn btn-success btn-lg w-100"><i class="fas fa-paper-plane me-2"></i>Enviar Solicitud</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAizP4kamFR2Cs6ucxhdnJNYoAxXhCSaz4&libraries=places"></script>
    <script>
    function initMap() {
        var pereiraCenter = {lat: 4.8133, lng: -75.6961};

        var mapInitial = new google.maps.Map(document.getElementById('map_initial'), {
            center: pereiraCenter,
            zoom: 13
        });

        var mapFinally = new google.maps.Map(document.getElementById('map_finally'), {
            center: pereiraCenter,
            zoom: 13
        });

        var inputInitial = document.getElementById('point_initial');
        var inputFinally = document.getElementById('point_finally');

        var options = {
            bounds: new google.maps.LatLngBounds(
                new google.maps.LatLng(4.7633, -75.7461),
                new google.maps.LatLng(4.8633, -75.6461)
            ),
            strictBounds: true,
            componentRestrictions: {country: 'CO'}
        };

        var autocompleteInitial = new google.maps.places.Autocomplete(inputInitial, options);
        var autocompleteFinally = new google.maps.places.Autocomplete(inputFinally, options);

        var markerInitial = new google.maps.Marker({map: mapInitial});
        var markerFinally = new google.maps.Marker({map: mapFinally});

        autocompleteInitial.addListener('place_changed', function() {
            var place = autocompleteInitial.getPlace();
            if (!place.geometry || !isInPereira(place)) {
                window.alert("Por favor seleccione una ubicación en Pereira, Risaralda.");
                return;
            }
            updateMap(place, mapInitial, markerInitial, inputInitial);
        });

        autocompleteFinally.addListener('place_changed', function() {
            var place = autocompleteFinally.getPlace();
            if (!place.geometry || !isInPereira(place)) {
                window.alert("Por favor seleccione una ubicación en Pereira, Risaralda.");
                return;
            }
            updateMap(place, mapFinally, markerFinally, inputFinally);
        });
    }

    function isInPereira(place) {
        var inPereira = false;
        place.address_components.forEach(function(component) {
            if (component.types.includes('administrative_area_level_2') && 
                component.long_name.toLowerCase() === 'pereira') {
                inPereira = true;
            }
        });
        return inPereira;
    }

    function updateMap(place, map, marker, input) {
        if (place.geometry.viewport) {
            map.fitBounds(place.geometry.viewport);
        } else {
            map.setCenter(place.geometry.location);
            map.setZoom(17);
        }
        marker.setPosition(place.geometry.location);
        marker.setVisible(true);

        input.value = place.formatted_address;
    }

    google.maps.event.addDomListener(window, 'load', initMap);
    </script>
</body>
</html>