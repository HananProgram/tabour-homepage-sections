{{-- Full-bleed block: map on top + dark band stuck to footer --}}
<div class="relative left-1/2 right-1/2 -ml-[50vw] -mr-[50vw] w-screen bg-gray-800">


  {{-- Dark band (same color as footer) --}}
  <div class="px-6 md:px-10 py-8 md:py-10 text-slate-100">
    <div class="mx-auto max-w-7xl grid grid-cols-1 md:grid-cols-3 gap-8">

      <div class="flex items-start gap-4">
        <span class="inline-flex h-10 w-10 rounded-xl bg-slate-700 items-center justify-center shrink-0">
          <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11.5a3 3 0 100-6 3 3 0 000 6z"/>
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.5 10.5c0 7-7.5 11-7.5 11s-7.5-4-7.5-11a7.5 7.5 0 1115 0z"/>
          </svg>
        </span>
        <div>
          <p class="text-slate-400 text-sm mb-1">@tr('Address')</p>
          <p class="font-medium">{{ $c['address'] ?? __('London Eye, London UK') }}</p>
        </div>
      </div>

      <div class="flex items-start gap-4">
        <span class="inline-flex h-10 w-10 rounded-xl bg-slate-700 items-center justify-center shrink-0">
          <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h1.6a2 2 0 011.94 1.515l.6 2.4a2 2 0 01-.51 1.93L7.8 10.67a14 14 0 006.53 6.53l1.825-1.83a2 2 0 011.93-.51l2.4.6A2 2 0 0121 17.4V19a2 2 0 01-2 2h-.5C9.61 21 3 14.39 3 6.5V6a2 2 0 010-1z"/>
          </svg>
        </span>
        <div>
          <p class="text-slate-400 text-sm mb-1">@tr('Phone')</p>
          <p class="font-medium">
            @if(!empty($c['phone'])) <a href="tel:{{ $c['phone'] }}" class="hover:underline">{{ $c['phone'] }}</a>
            @else 088-777-666-85 @endif
          </p>
        </div>
      </div>

      <div class="flex items-start gap-4">
        <span class="inline-flex h-10 w-10 rounded-xl bg-slate-700 items-center justify-center shrink-0">
          <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l9 6 9-6M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
          </svg>
        </span>
        <div class="w-full">
          <p class="text-slate-400 text-sm mb-1">@tr('Email')</p>
          <p class="font-medium">
            @if(!empty($c['email'])) <a href="mailto:{{ $c['email'] }}" class="hover:underline">{{ $c['email'] }}</a>
            @else <a href="mailto:contact@vegan.com" class="hover:underline">contact@vegan.com</a> @endif
          </p>

          @php($hasSocial = !empty($c['facebook']) || !empty($c['twitter']) || !empty($c['instagram']) || !empty($c['linkedin']))
          <div class="mt-3 flex flex-wrap gap-3">
            @foreach (['facebook','twitter','instagram','linkedin'] as $s)
              @if(!empty($c[$s]))
                <a href="{{ $c[$s] }}" target="_blank" rel="noopener"
                   class="inline-flex items-center justify-center h-9 w-9 rounded-lg bg-slate-700 hover:bg-slate-600">
                  <span class="sr-only">{{ ucfirst($s) }}</span>
                  {{-- ضع الأيقونة التي تريدها هنا --}}
                </a>
              @endif
            @endforeach
            @unless($hasSocial)
              <span class="text-slate-400 text-sm">@tr('Add your social links in settings')</span>
            @endunless
          </div>
        </div>
      </div>

    </div>
  </div>
</div>
