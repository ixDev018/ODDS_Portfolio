@extends('admin.odds.layout')

@section('title', 'Client Testimonials')

@section('content')
@push('styles')
<style>
    .testi-dots-wrap { position: relative; display: inline-block; }
    .testi-dots-btn {
        width: 28px; height: 28px;
        display: flex; align-items: center; justify-content: center;
        border-radius: 0.4rem;
        background: transparent;
        border: 1px solid transparent;
        cursor: pointer;
        color: var(--text-muted);
        transition: all 0.15s;
    }
    .testi-dots-btn:hover, .testi-dots-btn.open {
        background: var(--btn-sec-bg);
        border-color: var(--btn-sec-border);
        color: var(--text-title);
    }
    .testi-dropdown {
        position: absolute;
        right: 0; top: calc(100% + 4px);
        z-index: 50;
        background: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 0.6rem;
        box-shadow: 0 8px 32px rgba(0,0,0,0.25);
        min-width: 150px;
        overflow: hidden;
    }
    .testi-dropdown button {
        display: flex; align-items: center; gap: 0.5rem;
        width: 100%; text-align: left;
        padding: 0.55rem 0.85rem;
        font-size: 0.8rem; font-weight: 600;
        color: var(--text-body); background: transparent;
        border: none; cursor: pointer;
        text-decoration: none;
        transition: background 0.12s;
    }
    .testi-dropdown button.btn-edit:hover { background: var(--tr-hover); color: var(--odds-purple); }
    .testi-dropdown button.btn-del:hover { background: rgba(239, 68, 68, 0.15); color: #dc2626; }
    .testi-dropdown .testi-dd-divider {
        height: 1px; background: var(--border-color); margin: 0.25rem 0;
    }
</style>
@endpush

<div class="space-y-6 max-w-6xl mx-auto" x-data="{
    editModalOpen: false,
    newModalOpen: false,
    openMenuId: null,
    editData: {
        id: null,
        name: '',
        initials: '',
        role: '',
        company: '',
        stars: 5,
        text: '',
        avatar_path: '',
        is_active: true
    },
    editPreviewUrl: '',
    newPreviewUrl: '',
    openEdit(item) {
        this.openMenuId = null;
        this.editData = {
            id: item.id,
            name: item.name || '',
            initials: item.initials || '',
            role: item.role || '',
            company: item.company || '',
            stars: item.stars || 5,
            text: item.text || '',
            avatar_path: item.avatar_path || '',
            is_active: !!item.is_active
        };
        this.editPreviewUrl = item.avatar_path ? (item.avatar_path.startsWith('http') ? item.avatar_path : '{{ asset('') }}' + item.avatar_path.replace(/^\//, '')) : '';
        this.editModalOpen = true;
    },
    handleNewFile(event) {
        const file = event.target.files[0];
        if (file) {
            this.newPreviewUrl = URL.createObjectURL(file);
        }
    },
    handleEditFile(event) {
        const file = event.target.files[0];
        if (file) {
            this.editPreviewUrl = URL.createObjectURL(file);
            document.getElementById('edit_remove_avatar').value = '0';
        }
    },
    removeEditPhoto() {
        this.editPreviewUrl = '';
        this.editData.avatar_path = '';
        document.getElementById('edit_remove_avatar').value = '1';
        document.getElementById('edit_avatar_input').value = '';
    }
}">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-extrabold text-white tracking-tight">Client Testimonials</h1>
            <p class="text-xs font-mono text-gray-400 uppercase tracking-wider mt-0.5">Manage review cards & client photos displayed in the live marquee</p>
        </div>

        <button type="button" @click="newModalOpen = true; newPreviewUrl = ''" class="odds-btn-primary">
            <i class="fa-solid fa-plus text-xs"></i>
            <span>Add Testimonial</span>
        </button>
    </div>

    <div class="odds-card overflow-visible">
        <table class="odds-table">
            <thead>
                <tr>
                    <th style="width: 40px;"></th>
                    <th style="width: 60px;">PHOTO</th>
                    <th>CLIENT</th>
                    <th>ROLE & COMPANY</th>
                    <th>RATING</th>
                    <th>REVIEW QUOTE</th>
                    <th>STATUS</th>
                    <th class="text-right" style="width: 60px;">ACTION</th>
                </tr>
            </thead>
            <tbody id="sortable-testimonials">
                @forelse($testimonials as $t)
                <tr data-id="{{ $t->id }}" class="hover:bg-white/[0.02] transition-colors">
                    <td class="text-center cursor-grab text-gray-600 hover:text-[#875af5]">
                        <i class="fa-solid fa-grip-vertical text-xs"></i>
                    </td>
                    <td>
                        @if(!empty($t->avatar_path))
                            <img src="{{ $t->avatar_path }}" alt="{{ $t->name }}" class="w-9 h-9 rounded-full object-cover border border-[#875af5]/30 shadow-sm">
                        @else
                            <div class="w-9 h-9 rounded-full bg-gradient-to-br from-purple-500/20 to-[#875af5]/30 border border-[#875af5]/30 text-[#875af5] flex items-center justify-center font-bold text-xs font-mono">
                                {{ $t->initials ?? strtoupper(substr($t->name, 0, 2)) }}
                            </div>
                        @endif
                    </td>
                    <td>
                        <div class="font-bold text-white text-sm">{{ $t->name }}</div>
                    </td>
                    <td>
                        <div class="text-xs text-gray-400">
                            {{ $t->role ?? 'Client' }}
                            @if($t->company)
                                <span class="text-gray-600 font-mono">&bull;</span> {{ $t->company }}
                            @endif
                        </div>
                    </td>
                    <td>
                        <div class="flex text-amber-400 text-xs">
                            @for($i = 0; $i < $t->stars; $i++)
                                <i class="fa-solid fa-star"></i>
                            @endfor
                        </div>
                    </td>
                    <td>
                        <div class="text-xs text-gray-400 max-w-sm truncate italic" title="{{ $t->text }}">"{{ $t->text }}"</div>
                    </td>
                    <td>
                        @if($t->is_active)
                            <span class="odds-badge odds-badge-green text-[9px]">Active</span>
                        @else
                            <span class="odds-badge bg-gray-800/40 text-gray-500 border border-gray-700/30 text-[9px]">Hidden</span>
                        @endif
                    </td>
                    <td class="text-right">
                        <!-- 3-dot dropdown menu -->
                        <div class="testi-dots-wrap">
                            <button type="button" 
                                    class="testi-dots-btn" 
                                    :class="{ 'open': openMenuId === {{ $t->id }} }" 
                                    @click.stop="openMenuId = openMenuId === {{ $t->id }} ? null : {{ $t->id }}"
                                    title="Options">
                                <i class="fa-solid fa-ellipsis-vertical text-xs"></i>
                            </button>
                            <div class="testi-dropdown" 
                                 x-show="openMenuId === {{ $t->id }}" 
                                 @click.outside="openMenuId = null" 
                                 x-cloak
                                 style="display: none;">
                                <button type="button" 
                                        @click="openEdit({{ json_encode($t) }})"
                                        class="btn-edit">
                                    <i class="fa-solid fa-pen-to-square text-xs text-[#875af5]"></i>
                                    <span>Edit Review</span>
                                </button>
                                <div class="testi-dd-divider"></div>
                                <form action="{{ route('odds.admin.testimonials.delete', $t->id) }}" method="POST" onsubmit="return confirm('Delete this testimonial?');" style="margin: 0;">
                                    @csrf
                                    <button type="submit" class="btn-del">
                                        <i class="fa-solid fa-trash text-xs"></i>
                                        <span>Delete</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="py-12 text-center text-gray-500 font-mono text-xs">No testimonials created yet.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- New Testimonial Modal -->
    <div x-show="newModalOpen" 
         x-cloak
         class="fixed inset-0 bg-black/70 backdrop-blur-sm z-50 flex items-center justify-center p-4"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 scale-95"
         x-transition:enter-end="opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 scale-100"
         x-transition:leave-end="opacity-0 scale-95">
        <div class="odds-card w-full max-w-lg p-6 space-y-4 bg-[#141418] border border-[#262632] shadow-2xl max-h-[90vh] overflow-y-auto" @click.away="newModalOpen = false">
            <div class="flex items-center justify-between border-b border-[#22222a] pb-3">
                <div class="flex items-center space-x-2">
                    <div class="w-6 h-6 rounded-md bg-[#875af5]/20 text-[#875af5] flex items-center justify-center text-xs">
                        <i class="fa-solid fa-plus"></i>
                    </div>
                    <h3 class="font-bold text-base text-white">Add Client Testimonial</h3>
                </div>
                <button type="button" @click="newModalOpen = false" class="text-gray-400 hover:text-white text-lg">&times;</button>
            </div>

            <form action="{{ route('odds.admin.testimonials.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                
                <!-- Client Photo Section -->
                <div class="p-3.5 bg-[#0f0f13] border border-[#22222a] rounded-xl flex items-center space-x-4">
                    <div class="relative group">
                        <template x-if="newPreviewUrl">
                            <img :src="newPreviewUrl" class="w-14 h-14 rounded-full object-cover border-2 border-[#875af5] shadow-md">
                        </template>
                        <template x-if="!newPreviewUrl">
                            <div class="w-14 h-14 rounded-full bg-[#1b1b22] border border-[#2c2c38] text-gray-500 flex flex-col items-center justify-center">
                                <i class="fa-solid fa-user text-lg"></i>
                                <span class="text-[8px] font-mono mt-0.5">Avatar</span>
                            </div>
                        </template>
                    </div>
                    <div class="flex-1 min-w-0">
                        <label class="odds-label mb-1">Client Photo (Optional)</label>
                        <input type="file" name="avatar" accept="image/*" @change="handleNewFile" class="text-xs text-gray-400 file:mr-2.5 file:py-1 file:px-2.5 file:rounded-md file:border-0 file:text-xs file:font-semibold file:bg-[#875af5]/15 file:text-[#875af5] hover:file:bg-[#875af5]/25 file:cursor-pointer">
                        <p class="text-[10px] text-gray-500 font-mono mt-1">Leave empty to auto-generate styled initials avatar</p>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="odds-label">Client Name *</label>
                        <input type="text" name="name" required placeholder="John Doe" class="odds-input">
                    </div>
                    <div>
                        <label class="odds-label">Initials (Fallback)</label>
                        <input type="text" name="initials" placeholder="JD" class="odds-input font-mono">
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="odds-label">Role</label>
                        <input type="text" name="role" placeholder="CTO" class="odds-input">
                    </div>
                    <div>
                        <label class="odds-label">Company</label>
                        <input type="text" name="company" placeholder="Fintech Corp" class="odds-input">
                    </div>
                </div>

                <div>
                    <label class="odds-label">Rating (Stars)</label>
                    <select name="stars" class="odds-input bg-[#0f0f13]">
                        <option value="5" selected>5 Stars (★★★★★)</option>
                        <option value="4">4 Stars (★★★★☆)</option>
                        <option value="3">3 Stars (★★★☆☆)</option>
                        <option value="2">2 Stars (★★☆☆☆)</option>
                        <option value="1">1 Star (★☆☆☆☆)</option>
                    </select>
                </div>

                <div>
                    <label class="odds-label">Client Quote / Review *</label>
                    <textarea name="text" rows="3" required placeholder="Working with ODDS was seamless and extraordinarily fast..." class="odds-input text-xs"></textarea>
                </div>

                <div class="flex items-center space-x-2 pt-2">
                    <input type="checkbox" name="is_active" value="1" checked id="new_testi_active" class="rounded bg-[#0b0b0e] border-[#22222a] text-[#875af5] focus:ring-0">
                    <label for="new_testi_active" class="text-xs text-gray-300 font-semibold cursor-pointer">Active in Marquee</label>
                </div>

                <div class="flex justify-end space-x-3 pt-3 border-t border-[#22222a]">
                    <button type="button" @click="newModalOpen = false" class="odds-btn-secondary text-xs">Cancel</button>
                    <button type="submit" class="odds-btn-primary text-xs">Add Testimonial</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Testimonial Modal -->
    <div x-show="editModalOpen" 
         x-cloak
         class="fixed inset-0 bg-black/70 backdrop-blur-sm z-50 flex items-center justify-center p-4"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 scale-95"
         x-transition:enter-end="opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 scale-100"
         x-transition:leave-end="opacity-0 scale-95">
        <div class="odds-card w-full max-w-lg p-6 space-y-4 bg-[#141418] border border-[#262632] shadow-2xl max-h-[90vh] overflow-y-auto" @click.away="editModalOpen = false">
            <div class="flex items-center justify-between border-b border-[#22222a] pb-3">
                <div class="flex items-center space-x-2">
                    <div class="w-6 h-6 rounded-md bg-[#875af5]/20 text-[#875af5] flex items-center justify-center text-xs">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </div>
                    <h3 class="font-bold text-base text-white">Edit Client Testimonial</h3>
                </div>
                <button type="button" @click="editModalOpen = false" class="text-gray-400 hover:text-white text-lg">&times;</button>
            </div>

            <form :action="'{{ url('admin/testimonials/update') }}/' + editData.id" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <input type="hidden" name="remove_avatar" id="edit_remove_avatar" value="0">
                
                <!-- Client Photo Section with Live Preview & Remove Option -->
                <div class="p-3.5 bg-[#0f0f13] border border-[#22222a] rounded-xl flex items-center space-x-4">
                    <div class="relative group flex-shrink-0">
                        <template x-if="editPreviewUrl">
                            <div class="relative">
                                <img :src="editPreviewUrl" class="w-14 h-14 rounded-full object-cover border-2 border-[#875af5] shadow-md">
                                <button type="button" @click="removeEditPhoto()" class="absolute -top-1 -right-1 w-5 h-5 bg-red-500 hover:bg-red-600 text-white rounded-full flex items-center justify-center text-[10px] shadow" title="Remove photo">
                                    <i class="fa-solid fa-xmark"></i>
                                </button>
                            </div>
                        </template>
                        <template x-if="!editPreviewUrl">
                            <div class="w-14 h-14 rounded-full bg-[#1b1b22] border border-[#2c2c38] text-gray-500 flex flex-col items-center justify-center font-mono">
                                <span class="text-xs font-bold text-[#875af5]" x-text="editData.initials || 'CL'"></span>
                                <span class="text-[8px] opacity-70">Initials</span>
                            </div>
                        </template>
                    </div>
                    <div class="flex-1 min-w-0">
                        <label class="odds-label mb-1">Update Client Photo</label>
                        <input type="file" name="avatar" id="edit_avatar_input" accept="image/*" @change="handleEditFile" class="text-xs text-gray-400 file:mr-2.5 file:py-1 file:px-2.5 file:rounded-md file:border-0 file:text-xs file:font-semibold file:bg-[#875af5]/15 file:text-[#875af5] hover:file:bg-[#875af5]/25 file:cursor-pointer">
                        <p class="text-[10px] text-gray-500 font-mono mt-1">Upload a portrait to replace current avatar or remove to fallback to initials</p>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="odds-label">Client Name *</label>
                        <input type="text" name="name" x-model="editData.name" required class="odds-input">
                    </div>
                    <div>
                        <label class="odds-label">Initials</label>
                        <input type="text" name="initials" x-model="editData.initials" class="odds-input font-mono">
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="odds-label">Role</label>
                        <input type="text" name="role" x-model="editData.role" class="odds-input">
                    </div>
                    <div>
                        <label class="odds-label">Company</label>
                        <input type="text" name="company" x-model="editData.company" class="odds-input">
                    </div>
                </div>

                <div>
                    <label class="odds-label">Rating (Stars)</label>
                    <select name="stars" x-model="editData.stars" class="odds-input bg-[#0f0f13]">
                        <option value="5">5 Stars (★★★★★)</option>
                        <option value="4">4 Stars (★★★★☆)</option>
                        <option value="3">3 Stars (★★★☆☆)</option>
                        <option value="2">2 Stars (★★☆☆☆)</option>
                        <option value="1">1 Star (★☆☆☆☆)</option>
                    </select>
                </div>

                <div>
                    <label class="odds-label">Client Quote / Review *</label>
                    <textarea name="text" rows="3" x-model="editData.text" required class="odds-input text-xs"></textarea>
                </div>

                <div class="flex items-center space-x-2 pt-2">
                    <input type="checkbox" name="is_active" value="1" :checked="editData.is_active" id="edit_testi_active" class="rounded bg-[#0b0b0e] border-[#22222a] text-[#875af5] focus:ring-0">
                    <label for="edit_testi_active" class="text-xs text-gray-300 font-semibold cursor-pointer">Active in Marquee</label>
                </div>

                <div class="flex justify-end space-x-3 pt-3 border-t border-[#22222a]">
                    <button type="button" @click="editModalOpen = false" class="odds-btn-secondary text-xs">Cancel</button>
                    <button type="submit" class="odds-btn-primary text-xs">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const el = document.getElementById('sortable-testimonials');
        if (el) {
            new Sortable(el, {
                animation: 150,
                handle: '.cursor-grab',
                ghostClass: 'opacity-40',
                onEnd: function () {
                    const order = Array.from(el.querySelectorAll('tr[data-id]')).map(row => row.dataset.id);
                    fetch('{{ route("odds.admin.testimonials.reorder") }}', {
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
    });
</script>
@endpush

