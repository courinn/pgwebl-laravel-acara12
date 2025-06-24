<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }}</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    @yield('styles')
    <style>
/* Warna latar navbar */
.navbar {
    background: linear-gradient(45deg, #1D2671, #C33764);
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.15);
    transition: all 0.3s ease-in-out;
}

/* Brand dan icon */
.navbar-brand {
    color: #fff !important;
    font-weight: 600;
    letter-spacing: 0.5px;
    display: flex;
    align-items: center;
    gap: 8px;
}

/* Nav link umum */
.navbar-nav .nav-link {
    color: #f8f9fa !important;
    transition: all 0.2s ease-in-out;
    display: flex;
    align-items: center;
    gap: 6px;
}

.navbar-nav .nav-link:hover {
    color: #6aa1f3 !important;
    transform: translateY(-1px);
}

/* Dropdown */
.navbar .dropdown-menu {
    border: none;
    border-radius: 0.5rem;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    background-color: #f8f9fa;
}

.navbar .dropdown-item {
    color: #343a40;
    font-size: 14px;
}

.navbar .dropdown-item:hover {
    background-color: #e9ecef;
    color: #0d6efd;
}

/* Tombol logout (dalam form) */
.navbar .nav-item form .nav-link {
    background: none;
    border: none;
    padding: 0;
    color: #d7e4f8;
    font-weight: 500;
    cursor: pointer;
    transition: color 0.2s ease-in-out;
}

.navbar .nav-link.text-danger:hover {
    color: #ffb06a !important;
}

/* Tombol login */
.navbar .nav-link.text-primary:hover {
    color: #07ff7b !important;
}

/* Toggler */
.navbar-toggler {
    border: none;
    background-color: rgba(255, 255, 255, 0.1);
    border-radius: 4px;
}

.navbar-toggler-icon {
    filter: invert(1);
}


</style>

</head>

<body>
    @include('components/navbar')

    @yield('content')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    @yield('scripts')

    @include('components.toast')

</body>

</html>
