<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Aplikasi Kartu Keluarga</title>
    @vite('resources/css/app.css')

</head>
<body class="bg-gray-100 font-sans h-[1300px] leading-normal tracking-normal">
    <nav class="bg-gray-800 p-4">
        <div class="container mx-auto">
            <ul class="flex space-x-4">
                <li>
                    <a href="{{ route('kartu-keluarga.index') }}" class="text-white hover:text-gray-300">Kartu Keluarga</a>
                </li>
                <li>
                    <a href="{{ route('ktp.index') }}" class="text-white hover:text-gray-300">KTP</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container mx-auto p-6">
        @yield('content')
    </div>
</body>
</html>
