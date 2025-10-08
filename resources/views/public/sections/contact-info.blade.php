{{-- كتلة واحدة: خريطة بالأعلى + تذييل داكن بالأسفل بدون فواصل --}}
<div class="mb-8 rounded-2xl overflow-hidden shadow ring-1 ring-gray-200 dark:ring-slate-700">
  @if(!empty($c['map_embed']))
    <div class="aspect-[4/1] w-full [&_iframe]:w-full [&_iframe]:h-full [&_iframe]:border-0 bg-white dark:bg-slate-900">
      {!! $c['map_embed'] !!}
    </div>
  @else
    <div class="h-72 flex items-center justify-center text-gray-400 dark:text-slate-500 text-sm bg-white dark:bg-slate-900">
      @tr('Map will appear here once added.')
    </div>
  @endif

  {{-- التذييل الداكن ملتحم بالخريطة (لا margin ولا radius إضافي) --}}
  <div class="bg-slate-900 text-slate-100 px-6 py-8 md:py-10">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

      {{-- العنوان --}}
      <div class="flex items-start gap-4">
        <span class="inline-flex h-10 w-10 rounded-xl bg-slate-800 items-center justify-center shrink-0">
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

      {{-- الهاتف --}}
      <div class="flex items-start gap-4">
        <span class="inline-flex h-10 w-10 rounded-xl bg-slate-800 items-center justify-center shrink-0">
          <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h1.6a2 2 0 011.94 1.515l.6 2.4a2 2 0 01-.51 1.93L7.8 10.67a14 14 0 006.53 6.53l1.825-1.83a2 2 0 011.93-.51l2.4.6A2 2 0 0121 17.4V19a2 2 0 01-2 2h-.5C9.61 21 3 14.39 3 6.5V6a2 2 0 010-1z"/>
          </svg>
        </span>
        <div>
          <p class="text-slate-400 text-sm mb-1">@tr('Phone')</p>
          @if(!empty($c['phone']))
            <div class="flex flex-wrap items-center gap-3">
              <a href="tel:{{ $c['phone'] }}" class="font-medium hover:underline">{{ $c['phone'] }}</a>
              <a href="https://wa.me/{{ preg_replace('/\D+/', '', $c['phone']) }}"
                 class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs bg-green-600/15 text-green-300 hover:bg-green-600/25"
                 target="_blank" rel="noopener">WhatsApp</a>
            </div>
          @else
            <p class="font-medium">088-777-666-85</p>
          @endif
        </div>
      </div>

      {{-- البريد + السوشيال --}}
      <div class="flex items-start gap-4">
        <span class="inline-flex h-10 w-10 rounded-xl bg-slate-800 items-center justify-center shrink-0">
          <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l9 6 9-6M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
          </svg>
        </span>
        <div class="w-full">
          <p class="text-slate-400 text-sm mb-1">@tr('Email')</p>
          <p class="font-medium">
            @if(!empty($c['email']))
              <a href="mailto:{{ $c['email'] }}" class="hover:underline">{{ $c['email'] }}</a>
            @else
              <a href="mailto:contact@vegan.com" class="hover:underline">contact@vegan.com</a>
            @endif
          </p>

          @php($hasSocial = !empty($c['facebook']) || !empty($c['twitter']) || !empty($c['instagram']) || !empty($c['linkedin']))
          <div class="mt-3 flex flex-wrap gap-3">
            @foreach ([
              'facebook' => 'M13 3h4v4h-4v3h3.5l-.5 4H13v8h-4v-8H7v-4h2V7.5A4.5 4.5 0 0113 3z',
              'twitter'  => 'M22 5.8a8.2 8.2 0 01-2.36.65 4.1 4.1 0 001.8-2.26 8.2 8.2 0 01-2.6 1 4.1 4.1 0 00-7 3.74A11.7 11.7 0 013 5.15a4.1 4.1 0 001.27 5.48 4 4 0 01-1.85-.5v.05a4.1 4.1 0 003.3 4 4.1 4.1 0 01-1.85.07 4.1 4.1 0 003.83 2.85A8.23 8.23 0 012 19.54 11.6 11.6 0 008.29 21c7.55 0 11.68-6.26 11.68-11.68 0-.18 0-.35-.01-.53A8.3 8.3 0 0022 5.8z',
              'instagram'=> 'M7 2h10a5 5 0 015 5v10a5 5 0 01-5 5H7a5 5 0 01-5-5V7a5 5 0 015-5zm10 2a3 3 0 013 3v10a3 3 0 01-3 3H7a3 3 0 01-3-3V7a3 3 0 013-3h10zM12 7.5a5.5 5.5 0 110 11 5.5 5.5 0 010-11zm5.75 1a1 1 0 110 2 1 1 0 010-2z',
              'linkedin' => 'M4 3a2 2 0 110 4 2 2 0 010-4zM3 8h3v13H3V8zm6 0h3v1.8h.05A3.3 3.3 0 0115.8 8c3.2 0 3.8 2.1 3.8 4.8V21h-3v-6.5c0-1.6 0-3.7-2.2-3.7s-2.5 1.7-2.5 3.6V21H9V8z'
            ] as $s => $d)
              @php($url = $c[$s] ?? null)
              @if($url)
                <a href="{{ $url }}" target="_blank" rel="noopener"
                   class="inline-flex items-center justify-center h-9 w-9 rounded-lg bg-slate-800 hover:bg-slate-700">
                  <svg class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor"><path d="{{ $d }}"/></svg>
                  <span class="sr-only">{{ ucfirst($s) }}</span>
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
