<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Dashboard Ngaji Quran</title>
    <link rel="shortcut icon" href="{{ asset('assets/img/logo.svg') }}" type="image/x-icon">

    <link rel="stylesheet" href="{{ asset('assets-dashboard/modules/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets-dashboard/modules/fontawesome/css/all.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets-dashboard/modules/summernote/summernote-bs4.css') }}">
    <link rel="stylesheet" href="{{ asset('assets-dashboard/modules/jqvmap/dist/jqvmap.min.css') }}">

    {{-- Owl Carousels --}}
    <link rel="stylesheet" href="{{ asset('assets-dashboard/modules/owlcarousel2/dist/assets/owl.carousel.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('assets-dashboard/modules/owlcarousel2/dist/assets/owl.theme.default.min.css') }}">

    {{-- New Input File --}}
    <link rel="stylesheet" href="{{ asset('assets-dashboard/modules/jquery-selectric/selectric.css') }}">
    <link rel="stylesheet"
        href="{{ asset('assets-dashboard/modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}">

    {{-- Data Table --}}

    <link rel="stylesheet" href="{{ asset('assets-dashboard/modules/datatables/datatables.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('assets-dashboard/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('assets-dashboard/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css') }}">

    {{-- End Data Table --}}
    <link rel="shortcut icon" href="{{ asset('assets-dashboard//logo/AVASA2_COL.png') }}" type="image/x-icon">

    {{-- Toast --}}
    <link rel="stylesheet" href="{{ asset('assets-dashboard/modules/izitoast/css/iziToast.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets-dashboard/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets-dashboard/css/components.css') }}">
    <style>
        .gambar_data {
            width: 60px;
            height: 60px;
            object-fit: cover;
            object-position: center;
            border-radius: 10px;
        }
    </style>
</head>
</head>

<body>
    <div id="app">
        @include('layouts.dashboard.nav')
        @include('layouts.dashboard.sidebar')
        @yield('content')
        {{-- {{ $slot }} --}}
        @include('layouts.dashboard.footer')

    </div>
    <script>
        // Get all elements with the class 'harga'
        const inputs = document.querySelectorAll('.harga');

        // Loop through each input element
        inputs.forEach(input => {
            // Add event listener for 'input' event on each input
            input.addEventListener('input', function(event) {
                // Get the input value
                let value = event.target.value;

                // Remove any non-numeric characters from the value
                value = value.replace(/\D/g, '');

                // Format the value with dots as thousand separators
                value = formatRupiah(value);

                // Update the input field with the formatted value
                event.target.value = value;
            });
        });

        // Function to format the value with dots as thousand separators
        function formatRupiah(angka) {
            var number_string = angka.toString();
            var sisa = number_string.length % 3;
            var rupiah = number_string.substr(0, sisa);
            var ribuan = number_string.substr(sisa).match(/\d{3}/g);

            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            return rupiah;
        }
    </script>

    <script src="{{ asset('assets-dashboard/modules/jquery.min.js') }}"></script>
    <script src="{{ asset('assets-dashboard/modules/popper.js') }}"></script>
    <script src="{{ asset('assets-dashboard/modules/tooltip.js') }}"></script>
    <script src="{{ asset('assets-dashboard/modules/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets-dashboard/modules/nicescroll/jquery.nicescroll.min.js') }}"></script>
    <script src="{{ asset('assets-dashboard/modules/moment.min.js') }}"></script>
    <script src="{{ asset('assets-dashboard/js/stisla.js') }}"></script>

    <script src="{{ asset('assets-dashboard/modules/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets-dashboard/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}">
    </script>
    <script src="{{ asset('assets-dashboard/modules/datatables/Select-1.2.4/js/dataTables.select.min.js') }}"></script>
    <script src="{{ asset('assets-dashboard/modules/jquery-ui/jquery-ui.min.js') }}"></script>


    <script src="{{ asset('assets-dashboard/js/page/modules-datatables.js') }}"></script>

    <script src="{{ asset('assets-dashboard/modules/summernote/summernote-bs4.js') }}"></script>
    <script src="{{ asset('assets-dashboard/modules/jquery.sparkline.min.js') }}"></script>
    <script src="{{ asset('assets-dashboard/modules/chart.min.js') }}"></script>
    <script src="{{ asset('assets-dashboard/modules/owlcarousel2/dist/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets-dashboard/js/page/modules-slider.js') }}"></script>

    {{-- Modal --}}
    <script src="{{ asset('assets-dashboard/js/page/bootstrap-modal.js') }}"></script>

    {{-- Toast  --}}
    <script src="{{ asset('assets-dashboard/modules/izitoast/js/iziToast.min.js') }}"></script>
    <script src="{{ asset('assets-dashboard/js/page/modules-toastr.js') }}"></script>


    <script src="{{ asset('assets-dashboard/js/page/index.js') }}"></script>

    <script src="{{ asset('assets-dashboard/js/scripts.js') }}"></script>
    <script src="{{ asset('assets-dashboard/js/custom.js') }}"></script>

    {{-- Input File --}}
    <script src="{{ asset('assets-dashboard/js/page/features-post-create.js') }}"></script>
    <script src="{{ asset('assets-dashboard/modules/jquery-selectric/jquery.selectric.min.js') }}"></script>
    <script src="{{ asset('assets-dashboard/modules/upload-preview/assets/js/jquery.uploadPreview.min.js') }}"></script>
    <script src="{{ asset('assets-dashboard/modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') }}"></script>





</body>

</html>
