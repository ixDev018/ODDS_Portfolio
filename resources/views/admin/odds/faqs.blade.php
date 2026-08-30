@extends('admin.odds.layout')

@section('title', 'Frequently Asked Questions')

@section('content')
@push('styles')
<style>
    .faq-dots-wrap { position: relative; display: inline-block; }
    .faq-dots-btn {
        width: 28px; height: 28px;
        display: flex; align-items: center; justify-content: center;
        border-radius: 0.4rem;
        background: transparent;
        border: 1px solid transparent;
        cursor: pointer;
        color: var(--text-muted);
        transition: all 0.15s;
    }
    .faq-dots-btn:hover, .faq-dots-btn.open {
        background: var(--btn-sec-bg);
        border-color: var(--btn-sec-border);
        color: var(--text-title);
    }
    .faq-dropdown {
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
    .faq-dropdown button {
        display: flex; align-items: center; gap: 0.5rem;
        width: 100%; text-align: left;
        padding: 0.55rem 0.85rem;
        font-size: 0.8rem; font-weight: 600;
        color: var(--text-body); background: transparent;
        border: none; cursor: pointer;
        text-decoration: none;
        transition: background 0.12s;
    }
    .faq-dropdown button.btn-edit:hover { background: var(--tr-hover); color: var(--odds-purple); }
    .faq-dropdown button.btn-del:hover { background: rgba(239, 68, 68, 0.15); color: #dc2626; }
    .faq-dropdown .faq-dd-divider {
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
        question: '',
        answer: '',
        is_active: true
    },
    openEdit(item) {
        this.openMenuId = null;
        this.editData = {
            id: item.id,
            question: item.question || '',
            answer: item.answer || '',
            is_active: !!item.is_active
        };
        this.editModalOpen = true;
    }
}">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-extrabold text-white tracking-tight">Frequently Asked Questions</h1>
            <p class="text-xs font-mono text-gray-400 uppercase tracking-wider mt-0.5">Manage FAQ questions & answers displayed in the public accordion section</p>
        </div>

        <button type="button" @click="newModalOpen = true" class="odds-btn-primary">
            <i class="fa-solid fa-plus text-xs"></i>
            <span>Add FAQ</span>
        </button>
    </div>

    <div class="odds-card overflow-visible">
        <table class="odds-table">
            <thead>
                <tr>
                    <th style="width: 40px;"></th>
                    <th style="width: 45px;">#</th>
                    <th style="width: 32%;">QUESTION</th>
                    <th>ANSWER</th>
                    <th style="width: 100px;">STATUS</th>
                    <th class="text-right" style="width: 60px;">ACTION</th>
                </tr>
            </thead>
            <tbody id="sortable-faqs">
                @forelse($faqs as $index => $f)
                <tr data-id="{{ $f->id }}" class="hover:bg-white/[0.02] transition-colors">
                    <td class="text-center cursor-grab text-gray-600 hover:text-[#875af5]">
                        <i class="fa-solid fa-grip-vertical text-xs"></i>
                    </td>
                    <td class="font-mono text-xs text-gray-500 font-bold">
                        {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}
                    </td>
                    <td>
                        <div class="font-bold text-white text-sm leading-snug">{{ $f->question }}</div>
                    </td>
                    <td>
                        <div class="text-xs text-gray-400 max-w-xl leading-relaxed line-clamp-2" title="{{ $f->answer }}">{{ $f->answer }}</div>
                    </td>
                    <td>
                        @if($f->is_active)
                            <span class="odds-badge odds-badge-green text-[9px]">Active</span>
                        @else
                            <span class="odds-badge bg-gray-800/40 text-gray-500 border border-gray-700/30 text-[9px]">Hidden</span>
                        @endif
                    </td>
                    <td class="text-right">
                        <!-- 3-dot dropdown menu -->
                        <div class="faq-dots-wrap">
                            <button type="button" 
                                    class="faq-dots-btn" 
                                    :class="{ 'open': openMenuId === {{ $f->id }} }" 
                                    @click.stop="openMenuId = openMenuId === {{ $f->id }} ? null : {{ $f->id }}"
                                    title="Options">
                                <i class="fa-solid fa-ellipsis-vertical text-xs"></i>
                            </button>
                            <div class="faq-dropdown" 
                                 x-show="openMenuId === {{ $f->id }}" 
                                 @click.outside="openMenuId = null" 
                                 x-cloak
                                 style="display: none;">
                                <button type="button" 
                                        @click="openEdit({{ json_encode($f) }})"
                                        class="btn-edit">
                                    <i class="fa-solid fa-pen-to-square text-xs text-[#875af5]"></i>
                                    <span>Edit FAQ</span>
                                </button>
                                <div class="faq-dd-divider"></div>
                                <form action="{{ route('odds.admin.faqs.delete', $f->id) }}" method="POST" onsubmit="return confirm('Delete this FAQ?');" style="margin: 0;">
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
                    <td colspan="6" class="py-12 text-center text-gray-500 font-mono text-xs">No FAQs created yet.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- New FAQ Modal -->
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
                    <h3 class="font-bold text-base text-white">Add Frequently Asked Question</h3>
                </div>
                <button type="button" @click="newModalOpen = false" class="text-gray-400 hover:text-white text-lg">&times;</button>
            </div>

            <form action="{{ route('odds.admin.faqs.store') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="odds-label">Question *</label>
                    <input type="text" name="question" required placeholder="e.g. We don't have a technical spec yet — can you still help?" class="odds-input">
                </div>

                <div>
                    <label class="odds-label">Answer *</label>
                    <textarea name="answer" rows="4" required placeholder="Write the concise, clear answer..." class="odds-input text-xs leading-relaxed"></textarea>
                </div>

                <div class="flex items-center space-x-2 pt-2">
                    <input type="checkbox" name="is_active" value="1" checked id="new_faq_active" class="rounded bg-[#0b0b0e] border-[#22222a] text-[#875af5] focus:ring-0">
                    <label for="new_faq_active" class="text-xs text-gray-300 font-semibold cursor-pointer">Active on public page</label>
                </div>

                <div class="flex justify-end space-x-3 pt-3 border-t border-[#22222a]">
                    <button type="button" @click="newModalOpen = false" class="odds-btn-secondary text-xs">Cancel</button>
                    <button type="submit" class="odds-btn-primary text-xs">Add FAQ</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit FAQ Modal -->
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
                    <h3 class="font-bold text-base text-white">Edit Frequently Asked Question</h3>
                </div>
                <button type="button" @click="editModalOpen = false" class="text-gray-400 hover:text-white text-lg">&times;</button>
            </div>

            <form :action="'{{ url('admin/faqs/update') }}/' + editData.id" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="odds-label">Question *</label>
                    <input type="text" name="question" x-model="editData.question" required class="odds-input">
                </div>

                <div>
                    <label class="odds-label">Answer *</label>
                    <textarea name="answer" rows="4" x-model="editData.answer" required class="odds-input text-xs leading-relaxed"></textarea>
                </div>

                <div class="flex items-center space-x-2 pt-2">
                    <input type="checkbox" name="is_active" value="1" :checked="editData.is_active" id="edit_faq_active" class="rounded bg-[#0b0b0e] border-[#22222a] text-[#875af5] focus:ring-0">
                    <label for="edit_faq_active" class="text-xs text-gray-300 font-semibold cursor-pointer">Active on public page</label>
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
        const el = document.getElementById('sortable-faqs');
        if (el) {
            new Sortable(el, {
                animation: 150,
                handle: '.cursor-grab',
                ghostClass: 'opacity-40',
                onEnd: function () {
                    const order = Array.from(el.querySelectorAll('tr[data-id]')).map(row => row.dataset.id);
                    fetch('{{ route("odds.admin.faqs.reorder") }}', {
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
