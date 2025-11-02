@extends('layouts.superadmin')

@section('content')
<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">@tr('Edit Section')</h1>
        <a href="{{ route('superadmin.homepage-sections.index') }}" class="text-blue-600 hover:underline">&larr; @tr('Back to Sections')</a>
    </div>

  

    {{-- Main form --}}
    <form action="{{ route('superadmin.homepage-sections.update', $section) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="bg-white p-6 rounded-lg shadow-md space-y-6">
            <div>
                <label class="block font-medium">@tr('Section Type')</label>
                <p class="mt-1 text-gray-600 bg-gray-100 p-2 rounded">{{ ucfirst(str_replace('_', ' ', $section->type)) }}</p>
            </div>

            <div>
                <label for="title" class="block font-medium">@tr('Title')</label>
                <input type="text" name="title" value="{{ old('title', $section->title) }}" class="w-full border p-2 rounded mt-1">
            </div>

            <div>
                <label for="subtitle" class="block font-medium">@tr('Subtitle / Description')</label>
                <textarea name="subtitle" rows="4" class="w-full border p-2 rounded mt-1">{{ old('subtitle', $section->subtitle) }}</textarea>
            </div>

            {{-- Image for non-feature_grid --}}
            @if($section->type !== 'feature_grid' && $section->type !== 'contact_info')
                <div>
                    <label for="image" class="block font-medium">@tr('Image')</label>
                    <input type="file" name="image" class="w-full border p-2 rounded mt-1">
                    @if($section->image_path)
                        <div class="mt-2">
                            <img src="{{ Illuminate\Support\Facades\Storage::url($section->image_path) }}" alt="@tr('Current Image')" class="h-32 rounded-md">
                            <p class="text-xs text-gray-500 mt-1">@tr('Current image. Uploading a new one will replace it.')</p>
                        </div>
                    @endif
                </div>
            @endif

            {{-- Feature Grid editor --}}
            @if($section->type === 'feature_grid')
                <hr class="my-8">
                <div class="bg-gray-50 p-6 rounded-lg">
                    <h2 class="text-xl font-semibold mb-4 text-gray-800">@tr('Manage Features')</h2>

                    @foreach($section->content['features'] ?? [] as $index => $feature)
                        <div class="border-b pb-4 mb-4">
                            <div class="flex justify-between items-center">
                                <p class="font-semibold">@tr('Feature') {{ $index + 1 }}</p>
                                <button type="button"
                                        class="delete-feature-btn bg-red-100 text-red-800 text-sm font-medium px-3 py-1 rounded-md hover:bg-red-200"
                                        data-url="{{ route('superadmin.homepage-sections.features.destroy', ['section' => $section->id, 'featureIndex' => $index]) }}">
                                    @tr('Delete')
                                </button>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-2">
                                <div>
                                    <label class="block text-sm font-medium">@tr('Title')</label>
                                    <input type="text" name="features[{{ $index }}][title]" value="{{ $feature['title'] ?? '' }}" class="w-full border p-2 rounded mt-1">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium">@tr('Description')</label>
                                    <input type="text" name="features[{{ $index }}][description]" value="{{ $feature['description'] ?? '' }}" class="w-full border p-2 rounded mt-1">
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium mt-2">@tr('Icon/Image')</label>
                                <input type="file" name="features[{{ $index }}][image]" class="w-full border p-2 rounded mt-1">
                                @if(!empty($feature['image_path']))
                                    <img src="{{ Illuminate\Support\Facades\Storage::url($feature['image_path']) }}" class="h-16 mt-2 rounded">
                                @endif
                            </div>
                        </div>
                    @endforeach

                    <div class="mt-6">
                        <p class="font-semibold">@tr('Add New Feature')</p>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-2">
                            <div>
                                <label class="block text-sm font-medium">@tr('Title')</label>
                                <input type="text" name="features[new][title]" placeholder="@tr('New Feature Title')" class="w-full border p-2 rounded mt-1">
                            </div>
                            <div>
                                <label class="block text-sm font-medium">@tr('Description')</label>
                                <input type="text" name="features[new][description]" placeholder="@tr('New Feature Description')" class="w-full border p-2 rounded mt-1">
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium mt-2">@tr('Icon/Image')</label>
                            <input type="file" name="features[new][image]" class="w-full border p-2 rounded mt-1">
                        </div>
                    </div>
                </div>
            @endif

            {{-- Contact Info editor --}}
            @if($section->type === 'contact_info')
                <hr class="my-8">
                <div class="bg-gray-50 p-6 rounded-lg">
                    <h2 class="text-xl font-semibold mb-4 text-gray-800">@tr('Contact Information')</h2>
                    @php($c = $section->content['contact'] ?? [])
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <input type="text" name="contact[address]"  value="{{ old('contact.address',  $c['address']  ?? '') }}"  placeholder="@tr('Address')"       class="w-full border p-2 rounded">
                        <input type="text" name="contact[phone]"    value="{{ old('contact.phone',    $c['phone']    ?? '') }}"  placeholder="@tr('Phone')"         class="w-full border p-2 rounded">
                        <input type="email" name="contact[email]"   value="{{ old('contact.email',    $c['email']    ?? '') }}"  placeholder="@tr('Email')"         class="w-full border p-2 rounded">
                        <input type="url"   name="contact[website]" value="{{ old('contact.website',  $c['website']  ?? '') }}"  placeholder="@tr('Website URL')"  class="w-full border p-2 rounded">
                        <input type="url"   name="contact[facebook]" value="{{ old('contact.facebook', $c['facebook'] ?? '') }}" placeholder="@tr('Facebook URL')"  class="w-full border p-2 rounded">
                        <input type="url"   name="contact[twitter]"  value="{{ old('contact.twitter',  $c['twitter']  ?? '') }}" placeholder="@tr('X/Twitter URL')" class="w-full border p-2 rounded">
                        <input type="url"   name="contact[instagram]"value="{{ old('contact.instagram',$c['instagram']?? '') }}" placeholder="@tr('Instagram URL')" class="w-full border p-2 rounded">
                        <input type="url"   name="contact[linkedin]" value="{{ old('contact.linkedin', $c['linkedin'] ?? '') }}" placeholder="@tr('LinkedIn URL')"  class="w-full border p-2 rounded">
                    </div>
                    <div class="mt-4">
                        <label class="block text-sm font-medium">@tr('Map Embed (iframe)')</label>
                        <textarea name="contact[map_embed]" rows="3" class="w-full border p-2 rounded mt-1">{{ old('contact.map_embed', $c['map_embed'] ?? '') }}</textarea>
                    </div>
                </div>
            @endif

            <div class="text-right">
                <button type="submit" class="bg-green-600 text-white font-bold px-6 py-2 rounded-lg hover:bg-green-700">
                    @tr('Update Section')
                </button>
            </div>
        </div>
    </form>
