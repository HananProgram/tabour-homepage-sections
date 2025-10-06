{{-- resources/views/homepage-sections/feature-grid.blade.php --}}

<section class="py-20 bg-gray-50">
    <div class="container mx-auto px-6">
        <div class="text-center mb-16">
            <h3 class="text-3xl font-bold text-gray-800">
                {{ trk('homepage.feature_grid.title.'.$section->id, $section->title ?? '') }}
            </h3>
            <p class="text-gray-600 mt-2">
                {{ trk('homepage.feature_grid.subtitle.'.$section->id, $section->subtitle ?? '') }}
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
            @foreach(($section->content['features'] ?? []) as $i => $feature)
                @php
                    $ftitle = $feature['title'] ?? '';
                    $fdesc  = $feature['description'] ?? '';
                @endphp
                @if(!empty($ftitle))
                    <div class="text-center">
                        @if(!empty($feature['image_path']))
                            {{-- LARGER, SQUARE IMAGE --}}
                            <img
                                src="{{ Illuminate\Support\Facades\Storage::url($feature['image_path']) }}"
                                alt="{{ trk('homepage.feature_grid.feature_title.'.$section->id.'.'.$i, $ftitle) }}"
                                class="h-48 w-full rounded-lg mx-auto mb-4 object-cover">
                        @else
                            {{-- Default Icon --}}
                            <div class="flex items-center justify-center h-16 w-16 rounded-full bg-blue-100 text-blue-600 mx-auto mb-4">
                               <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path></svg>
                            </div>
                        @endif

                        <h4 class="text-xl font-semibold text-gray-800">
                            {{ trk('homepage.feature_grid.feature_title.'.$section->id.'.'.$i, $ftitle) }}
                        </h4>
                        <p class="mt-2 text-gray-600">
                            {{ trk('homepage.feature_grid.feature_desc.'.$section->id.'.'.$i, $fdesc) }}
                        </p>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</section>
