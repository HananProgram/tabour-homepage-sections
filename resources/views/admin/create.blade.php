@extends('layouts.superadmin')

@section('content')
<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">@tr('Add New Homepage Section')</h1>
        <a href="{{ route('superadmin.homepage-sections.index') }}" class="text-blue-600 hover:underline">&larr; @tr('Back to Sections')</a>
    </div>

    @if ($errors->any())
        <div class="p-4 mb-6 text-sm text-red-800 rounded-lg bg-red-50" role="alert">
            <span class="font-medium">@tr('Please fix the following errors:')</span>
            <ul class="mt-1.5 list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('superadmin.homepage-sections.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="bg-white p-6 rounded-lg shadow-md space-y-6">
            {{-- Main Section Details --}}
            <div>
                <label for="section-type-select" class="block font-medium">@tr('Section Type')</label>
               <select name="type" id="section-type-select" class="w-full border p-2 rounded mt-1" required>
                    <option value="hero" @if(old('type') == 'hero') selected @endif>@tr('Hero Section')</option>
                    <option value="feature_grid" @if(old('type') == 'feature_grid') selected @endif>@tr('Feature Grid')</option>
                    <option value="cta" @if(old('type') == 'cta') selected @endif>@tr('Call to Action')</option>
                    <option value="contact_info" @if(old('type') == 'contact_info') selected @endif>@tr('Contact Information')</option>
                </select>

            </div>

            <div>
                <label for="title" class="block font-medium">@tr('Title')</label>
                <input type="text" name="title" value="{{ old('title') }}" class="w-full border p-2 rounded mt-1" placeholder="@tr('Title')">
            </div>

            <div>
                <label for="subtitle" class="block font-medium">@tr('Subtitle / Description')</label>
                <textarea name="subtitle" rows="4" class="w-full border p-2 rounded mt-1" placeholder="@tr('Subtitle / Description')">{{ old('subtitle') }}</textarea>
            </div>

            {{-- Main Image --}}
            <div id="main-image-container">
                <label for="image" class="block font-medium">@tr('Main Image (for Hero/CTA)')</label>
                <input type="file" name="image" class="w-full border p-2 rounded mt-1">
            </div>

            {{-- Feature Grid --}}
            <div id="featureGridContainer" class="bg-gray-50 p-4 rounded-lg border" style="display: none;">
                <h3 class="text-lg font-semibold text-gray-700 mb-4">@tr('Features')</h3>
                @for ($i = 0; $i < 3; $i++)
                    <div class="border-t pt-4 mt-4">
                        <p class="font-medium">@tr('Feature') {{ $i + 1 }}</p>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-2">
                            <input type="text" name="features[{{ $i }}][title]" placeholder="@tr('Feature Title')" class="w-full border p-2 rounded">
                            <input type="text" name="features[{{ $i }}][description]" placeholder="@tr('Feature Description')" class="w-full border p-2 rounded">
                        </div>
                        <div class="mt-2">
                            <label class="block text-sm font-medium">@tr('Image (Optional)')</label>
                            <input type="file" name="features[{{ $i }}][image]" class="w-full border p-2 rounded mt-1 text-sm">
                        </div>
                    </div>
                @endfor
            </div>
        </div> <!-- نهاية featureGridContainer -->

        {{-- Contact Info --}}
        <div id="contactInfoContainer" class="bg-gray-50 p-4 rounded-lg border" style="display:none;">
        <h3 class="text-lg font-semibold text-gray-700 mb-4">@tr('Contact Information')</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <input type="text" name="contact[address]"      value="{{ old('contact.address') }}"      placeholder="@tr('Address')"      class="w-full border p-2 rounded">
            <input type="text" name="contact[phone]"        value="{{ old('contact.phone') }}"        placeholder="@tr('Phone')"        class="w-full border p-2 rounded">
            <input type="email" name="contact[email]"       value="{{ old('contact.email') }}"        placeholder="@tr('Email')"        class="w-full border p-2 rounded">
            <input type="url"   name="contact[website]"     value="{{ old('contact.website') }}"      placeholder="@tr('Website URL')" class="w-full border p-2 rounded">
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
            <input type="url" name="contact[facebook]"  value="{{ old('contact.facebook') }}"  placeholder="@tr('Facebook URL')"  class="w-full border p-2 rounded">
            <input type="url" name="contact[twitter]"   value="{{ old('contact.twitter') }}"   placeholder="@tr('X/Twitter URL')" class="w-full border p-2 rounded">
            <input type="url" name="contact[instagram]" value="{{ old('contact.instagram') }}" placeholder="@tr('Instagram URL')" class="w-full border p-2 rounded">
            <input type="url" name="contact[linkedin]"  value="{{ old('contact.linkedin') }}"  placeholder="@tr('LinkedIn URL')"  class="w-full border p-2 rounded">
        </div>

        </div>

            <div class="text-right">
                <button type="submit" class="bg-blue-600 text-white font-bold px-6 py-2 rounded-lg hover:bg-blue-700">
                    @tr('Create Section')
                </button>
            </div>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const sectionTypeSelect = document.getElementById('section-type-select');
        const mainImageContainer = document.getElementById('main-image-container');
        const featureGridContainer = document.getElementById('featureGridContainer');
        const contactInfoContainer = document.getElementById('contactInfoContainer');

       function updateFormVisibility() {
    const selectedType = sectionTypeSelect.value;

    // Toggle Main Image visibility
    if (selectedType === 'feature_grid' || selectedType === 'contact_info') {
        mainImageContainer.style.display = 'none';
    } else {
        mainImageContainer.style.display = 'block';
    }

    // Feature Grid visibility
    if (selectedType === 'feature_grid') {
        featureGridContainer.style.display = 'block';
    } else {
        featureGridContainer.style.display = 'none';
    }

    // Contact Info visibility
    if (selectedType === 'contact_info') {
        contactInfoContainer.style.display = 'block';
    } else {
        contactInfoContainer.style.display = 'none';
    }
}


        // Initial state
        updateFormVisibility();

        // On change
        sectionTypeSelect.addEventListener('change', updateFormVisibility);
    });
</script>
@endpush
