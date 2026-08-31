@extends('admin.odds.layout')

@section('title', 'Services & Marquee')

@section('content')

<style>
    /* ─── Shell ─────────────────────────────────────────────── */
    .op-shell {
        display: flex;
        gap: 1.25rem;
        height: calc(100vh - 7.5rem);
        min-height: 0;
        overflow: hidden;
    }

    /* ─── LEFT panel ─────────────────────────────────────────── */
    .op-left {
        flex: 1 1 0;
        min-width: 0;
        display: flex;
        flex-direction: column;
        background: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 1rem;
        overflow: hidden;
    }

    /* toolbar */
    .op-toolbar {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.75rem 1rem;
        background: var(--bg-sidebar);
        border-bottom: 1px solid var(--border-color);
        flex-shrink: 0;
        flex-wrap: wrap;
    }

    .op-search-wrap { position: relative; flex: 1; min-width: 150px; }
    .op-search-wrap svg {
        position: absolute; left: 0.75rem; top: 50%;
        transform: translateY(-50%);
        color: var(--text-muted); pointer-events: none;
    }
    .op-search {
        width: 100%;
        background: var(--bg-input);
        border: 1px solid var(--border-color);
        border-radius: 100px;
        padding: 0.42rem 0.85rem 0.42rem 2.2rem;
        color: var(--text-title);
        font-size: 0.8125rem;
        outline: none;
        transition: border-color 0.18s, box-shadow 0.18s;
    }
    .op-search::placeholder { color: var(--text-faint); }
    .op-search:focus {
        border-color: var(--odds-purple);
        box-shadow: 0 0 0 2px rgba(135, 90, 245, 0.2);
    }

    /* filter pills */
    .op-filter-btn {
        display: inline-flex; align-items: center;
        padding: 0.3rem 0.75rem;
        margin: 0 0.25rem 0 0;
        flex-shrink: 0;
        background: var(--btn-sec-bg);
        border: 1px solid var(--btn-sec-border);
        border-radius: 100px;
        color: var(--btn-sec-text);
        font-size: 0.62rem;
        font-family: var(--font-mono);
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        cursor: pointer;
        transition: all 0.15s;
        white-space: nowrap;
    }
    .op-filter-btn:hover {
        border-color: var(--odds-purple);
        color: var(--odds-purple);
        background: var(--tr-selected);
    }
    .op-filter-btn.active {
        background: var(--odds-purple);
        border-color: var(--odds-purple);
        color: #ffffff !important;
    }

    .op-hide-scroll::-webkit-scrollbar { display: none; }
    .op-hide-scroll { -ms-overflow-style: none; scrollbar-width: none; }

    /* table scroll */
    .op-table-scroll { flex: 1; overflow-y: auto; }
    .op-table { width: 100%; border-collapse: collapse; }

    .op-table thead tr {
        background: var(--bg-sidebar);
        border-bottom: 1px solid var(--border-color);
        position: sticky; top: 0; z-index: 1;
    }
    .op-table th {
        font-family: var(--font-mono);
        font-size: 0.6rem; text-transform: uppercase;
        letter-spacing: 0.1em; color: var(--text-muted);
        padding: 0.65rem 1rem; text-align: left;
        white-space: nowrap;
    }
    .op-table td {
        padding: 0.65rem 1rem;
        border-bottom: 1px solid var(--border-color);
        font-size: 0.8125rem; color: var(--text-body);
        vertical-align: middle;
    }
    .op-table tr:last-child td { border-bottom: none; }
    .op-table tbody tr { cursor: pointer; transition: background 0.12s; }
    .op-table tbody tr:hover td { background: var(--tr-hover); }
    .op-table tbody tr.selected td { background: var(--tr-selected); }
    .op-table tbody tr.selected td:first-child {
        box-shadow: inset 3px 0 0 var(--odds-purple);
    }

    /* footer */
    .op-table-footer {
        display: flex; align-items: center; justify-content: space-between;
        padding: 0.6rem 1rem;
        border-top: 1px solid var(--border-color);
        background: var(--bg-sidebar);
        flex-shrink: 0;
    }
    .op-count-label {
        font-family: var(--font-mono);
        font-size: 0.6rem; color: var(--text-muted);
        text-transform: uppercase; letter-spacing: 0.1em;
    }

    /* ─── 3-dot dropdown ─────────────────────────────────────── */
    .op-dots-wrap { position: relative; }
    .op-dots-btn {
        width: 28px; height: 28px;
        display: flex; align-items: center; justify-content: center;
        border-radius: 0.4rem;
        background: transparent;
        border: 1px solid transparent;
        cursor: pointer;
        color: var(--text-muted);
        transition: all 0.15s;
    }
    .op-dots-btn:hover {
        background: var(--btn-sec-bg);
        border-color: var(--btn-sec-border);
        color: var(--text-title);
    }
    .op-dropdown {
        position: absolute;
        right: 0; top: calc(100% + 4px);
        z-index: 50;
        background: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 0.6rem;
        box-shadow: 0 8px 32px rgba(0,0,0,0.15);
        min-width: 140px;
        overflow: hidden;
    }
    .op-dropdown a, .op-dropdown button {
        display: flex; align-items: center; gap: 0.5rem;
        width: 100%; text-align: left;
        padding: 0.55rem 0.85rem;
        font-size: 0.8rem; font-weight: 600;
        color: var(--text-body); background: transparent;
        border: none; cursor: pointer;
        text-decoration: none;
        transition: background 0.12s;
    }
    .op-dropdown a:hover { background: var(--tr-hover); color: var(--text-title); }
    .op-dropdown button:hover { background: rgba(239, 68, 68, 0.15); color: #dc2626; }
    .op-dropdown .op-dd-divider {
        height: 1px; background: var(--border-color); margin: 0.25rem 0;
    }

    /* ─── RIGHT panel ────────────────────────────────────────── */
    .op-right {
        width: 320px; flex-shrink: 0;
        display: flex; flex-direction: column;
        background: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 1rem; overflow: hidden;
    }

    .op-right-header {
        display: flex; align-items: center; justify-content: space-between;
        padding: 0.75rem 1rem;
        border-bottom: 1px solid var(--border-color);
        background: var(--bg-sidebar);
        flex-shrink: 0;
    }
    .op-right-header-label {
        font-family: var(--font-mono);
        font-size: 0.6rem; text-transform: uppercase;
        letter-spacing: 0.1em; color: var(--text-muted);
    }

    .op-thumb-container {
        width: 100%;
        aspect-ratio: 16 / 9;
        flex-shrink: 0;
        overflow: hidden;
        background: var(--bg-subtle);
        display: flex; align-items: center; justify-content: center;
        position: relative;
    }
    .op-thumb-container img {
        width: 100%; height: 100%;
        object-fit: cover; display: block;
    }

    .op-preview-body {
        flex: 1; overflow-y: auto;
        display: flex; flex-direction: column;
        align-items: stretch; text-align: center;
        width: 100%;
    }
    .op-meta {
        padding: 1.25rem 1rem; width: 100%; box-sizing: border-box;
        display: flex; flex-direction: column; align-items: center; text-align: center; gap: 0.85rem;
    }
    .op-meta-title {
        font-size: 1.15rem; font-weight: 800; color: var(--text-title); line-height: 1.3; text-align: center;
    }
    .op-meta-slug {
        font-family: var(--font-mono); font-size: 0.6rem;
        color: var(--text-muted); margin-top: 0.2rem;
        word-break: break-all; text-align: center;
    }
    .op-meta-grid {
        display: grid; grid-template-columns: 1fr 1fr; gap: 0.5rem; width: 100%;
    }
    .op-meta-item {
        display: flex; flex-direction: column; align-items: center; justify-content: center;
        background: var(--bg-input); border: 1px solid var(--border-color); border-radius: 0.5rem; padding: 0.5rem;
        text-align: center;
    }
    .op-meta-item label {
        display: block; font-family: var(--font-mono);
        font-size: 0.55rem; text-transform: uppercase;
        letter-spacing: 0.1em; color: var(--text-muted); margin-bottom: 0.15rem; text-align: center;
    }
    .op-meta-item .val {
        font-size: 0.8rem; color: var(--text-title); font-weight: 600; text-align: center;
    }

    /* preview actions */
    .op-preview-actions {
        padding: 0.85rem 1rem;
        border-top: 1px solid var(--border-color);
        display: flex; flex-direction: column; gap: 0.5rem;
        flex-shrink: 0; background: var(--bg-sidebar);
        width: 100%; box-sizing: border-box;
        margin-top: auto;
    }
    .op-preview-actions a, .op-preview-actions button {
        width: 100%; box-sizing: border-box; display: flex;
        align-items: center; justify-content: center; gap: 0.5rem;
        padding: 0.65rem 1rem; border-radius: 100px;
        font-size: 0.78rem; font-weight: 700;
        transition: all 0.15s; cursor: pointer;
        text-decoration: none;
    }
    .op-preview-actions form {
        width: 100%; margin: 0; display: flex;
    }
    .op-btn-edit {
        background: var(--odds-purple); border: 1px solid var(--odds-purple); color: #fff !important;
    }
    .op-btn-edit:hover { background: #966bf7; }

    .op-btn-view {
        background: var(--btn-sec-bg); border: 1px solid var(--btn-sec-border); color: var(--btn-sec-text);
    }
    .op-btn-view:hover { background: var(--bg-card-hover); color: var(--text-title); }

    .op-btn-del {
        background: rgba(239, 68, 68, 0.15); border: 1px solid rgba(239, 68, 68, 0.3);
        color: #ef4444;
    }
    .op-btn-del:hover { background: rgba(239, 68, 68, 0.25); }

    /* empty */
    .op-empty-preview {
        flex: 1; display: flex; flex-direction: column;
        align-items: center; justify-content: center;
        gap: 0.65rem; padding: 2rem; text-align: center;
    }
    .op-empty-preview p {
        font-family: var(--font-mono); font-size: 0.65rem;
        text-transform: uppercase; letter-spacing: 0.1em; color: var(--text-faint);
    }

    /* page header */
    .op-page-header {
        display: flex; align-items: center; justify-content: space-between;
        margin-bottom: 1rem; flex-shrink: 0;
    }

    .op-row-thumb {
        width: 38px; height: 38px; border-radius: 0.4rem;
        object-fit: cover; border: 1px solid var(--border-color); flex-shrink: 0;
    }
    .op-row-thumb-ph {
        width: 38px; height: 38px; border-radius: 0.4rem;
        background: rgba(150, 107, 254, 0.1); border: 1px solid rgba(150, 107, 254, 0.25);
        display: flex; align-items: center; justify-content: center;
        flex-shrink: 0; color: #875af5; font-size: 16px;
    }
    .op-row-thumb-ph svg {
        width: 20px; height: 20px; stroke: #875af5;
    }

    .op-drag-handle {
        cursor: grab; color: var(--text-faint); transition: color 0.15s;
    }
    .op-drag-handle:hover { color: var(--odds-purple); }
    .op-drag-handle:active { cursor: grabbing; }

    @media (max-width: 900px) {
        .op-shell { flex-direction: column; height: auto; overflow: visible; }
        .op-right { width: 100%; }
        .op-left { height: 60vh; }
    }
</style>

<div x-data="{
    selectedService: {{ $services->first() ? json_encode($services->first()) : 'null' }},
    search: '',
    activeFilter: 'all',
    openMenuId: null,
    services: {{ json_encode($services) }},
    
    get filteredServices() {
        return this.services.filter(s => {
            const matchesFilter = this.activeFilter === 'all' || 
                (this.activeFilter === 'active' && s.is_active) || 
                (this.activeFilter === 'hidden' && !s.is_active);
            const matchesSearch = this.search === '' || 
                (s.name && s.name.toLowerCase().includes(this.search.toLowerCase())) ||
                (s.tagline && s.tagline.toLowerCase().includes(this.search.toLowerCase())) ||
                (s.description && s.description.toLowerCase().includes(this.search.toLowerCase()));
            return matchesFilter && matchesSearch;
        });
    }
}">

    <!-- Page Header -->
    <div class="op-page-header">
        <div>
            <h1 class="text-2xl font-extrabold text-white tracking-tight">
                Studio Services & Marquee
            </h1>
            <p class="text-xs font-mono text-gray-400 uppercase tracking-wider mt-0.5">
                Infinite Marquee Cards & Interactive Notion Detail Story Builder
            </p>
        </div>

        <a href="{{ route('odds.admin.services.create') }}" class="odds-btn-primary">
            <i class="fa-solid fa-plus text-xs"></i>
            <span>Add Service</span>
        </a>
    </div>

    <!-- Main Shell (Left Table + Right Live Detail) -->
    <div class="op-shell">

        <!-- ══ LEFT PANEL: Table List ══ -->
        <div class="op-left">

            <!-- Toolbar -->
            <div class="op-toolbar">
                <!-- Search -->
                <div class="op-search-wrap">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/>
                    </svg>
                    <input type="text" x-model="search" placeholder="Search services..." class="op-search">
                </div>

                <!-- Filters -->
                <div class="flex items-center overflow-x-auto op-hide-scroll">
                    <button type="button" class="op-filter-btn" :class="{ 'active': activeFilter === 'all' }" @click="activeFilter = 'all'">
                        All (<span x-text="services.length"></span>)
                    </button>
                    <button type="button" class="op-filter-btn" :class="{ 'active': activeFilter === 'active' }" @click="activeFilter = 'active'">
                        Active
                    </button>
                    <button type="button" class="op-filter-btn" :class="{ 'active': activeFilter === 'hidden' }" @click="activeFilter = 'hidden'">
                        Hidden
                    </button>
                </div>
            </div>

            <!-- Table Scroll -->
            <div class="op-table-scroll">
                <table class="op-table">
                    <thead>
                        <tr>
                            <th style="width: 32px;"></th>
                            <th style="width: 44px;"></th>
                            <th>SERVICE / TAGLINE</th>
                            <th>NOTION STORY</th>
                            <th>STATUS</th>
                            <th style="width: 40px;"></th>
                        </tr>
                    </thead>
                    <tbody id="sortable-services-body">
                        <template x-for="s in filteredServices" :key="s.id">
                            <tr :class="{ 'selected': selectedService && selectedService.id === s.id }"
                                @click="selectedService = s"
                                :data-id="s.id">
                                
                                <!-- Drag Handle -->
                                <td class="op-drag-handle" @click.stop style="padding: 0.65rem 0.4rem; text-align: center;">
                                    <i class="fa-solid fa-grip-vertical text-xs"></i>
                                </td>

                                <!-- Icon / Thumbnail -->
                                <td style="padding: 0.65rem 0.4rem;">
                                    <template x-if="s.cover_image">
                                        <img :src="s.cover_image" class="op-row-thumb" alt="">
                                    </template>
                                    <template x-if="!s.cover_image">
                                        <div class="op-row-thumb-ph" x-html="s.icon_svg || '<i class=\'fa-solid fa-cube\'></i>'"></div>
                                    </template>
                                </td>

                                <!-- Title & Tagline -->
                                <td>
                                    <div class="font-bold text-sm" style="color: var(--text-title);" x-text="s.name.replace(/\n/g, ' ')"></div>
                                    <div class="font-mono text-xs" style="color: var(--text-faint);" x-text="s.tagline || 'ODDS Engineering Service'"></div>
                                </td>

                                <!-- Notion Story Blocks -->
                                <td>
                                    <span class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded-full text-[10px] font-mono font-bold bg-[#875af5]/10 text-[#875af5] border border-[#875af5]/25">
                                        <i class="fa-solid fa-cubes text-[9px]"></i>
                                        <span x-text="s.body_content && s.body_content.length ? s.body_content.length + ' Blocks' : 'Default Outline'"></span>
                                    </span>
                                </td>

                                <!-- Status -->
                                <td>
                                    <template x-if="s.is_active">
                                        <span class="odds-badge odds-badge-green text-[9px]"><i class="fa-solid fa-circle text-[6px]"></i> In Marquee</span>
                                    </template>
                                    <template x-if="!s.is_active">
                                        <span class="odds-badge text-[9px]" style="background: var(--bg-subtle); color: var(--text-faint); border: 1px solid var(--border-color);">Hidden</span>
                                    </template>
                                </td>

                                <!-- 3-dot dropdown menu -->
                                <td style="text-align: right;" @click.stop>
                                    <div class="op-dots-wrap">
                                        <button type="button" class="op-dots-btn" :class="{ 'open': openMenuId === s.id }" @click="openMenuId = openMenuId === s.id ? null : s.id">
                                            <i class="fa-solid fa-ellipsis-vertical text-xs"></i>
                                        </button>
                                        <div class="op-dropdown" x-show="openMenuId === s.id" @click.outside="openMenuId = null" style="display: none;">
                                            <a :href="'{{ url('admin/services/edit') }}/' + s.id">
                                                <i class="fa-solid fa-pen-to-square text-xs text-[#875af5]"></i> Edit Story
                                            </a>
                                            <div class="op-dd-divider"></div>
                                            <form :action="'{{ url('admin/services/delete') }}/' + s.id" method="POST" onsubmit="return confirm('Permanently delete this service?');">
                                                @csrf
                                                <button type="submit">
                                                    <i class="fa-solid fa-trash text-xs"></i> Delete
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </template>

                        <template x-if="filteredServices.length === 0">
                            <tr>
                                <td colspan="6" class="text-center py-12 font-mono text-xs" style="color: var(--text-faint);">
                                    No services match your query.
                                </td>
                            </tr>
                        </template>
                    </tbody>
                </table>
            </div>

            <!-- Footer -->
            <div class="op-table-footer">
                <span class="op-count-label">
                    Total Services: <strong style="color: var(--text-title);" x-text="filteredServices.length"></strong>
                </span>
                <span class="font-mono text-[10px]" style="color: var(--text-faint);">
                    DRAG ROW TO REORDER ON HOMEPAGE MARQUEE
                </span>
            </div>
        </div>

        <!-- ══ RIGHT PANEL: Live Selected Detail Inspector ══ -->
        <div class="op-right">

            <div class="op-right-header">
                <span class="op-right-header-label">Service Inspector</span>
                <template x-if="selectedService">
                    <span class="font-mono text-[10px] text-[#875af5] font-bold">LIVE PREVIEW</span>
                </template>
            </div>

            <template x-if="selectedService">
                <div class="op-preview-body">
                    <!-- Thumbnail or Icon Visual -->
                    <div class="op-thumb-container">
                        <template x-if="selectedService.cover_image">
                            <img :src="selectedService.cover_image" alt="Service Cover">
                        </template>
                        <template x-if="!selectedService.cover_image">
                            <div class="flex flex-col items-center justify-center p-4">
                                <div class="w-16 h-16 rounded-2xl bg-[#875af5]/15 border border-[#875af5]/30 flex items-center justify-center text-[#875af5]" x-html="selectedService.icon_svg || '<i class=\'fa-solid fa-cube text-2xl\'></i>'"></div>
                            </div>
                        </template>
                    </div>

                    <!-- Meta -->
                    <div class="op-meta">
                        <div class="text-center w-full">
                            <div class="op-meta-title" x-text="selectedService.name.replace(/\n/g, ' ')"></div>
                            <div class="op-meta-slug" x-text="'slug: ' + (selectedService.slug || 'service-' + selectedService.id)"></div>
                        </div>

                        <div class="op-meta-grid">
                            <div class="op-meta-item">
                                <label>Tagline</label>
                                <div class="val" x-text="selectedService.tagline || 'Engineering Service'"></div>
                            </div>
                            <div class="op-meta-item">
                                <label>CTA Button</label>
                                <div class="val font-mono" x-text="selectedService.action_btn_text || 'Let\'s Build'"></div>
                            </div>
                        </div>

                        <div class="op-meta-item w-full text-center">
                            <label class="text-center">Overview Hook</label>
                            <p class="text-xs leading-relaxed text-center" style="color: var(--text-muted);" x-text="selectedService.description || 'No overview summary provided.'"></p>
                        </div>

                        <!-- Story block metrics -->
                        <div class="grid grid-cols-2 gap-2 w-full">
                            <div class="p-2.5 rounded-xl text-xs font-mono space-y-1 text-center border"
                                 style="background: var(--bg-input); border-color: var(--border-color);">
                                <div class="text-[9px] uppercase font-bold text-center" style="color: var(--text-faint);">Notion Story</div>
                                <div class="font-semibold text-center text-[11px]" style="color: var(--text-title);">
                                    <span x-text="selectedService.body_content && selectedService.body_content.length ? selectedService.body_content.length + ' Blocks' : 'Default Outline'"></span>
                                </div>
                            </div>
                            <div class="p-2.5 rounded-xl text-xs font-mono space-y-1 text-center border"
                                 style="background: var(--bg-input); border-color: var(--border-color);">
                                <div class="text-[9px] uppercase font-bold text-center" style="color: var(--text-faint);">Marquee Status</div>
                                <div class="font-semibold text-center text-[11px]">
                                    <template x-if="selectedService.is_active">
                                        <span class="text-emerald-400 font-bold">Active</span>
                                    </template>
                                    <template x-if="!selectedService.is_active">
                                        <span class="text-gray-500 font-bold">Hidden</span>
                                    </template>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="op-preview-actions">
                        <a :href="'{{ url('admin/services/edit') }}/' + selectedService.id" class="op-btn-edit">
                            <i class="fa-solid fa-pen-to-square text-xs"></i>
                            <span>Edit Story</span>
                        </a>
                        <a href="{{ route('portfolio.index') }}#services" target="_blank" class="op-btn-view">
                            <i class="fa-solid fa-arrow-up-right-from-square text-xs"></i>
                            <span>View Live</span>
                        </a>
                        <form :action="'{{ url('admin/services/delete') }}/' + selectedService.id" method="POST" onsubmit="return confirm('Delete this service?');" style="margin:0;">
                            @csrf
                            <button type="submit" class="op-btn-del" title="Delete Service">
                                <i class="fa-solid fa-trash text-xs"></i>
                                <span>Delete</span>
                            </button>
                        </form>
                    </div>
                </div>
            </template>

            <template x-if="!selectedService">
                <div class="op-empty-preview">
                    <i class="fa-solid fa-arrow-pointer text-2xl text-gray-600"></i>
                    <p>Select a service from the left to inspect</p>
                </div>
            </template>

        </div>

    </div>

</div>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const sortableBody = document.getElementById('sortable-services-body');
    if (sortableBody) {
        new Sortable(sortableBody, {
            handle: '.op-drag-handle',
            animation: 150,
            onEnd: function () {
                const order = [];
                sortableBody.querySelectorAll('tr[data-id]').forEach(tr => {
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
});
</script>
@endpush
