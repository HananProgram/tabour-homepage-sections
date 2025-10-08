<section class="py-20 bg-gradient-to-b from-gray-50 to-white dark:from-slate-900 dark:to-slate-950"
         dir="{{ app()->getLocale()==='ar' ? 'rtl' : 'ltr' }}">
  <div class="mx-auto max-w-7xl px-6">
    {{-- Header --}}
    <div class="text-center mb-12">
      <h3 class="text-3xl md:text-4xl font-extrabold tracking-tight text-gray-900 dark:text-white">
        {{ trk('homepage.contact.title.'.$section->id, $section->title ?? __('Contact Us')) }}
      </h3>
      @if(filled($section->subtitle))
        <p class="mt-3 max-w-2xl mx-auto text-gray-600 dark:text-slate-300">
          {{ trk('homepage.contact.subtitle.'.$section->id, $section->subtitle) }}
        </p>
      @endif
    </div>

    @php($c = (is_array($section->content) ? $section->content : (json_decode($section->content, true) ?? []))['contact'] ?? [])
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 max-w-6xl mx-auto">

      {{-- Card: Contact details --}}
      <div class="bg-white/80 dark:bg-slate-900/60 backdrop-blur p-6 md:p-8 rounded-2xl shadow-sm ring-1 ring-gray-200 dark:ring-slate-700">
        <ul class="space-y-5">
          @if(!empty($c['address']))
            <li class="flex items-start gap-3">
              <span class="inline-flex h-10 w-10 rounded-xl bg-blue-50 dark:bg-blue-900/40 items-center justify-center">
                <svg class="h-5 w-5 text-blue-600 dark:text-blue-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11.5a3 3 0 100-6 3 3 0 000 6z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.5 10.5c0 7-7.5 11-7.5 11s-7.5-4-7.5-11a7.5 7.5 0 1115 0z"/></svg>
              </span>
              <div>
                <p class="text-xs text-gray-500 dark:text-slate-400">@tr('Address')</p>
                <p class="font-medium text-gray-900 dark:text-white">{{ $c['address'] }}</p>
              </div>
            </li>
          @endif

          @if(!empty($c['phone']))
            <li class="flex items-start gap-3">
              <span class="inline-flex h-10 w-10 rounded-xl bg-blue-50 dark:bg-blue-900/40 items-center justify-center">
                <svg class="h-5 w-5 text-blue-600 dark:text-blue-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h1.6a2 2 0 011.94 1.515l.6 2.4a2 2 0 01-.51 1.93L7.8 10.67a14 14 0 006.53 6.53l1.825-1.83a2 2 0 011.93-.51l2.4.6A2 2 0 0121 17.4V19a2 2 0 01-2 2h-.5C9.61 21 3 14.39 3 6.5V6a2 2 0 010-1z"/></svg>
              </span>
              <div>
                <p class="text-xs text-gray-500 dark:text-slate-400">@tr('Phone')</p>
                <div class="flex flex-wrap items-center gap-2">
                  <a href="tel:{{ $c['phone'] }}" class="font-medium text-blue-600 hover:underline">
                    {{ $c['phone'] }}
                  </a>
                  {{-- WhatsApp shortcut if phone present --}}
                  <a href="https://wa.me/{{ preg_replace('/\D+/', '', $c['phone']) }}"
                     class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs bg-green-50 text-green-700 hover:bg-green-100 dark:bg-green-900/30 dark:text-green-300"
                     target="_blank" rel="noopener" aria-label="WhatsApp">
                    <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="currentColor"><path d="M20.5 3.5A11 11 0 1 0 4 20l-1 3 3-1a11 11 0 1 0 14.5-18.5zM6.8 18.1l.3.2a8.9 8.9 0 1 1 3.5 1l-.3-.2-2 .7.5-1.7zM8.9 8.8c.2-.5.3-.5.6-.5h.5c.2 0 .4 0 .5.4s.6 1.5.7 1.8c.1.3 0 .4-.1.6l-.3.4c-.1.1-.3.3-.1.6.2.3.9 1.4 2.1 2.3 1.4 1 1.7.8 2 .7l.5-.3c.2-.1.3 0 .5.1.2.2 1.2.6 1.4.7.3.1.4.1.5.2s.1.9-.2 1.7c-.3.7-1.3 1-2.2.7-1-.3-2.2-.8-3.5-1.8-1.2-.9-2.6-2.6-3-3.3-.3-.7-.6-1.8-.3-2.5z"/></svg>
                    WhatsApp
                  </a>
                </div>
              </div>
            </li>
          @endif

          @if(!empty($c['email']))
            <li class="flex items-start gap-3">
              <span class="inline-flex h-10 w-10 rounded-xl bg-blue-50 dark:bg-blue-900/40 items-center justify-center">
                <svg class="h-5 w-5 text-blue-600 dark:text-blue-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l9 6 9-6M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
              </span>
              <div>
                <p class="text-xs text-gray-500 dark:text-slate-400">@tr('Email')</p>
                <a href="mailto:{{ $c['email'] }}" class="font-medium text-blue-600 hover:underline">{{ $c['email'] }}</a>
              </div>
            </li>
          @endif

          @if(!empty($c['website']))
            <li class="flex items-start gap-3">
              <span class="inline-flex h-10 w-10 rounded-xl bg-blue-50 dark:bg-blue-900/40 items-center justify-center">
                <svg class="h-5 w-5 text-blue-600 dark:text-blue-300" viewBox="0 0 24 24" fill="none" stroke="currentColor"><circle cx="12" cy="12" r="9" stroke-width="2"/><path d="M3 12h18M12 3a15.3 15.3 0 010 18M12 3a15.3 15.3 0 000 18" stroke-width="2"/></svg>
              </span>
              <div>
                <p class="text-xs text-gray-500 dark:text-slate-400">@tr('Website')</p>
                <a href="{{ $c['website'] }}" target="_blank" rel="noopener" class="font-medium text-blue-600 hover:underline">
                  {{ $c['website'] }}
                </a>
              </div>
            </li>
          @endif
        </ul>

        {{-- Socials --}}
        @php($hasSocial = !empty($c['facebook']) || !empty($c['twitter']) || !empty($c['instagram']) || !empty($c['linkedin']))
        @if($hasSocial)
          <div class="mt-8">
            <p class="text-sm text-gray-500 dark:text-slate-400 mb-3">@tr('Follow us')</p>
            <div class="flex flex-wrap gap-3">
              @foreach (['facebook','twitter','instagram','linkedin'] as $s)
                @if(!empty($c[$s]))
                  <a href="{{ $c[$s] }}" target="_blank" rel="noopener"
                     class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm dark:bg-slate-800 dark:hover:bg-slate-700 dark:text-slate-200">
                    @switch($s)
                      @case('facebook')  <svg class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor"><path d="M13 3h4v4h-4v3h3.5l-.5 4H13v8h-4v-8H7v-4h2V7.5A4.5 4.5 0 0113 3z"/></svg> @break
                      @case('twitter')   <svg class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor"><path d="M22 5.8a8.2 8.2 0 01-2.36.65 4.1 4.1 0 001.8-2.26 8.2 8.2 0 01-2.6 1 4.1 4.1 0 00-7 3.74A11.7 11.7 0 013 5.15a4.1 4.1 0 001.27 5.48 4 4 0 01-1.85-.5v.05a4.1 4.1 0 003.3 4 4.1 4.1 0 01-1.85.07 4.1 4.1 0 003.83 2.85A8.23 8.23 0 012 19.54 11.6 11.6 0 008.29 21c7.55 0 11.68-6.26 11.68-11.68 0-.18 0-.35-.01-.53A8.3 8.3 0 0022 5.8z"/></svg> @break
                      @case('instagram') <svg class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor"><path d="M7 2h10a5 5 0 015 5v10a5 5 0 01-5 5H7a5 5 0 01-5-5V7a5 5 0 015-5zm10 2a3 3 0 013 3v10a3 3 0 01-3 3H7a3 3 0 01-3-3V7a3 3 0 013-3h10zM12 7.5a5.5 5.5 0 110 11 5.5 5.5 0 010-11zm5.75 1a1 1 0 110 2 1 1 0 010-2z"/></svg> @break
                      @case('linkedin')  <svg class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor"><path d="M4 3a2 2 0 110 4 2 2 0 010-4zM3 8h3v13H3V8zm6 0h3v1.8h.05A3.3 3.3 0 0115.8 8c3.2 0 3.8 2.1 3.8 4.8V21h-3v-6.5c0-1.6 0-3.7-2.2-3.7s-2.5 1.7-2.5 3.6V21H9V8z"/></svg> @break
                    @endswitch
                    <span class="capitalize">{{ $s }}</span>
                  </a>
                @endif
              @endforeach
            </div>
          </div>
        @endif
      </div>

      {{-- Card: Map --}}
      <div class="bg-white/80 dark:bg-slate-900/60 backdrop-blur p-3 rounded-2xl shadow-sm ring-1 ring-gray-200 dark:ring-slate-700">
        @if(!empty($c['map_embed']))
          <div class="aspect-video w-full overflow-hidden rounded-xl [&_iframe]:w-full [&_iframe]:h-full [&_iframe]:border-0">
            {!! $c['map_embed'] !!}
          </div>
        @else
          <div class="h-full min-h-[300px] flex items-center justify-center text-gray-400 dark:text-slate-500">
            @tr('Map will appear here once added.')
          </div>
        @endif
      </div>
    </div>
  </div>
</section>
