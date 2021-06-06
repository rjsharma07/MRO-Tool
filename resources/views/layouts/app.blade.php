<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Market Research') }}</title>

        <!-- Fonts -->
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
        <style>
            .project-form {
                width: 100%;
                padding: 30px 0px;
            }
            .form-group {
                width: 100%;
            }
            .redirects {
                padding-top: 30px;
            }
            .p-ud-15 {
                padding-top: 15px;
                padding-bottom: 15px;
            }
        </style>
        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen custom-page-bg">
            @include('layouts.navigation')
            @include('layouts.sidenav')

            <!-- Page Heading -->
            <header class="custom-bg-lpurple header-custom shadow">
                <div class="max-w-6xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
            @if (\Session::has('error'))
            <div class="alert-flash error-msg">
                <span class="flash-msg">{!! \Session::get('error') !!}</span>
            </div>
            @endif
            @if (\Session::has('success'))
            <div class="alert-flash success-msg">
                <span class="flash-msg">{!! \Session::get('success') !!}</span>
            </div>
            @endif
            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
    <script src="{{asset('js/custom.js')}}"></script>
    </body>
</html>
