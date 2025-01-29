<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Kasir Merchandise</title>
    @vite('resources/css/app.css')
    <style>
        /* Custom scrollbar */
        .overflow-y-auto::-webkit-scrollbar {
            width: 6px;
        }
        
        .overflow-y-auto::-webkit-scrollbar-track {
            background: #f1f1f1;
        }
        
        .overflow-y-auto::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 3px;
        }
        
        .overflow-y-auto::-webkit-scrollbar-thumb:hover {
            background: #555;
        }
    </style>
</head>

<body>
    {{ $slot }}
    <script src="{{ asset('js/keranjang.js') }}"></script>

    <!-- SweetAlert2 untuk notifikasi -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // Fungsi untuk menampilkan notifikasi
        function showNotification(title, icon = 'success') {
            Swal.fire({
                title: title,
                icon: icon,
                timer: 2000,
                showConfirmButton: false,
                position: 'top-end',
                toast: true
            });
        }
    </script>
</body>

</html>
