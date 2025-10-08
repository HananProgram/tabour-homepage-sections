<section class="py-20 bg-gradient-to-b from-blue-50 to-white dark:from-slate-900 dark:to-slate-950"
         dir="{{ app()->getLocale()==='ar' ? 'rtl' : 'ltr' }}">
  <div class="mx-auto max-w-7xl px-6">
    {{-- Hero header --}}
    <div class="text-center mb-12">
      <h1 class="text-4xl md:text-5xl font-extrabold tracking-tight text-slate-900 dark:text-white">
        {{ trk('homepage.contact.title.'.$section->id, $section->title ?? __('Contact Us')) }}
      </h1>
      @if(filled($section->subtitle))
        <p class="mt-3 max-w-2xl mx-auto text-slate-600 dark:text-slate-300">
          {{ trk('homepage.contact.subtitle.'.$section->id, $section->subtitle) }}
        </p>
      @endif
    </div>

    @php($c = (is_array($section->content) ? $section->content : (json_decode($section->content, true) ?? []))['contact'] ?? [])
    {{-- Layout like the reference: left info + map, right form --}}
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
      {{-- Left: info cards + map --}}
      <div class="lg:col-span-5 space-y-6">
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
          @if(!empty($c['phone']))
            <div class="rounded-2xl bg-white shadow-sm ring-1 ring-blue-100 p-6 hover:shadow-md transition">
              <div class="flex items-start gap-3">
                <span class="inline-flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-blue-100 text-blue-700">
                  {{-- phone icon --}}
                  <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M3 5a2 2 0 012-2h1.6a2 2 0 011.94 1.515l.6 2.4a2 2 0 01-.51 1.93L7.8 10.67a14 14 0 006.53 6.53l1.825-1.83a2 2 0 011.93-.51l2.4.6A2 2 0 0121 17.4V19a2 2 0 01-2 2h-.5C9.61 21 3 14.39 3 6.5V6a2 2 0 010-1z"/>
                  </svg>
                </span>
                <div>
                  <p class="text-sm text-slate-500">@tr('Phone')</p>
                  <a href="tel:{{ $c['phone'] }}" class="font-semibold text-slate-900 hover:text-blue-700">
                    {{ $c['phone'] }}
                  </a>
                </div>
              </div>
            </div>
          @endif

          @if(!empty($c['whatsapp'] ?? $c['phone']))
            @php($wa = preg_replace('/\D+/', '', $c['whatsapp'] ?? $c['phone']))
            <a href="https://wa.me/{{ $wa }}" target="_blank" rel="noopener"
               class="rounded-2xl bg-white shadow-sm ring-1 ring-green-100 p-6 hover:shadow-md transition block">
              <div class="flex items-start gap-3">
                <span class="inline-flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-green-100 text-green-700">
                  {{-- whatsapp --}}
                  <svg class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M20.5 3.5A11 11 0 1 0 4 20l-1 3 3-1a11 11 0 1 0 14.5-18.5zM6.8 18.1l.3.2a8.9 8.9 0 1 1 3.5 1l-.3-.2-2 .7.5-1.7z"/>
                  </svg>
                </span>
                <div>
                  <p class="text-sm text-slate-500">WhatsApp</p>
                  <p class="font-semibold text-slate-900">+{{ $wa }}</p>
                </div>
              </div>
            </a>
          @endif

          @if(!empty($c['email']))
            <div class="rounded-2xl bg-white shadow-sm ring-1 ring-blue-100 p-6 hover:shadow-md transition">
              <div class="flex items-start gap-3">
                <span class="inline-flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-blue-100 text-blue-700">
                  {{-- email --}}
                  <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M3 8l9 6 9-6M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                  </svg>
                </span>
                <div>
                  <p class="text-sm text-slate-500">@tr('Email')</p>
                  <a href="mailto:{{ $c['email'] }}" class="font-semibold text-slate-900 hover:text-blue-700">
                    {{ $c['email'] }}
                  </a>
                </div>
              </div>
            </div>
          @endif

          @if(!empty($c['address']))
            <div class="rounded-2xl bg-white shadow-sm ring-1 ring-blue-100 p-6 hover:shadow-md transition">
              <div class="flex items-start gap-3">
                <span class="inline-flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-blue-100 text-blue-700">
                  {{-- shop --}}
                  <svg class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M4 7h16l-1 11a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2L4 7zm16-2H4l1.5-3h13L20 5z"/>
                  </svg>
                </span>
                <div>
                  <p class="text-sm text-slate-500">@tr('Our Shop')</p>
                  <p class="font-semibold text-slate-900">{{ $c['address'] }}</p>
                </div>
              </div>
            </div>
          @endif
        </div>

        {{-- Map (wide like the screenshot) --}}
        <div class="rounded-2xl bg-white shadow-sm ring-1 ring-blue-100 p-3">
          @if(!empty($c['map_embed']))
            <div class="aspect-video w-full overflow-hidden rounded-xl [&_iframe]:w-full [&_iframe]:h-full [&_iframe]:border-0">
              {!! $c['map_embed'] !!}
            </div>
          @else
            <div class="h-[320px] flex items-center justify-center text-slate-400">@tr('Map will appear here once added.')</div>
          @endif
        </div>
      </div>

      {{-- Right: form --}}
      <div class="lg:col-span-7">
        <div class="rounded-3xl bg-white shadow-sm ring-1 ring-blue-100 p-8">
          <h2 class="text-3xl font-extrabold text-slate-900 mb-2">@tr('Get In Touch')</h2>
          <p class="text-slate-600 mb-6">{{ $c['intro'] ?? '' }}</p>

          <form method="POST" action="{{ $c['form_action'] ?? route('contact.send', [], false) }}">
            @csrf
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
              <div>
                <label class="block text-sm text-slate-600 mb-1">@tr('Name')</label>
                <input name="name" required class="w-full rounded-xl border-slate-200 focus:border-blue-500 focus:ring-blue-500" />
              </div>
              <div>
                <label class="block text-sm text-slate-600 mb-1">@tr('Email')</label>
                <input type="email" name="email" required class="w-full rounded-xl border-slate-200 focus:border-blue-500 focus:ring-blue-500" />
              </div>
              <div class="sm:col-span-2">
                <label class="block text-sm text-slate-600 mb-1">@tr('Subject')</label>
                <input name="subject" class="w-full rounded-xl border-slate-200 focus:border-blue-500 focus:ring-blue-500" />
              </div>
              <div class="sm:col-span-2">
                <label class="block text-sm text-slate-600 mb-1">@tr('Message')</label>
                <textarea name="message" rows="5" class="w-full rounded-xl border-slate-200 focus:border-blue-500 focus:ring-blue-500"></textarea>
              </div>
            </div>

            <div class="mt-6">
              <button type="submit"
                      class="inline-flex items-center justify-center rounded-xl px-6 py-3 font-semibold text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-600">
                @tr('Send Now')
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
