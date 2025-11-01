@extends('layouts.superadmin')

@section('content')
<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">@tr('Manage Homepage Sections')</h1>
        <a href="{{ route('superadmin.homepage-sections.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            @tr('Add New Section')
        </a>
    </div>

    @if (session('success'))
        <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-xl font-semibold mb-4">@tr('Current Sections')</h2>
        <ul id="sortable-sections" class="divide-y divide-gray-200">
            @forelse($sections as $section)
                <li class="flex justify-between items-center py-3" data-id="{{ $section->id }}">
                    <div class="flex items-center">
                        <span class="cursor-grab mr-3">
                            <svg class="w-5 h-5 text-gray-400 mr-3 cursor-grab" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                        </span>
                        <div>
                            <span class="font-medium text-gray-800">{{ $section->title ?? ucfirst(str_replace('_', ' ', $section->type)) }}</span>
                            <span class="text-sm text-gray-500">({{ $section->type }})</span>
                        </div>
                    </div>
                    <div class="flex items-center {{ app()->isLocale('ar') ? 'flex-row-reverse gap-2' : 'gap-2' }}">
    <a href="{{ route('superadmin.homepage-sections.edit', $section) }}"
       class="bg-blue-100 text-blue-800 text-sm font-medium px-3 py-1 rounded-md hover:bg-blue-200">
        @tr('Edit')
    </a>

    <form action="{{ route('superadmin.homepage-sections.destroy', $section) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="button"
                class="delete-section-btn bg-red-100 text-red-800 text-sm font-medium px-3 py-1 rounded-md hover:bg-red-200">
            @tr('Delete')
        </button>
    </form>
</div>
                </li>
            @empty
                <li class="text-gray-500 py-4">
                    @tr('No sections created yet. Click "Add New Section" to get started.')
                </li>
            @endforelse
        </ul>
    </div>
</div>

{{-- Delete modal --}}
<div id="delete-section-modal" class="hidden fixed inset-0 bg-[rgba(var(--primary-500),0.18)] grid place-items-center z-[100] p-4">
    <div class="bg-white p-6 rounded-lg shadow-xl w-[90vw] max-w-md md:max-w-lg">
        <h3 class="text-xl font-bold mb-4">@tr('Confirm Section Deletion')</h3>
        <p class="text-gray-600 mb-6">
            @tr('Are you sure you want to delete this section? This action cannot be undone.')
        </p>

        <div class="flex justify-center gap-4">
            <form id="delete-section-form" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">
                    @tr('Yes, delete section')
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
<script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Sorting
        const sortableList = document.getElementById('sortable-sections');
        if (sortableList) {
            new Sortable(sortableList, {
                animation: 150,
                ghostClass: 'bg-blue-100',
                handle: '.cursor-grab',
                onEnd: function () {
                    const order = Array.from(sortableList.children).map(el => el.dataset.id);
                    fetch('{{ route("superadmin.homepage-sections.reorder") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ order })
                    });
                }
            });
        }

        // Delete modal
        const deleteModal = document.getElementById('delete-section-modal');
        const modalForm = document.getElementById('delete-section-form');
        const cancelBtn = document.getElementById('cancel-delete-btn');
        const deleteButtons = document.querySelectorAll('.delete-section-btn');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function () {
                const rowForm = this.closest('form');
                if (rowForm) {
                    modalForm.setAttribute('action', rowForm.getAttribute('action'));
                    deleteModal.classList.remove('hidden');
                }
            });
        });

        cancelBtn.addEventListener('click', () => deleteModal.classList.add('hidden'));
        deleteModal.addEventListener('click', (event) => {
            if (event.target === deleteModal) {
                deleteModal.classList.add('hidden');
            }
        });
    });
</script>
@endpush
