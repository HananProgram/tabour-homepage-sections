<section class="py-20 bg-white">
  <div class="container mx-auto px-6">
    <div class="text-center mb-10">
      <h3 class="text-3xl font-bold text-gray-800">
        {{ trk('homepage.contact.title.'.$section->id, $section->title ?? @tr('Contact Us')) }}
      </h3>
      @if(!empty($section->subtitle))
        <p class="text-gray-600 mt-2">
          {{ trk('homepage.contact.subtitle.'.$section->id, $section->subtitle) }}
        </p>
      @endif
    </div>

    @php($c = $section->content['contact'] ?? [])
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
      <div class="space-y-4">
        @if(!empty($c['address']))
          <p class="flex items-start">
            <span class="font-semibold w-24">@tr('Address')</span>
            <span class="text-gray-700">{{ $c['address'] }}</span>
          </p>
        @endif

        @if(!empty($c['phone']))
          <p class="flex items-start">
            <span class="font-semibold w-24">@tr('Phone')</span>
            <a href="tel:{{ $c['phone'] }}" class="text-blue-600 hover:underline">{{ $c['phone'] }}</a>
          </p>
        @endif

        @if(!empty($c['email']))
          <p class="flex items-start">
            <span class="font-semibold w-24">@tr('Email')</span>
            <a href="mailto:{{ $c['email'] }}" class="text-blue-600 hover:underline">{{ $c['email'] }}</a>
          </p>
        @endif

        @if(!empty($c['website']))
          <p class="flex items-start">
            <span class="font-semibold w-24">@tr('Website')</span>
            <a href="{{ $c['website'] }}" target="_blank" rel="noopener" class="text-blue-600 hover:underline">
              {{ $c['website'] }}
            </a>
          </p>
        @endif

        @php($hasSocial = !empty($c['facebook']) || !empty($c['twitter']) || !empty($c['instagram']) || !empty($c['linkedin']))
        @if($hasSocial)
          <div class="pt-2">
            <p class="font-semibold mb-2">@tr('Follow us')</p>
            <div class="flex flex-wrap gap-3">
              @foreach (['facebook','twitter','instagram','linkedin'] as $s)
                @if(!empty($c[$s]))
                  <a href="{{ $c[$s] }}" target="_blank" rel="noopener" class="text-blue-600 hover:underline capitalize">{{ $s }}</a>
                @endif
              @endforeach
            </div>
          </div>
        @endif
      </div>

      <div>
        @if(!empty($c['map_embed']))
          <div class="rounded-lg overflow-hidden shadow">
            {!! $c['map_embed'] !!}
          </div>
        @endif
      </div>
    </div>
  </div>
</section>
