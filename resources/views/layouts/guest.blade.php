<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Market Research') }}</title>

        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Lato&family=Newsreader&family=Source+Sans+Pro&family=Spectral:wght@300&display=swap" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"/>
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css"/>
        <link rel="stylesheet" href="{{asset('css/style.css')}}">

        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://kit.fontawesome.com/97cf4c9aa7.js" crossorigin="anonymous"></script>
    </head>
    <body>
        <div class="min-h-screen custom-page-bg">
            @include('layouts.navigation')
            <div class="font-sans text-gray-900 antialiased">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
