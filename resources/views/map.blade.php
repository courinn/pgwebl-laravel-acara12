@extends('layout/template')

@section('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">



<style>
    /* Peta */
html, body {
    height: 100%;
    margin: 0;
    padding: 0;
    overflow: hidden; /* Cegah scroll vertikal */
}

body {
    display: flex;
    flex-direction: column;
}

/* Pastikan kontainer map benar-benar mengisi viewport */
#map {
    flex: 1;
    height: 100vh; /* Gunakan full height viewport */
    max-height: 100vh;
    overflow: hidden;
    position: relative;
    z-index: 0;
}


    /* Sidebar */
    .sidebar {
        position: absolute;
        top: 56px;
        right: -100%;
        width: 360px;
        height: calc(100vh - 56px);
        background: linear-gradient(to bottom, #f1f3f3, #f9f9f9);
        z-index: 9999;
        overflow-y: auto;
        transition: right 0.4s ease-in-out;
        box-shadow: -4px 0 12px rgba(0, 0, 0, 0.1);
        border-left: 1px solid #ddd;
        padding: 20px;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .sidebar.open {
        right: 0;
    }

    /* Tombol Close */
    .close-btn {
        position: absolute;
        top: 12px;
        left: 12px;
        background: none;
        border: none;
        font-size: 1.5rem;
        color: #555;
        cursor: pointer;
        transition: transform 0.3s ease, color 0.3s ease;
    }

    .close-btn:hover {
        transform: scale(1.1);
        color: #d33;
    }

    /* Scrollbar custom */
    .sidebar::-webkit-scrollbar {
        width: 8px;
    }

    .sidebar::-webkit-scrollbar-track {
        background: #f1f1f1;
    }

    .sidebar::-webkit-scrollbar-thumb {
        background: #cccccc;
        border-radius: 4px;
    }

    .sidebar::-webkit-scrollbar-thumb:hover {
        background: #999999;
    }

    /* Konten dalam sidebar */
    #sidebarContent h5 {
        font-weight: 600;
        margin-bottom: 8px;
    }

    #sidebarContent p {
        margin-bottom: 12px;
        color: #333;
        font-size: 14px;
    }

    #sidebarContent .btn {
        font-size: 13px;
        padding: 5px 12px;
    }

    #sidebarContent .row {
        margin-top: 20px;
    }


.fade-in {
    animation: fadeInSidebar 0.4s ease-in-out both;
}

    .hover-text-elevate {
        display: inline-block;
        transition: all 0.3s ease;
        text-decoration: none;
        color: #0d6efd;
        font-weight: bold;
    }

    .hover-text-elevate:hover {
        transform: translateY(-2px);
        text-shadow: 0 1px 3px rgba(0, 0, 0, 0.2);
        color: #084298;
    }


@keyframes fadeInSidebar {
    0% {
        opacity: 0;
        transform: translateY(10px);
    }
    100% {
        opacity: 1;
        transform: translateY(0);
    }
}

.progress {
    background-color: #f1f1f1;
}
.progress-bar {
    transition: width 0.6s ease;
}

.info-box {
    background-color: #f9f9f9;
    padding: 12px 14px;
    border-radius: 10px;
    border-left: 4px solid #e0e0e0;
    transition: background 0.3s;
}

.info-box:hover {
    background-color: #f1f1f1;
}