</div>

{{-- Delete Feature modal (feature_grid فقط) --}}
<div id="delete-feature-modal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-60 flex items-center justify-center z-50">
    <div class="bg-white p-6 rounded-lg shadow-xl max-w-sm w-full">
        <h3 class="text-xl font-bold mb-4">@tr('Confirm Feature Deletion')</h3>
        <p class="text-gray-600 mb-6">@tr('Are you sure you want to delete this feature? This action cannot be undone.')</p>

        <div class="flex justify-center gap-4">
            <form id="delete-feature-form" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">
                    @tr('Yes, delete feature')
                </button>
            </form>

            <button type="button" id="cancel-delete-btn" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300">
                @tr('Cancel')
            </button>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const deleteModal = document.getElementById('delete-feature-modal');
    const deleteForm = document.getElementById('delete-feature-form');
    const cancelDeleteBtn = document.getElementById('cancel-delete-btn');
    const deleteButtons = document.querySelectorAll('.delete-feature-btn');

    if (deleteButtons.length) {
        deleteButtons.forEach(button => {
            button.addEventListener('click', function (event) {
                event.preventDefault();
                const deleteUrl = this.dataset.url;
                deleteForm.setAttribute('action', deleteUrl);
                deleteModal.classList.remove('hidden');
            });
        });

        cancelDeleteBtn.addEventListener('click', function () {
            deleteModal.classList.add('hidden');
        });

        deleteModal.addEventListener('click', function (event) {
            if (event.target === deleteModal) {
                deleteModal.classList.add('hidden');
            }
        });
    }
});
</script>
@endpush
