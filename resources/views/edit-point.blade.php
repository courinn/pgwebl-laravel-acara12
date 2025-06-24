@extends('layout.template')

@section('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">


    <style>
        #map {
            width: 100%;
            height: calc(100vh - 56px);
        }

        /* === Modal Container === */
.modal-content {
    border-radius: 14px;
    box-shadow: 0 12px 40px rgba(0, 0, 0, 0.25);
    border: none;
    overflow: hidden;
    animation: slideInModal 0.35s ease-in-out;
}

/* === Modal Header === */
.modal-header {
    background: linear-gradient(45deg, #1D2671, #C33764);
    color: #fff;
    padding: 1rem 1.5rem;
    border-bottom: none;
}

.modal-title {
    font-size: 1.25rem;
    font-weight: 600;
}

.btn-close {
    background-color: #fff;
    border-radius: 50%;
    padding: 0.25rem;
    opacity: 0.8;
}

.btn-close:hover {
    opacity: 1;
    transform: scale(1.1);
}

/* === Modal Body === */
.modal-body {
    background-color: #fdfdfd;
    padding: 1.5rem;
}

.modal-body label {
    font-weight: 600;
    margin-bottom: 6px;
    color: #333;
    font-size: 0.95rem;
}

.modal-body input[type="text"],
.modal-body input[type="file"],
.modal-body textarea,
.modal-body input[type="date"] {
    border: 1px solid #ced4da;
    border-radius: 10px;
    padding: 10px 14px;
    width: 100%;
    font-size: 0.95rem;
    transition: border-color 0.3s, box-shadow 0.3s;
    background-color: #fff;
}

.modal-body input:focus,
.modal-body textarea:focus {
    border-color: #3a6cf7;
    box-shadow: 0 0 0 0.2rem rgba(58, 108, 247, 0.25);
    outline: none;
}

.modal-body input[type="date"] {
    position: relative;
    background-color: #fff;
    cursor: pointer;
}

.modal-body input[type="date"]::-webkit-calendar-picker-indicator {
    filter: invert(0.4);
}

/* Gaya Umum untuk Input Date */
input[type="date"] {
    appearance: none;
    -webkit-appearance: none;
    background-color: #fff;
    border: 1px solid #ccc;
    border-radius: 8px;
    padding: 10px 14px;
    font-size: 14px;
    font-family: 'Segoe UI', Tahoma, sans-serif;
    color: #333;
    transition: border-color 0.3s, box-shadow 0.3s;
    box-shadow: 0 2px 6px rgba(0,0,0,0.05);
}

input[type="date"]:hover {
    border-color: #5188e7;
}

input[type="date"]:focus {
    border-color: #224abe;
    box-shadow: 0 0 0 3px rgba(81, 136, 231, 0.2);
    outline: none;
    background-color: #fcfcff;
}

/* Placeholder tampilan kosong */
input[type="date"]::placeholder {
    color: #999;
    font-style: italic;
}

/* Ikon kalender hanya untuk browser tertentu */
input[type="date"]::-webkit-calendar-picker-indicator {
    filter: invert(35%) sepia(42%) saturate(1650%) hue-rotate(195deg) brightness(98%) contrast(90%);
    cursor: pointer;
    padding: 4px;
    border-radius: 50%;
    transition: background 0.3s;
}

input[type="date"]::-webkit-calendar-picker-indicator:hover {
    background-color: #e7efff;
}


/* === Image Preview === */
.img-thumbnail {
    margin-top: 10px;
    border-radius: 10px;
    max-height: 180px;
    object-fit: cover;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.12);
}

/* === Modal Footer === */
.modal-footer {
    background-color: #f1f3f5;
    border-top: none;
    padding: 1rem 1.5rem;
}

.modal-footer .btn {
    padding: 10px 22px;
    border-radius: 8px;
    font-weight: 600;
    font-size: 0.95rem;
    transition: all 0.3s ease;
}

.modal-footer .btn-primary {
    background-color: #3a6cf7;
    border: none;
    color: #fff;
}

.modal-footer .btn-primary:hover {
    background-color: #224abe;
}

.modal-footer .btn-secondary {
    background-color: #adb5bd;
    border: none;
    color: #fff;
}

