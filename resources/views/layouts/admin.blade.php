<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Boat Admin') }} - @yield('title')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Page Specific Scripts -->
    @stack('scripts')

    <style>
        body {
            font-family: 'Roboto', sans-serif;
            overflow: hidden; /* Prevent double scrollbars */
        }

        /* Custom styles for fixed layout */
        .admin-layout {
            display: flex;
            height: 100vh;
            width: 100vw;
            overflow: hidden;
        }

        .admin-sidebar {
            width: 16rem; /* 64px, same as w-64 */
            flex-shrink: 0;
            z-index: 30;
        }

        .admin-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        .admin-header {
            height: 4rem; /* 64px, same as h-16 */
            flex-shrink: 0;
            z-index: 20;
        }

        .admin-main {
            flex: 1;
            overflow-y: auto;
            overflow-x: hidden;
        }

        /* Custom color for primary blue */
        .custom-blue {
            color: #2271B3;
        }

        .custom-blue-bg {
            background-color: #2271B3;
        }

        .custom-blue-light-bg {
            background-color: #E6F0F9;
        }
    </style>
</head>
<body class="font-sans antialiased bg-gray-50">
    <div class="admin-layout">
        <!-- Sidebar -->
        <div class="admin-sidebar">
            @include('partials.admin.sidebar')
        </div>

        <!-- Content Area -->
        <div class="admin-content">
            <!-- Fixed Header -->
            <div class="admin-header">
                @include('partials.admin.header')
            </div>

            <!-- Scrollable Main Content -->
            <main class="admin-main bg-gray-50 p-4 md:p-6">
                <!-- Page Heading -->
                <div class="mb-6">
                    <h1 class="text-xl md:text-2xl font-medium text-gray-800">@yield('header')</h1>
                    @yield('breadcrumbs')
                </div>

                <!-- Page Content -->
                <div class="dashboard-container">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>
</body>
</html>
