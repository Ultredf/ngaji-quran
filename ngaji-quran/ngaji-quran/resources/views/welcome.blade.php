<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Ngaji Quran</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    @vite('resources/css/app.css')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Amiri+Quran&family=Londrina+Solid:wght@100;300;400;900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('assets/img/logo.svg') }}" type="image/x-icon">

</head>

<body>
    @include('templates.header')
    @yield('content')

    @include('templates.footer')

    <script>
        function toggleText(id) {
            var shortText = document.getElementById('pertanyaan-short-' + id);
            var fullText = document.getElementById('pertanyaan-full-' + id);

            if (shortText.classList.contains('hidden')) {
                shortText.classList.remove('hidden');
                fullText.classList.add('hidden');
            } else {
                shortText.classList.add('hidden');
                fullText.classList.remove('hidden');
            }
        }

        function toggleForm() {
            var form = document.getElementById('forkomForm');
            form.classList.toggle('hidden');
        }

        function openModal3(id, id_user, instagram, tiktok, facebook, x) {
            // Dynamically set the values of the modal fields
            document.getElementById('modal-id-' + id).value = id;
            document.getElementById('modal-id_user-' + id).value = id_user;
            document.getElementById('modal-instagram-' + id).value = instagram;
            document.getElementById('modal-tiktok-' + id).value = tiktok;
            document.getElementById('modal-facebook-' + id).value = facebook;
            document.getElementById('modal-x-' + id).value = x;

            // Show the modal
            document.getElementById('detail-modal-' + id).classList.remove('hidden');
        }

        function openModal(tanggapanId, tanggapanText, pertanyaanText) {
            document.getElementById('modal-textarea').value = tanggapanText;
            document.getElementById('modal-pertanyaan').value = pertanyaanText;
            document.getElementById('editModal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('editModal').classList.add('hidden');
        }
    </script>
</body>

</html>
