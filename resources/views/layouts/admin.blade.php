<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Admin Panel')</title>
    <link rel="icon" type="image/png" href="{{ asset('logo/madrast elshmamsa.png') }}">

    <!-- Tailwind CDN -->
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body class="min-h-screen flex flex-col" style="background-color: #f2efe8;"> 

    
    <header style="background-color: #420707;" class="text-white shadow">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
           
           <div class="flex items-center space-x-4">
    <img src="{{ asset('logo/madrast elshmamsa.png') }}" alt="Logo 1" class="h-15 w-auto">
    <img src="{{ asset('logo/st john church.png') }}" alt="Logo 2" class="h-15 w-auto">
</div>


           
            <h1 class="text-xl font-bold"> StJohnDeaconSchool</h1>
            

            
            <nav class="space-x-4">
                <a href="{{ route('admin.index') }}" class="hover:underline">
                    Search
                </a>
                    <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit"class="hover:underline">
                    Logout
                </button>
            </form>
            </nav>
        </div>
    </header>

    
    <main class="flex-grow container mx-auto px-4 py-6" style="color: #4d0202;"> 
        @yield('content')
    </main>

    
    <footer style="background-color: #420707;" class="text-white text-center py-3 text-sm">
        © {{ date('Y') }}StJohnDeaconSchool
    </footer>

</body>
</html>
