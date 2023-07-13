<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('AdminLTE') }}/plugins/fontawesome-free/css/all.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('AdminLTE') }}/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('AdminLTE') }}/dist/css/adminlte.min.css">
    {{-- Trix Editor --}}
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.0/dist/trix.css">
    <link rel="stylesheet" href="{{ asset('css') }}/style-dashboard.css">

    <script type="text/javascript" src="https://unpkg.com/trix@2.0.0/dist/trix.umd.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">

    @include('dashboard.layouts.partials.navbar')

    @include('dashboard.layouts.partials.sidebar')

    @yield('container')

    @include('dashboard.layouts.partials.footer')

    {{-- Fetch API JavaScript -- create slug automatically with get from title --}}
    <script>
        const title = document.querySelector('#title');
        const slug = document.querySelector('#slug');

        // Even Handler, yang menangani ketika kita tuliskan di dalam title itu berubah.
        title.addEventListener('change', function() {
            // kita akan melakukan fetch dari controller dashboard/post/ method checkSlug()
            // data dari title diambil kemudian diolah dan dikembalikan sebagai slug
            fetch('/dashboard/posts/checkSlug?title=' + title.value)
                .then(response => response.json())
                .then(data => slug.value = data.slug)
            console.log(data.slug);
        });

        // mematikan fungsi file upload di trix
        document.addEventListener('trix-file-accept', function(e) {
            e.preventDefault();
        });

        // Preview Image Before Upload
        function previewImage() {
            const image = document.querySelector('#image');
            const imgPreview = document.querySelector('.img-preview');

            imgPreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        }
    </script>

    <!-- REQUIRED SCRIPTS -->
    <!-- jQuery -->
    <script src="{{ asset('AdminLTE') }}/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="{{ asset('AdminLTE') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('AdminLTE') }}/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('AdminLTE') }}/dist/js/adminlte.js"></script>

    <!-- PAGE PLUGINS -->
    <!-- jQuery Mapael -->
    <script src="{{ asset('AdminLTE') }}/plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
    <script src="{{ asset('AdminLTE') }}/plugins/raphael/raphael.min.js"></script>
    <script src="{{ asset('AdminLTE') }}/plugins/jquery-mapael/jquery.mapael.min.js"></script>
    <script src="{{ asset('AdminLTE') }}/plugins/jquery-mapael/maps/usa_states.min.js"></script>
    <!-- ChartJS -->
    <script src="{{ asset('AdminLTE') }}/plugins/chart.js/Chart.min.js"></script>
    <script src="{{ asset('AdminLTE') }}/dist/js/pages/dashboard2.js"></script>

</body>

</html>
