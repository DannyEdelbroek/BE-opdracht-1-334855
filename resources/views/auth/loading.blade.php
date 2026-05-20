<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50">
    <div class="min-h-screen flex items-center justify-center">
        <x-loadbar />
        <div class="text-center">
            <p class="text-gray-600">Redirecting you to your dashboard...</p>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const user = @json(Auth::user());
            if (user) {
                setTimeout(() => {
                    switch (user.role) {
                        case 'Administrator':
                            window.location.href = '{{ route('admin.dashboard') }}';
                            break;
                        case 'Instructeur':
                            window.location.href = '{{ route('instructeur.dashboard') }}';
                            break;
                        case 'leerling':
                            window.location.href = '{{ route('leerling.dashboard') }}';
                            break;
                        case 'user':
                            window.location.href = '{{ route('users.dashboard') }}';
                            break;
                        default:
                            window.location.href = '/';
                    }
                }, 1500);
            }
        });
    </script>
</body>

</html>