.modal-footer .btn-secondary:hover {
    background-color: #868e96;
}

/* === Animasi Muncul === */
@keyframes slideInModal {
    from {
        transform: translateY(20px);
        opacity: 0;
    }
    to {
        transform: translateY(0);
        opacity: 1;
    }
}

/* === Responsif Lebih Baik di Mobile === */
@media (max-width: 576px) {
    .modal-dialog {
        margin: 1rem;
    }

    .modal-content {
        border-radius: 10px;
    }

    .modal-title {
        font-size: 1.1rem;
    }

    .modal-footer .btn {
        font-size: 0.9rem;
        padding: 8px 16px;
    }
}


    </style>
@endsection


@section('content')
    <div id="map"></div>

    <!-- Modal Edit Point-->
    <div class="modal fade" id="editpointModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Point</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="{{ route('points.update', $id) }}" enctype="multipart/form-data">
                    <div class="modal-body">
                        @csrf
                        @method('PATCH')
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Isikan nama anak">
                        </div>

                        <div class="mb-3">
                            <label for="birth_date" class="form-label">Tanggal Lahir Anak</label>
                            <input type="date" class="form-control" id="birth_date" name="birth_date">
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Nama Orang Tua</label>
                            <input type="text" class="form-control" id="description" name="description" placeholder="Isikan nama orang tua">
                        </div>

                        <div class="mb-3">
                            <label for="geom_point" class="form-label">Geometry</label>
                            <textarea class="form-control" id="geom_point" name="geom_point" rows="3"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label">Photo</label>
                            <input type="file" class="form-control" id="image_point" name="image"
                                onchange="document.getElementById('preview-image-point').src = window.URL.createObjectURL(this.files[0])">
                            <img src="" alt="" id="preview-image-point" class="img-thumbnail"
                                width="400">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection


@section('scripts')
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.js"></script>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script src="https://unpkg.com/@terraformer/wkt"></script>

    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <script>
flatpickr("#birth_date", {
    dateFormat: "Y-m-d",
    altInput: true,
    altFormat: "F j, Y",
    allowInput: true,
    wrap: false,
});
</script>

    <script>
        var map = L.map('map').setView([1.4811444328133583, 124.84622679551077], 12);

        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        /* Digitize Function */
        var drawnItems = new L.FeatureGroup();
        map.addLayer(drawnItems);

        var drawControl = new L.Control.Draw({
            draw: false,
            edit: {
                featureGroup: drawnItems,
                edit: true,
                remove: true
            }
        });

        map.addControl(drawControl);

        map.on('draw:edited', function(e) {
            var layers = e.layers;

            layers.eachLayer(function(layer) {
                var drawnJSONObject = layer.toGeoJSON();
                console.log(drawnJSONObject);

                var objectGeometry = Terraformer.geojsonToWKT(drawnJSONObject.geometry);
                console.log(objectGeometry);

                // layer properties
                var properties = drawnJSONObject.properties;
                console.log(properties);

                drawnItems.addLayer(layer);

                // menampilkan data ke dalam modal
                $('#name').val(properties.name);
                $('#description').val(properties.description);
                $('#geom_point').val(objectGeometry);
                $('#preview-image-point').attr('src', "{{ asset('storage/images') }}/" + properties.image);


                // menampilkan modal edit
                $('#editpointModal').modal('show');
            });

        });

        // GeoJSON Points
        var point = L.geoJson(null, {
            onEachFeature: function(feature, layer) {

                drawnItems.addLayer(layer);

                var properties = feature.properties;
                var objectGeometry = Terraformer.geojsonToWKT(feature.geometry);

                layer.on({
                    click: function(e) {
                    // menampilkan data ke dalam modal
                    $('#name').val(properties.name);
                    $('#description').val(properties.description);
                    $('#geom_point').val(objectGeometry);
                    $('#preview-image-point').attr('src', "{{ asset('storage/images') }}/" + properties.image);

                    // menampilkan modal edit
                    $('#editpointModal').modal('show');
                    },
                });
            },
        });
        $.getJSON("{{ route('api.point', $id) }}", function(data) {
            point.addData(data);
            map.addLayer(point);
            map.fitBounds(point.getBounds(), {
                padding: [100, 100]
            });
        });

    </script>
@endsection
