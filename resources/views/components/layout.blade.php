<!DOCTYPE html class="h-full bg-gray-100">
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css','resources/js/app.js'])
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.8/dist/trix.css">
    <script type="text/javascript" src="https://unpkg.com/trix@2.0.8/dist/trix.umd.min.js"></script>

    <style>
        trix-toolbar [data-trix-button-group="file-tools"] {
            display:none;
        }
    </style>

    <title>Home Page</title>
</head>
<body class="h-full">
  
<div class="min-h-full">
   <x-navbar></x-navbar>
  
   <x-header>{{ $title }}</x-header>
    
    <main>
        <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
            {{ $slot }}
        </div>
    </main>
  </div>
  
</body>
</html>