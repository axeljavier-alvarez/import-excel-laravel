<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Excel</title>
    
    <!-- Carga Tailwind a través de Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    @livewireStyles
</head>
<body class="bg-gray-100 antialiased">

    <div class="container mx-auto p-4">
        <livewire:upload-excel />
    </div>

    @livewireScripts
</body>
</html>