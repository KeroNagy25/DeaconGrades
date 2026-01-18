<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Admin Panel')</title>

    <!-- Tailwind CDN -->
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body class="min-h-screen flex flex-col" style="background-color: #f2efe8;"> <!-- بيج فاتح -->

    <!-- Header -->
    <header style="background-color: #420707;" class="text-white shadow">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <!-- لوجو 1 + لوجو 2 -->
           <div class="flex items-center space-x-4">
    <img src="{{ asset('logo/madrast elshmamsa.png') }}" alt="Logo 1" class="h-15 w-auto">
    <img src="{{ asset('logo/st john church.png') }}" alt="Logo 2" class="h-15 w-auto">
</div>


            <!-- اسم المدرسة -->
            <h1 class="text-xl font-bold"> StJohnDeaconSchool</h1>
            

            <!-- Navigation -->
            <nav class="space-x-4">
                <a href="{{ route('admin.index') }}" class="hover:underline">Search</a>
                            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit"
                        class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-sm">
                    Logout
                </button>
            </form>
            </nav>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow container mx-auto px-4 py-6" style="color: #4d0202;"> <!-- نص نبيتي -->
        @yield('content')
    </main>

    <!-- Footer -->
    <footer style="background-color: #420707;" class="text-white text-center py-3 text-sm">
        © {{ date('Y') }}StJohnDeaconSchool
    </footer>

</body>
</html>
