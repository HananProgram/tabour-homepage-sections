{{-- resources/views/homepage-sections/cta.blade.php --}}

<section class="gradient-bg relative py-20 text-white overflow-hidden">
    {{-- Background Image --}}
    @if($section->image_path)
        <div class="absolute inset-0">
            <img src="{{ Illuminate\Support\Facades\Storage::url($section->image_path) }}" class="w-full h-full object-cover opacity-20">
        </div>
    @endif
    
    <div class="container mx-auto px-6 text-center relative z-10">
        <h3 class="text-3xl font-bold">
            {{ trk('homepage.cta.title.'.$section->id, $section->title) }}
        </h3>
        @if(filled($section->subtitle))
            <p class="mt-4 max-w-2xl mx-auto">
                {{ trk('homepage.cta.subtitle.'.$section->id, $section->subtitle) }}
            </p>
        @endif
        <div class="mt-8">
            <a href="{{ route('application.show') }}" class="inline-block bg-white text-blue-600 font-bold text-lg px-8 py-4 rounded-lg shadow-lg hover:bg-gray-100 transition duration-300">
                {{ tr('Apply to Join Now!') }}
            </a>
        </div>
    </div>
</section>
