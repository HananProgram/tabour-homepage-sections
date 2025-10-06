<section class="bg-white">
    <div class="container mx-auto px-6 py-24 text-center">
        <h2 class="text-4xl md:text-6xl font-extrabold text-gray-900 leading-tight">
            {{ trk('homepage.hero.title.'.$section->id, $section->title ?? '') }}
        </h2>
        <p class="mt-6 text-lg text-gray-600 max-w-3xl mx-auto">
            {{ trk('homepage.hero.subtitle.'.$section->id, $section->subtitle ?? '') }}
        </p>
        <div class="mt-10">
            @if(!empty($isFirstHero) && $isFirstHero)
            <a href="{{ route('application.show') }}" class="inline-block gradient-bg text-white font-bold text-lg px-8 py-4 rounded-lg shadow-lg hover:opacity-90 transform hover:-translate-y-1 transition duration-300">
                @tr('Get Started for Free!')
            </a>
            @endif
        </div>
        @if($section->image_path)
            <div class="mt-12">
                <img
                    src="{{ Illuminate\Support\Facades\Storage::url($section->image_path) }}"
                    alt="{{ trk('homepage.hero.title.'.$section->id, $section->title ?? '') }}"
                    class="mx-auto rounded-lg shadow-xl w-full max-w-4xl">
            </div>
        @endif
    </div>
</section>