.icon-box {
    width: 32px;
    height: 32px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.popup-custom {
    font-size: 13px;
    line-height: 1.4;
    background-color: #fdfdfd;
}

.leaflet-popup-content-wrapper {
    border-radius: 8px !important;
    border: 1px solid #dee2e6;
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
}

.custom-tooltip1 {
    background-color: #5bc0ef;
    color: #fff;
    font-size: 12px;
    padding: 4px 8px;
    border-radius: 4px;
    font-weight: 500;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
}

.custom-tooltip2 {
    background-color: #f45c48;
    color: #fff;
    font-size: 12px;
    padding: 4px 8px;
    border-radius: 4px;
    font-weight: 500;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
}

.custom-tooltip3 {
    background-color: #3f51b5;
    color: #fff;
    font-size: 12px;
    padding: 4px 8px;
    border-radius: 4px;
    font-weight: 500;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
}

.custom-tooltip4 {
    background-color: #f49485;
    color: #fff;
    font-size: 12px;
    padding: 4px 8px;
    border-radius: 4px;
    font-weight: 500;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
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

.leaflet-layer-panel {
  position: absolute;
  top: 70px;
  left: 15px;
  z-index: 1000;
  width: 240px;
  background: #ffffffee;
  border-radius: 8px;
  padding: 16px 20px;
  box-shadow: 0 4px 10px rgba(0,0,0,0.1);
  font-family: 'Segoe UI', sans-serif;
  font-size: 14px;
  line-height: 1.5;
  border: 1px solid #dee2e6;
}

.leaflet-layer-panel h5 {
  font-weight: 600;
  margin-bottom: 10px;
}

.leaflet-layer-panel label {
  cursor: pointer;
}

.toolbox-btn {
    position: absolute;
    top: 80px;
    left: 15px;
    z-index: 1100;
    background-color: #ffffff;
    border: 1px solid #ccc;
    padding: 8px 12px;
    font-weight: bold;
    border-radius: 6px;
    box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    cursor: pointer;
  }

  .toolbox-panel {
    position: absolute;
    top: 130px;
    left: 15px;
    width: 260px;
    background-color: #ffffffee;
    padding: 15px;
    border-radius: 8px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    border: 1px solid #ddd;
    font-family: 'Segoe UI', sans-serif;
    font-size: 14px;
    z-index: 1100;
    display: none;
    max-height: 80vh;
    overflow-y: auto;
  }

  .tool-section {
    margin-bottom: 16px;
  }

  .tool-section label {
    display: block;
    margin-bottom: 6px;
    font-weight: 500;
  }

  .tool-section input[type="text"] {
    width: 100%;
    padding: 6px;
    margin-bottom: 6px;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 13px;
  }

  .tool-section button {
    width: 100%;
    padding: 6px;
    border: none;
    border-radius: 4px;
    background: linear-gradient(135deg, #1D2671, #2C5364);
    color: white;
    cursor: pointer;
    font-size: 13px;
  }

  .tool-section button:hover {
    background: #2C5364;
  }

  #toggleToolbox {
  position: absolute;
  top: 90%;
  left: 10px;
  z-index: 9999;
  background-color: #ffffff;
  border: 1px solid #ced4da;
  padding: 6px 12px;
  border-radius: 8px;
  cursor: pointer;
}

.toolbox-toggle {
  width: 40px;
  height: 50px;
  background: linear-gradient(135deg, #1D2671, #C33764);
  color: white;
  border: none;
  border-radius: 0 40px 40px 0;
  cursor: pointer;
  z-index: 1100;
  font-weight: bold;
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.25);
  transition: background 0.3s ease;
  display: flex;
  align-items: center;
  justify-content: center;
  writing-mode: vertical-lr;
  text-orientation: upright;
  font-size: 12px;
  padding: 0;
}

.toolbox-toggle:hover {
  background: linear-gradient(135deg, #1D2671, #2C5364);
}


/* Toolbox Panel */
.toolbox-panel {
  position: absolute;
  top: 58%;
  left: 50px;
  transform: translateY(-50%);
  width: 280px;
  display: none;
  background: #ffffff;
  border: 1px solid #dee2e6;
  border-radius: 10px;
  z-index: 1100;
  height: 1000vh;
  overflow-y: auto;
}

/* Tombol Close di dalam panel */
.toolbox-panel .btn-close {
  font-size: 10px;
  padding: 4px;
}

/* Tambahan untuk konten panel */
.tool-section {
  margin-bottom: 15px;
}

#suggestions li {
  cursor: pointer;
  padding: 5px 10px;
  font-size: 14px;
}
#suggestions li:hover {
  background-color: #f0f0f0;
}

.basemap-group label,
.layer-group label {
  margin-bottom: 8px;
  display: flex;
  align-items: center;
  gap: 10px;
  padding: 6px 10px;
  border-radius: 6px;
  transition: all 0.2s ease-in-out;
}

.basemap-group label:hover,
.layer-group label:hover {
  background-color: #f5f5f5;
  cursor: pointer;
}

.form-check-input:checked {
  background-color: #1D2671;
  border-color: #1D2671;
}


</style>


@endsection

@section('content')
    <div id="map"></div>

<!-- Toggle Toolbox Button -->
<button id="toggleToolbox" class="toolbox-toggle" title="Open Toolbox">🛠️</button>


<!-- Toolbox Panel -->
<div id="toolboxPanel" class="toolbox-panel card shadow-lg">
  <div class="card-header text-white py-2 px-3" style="background: linear-gradient(45deg, #1D2671, #C33764); cursor: move;">
    <strong>🧰 Toolbox</strong>
    <button id="closeToolbox" class="btn-close btn-close-white float-end btn-sm"></button>
  </div>
  <div class="card-body p-3">
    <!-- === ZOOM CONTROL === -->
    <div class="tool-section mb-3">
      <label class="form-label"><strong>Zoom Control</strong></label>
      <button id="zoomExtentBtn" class="btn btn-sm btn-outline-secondary w-100">🌐 Zoom to Extent</button>
    </div>

    <!-- === SEARCH FEATURE === -->
    <div class="tool-section mb-3">
      <label class="form-label"><strong>Search Point by Name</strong></label>
      <div class="position-relative">
        <input type="text" id="searchName" class="form-control form-control-sm" placeholder="Enter name...">
        <ul id="suggestions" class="list-group position-absolute w-100 shadow-sm" style="z-index: 2000; display: none; max-height: 200px; overflow-y: auto;"></ul>
        <button id="searchBtn" class="btn btn-sm btn-outline-secondary w-100">🔎 Search</button>
      </div>
    </div>



    <!-- === BASEMAP CONTROL === -->
<div class="tool-section mb-4">
  <label class="form-label d-block mb-2">
    <i class="bi bi-layers-fill me-1"></i> <strong>Basemap Selection</strong>
  </label>
  <div class="basemap-group card p-2 border shadow-sm">
    <label class="form-check basemap-option">
      <input class="form-check-input" type="radio" name="basemap" value="osm" checked>
      <span class="form-check-label">🗺️ OpenStreetMap</span>
    </label>
    <label class="form-check basemap-option">
      <input class="form-check-input" type="radio" name="basemap" value="esri">
      <span class="form-check-label">🛰️ Esri Imagery</span>
    </label>
    <label class="form-check basemap-option">
      <input class="form-check-input" type="radio" name="basemap" value="topo">
      <span class="form-check-label">⛰️ Topographic</span>
    </label>
    <label class="form-check basemap-option">
      <input class="form-check-input" type="radio" name="basemap" value="rbi">
      <span class="form-check-label">📍 RBI (BIG)</span>
    </label>
  </div>
</div>

<!-- === LAYER CONTROL === -->
<div class="tool-section mb-4">
  <label class="form-label d-block mb-2">
    <i class="bi bi-layers-half me-1"></i> <strong>Layer Visibility</strong>
  </label>
  <div class="layer-group card p-2 border shadow-sm">
    <label class="form-check layer-option">
      <input class="form-check-input" type="checkbox" id="layer-point" checked>
      <span class="form-check-label">📌 Titik Lokasi</span>
    </label>
    <label class="form-check layer-option">
      <input class="form-check-input" type="checkbox" id="layer-puskesmas" checked>
      <span class="form-check-label">🏥 Puskesmas</span>
    </label>
    <label class="form-check layer-option">
      <input class="form-check-input" type="checkbox" id="layer-jalan" checked>
      <span class="form-check-label">🛣️ Jalan Manado</span>
    </label>
    <label class="form-check layer-option">
      <input class="form-check-input" type="checkbox" id="layer-stunting" checked>
      <span class="form-check-label">👶 Persentase Stunting</span>
    </label>
  </div>
</div>

  </div>
</div>


    <!-- Sidebar -->
<div id="sidebar" class="sidebar">
    <button id="closeSidebar" class="close-btn">×</button>
    <div id="sidebarContent" class="p-3"></div>
</div>

<!-- Modal Create Point -->
<div class="modal fade" id="CreatePointModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel"><i class="fa-solid fa-child me-2 text-danger"></i>Tambah Anak Stunting</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <form method="POST" action="{{ route('points.store') }}" enctype="multipart/form-data">
            <div class="modal-body">
                @csrf

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
                    <img src="" alt="" id="preview-image-point" class="img-thumbnail" width="400">
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

<!-- Modal Create Polyline -->
<div class="modal fade" id="CreatePolylineModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Create Polyline</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <form method="POST" action="{{ route('polylines.store') }}" enctype="multipart/form-data">
            <div class="modal-body">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Fill polyline name">
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                </div>

                <div class="mb-3">
                    <label for="geom_polyline" class="form-label">Geometry</label>
                    <textarea class="form-control" id="geom_polyline" name="geom_polyline" rows="3"></textarea>
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Photo</label>
                    <input type="file" class="form-control" id="image_polyline" name="image"
                    onchange="document.getElementById('preview-image-polyline').src = window.URL.createObjectURL(this.files[0])">
                    <img src="" alt="" id="preview-image-polyline" class="img-thumbnail" width="400">
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

<!-- Modal Create Polygon -->
<div class="modal fade" id="CreatePolygonModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Create Polygon</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <form method="POST" action="{{ route('polygons.store') }}" enctype="multipart/form-data">
            <div class="modal-body">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Fill polygon name">
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                </div>

                <div class="mb-3">
                    <label for="geom_polygon" class="form-label">Geometry</label>
                    <textarea class="form-control" id="geom_polygon" name="geom_polygon" rows="3"></textarea>
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Photo</label>
                    <input type="file" class="form-control" id="image_polygon" name="image"
                    onchange="document.getElementById('preview-image-polygon').src = window.URL.createObjectURL(this.files[0])">
                    <img src="" alt="" id="preview-image-polygon" class="img-thumbnail" width="400">
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
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.js"></script>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script src="https://unpkg.com/@terraformer/wkt"></script>

    <script src="plugin/leaflet-search-master/leaflet-search-master/dist/leaflet-search.min.js"></script>

    <script
        src="plugin/Leaflet.defaultextent-master/Leaflet.defaultextent-master/dist/leaflet.defaultextent.js"></script>

    <script src="https://unpkg.com/leaflet-sidebar-v2/js/leaflet-sidebar.min.js"></script>

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
    var map = L.map('map').setView([1.5, 124.85], 12);
// ==== Basemap ====
var basemapList = {
  osm: L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", { attribution: 'OSM' }),
  esri: L.tileLayer("https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}", { attribution: 'Esri' }),
  topo: L.tileLayer("https://{s}.tile.opentopomap.org/{z}/{x}/{y}.png", { attribution: 'Topographic' }),
  rbi: L.tileLayer("https://geoservices.big.go.id/rbi/rest/services/BASEMAP/Rupabumi_Indonesia/MapServer/tile/{z}/{y}/{x}", { attribution: 'BIG' })
};

basemapList.osm.addTo(map);

// Ganti basemap dari radio input
document.querySelectorAll('input[name="basemap"]').forEach(radio => {
  radio.addEventListener('change', e => {
    for (let key in basemapList) {
      map.removeLayer(basemapList[key]);
    }
    basemapList[e.target.value].addTo(map);
  });
});

// Fungsi Toggle Layer berdasarkan Checkbox
document.getElementById("layer-point").addEventListener("change", function () {
    this.checked ? map.addLayer(point) : map.removeLayer(point);
});

document.getElementById("layer-puskesmas").addEventListener("change", function () {
    this.checked ? map.addLayer(puskesmas) : map.removeLayer(puskesmas);
});

document.getElementById("layer-jalan").addEventListener("change", function () {
    this.checked ? map.addLayer(jalan_manado) : map.removeLayer(jalan_manado);
});

document.getElementById("layer-stunting").addEventListener("change", function () {
    this.checked ? map.addLayer(data_persentase_stunting) : map.removeLayer(data_persentase_stunting);
});


// Toggle Panel Visibility
document.getElementById("toggleToolbox").addEventListener("click", function () {
    const panel = document.getElementById("toolboxPanel");
    panel.style.display = (panel.style.display === "none" || panel.style.display === "") ? "block" : "none";
});

// Close Button on Toolbox
document.getElementById("closeToolbox").addEventListener("click", function () {
    document.getElementById("toolboxPanel").style.display = "none";
});


  document.getElementById("zoomExtentBtn").addEventListener("click", () => map.setView([1.5, 124.85], 12));

const searchInput = document.getElementById("searchName");
const suggestionBox = document.getElementById("suggestions");

// Fungsi Highlight marker
function highlightMarker(layer) {
  const highlight = L.circleMarker(layer.getLatLng(), {
    radius: 20,
    color: '#3a6cf7',
    weight: 3,
    fillOpacity: 0.3,
  }).addTo(map);

  setTimeout(() => map.removeLayer(highlight), 10000); // Hapus highlight setelah 3 detik
}

// Ambil semua nama dari layer
function getAllNamesFromLayers() {
  let names = [];

  point.eachLayer(layer => {
    if (layer.feature?.properties?.name) {
      names.push({ name: layer.feature.properties.name, layer });
    }
  });

  kasus_stunting.eachLayer(layer => {
    const namaAnak = layer.feature?.properties?.name || layer.feature?.properties?.Nama;
    if (namaAnak) {
      names.push({ name: namaAnak, layer });
    }
  });

  return names;
}

// Saat mengetik di input
searchInput.addEventListener("input", () => {
  const val = searchInput.value.toLowerCase();
  const allNames = getAllNamesFromLayers();

  // Filter hasil
  const filtered = allNames.filter(n => n.name.toLowerCase().includes(val));

  // Tampilkan suggestions
  if (val && filtered.length > 0) {
    suggestionBox.innerHTML = "";
    filtered.forEach(item => {
      const li = document.createElement("li");
      li.textContent = item.name;
      li.classList.add("list-group-item", "list-group-item-action");
      li.addEventListener("click", () => {
        searchInput.value = item.name;
        map.setView(item.layer.getLatLng(), 16);
        item.layer.openPopup();
        highlightMarker(item.layer);
        suggestionBox.style.display = "none";
      });
      suggestionBox.appendChild(li);
    });
    suggestionBox.style.display = "block";
  } else {
    suggestionBox.style.display = "none";
  }
});

// Tutup dropdown jika klik di luar
document.addEventListener("click", function (e) {
  if (!suggestionBox.contains(e.target) && e.target !== searchInput) {
    suggestionBox.style.display = "none";
  }
});

  document.getElementById("searchBtn").addEventListener("click", () => {
  const name = document.getElementById("searchName").value.toLowerCase();
  let found = false;

  // Cari di layer "point"
  point.eachLayer(layer => {
    const props = layer.feature.properties;
    if (props.name && props.name.toLowerCase().includes(name)) {
      map.setView(layer.getLatLng(), 15);
      layer.openPopup();
      found = true;
    }
  });

   if (!found) {
    alert("Nama anak tidak ditemukan.");
  }
  suggestionBox.style.display = "none";

});



    /* Digitize Function */
var drawnItems = new L.FeatureGroup();
map.addLayer(drawnItems);

var drawControl = new L.Control.Draw({
	draw: {
		position: 'topleft',
		polyline: false,
		polygon: false,
		rectangle: false,
		circle: false,
		marker: true,
		circlemarker: false
	},
	edit: false
});

map.addControl(drawControl);

map.on('draw:created', function(e) {
	var type = e.layerType,
		layer = e.layer;

	console.log(type);

	var drawnJSONObject = layer.toGeoJSON();
	var objectGeometry = Terraformer.geojsonToWKT(drawnJSONObject.geometry);

	console.log(drawnJSONObject);
	// console.log(objectGeometry);


    // memunculkan modal create polyline

	if (type === 'polyline') {
		console.log("Create " + type);

        $('#geom_polyline').val(objectGeometry);

        $('#CreatePolylineModal').modal('show');

    // memunculkan modal create polygon

	} else if (type === 'polygon' || type === 'rectangle') {
		console.log("Create " + type);

        $('#geom_polygon').val(objectGeometry);

        $('#CreatePolygonModal').modal('show');

    // memunculkan modal create marker

	} else if (type === 'marker') {
		console.log("Create " + type);

        $('#geom_point').val(objectGeometry);

        $('#CreatePointModal').modal('show');


	} else {
		console.log('__undefined__');
	}

	drawnItems.addLayer(layer);
});




// GeoJSON Points
var point = L.geoJson(null, {
    onEachFeature: function(feature, layer) {
        var routedelete = "{{ route('points.destroy', ':id')}}".replace(':id', feature.properties.id);
        var routeedit = "{{ route('points.edit', ':id')}}".replace(':id', feature.properties.id);

var konten = `
<div class="fade-in">
    <div class="mb-4">
        <div class="rounded border border-2 border-light-subtle p-2 bg-light mx-auto mb-3 d-flex justify-content-center align-items-center"
        style="max-width: 200px; min-height: 180px; max-height: 200px; overflow: hidden;">
            ${
                feature.properties.image
                ? `<img src="{{ asset('storage/images/') }}/${feature.properties.image}"
                    alt="Foto Anak"
                    onerror="this.onerror=null; this.src='{{ asset('storage/images/default.jpg') }}';"
                    class="img-fluid rounded shadow-sm" style="max-height: 200px; object-fit: cover;">`
                : `<div class="text-muted fst-italic" style="font-size: 14px;">Tidak ada gambar</div>`
            }
        </div>
    </div>

    <div class="text-center mb-3">
    <h5 class="d-inline-flex align-items-center justify-content-center">
        <i class="fa-solid fa-child me-2 text-primary"></i>
        <a href="table" class="hover-text-elevate text-decoration-none">
            ${feature.properties.name || '-'}
        </a>
    </h5>
</div>


        <div class="mb-2 d-flex align-items-start">
            <i class="fa-solid fa-calendar-day me-2 mt-1 text-secondary"></i>
            <div>
                <strong class="text-dark">Tanggal Lahir:</strong><br>
                <span class="text-muted small">${feature.properties.birth_date || '-'}</span>
            </div>
        </div>

        <div class="mb-2 d-flex align-items-start">
            <i class="fa-solid fa-user me-2 mt-1 text-secondary"></i>
            <div>
                <strong class="text-dark">Nama Orang Tua:</strong><br>
                <span class="text-muted small">${feature.properties.description || '-'}</span>
            </div>
        </div>

            <div class="mb-2 d-flex align-items-start">
        <i class="fa-solid fa-circle-user me-2 mt-1 text-secondary"></i>
        <div>
            <strong class="text-dark">Dibuat oleh:</strong><br>
            <span class="text-muted small">${feature.properties.user_created || '-'}</span>
        </div>
    </div>

    </div>

    <hr class="my-3">

    <div class="d-flex justify-content-between gap-2">
        <a href="${routeedit}" class="btn btn-sm btn-outline-primary w-100 d-flex align-items-center justify-content-center">
            <i class="fa-solid fa-pen-to-square me-1"></i> Edit
        </a>
        <form method="POST" action="${routedelete}" onsubmit="return confirm('Yakin ingin menghapus data ini?')" class="w-100">
            {!! csrf_field() !!}
            {!! method_field('DELETE') !!}
            <button type="submit" class="btn btn-sm btn-outline-danger w-100 d-flex align-items-center justify-content-center">
                <i class="fa-solid fa-trash-can me-1"></i> Hapus
            </button>
        </form>
    </div>
</div>
`;

        // Tampilkan Sidebar saat marker diklik
        layer.on('click', function () {
            const sidebar = document.getElementById("sidebar");
            const sidebarContent = document.getElementById("sidebarContent");
            sidebarContent.innerHTML = konten;
            sidebar.classList.add("open");
        });

        // Tooltip dan popup opsional
        layer.on({
            mouseover: function(e) {
                layer.bindTooltip(`<strong>${feature.properties.name || '-'}</strong>`, {
            direction: "top",
            sticky: true,
            offset: [0, -5],
            opacity: 0.9,
            className: 'custom-tooltip1'
    });
    }
});
    },
});
$.getJSON("{{ route('api.points') }}", function(data) {
    point.addData(data);
    map.addLayer(point);
});


// Close Sidebar
document.getElementById("closeSidebar").onclick = function () {
    document.getElementById("sidebar").classList.remove("open");
};



// === STUNTING ===
var kasus_stunting = L.geoJSON(null, {
    pointToLayer: function (feature, latlng) {
        return L.marker(latlng, {
            icon: L.icon({
                iconUrl: "{{ asset('storage/icon/stunting2.png') }}",
                iconSize: [24, 24],
                iconAnchor: [12, 24],
                popupAnchor: [0, -20],
                tooltipAnchor: [0, -20],
            }),
        });
    },
    onEachFeature: function (feature, layer) {
        var routedelete = "{{ route('stunting.destroy', ':id') }}".replace(':id', feature.properties.id);
        var routeedit = "{{ route('stunting.edit', ':id') }}".replace(':id', feature.properties.id);

        // Konten Sidebar
        var konten = `
            <h5 class="mb-2 text-primary"><i class="fa-solid fa-child"></i> ${feature.properties.Nama}</h5>
            <p><strong>Tanggal Lahir:</strong><br>${feature.properties.tgl_lahir}</p>
            <p><strong>Nama Orang Tua:</strong><br>${feature.properties.nama_ortu}</p>
            <div class="row">
                <div class="col-6 text-end">
                    <a href="${routeedit}" class="btn btn-outline-warning btn-sm w-100">
                        <i class="fa-solid fa-pen-to-square"></i> Edit
                    </a>
                </div>
                <div class="col-6">
                    <form method="POST" action="${routedelete}" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                        {!! csrf_field() !!}
                        {!! method_field('DELETE') !!}
                        <button type="submit" class="btn btn-outline-danger btn-sm w-100">
                            <i class="fa-solid fa-trash-can"></i> Hapus
                        </button>
                    </form>
                </div>
            </div>
        `;

        // Tampilkan Sidebar saat marker diklik
        layer.on('click', function () {
            const sidebar = document.getElementById("sidebar");
            const sidebarContent = document.getElementById("sidebarContent");
            sidebarContent.innerHTML = konten;
            sidebar.classList.add("open");
        });

        // Tooltip
        layer.bindTooltip(`<strong>${feature.properties.nama || '-'}</strong>`, {
            direction: "top",
            sticky: true,
            offset: [0, -5],
            opacity: 0.9,
            className: 'custom-tooltip1'
    });
    }
});

// Load GeoJSON data
$.getJSON("{{ asset('storage/data/kasus_stunting.geojson') }}", function (data) {
    kasus_stunting.addData(data);
    map.addLayer(kasus_stunting);
});

// Close Sidebar
document.getElementById("closeSidebar").onclick = function () {
    document.getElementById("sidebar").classList.remove("open");
};




// === PUSKESMAS ===
var puskesmas = L.geoJSON(null, {
    pointToLayer: function (feature, latlng) {
        return L.marker(latlng, {
            icon: L.icon({
                iconUrl: "{{ asset('storage/icon/puskesmas3.png') }}",
                iconSize: [30, 30],
                iconAnchor: [24, 48],
                popupAnchor: [0, -48],
                tooltipAnchor: [-16, -30],
            }),
        });
    },
    onEachFeature: function (feature, layer) {
        var popup_content = `
    <div class="popup-custom px-2 py-1">
        <h6 class="text-danger fw-bold mb-2 d-flex align-items-center">
            <i class="fa-solid fa-house-medical me-2"></i> ${feature.properties.nama || '-'}
        </h6>

        <div class="mb-1 small">
            <i class="fa-solid fa-location-dot text-secondary me-1"></i>
            <strong class="text-dark">Alamat:</strong>
            <span class="text-muted">${feature.properties.alamat || '-'}</span>
        </div>
    </div>
`;

        layer.bindPopup(popup_content, {
            maxWidth: 300,
            className: 'leaflet-popup-content-wrapper'
        });

        layer.bindTooltip(`<strong>${feature.properties.nama || '-'}</strong>`, {
            direction: "top",
            sticky: true,
            offset: [0, -5],
            opacity: 0.9,
            className: 'custom-tooltip2'
    });
    }
});

$.getJSON("{{ asset('storage/data/puskesmas.geojson') }}", function (data) {

    puskesmas.addData(data);
    map.addLayer(puskesmas);
});




// === JALAN MANADO ===
map.createPane('paneJalanManado');
map.getPane("paneJalanManado").style.zIndex = 401;

var jalan_manado = L.geoJSON(null, {
    pane: 'paneJalanManado',
    style: function () {
        return { color: "#1D2671", opacity: 1, weight: 1 };
    },
    onEachFeature: function (feature, layer) {
        var popup_content = `
            <div class="popup-custom px-2 py-1">
                <h6 class="text-primary fw-bold mb-2 d-flex align-items-center">
                    <i class="fa-solid fa-road me-2"></i> ${feature.properties.NAMOBJ || '-'}
                </h6>

                <div class="mb-1 small">
                    <i class="fa-solid fa-circle-info text-secondary me-1"></i>
                    <strong class="text-dark">Fungsi:</strong>
                    <span class="text-muted">${feature.properties.FGSRJL || '-'}</span>
                </div>

                <div class="mb-1 small">
                    <i class="fa-solid fa-car-side text-secondary me-1"></i>
                    <strong class="text-dark">Tipe:</strong>
                    <span class="text-muted">${feature.properties.AUTRJL || '-'}</span>
                </div>
            </div>
        `;

        layer.bindPopup(popup_content, {
            maxWidth: 300,
            className: 'leaflet-popup-content-wrapper'
        });

        layer.bindTooltip(`<strong>${feature.properties.NAMOBJ || '-'}</strong>`, {
            direction: "top",
            sticky: true,
            offset: [0, -5],
            opacity: 0.9,
            className: 'custom-tooltip3'
        });
    }
});

$.getJSON("{{ asset('storage/data/jalan_manado.geojson') }}", function (data) {

    jalan_manado.addData(data);
    map.addLayer(jalan_manado);
});


// === PERSENTASE STUNTING ===
map.createPane('panePersentaseStunting');
map.getPane("panePersentaseStunting").style.zIndex = 301;

var data_persentase_stunting = L.geoJSON(null, {
    pane: 'panePersentaseStunting',
    style: function (feature) {
        var persen = feature.properties.PRSN_BLTA;
        var color = "#808080";
        if (persen === 0) color = "#ffcc99";
        else if (persen <= 1) color = "#ff6666";
        else if (persen <= 4) color = "#e6004c";
        else if (persen > 4) color = "#660033";

        return {
            color: '#000',
            weight: 1,
            opacity: 1,
            fillOpacity: 0.9,
            fillColor: color,
        };
    },
    onEachFeature: function (feature, layer) {
        var persen = feature.properties.PRSN_BLTA;
        var tingkat = persen === 0 ? "Sangat Rendah" :
                    persen <= 1 ? "Rendah" :
                    persen <= 4 ? "Sedang" : "Tinggi";
        var warna = persen === 0 ? "#ffcc99" :
                    persen <= 1 ? "#ff6666" :
                    persen <= 4 ? "#e6004c" : "#660033";

    var konten = `
<div class="fade-in">
    <div class="text-center mb-4">

            <h5 class="fw-bold text-primary mb-0">
                <i class="fa-solid fa-chart-pie me-2"></i> ${feature.properties.Kelurahan || '-'}
            </h5>
            <div class="small text-muted mt-1">
                <i class="fa-solid fa-location-dot me-1"></i> ${feature.properties.Kecamatan || '-'}
            </div>
        </div>
    </div>

    <div class="px-2">
        <div class="info-box mb-3">
            <div class="d-flex align-items-start">
                <div class="icon-box me-3">
                    <i class="fa-solid fa-percent text-primary fs-5"></i>
                </div>
                <div>
                    <div class="fw-semibold text-dark">Persentase Stunting</div>
                    <div class="text-muted small">${persen || 0}%</div>
                </div>
            </div>
        </div>

        <div class="info-box mb-3">
            <div class="d-flex align-items-start">
                <div class="icon-box me-3">
                    <i class="fa-solid fa-signal text-danger fs-5"></i>
                </div>
                <div>
                    <div class="fw-semibold text-dark">Tingkat</div>
                    <span class="badge rounded-pill" style="background-color: ${warna}; color: white;">
                        ${tingkat}
                    </span>
                </div>
            </div>
        </div>

        <div class="mb-2 mt-4">
            <strong class="small text-muted">Visualisasi Tingkat (%)</strong>
            <div class="progress mt-1" style="height: 14px; border-radius: 7px;">
                <div class="progress-bar" role="progressbar"
                    style="width: ${persen}%; background-color: ${warna}; transition: width 0.6s ease;"
                    aria-valuenow="${persen}" aria-valuemin="0" aria-valuemax="100">
                </div>
            </div>
        </div>
    </div>
</div>
`;


        // Tampilkan Sidebar saat diklik
        layer.on('click', function () {
            const sidebar = document.getElementById("sidebar");
            const sidebarContent = document.getElementById("sidebarContent");
            sidebarContent.innerHTML = konten;
            sidebar.classList.add("open");
        });

        layer.bindTooltip(`<strong>${feature.properties.Kelurahan || '-'}</strong>`, {
            direction: "top",
            sticky: true,
            offset: [0, -5],
            opacity: 0.9,
            className: 'custom-tooltip4'
        });
    }
});


$.getJSON("{{ asset('storage/data/data_persentase_stunting.geojson') }}", function (data) {

    data_persentase_stunting.addData(data);
    map.addLayer(data_persentase_stunting);
});



</script>



@endsection
