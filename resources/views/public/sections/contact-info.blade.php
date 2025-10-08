@php(
  $c = (is_array($section->content) ? $section->content : (json_decode($section->content, true) ?? []))['contact'] ?? []
)

{{-- عنوان ووصف اختياري وصورة هيدر اختيارية --}}
<section class="py-12 md:py-16 bg-gradient-to-b from-blue-50 to-white dark:from-slate-900 dark:to-slate-950"
         dir="{{ app()->getLocale()==='ar' ? 'rtl' : 'ltr' }}">
  <div class="mx-auto max-w-7xl px-6">
    <div class="text-center mb-8">
      <h2 class="text-3xl md:text-4xl font-extrabold tracking-tight text-slate-900 dark:text-white">
        {{ trk('homepage.contact.title.'.$section->id, $section->title ?? __('Contact Us')) }}
      </h2>
      @if(filled($section->subtitle))
        <p class="mt-3 max-w-2xl mx-auto text-slate-600 dark:text-slate-300">
          {{ trk('homepage.contact.subtitle.'.$section->id, $section->subtitle) }}
        </p>
      @endif
      @if(!empty($section->image_path))
        <div class="mt-6 flex justify-center">
          <img src="{{ asset($section->image_path) }}" alt="Contact" class="w-full max-w-3xl rounded-2xl shadow-sm ring-1 ring-slate-200 dark:ring-slate-700 object-cover">
        </div>
      @endif
    </div>
  </div>
</section>

{{-- كتلة كاملة العرض: الخريطة بالأعلى (إن وجدت) وشريط داكن ملتصق بالـfooter --}}
<div class="relative left-1/2 right-1/2 -ml-[50vw] -mr-[50vw] w-screen bg-gray-800">


  {{-- الشريط الداكن --}}
  <div class="px-6 md:px-10 py-8 md:py-10 text-slate-100">
    <div class="mx-auto max-w-7xl grid grid-cols-1 md:grid-cols-3 gap-8">

      {{-- Address --}}
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

      {{-- Phone --}}
      <div class="flex items-start gap-4">
        <span class="inline-flex h-10 w-10 rounded-xl bg-slate-700 items-center justify-center shrink-0">
          <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h1.6a2 2 0 011.94 1.515l.6 2.4a2 2 0 01-.51 1.93L7.8 10.67a14 14 0 006.53 6.53l1.825-1.83a2 2 0 011.93-.51l2.4.6A2 2 0 0121 17.4V19a2 2 0 01-2 2h-.5C9.61 21 3 14.39 3 6.5V6a2 2 0 010-1z"/>
          </svg>
        </span>
        <div>
          <p class="text-slate-400 text-sm mb-1">@tr('Phone')</p>
          <p class="font-medium">
            @if(!empty($c['phone']))
              <a href="tel:{{ $c['phone'] }}" class="hover:underline">{{ $c['phone'] }}</a>
            @else
              088-777-666-85
            @endif
          </p>
        </div>
      </div>

      {{-- Email + Socials --}}
      <div class="flex items-start gap-4">
        <span class="inline-flex h-10 w-10 rounded-xl bg-slate-700 items-center justify-center shrink-0">
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
  @foreach (['facebook','twitter','instagram','linkedin'] as $s)
    @if(!empty($c[$s]))
      <a href="{{ $c[$s] }}" target="_blank" rel="noopener"
         class="inline-flex items-center justify-center h-9 w-9 rounded-lg bg-slate-700 hover:bg-slate-600"
         aria-label="{{ ucfirst($s) }}">
        @switch($s)
          @case('facebook')
            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor">
              <path d="M13 3h4v4h-4v3h3.5l-.5 4H13v8h-4v-8H7v-4h2V7.5A4.5 4.5 0 0113 3z"/>
            </svg>
          @break
          @case('twitter')
            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor">
              <path d="M22 5.8a8.2 8.2 0 01-2.36.65 4.1 4.1 0 001.8-2.26 8.2 8.2 0 01-2.6 1 4.1 4.1 0 00-7 3.74A11.7 11.7 0 013 5.15a4.1 4.1 0 001.27 5.48 4 4 0 01-1.85-.5v.05a4.1 4.1 0 003.3 4 4.1 4.1 0 01-1.85.07 4.1 4.1 0 003.83 2.85A8.23 8.23 0 012 19.54 11.6 11.6 0 008.29 21c7.55 0 11.68-6.26 11.68-11.68 0-.18 0-.35-.01-.53A8.3 8.3 0 0022 5.8z"/>
            </svg>
          @break
          @case('instagram')
            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor">
              <path d="M7 2h10a5 5 0 015 5v10a5 5 0 01-5 5H7a5 5 0 01-5-5V7a5 5 0 015-5zm0 2a3 3 0 00-3 3v10a3 3 0 003 3h10a3 3 0 003-3V7a3 3 0 00-3-3H7zm5 3.5a5.5 5.5 0 110 11 5.5 5.5 0 010-11zm5.75-.75a1 1 0 110 2 1 1 0 010-2z"/>
            </svg>
          @break
          @case('linkedin')
            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor">
              <path d="M4 3a2 2 0 110 4 2 2 0 010-4zM3 8h3v13H3V8zm6 0h3v1.8h.05A3.3 3.3 0 0115.8 8c3.2 0 3.8 2.1 3.8 4.8V21h-3v-6.5c0-1.6 0-3.7-2.2-3.7s-2.5 1.7-2.5 3.6V21H9V8z"/>
            </svg>
          @break
        @endswitch
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
