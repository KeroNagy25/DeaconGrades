@extends('layouts.student')
@section('title', 'Result - St John Deacon School')
@section('content')

<div class="max-w-2xl mx-auto mt-16 p-6">
    <!-- Header Quote -->
    <h2 class="text-2xl md:text-3xl font-bold mb-6 text-center text-red-900 leading-relaxed">
        <p class="quote italic text-gray-700">"أَيُّهَا الْحَبِيبُ، فِي كُلِّ شَيْءٍ أَرُومُ أَنْ تَكُونَ نَاجِحًا وَصَحِيحًا، كَمَا أَنَّ نَفْسَكَ نَاجِحَةٌ." (3 يو 1:2)</p>
        <span class="block mt-3 text-red-900 font-semibold text-lg">نتيجة مدرسة الشمامسة الترم الاول عام 2025-2026م</span>
    </h2>
    @if(session('noResult'))
    <div class="bg-red-50 border-l-4 border-red-600 text-red-800 p-4 rounded-lg shadow text-center font-semibold mt-4">
        {{ session('noResult') }}
    </div>
@endif

    <!-- Search Form Card -->
    <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-200">
        <h3 class="text-xl md:text-2xl font-bold mb-4 text-center text-red-900">
            🔍 الاستعلام عن النتيجة
        </h3>

        <form action="{{ route('student.search') }}" method="GET" class="flex flex-col gap-4">
            <input type="text"
                   name="query"
                   value="{{ old('query') }}"
                   placeholder="اكتب اسمك أو رقم التليفون"
                   class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-900 transition-shadow duration-200 @error('query') border-red-500 @enderror">
            
            <!-- Validation Error Message -->
            @error('query')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror

            <button type="submit"
                    class="w-full bg-red-900 hover:bg-red-800 text-white py-3 rounded-lg font-semibold shadow-md transition-transform duration-200 transform hover:scale-105">
                عرض النتيجة
            </button>
        </form>
        
    </div>
</div>

@endsection
