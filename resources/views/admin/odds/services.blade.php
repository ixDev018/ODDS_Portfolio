@extends('admin.odds.layout')

@section('title', 'Services')

@section('content')
<div class="space-y-6 max-w-6xl mx-auto">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-extrabold text-white tracking-tight">Studio Services & Marquee</h1>
            <p class="text-xs font-mono text-gray-400 uppercase tracking-wider mt-0.5">Configure service cards displayed in the infinite loop carousel</p>
        </div>

        <button type="button" onclick="document.getElementById('new-service-modal').classList.remove('hidden')" class="odds-btn-primary">
            <i class="fa-solid fa-plus text-xs"></i>
            <span>Add Service</span>
        </button>
    </div>

    <div class="odds-card overflow-hidden">
        <table class="odds-table">
            <thead>
                <tr>
                    <th style="width: 40px;"></th>
                    <th>SERVICE NAME</th>
                    <th>DESCRIPTION</th>
                    <th>STATUS</th>
                    <th class="text-right" style="width: 100px;">ACTION</th>
                </tr>
            </thead>
            <tbody id="sortable-services">
                @forelse($services as $svc)
                <tr data-id="{{ $svc->id }}" class="hover:bg-white/[0.02] transition-colors">
                    <td class="text-center cursor-grab text-gray-600 hover:text-[#875af5]">
                        <i class="fa-solid fa-grip-vertical text-xs"></i>
                    </td>
                    <td>
                        <div class="font-bold text-white text-sm">{{ $svc->name }}</div>
                    </td>
                    <td>
                        <div class="text-xs text-gray-400 max-w-md leading-relaxed">{{ $svc->description }}</div>
                    </td>
                    <td>
                        @if($svc->is_active)
                            <span class="odds-badge odds-badge-green text-[9px]">Active</span>
                        @else
                            <span class="odds-badge bg-gray-800/40 text-gray-500 border border-gray-700/30 text-[9px]">Hidden</span>
                        @endif
                    </td>
                    <td class="text-right">
                        <div class="flex items-center justify-end space-x-2">
                            <button type="button" onclick="openEditModal({{ json_encode($svc) }})" class="p-1.5 text-gray-400 hover:text-[#875af5] transition-colors">
                                <i class="fa-solid fa-pen-to-square text-xs"></i>
                            </button>
                            <form action="{{ route('odds.admin.services.delete', $svc->id) }}" method="POST" onsubmit="return confirm('Delete this service?');" class="inline">
                                @csrf
                                <button type="submit" class="p-1.5 text-gray-400 hover:text-red-400 transition-colors">
                                    <i class="fa-solid fa-trash text-xs"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="py-12 text-center text-gray-500 font-mono text-xs">No services created yet.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- New Service Modal -->
<div id="new-service-modal" class="fixed inset-0 bg-black/70 backdrop-blur-sm z-50 flex items-center justify-center hidden">
    <div class="odds-card w-full max-w-lg p-6 space-y-4 m-4 bg-[#141418] border border-[#262632]">
        <div class="flex items-center justify-between border-b border-[#22222a] pb-3">
            <h3 class="font-bold text-base text-white">Add New Studio Service</h3>
            <button type="button" onclick="document.getElementById('new-service-modal').classList.add('hidden')" class="text-gray-400 hover:text-white">&times;</button>
        </div>

        <form action="{{ route('odds.admin.services.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="odds-label">Service Name *</label>
                <input type="text" name="name" required placeholder="e.g. Software Development" class="odds-input">
            </div>

            <div>
                <label class="odds-label">Description</label>
                <textarea name="description" rows="2" placeholder="Short description..." class="odds-input text-xs"></textarea>
            </div>

            <div class="flex items-center space-x-2 pt-2">
                <input type="checkbox" name="is_active" value="1" checked id="new_is_active" class="rounded bg-[#0b0b0e] border-[#22222a] text-[#875af5]">
                <label for="new_is_active" class="text-xs text-gray-300 font-semibold">Active in Marquee</label>
            </div>

            <div class="flex justify-end space-x-3 pt-3">
                <button type="button" onclick="document.getElementById('new-service-modal').classList.add('hidden')" class="odds-btn-secondary text-xs">Cancel</button>
                <button type="submit" class="odds-btn-primary text-xs">Add Service</button>
            </div>
        </form>
    </div>
</div>

<!-- Edit Service Modal -->
<div id="edit-service-modal" class="fixed inset-0 bg-black/70 backdrop-blur-sm z-50 flex items-center justify-center hidden">
    <div class="odds-card w-full max-w-lg p-6 space-y-4 m-4 bg-[#141418] border border-[#262632]">
        <div class="flex items-center justify-between border-b border-[#22222a] pb-3">
            <h3 class="font-bold text-base text-white">Edit Service</h3>
            <button type="button" onclick="document.getElementById('edit-service-modal').classList.add('hidden')" class="text-gray-400 hover:text-white">&times;</button>
        </div>

        <form id="edit-service-form" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="odds-label">Service Name *</label>
                <input type="text" name="name" id="edit_name" required class="odds-input">
            </div>

            <div>
                <label class="odds-label">Description</label>
                <textarea name="description" id="edit_description" rows="2" class="odds-input text-xs"></textarea>
            </div>

            <div class="flex items-center space-x-2 pt-2">
                <input type="checkbox" name="is_active" value="1" id="edit_is_active" class="rounded bg-[#0b0b0e] border-[#22222a] text-[#875af5]">
                <label for="edit_is_active" class="text-xs text-gray-300 font-semibold">Active in Marquee</label>
            </div>

            <div class="flex justify-end space-x-3 pt-3">
                <button type="button" onclick="document.getElementById('edit-service-modal').classList.add('hidden')" class="odds-btn-secondary text-xs">Cancel</button>
                <button type="submit" class="odds-btn-primary text-xs">Save Changes</button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
function openEditModal(svc) {
    document.getElementById('edit_name').value = svc.name;
    document.getElementById('edit_description').value = svc.description || '';
    document.getElementById('edit_is_active').checked = svc.is_active;
    document.getElementById('edit-service-form').action = `{{ url('admin/services/update') }}/${svc.id}`;
    document.getElementById('edit-service-modal').classList.remove('hidden');
}

const sortableServices = document.getElementById('sortable-services');
if (sortableServices) {
    new Sortable(sortableServices, {
        animation: 150,
        handle: '.fa-grip-vertical',
        onEnd: function () {
            const order = [];
            sortableServices.querySelectorAll('tr[data-id]').forEach(tr => {
                order.push(tr.dataset.id);
            });

            fetch('{{ route("odds.admin.services.reorder") }}', {
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
</script>
@endpush
