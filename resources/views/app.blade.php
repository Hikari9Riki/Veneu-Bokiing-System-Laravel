<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Venue System</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <nav class="bg-white shadow-lg p-4 flex justify-between">
        <div>
            <a href="/" class="font-bold text-xl">Venue System</a>
        </div>

        <div class="space-x-4 flex items-center">
            <a href="/" class="hover:text-blue-500">Home</a>

            @auth
                <a href="/dashboard" class="hover:text-blue-500">My Dashboard</a>
                
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded text-sm">
                        Logout ({{ Auth::user()->name }})
                    </button>
                </form>
            @endauth

            @guest
                <a href="/login" class="hover:text-blue-500">Login</a>
                <a href="/register" class="hover:text-blue-500 border border-blue-500 px-3 py-1 rounded">Register</a>
            @endguest
        </div>
    </nav>

    <main class="p-8">
        @yield('content')
    </main>

</body>
</html>