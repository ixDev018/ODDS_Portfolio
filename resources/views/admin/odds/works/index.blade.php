@extends('admin.odds.layout')

@section('title', 'Outputs & Works')

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
        background: #141418;
        border: 1px solid #22222a;
        border-radius: 1rem;
        overflow: hidden;
    }

    /* toolbar */
    .op-toolbar {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.75rem 1rem;
        background: #111115;
        border-bottom: 1px solid #22222a;
        flex-shrink: 0;
        flex-wrap: wrap;
    }

    .op-search-wrap { position: relative; flex: 1; min-width: 150px; }
    .op-search-wrap svg {
        position: absolute; left: 0.75rem; top: 50%;
        transform: translateY(-50%);
        color: #6c6c7d; pointer-events: none;
    }
    .op-search {
        width: 100%;
        background: #0b0b0e;
        border: 1px solid #22222a;
        border-radius: 100px;
        padding: 0.42rem 0.85rem 0.42rem 2.2rem;
        color: #ffffff;
        font-size: 0.8125rem;
        outline: none;
        transition: border-color 0.18s, box-shadow 0.18s;
    }
    .op-search::placeholder { color: #555562; }
    .op-search:focus {
        border-color: #875af5;
        box-shadow: 0 0 0 2px rgba(135, 90, 245, 0.2);
    }

    /* filter pills */
    .op-filter-btn {
        display: inline-flex; align-items: center;
        padding: 0.3rem 0.75rem;
        margin: 0 0.25rem 0 0;
        flex-shrink: 0;
        background: #181820;
        border: 1px solid #262632;
        border-radius: 100px;
        color: #8a8a99;
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
        border-color: #875af5;
        color: #ffffff;
        background: rgba(135, 90, 245, 0.15);
    }
    .op-filter-btn.active {
        background: #875af5;
        border-color: #875af5;
        color: #ffffff;
    }

    .op-hide-scroll::-webkit-scrollbar { display: none; }
    .op-hide-scroll { -ms-overflow-style: none; scrollbar-width: none; }

    /* table scroll */
    .op-table-scroll { flex: 1; overflow-y: auto; }
    .op-table { width: 100%; border-collapse: collapse; }

    .op-table thead tr {
        background: #111115;
        border-bottom: 1px solid #22222a;
        position: sticky; top: 0; z-index: 1;
    }
    .op-table th {
        font-family: var(--font-mono);
        font-size: 0.6rem; text-transform: uppercase;
        letter-spacing: 0.1em; color: #6c6c7d;
        padding: 0.65rem 1rem; text-align: left;
        white-space: nowrap;
    }
    .op-table td {
        padding: 0.65rem 1rem;
        border-bottom: 1px solid #1c1c24;
        font-size: 0.8125rem; color: #d1d1db;
        vertical-align: middle;
    }
    .op-table tr:last-child td { border-bottom: none; }
    .op-table tbody tr { cursor: pointer; transition: background 0.12s; }
    .op-table tbody tr:hover td { background: #181820; }
    .op-table tbody tr.selected td { background: rgba(135, 90, 245, 0.12); }
    .op-table tbody tr.selected td:first-child {
        box-shadow: inset 3px 0 0 #875af5;
    }

    /* footer */
    .op-table-footer {
        display: flex; align-items: center; justify-content: space-between;
        padding: 0.6rem 1rem;
        border-top: 1px solid #22222a;
        background: #111115;
        flex-shrink: 0;
    }
    .op-count-label {
        font-family: var(--font-mono);
        font-size: 0.6rem; color: #6c6c7d;
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
        color: #8a8a99;
        transition: all 0.15s;
    }
    .op-dots-btn:hover {
        background: #1e1e26;
        border-color: #2c2c36;
        color: #ffffff;
    }
    .op-dropdown {
        position: absolute;
        right: 0; top: calc(100% + 4px);
        z-index: 50;
        background: #181820;
        border: 1px solid #2c2c36;
        border-radius: 0.6rem;
        box-shadow: 0 8px 32px rgba(0,0,0,0.5);
        min-width: 140px;
        overflow: hidden;
    }
    .op-dropdown a, .op-dropdown button {
        display: flex; align-items: center; gap: 0.5rem;
        width: 100%; text-align: left;
        padding: 0.55rem 0.85rem;
        font-size: 0.8rem; font-weight: 600;
        color: #d1d1db; background: transparent;
        border: none; cursor: pointer;
        text-decoration: none;
        transition: background 0.12s;
    }
    .op-dropdown a:hover { background: #22222c; color: #ffffff; }
    .op-dropdown button:hover { background: rgba(239, 68, 68, 0.15); color: #f87171; }
    .op-dropdown .op-dd-divider {
        height: 1px; background: #262632; margin: 0.25rem 0;
    }

    /* ─── RIGHT panel ────────────────────────────────────────── */
    .op-right {
        width: 320px; flex-shrink: 0;
        display: flex; flex-direction: column;
        background: #141418;
        border: 1px solid #22222a;
        border-radius: 1rem; overflow: hidden;
    }

    .op-right-header {
        display: flex; align-items: center; justify-content: space-between;
        padding: 0.75rem 1rem;
        border-bottom: 1px solid #22222a;
        background: #111115;
        flex-shrink: 0;
    }
    .op-right-header-label {
        font-family: var(--font-mono);
        font-size: 0.6rem; text-transform: uppercase;
        letter-spacing: 0.1em; color: #8a8a99;
    }

    .op-thumb-container {
        width: 100%;
        height: 170px;
        flex-shrink: 0;
        overflow: hidden;
        background: #0b0b0e;
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
        align-items: center; text-align: center;
    }
    .op-meta {
        padding: 1.25rem 1rem; width: 100%;
        display: flex; flex-direction: column; align-items: center; text-align: center; gap: 0.85rem;
    }
    .op-meta-title {
        font-size: 1.15rem; font-weight: 800; color: #ffffff; line-height: 1.3; text-align: center;
    }
    .op-meta-slug {
        font-family: var(--font-mono); font-size: 0.6rem;
        color: #6c6c7d; margin-top: 0.2rem;
        word-break: break-all; text-align: center;
    }
    .op-meta-grid {
        display: grid; grid-template-columns: 1fr 1fr; gap: 0.5rem; width: 100%;
    }
    .op-meta-item {
        display: flex; flex-direction: column; align-items: center; justify-content: center;
        background: #0f0f13; border: 1px solid #22222a; border-radius: 0.5rem; padding: 0.5rem;
        text-align: center;
    }
    .op-meta-item label {
        display: block; font-family: var(--font-mono);
        font-size: 0.55rem; text-transform: uppercase;
        letter-spacing: 0.1em; color: #6c6c7d; margin-bottom: 0.15rem; text-align: center;
    }
    .op-meta-item .val {
        font-size: 0.8rem; color: #e2e2e8; font-weight: 600; text-align: center;
    }

    /* preview actions */
    .op-preview-actions {
        padding: 0.75rem 1rem;
        border-top: 1px solid #22222a;
        display: flex; gap: 0.5rem;
        flex-shrink: 0; background: #111115;
    }
    .op-preview-actions a, .op-preview-actions button {
        flex: 1; display: inline-flex;
        align-items: center; justify-content: center; gap: 0.35rem;
        padding: 0.5rem 0.6rem; border-radius: 100px;
        font-size: 0.75rem; font-weight: 700;
        transition: all 0.15s; cursor: pointer;
        text-decoration: none;
    }
    .op-btn-edit {
        background: #875af5; border: 1px solid #875af5; color: #fff;
    }
    .op-btn-edit:hover { background: #966bf7; }

    .op-btn-view {
        background: #1e1e26; border: 1px solid #2c2c36; color: #d1d1db;
    }
    .op-btn-view:hover { background: #282834; color: #fff; }

    .op-btn-del {
        background: rgba(239, 68, 68, 0.15); border: 1px solid rgba(239, 68, 68, 0.3);
        color: #f87171; flex: 0; padding: 0.5rem 0.65rem;
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
        text-transform: uppercase; letter-spacing: 0.1em; color: #555562;
    }

    /* page header */
    .op-page-header {
        display: flex; align-items: center; justify-content: space-between;
        margin-bottom: 1rem; flex-shrink: 0;
    }

    .op-row-thumb {
        width: 38px; height: 38px; border-radius: 0.4rem;
        object-fit: cover; border: 1px solid #262632; flex-shrink: 0;
    }
    .op-row-thumb-ph {
        width: 38px; height: 38px; border-radius: 0.4rem;
        background: #0b0b0e; border: 1px solid #22222a;
        display: flex; align-items: center; justify-content: center;
        flex-shrink: 0; color: #555562; font-family: var(--font-mono); font-size: 9px;
    }

    .op-drag-handle {
        cursor: grab; color: #555562; transition: color 0.15s;
    }
    .op-drag-handle:hover { color: #875af5; }
    .op-drag-handle:active { cursor: grabbing; }

    @media (max-width: 900px) {
        .op-shell { flex-direction: column; height: auto; overflow: visible; }
        .op-right { width: 100%; }
        .op-left { height: 60vh; }
    }
</style>

<div x-data="{
    selectedProject: {{ $works->first() ? json_encode($works->first()) : 'null' }},
    search: '',
    activeFilter: 'all',
    openMenuId: null,
    projects: {{ json_encode($works) }},
    
    get filteredProjects() {
        return this.projects.filter(p => {
            const matchesFilter = this.activeFilter === 'all' || (p.category && p.category.toLowerCase() === this.activeFilter.toLowerCase());
            const matchesSearch = this.search === '' || 
                (p.title && p.title.toLowerCase().includes(this.search.toLowerCase())) ||
                (p.category && p.category.toLowerCase().includes(this.search.toLowerCase())) ||
                (p.client && p.client.toLowerCase().includes(this.search.toLowerCase()));
            return matchesFilter && matchesSearch;
        });
    }
}">

    <!-- Page Header -->
    <div class="op-page-header">
        <div>
            <h1 class="text-2xl font-extrabold text-white tracking-tight">
                Project Outputs
            </h1>
            <p class="text-xs font-mono text-gray-400 uppercase tracking-wider mt-0.5">
                3×3 Grid Folder Showcase & Notion Story Builder
            </p>
        </div>

        <a href="{{ route('odds.admin.works.create') }}" class="odds-btn-primary">
            <i class="fa-solid fa-plus text-xs"></i>
            <span>Add Output</span>
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
                    <input type="text" x-model="search" placeholder="Search outputs..." class="op-search">
                </div>

                <!-- Filters -->
                <div class="flex items-center overflow-x-auto op-hide-scroll">
                    <button type="button" class="op-filter-btn" :class="{ 'active': activeFilter === 'all' }" @click="activeFilter = 'all'">
                        All (<span x-text="projects.length"></span>)
                    </button>
                    @php
                        $categories = $works->pluck('category')->filter()->unique();
                    @endphp
                    @foreach($categories as $cat)
                    <button type="button" class="op-filter-btn" :class="{ 'active': activeFilter === '{{ strtolower($cat) }}' }" @click="activeFilter = '{{ strtolower($cat) }}'">
                        {{ $cat }}
                    </button>
                    @endforeach
                </div>
            </div>

            <!-- Table Scroll -->
            <div class="op-table-scroll">
                <table class="op-table">
                    <thead>
                        <tr>
                            <th style="width: 32px;"></th>
                            <th style="width: 44px;"></th>
                            <th>TITLE / CLIENT</th>
                            <th>CATEGORY</th>
                            <th>YEAR</th>
                            <th>FEATURED</th>
                            <th style="width: 40px;"></th>
                        </tr>
                    </thead>
                    <tbody id="sortable-works-body">
                        <template x-for="p in filteredProjects" :key="p.id">
                            <tr :class="{ 'selected': selectedProject && selectedProject.id === p.id }"
                                @click="selectedProject = p"
                                :data-id="p.id">
                                
                                <!-- Drag Handle -->
                                <td class="op-drag-handle" @click.stop style="padding: 0.65rem 0.4rem; text-align: center;">
                                    <i class="fa-solid fa-grip-vertical text-xs"></i>
                                </td>

                                <!-- Thumbnail -->
                                <td style="padding: 0.65rem 0.4rem;">
                                    <template x-if="p.cover_image">
                                        <img :src="p.cover_image" class="op-row-thumb" alt="">
                                    </template>
                                    <template x-if="!p.cover_image">
                                        <div class="op-row-thumb-ph">ODDS</div>
                                    </template>
                                </td>

                                <!-- Title & Client -->
                                <td>
                                    <div class="font-bold text-white text-sm" x-text="p.title"></div>
                                    <div class="font-mono text-xs text-gray-500" x-text="p.client || 'ODDS Project'"></div>
                                </td>

                                <!-- Category -->
                                <td>
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-mono font-bold bg-[#1e1e28] text-[#875af5] border border-[#875af5]/25" x-text="p.category || 'General'"></span>
                                </td>

                                <!-- Year -->
                                <td>
                                    <span class="font-mono text-xs text-gray-400" x-text="p.year || '2024'"></span>
                                </td>

                                <!-- Featured Status -->
                                <td>
                                    <template x-if="p.is_featured">
                                        <span class="odds-badge odds-badge-purple text-[9px]"><i class="fa-solid fa-check text-[8px]"></i> 3×3 Grid</span>
                                    </template>
                                    <template x-if="!p.is_featured">
                                        <span class="odds-badge bg-gray-800/40 text-gray-500 border border-gray-700/30 text-[9px]">Hidden</span>
                                    </template>
                                </td>

                                <!-- 3-dot dropdown menu -->
                                <td style="text-align: right;" @click.stop>
                                    <div class="op-dots-wrap">
                                        <button type="button" class="op-dots-btn" :class="{ 'open': openMenuId === p.id }" @click="openMenuId = openMenuId === p.id ? null : p.id">
                                            <i class="fa-solid fa-ellipsis-vertical text-xs"></i>
                                        </button>
                                        <div class="op-dropdown" x-show="openMenuId === p.id" @click.outside="openMenuId = null" style="display: none;">
                                            <a :href="'{{ url('admin/works/edit') }}/' + p.id">
                                                <i class="fa-solid fa-pen-to-square text-xs text-[#875af5]"></i> Edit Story
                                            </a>
                                            <div class="op-dd-divider"></div>
                                            <form :action="'{{ url('admin/works/delete') }}/' + p.id" method="POST" onsubmit="return confirm('Permanently delete this project?');">
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

                        <template x-if="filteredProjects.length === 0">
                            <tr>
                                <td colspan="7" class="text-center py-12 text-gray-500 font-mono text-xs">
                                    No project outputs match your query.
                                </td>
                            </tr>
                        </template>
                    </tbody>
                </table>
            </div>

            <!-- Footer -->
            <div class="op-table-footer">
                <span class="op-count-label">
                    Total Outputs: <strong class="text-white" x-text="filteredProjects.length"></strong>
                </span>
                <span class="font-mono text-[10px] text-gray-500">
                    DRAG ROW TO REORDER ON HOMEPAGE
                </span>
            </div>
        </div>

        <!-- ══ RIGHT PANEL: Live Selected Detail Inspector ══ -->
        <div class="op-right">

            <div class="op-right-header">
                <span class="op-right-header-label">Output Inspector</span>
                <template x-if="selectedProject">
                    <span class="font-mono text-[10px] text-[#875af5] font-bold">LIVE PREVIEW</span>
                </template>
            </div>

            <template x-if="selectedProject">
                <div class="op-preview-body">
                    <!-- Thumbnail -->
                    <div class="op-thumb-container">
                        <template x-if="selectedProject.cover_image">
                            <img :src="selectedProject.cover_image" alt="Project Cover">
                        </template>
                        <template x-if="!selectedProject.cover_image">
                            <div class="font-bold text-2xl tracking-widest text-[#875af5]/40 font-mono">ODDS</div>
                        </template>
                    </div>

                    <!-- Meta -->
                    <div class="op-meta">
                        <div class="text-center w-full">
                            <div class="op-meta-title" x-text="selectedProject.title"></div>
                            <div class="op-meta-slug" x-text="'slug: ' + selectedProject.slug"></div>
                        </div>

                        <div class="op-meta-grid">
                            <div class="op-meta-item">
                                <label>Category</label>
                                <div class="val" x-text="selectedProject.category || 'General'"></div>
                            </div>
                            <div class="op-meta-item">
                                <label>Year</label>
                                <div class="val font-mono" x-text="selectedProject.year || '2024'"></div>
                            </div>
                            <div class="op-meta-item">
                                <label>Client</label>
                                <div class="val" x-text="selectedProject.client || 'None'"></div>
                            </div>
                            <div class="op-meta-item">
                                <label>Role</label>
                                <div class="val" x-text="selectedProject.role || 'Full Stack'"></div>
                            </div>
                        </div>

                        <div class="op-meta-item w-full text-center">
                            <label class="text-center">Overview Hook</label>
                            <p class="text-xs text-gray-400 leading-relaxed text-center" x-text="selectedProject.description || 'No overview summary provided.'"></p>
                        </div>

                        <!-- Story block metric -->
                        <div class="p-3 rounded-xl bg-[#0b0b0e] border border-[#22222a] text-xs font-mono space-y-1 w-full text-center">
                            <div class="text-[10px] text-gray-500 uppercase font-bold text-center">Notion Story Status</div>
                            <div class="text-white font-semibold text-center">
                                <span x-text="selectedProject.body_content && selectedProject.body_content.length ? selectedProject.body_content.length + ' Content Blocks' : 'Default Outline'"></span>
                            </div>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="op-preview-actions">
                        <a :href="'{{ url('admin/works/edit') }}/' + selectedProject.id" class="op-btn-edit">
                            <i class="fa-solid fa-pen-to-square text-xs"></i>
                            <span>Edit Story</span>
                        </a>
                        <a href="{{ route('portfolio.index') }}#works" target="_blank" class="op-btn-view">
                            <i class="fa-solid fa-arrow-up-right-from-square text-xs"></i>
                            <span>View Live</span>
                        </a>
                        <form :action="'{{ url('admin/works/delete') }}/' + selectedProject.id" method="POST" onsubmit="return confirm('Delete this project?');" style="margin:0;">
                            @csrf
                            <button type="submit" class="op-btn-del" title="Delete Output">
                                <i class="fa-solid fa-trash text-xs"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </template>

            <template x-if="!selectedProject">
                <div class="op-empty-preview">
                    <i class="fa-solid fa-arrow-pointer text-2xl text-gray-600"></i>
                    <p>Select an output from the left to inspect</p>
                </div>
            </template>

        </div>

    </div>

</div>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const sortableBody = document.getElementById('sortable-works-body');
    if (sortableBody) {
        new Sortable(sortableBody, {
            handle: '.op-drag-handle',
            animation: 150,
            onEnd: function () {
                const order = [];
                sortableBody.querySelectorAll('tr[data-id]').forEach(tr => {
                    order.push(tr.dataset.id);
                });

                fetch('{{ route("odds.admin.works.reorder") }}', {
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
