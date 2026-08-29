@extends('admin.odds.layout')

@section('title', 'About Us (Blog) Sections')

@section('content')

<style>
    /* ─── Shell ─────────────────────────────────────────────── */
    .ab-shell {
        display: flex;
        gap: 1.25rem;
        height: calc(100vh - 7.5rem);
        min-height: 0;
        overflow: hidden;
    }

    .ab-left {
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
    .ab-toolbar {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.75rem 1rem;
        background: var(--bg-sidebar);
        border-bottom: 1px solid var(--border-color);
        flex-shrink: 0;
        flex-wrap: wrap;
    }

    .ab-search-wrap { position: relative; flex: 1; min-width: 150px; }
    .ab-search-wrap svg {
        position: absolute; left: 0.75rem; top: 50%;
        transform: translateY(-50%);
        color: var(--text-muted); pointer-events: none;
    }
    .ab-search {
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
    .ab-search::placeholder { color: var(--text-faint); }
    .ab-search:focus {
        border-color: var(--odds-purple);
        box-shadow: 0 0 0 2px rgba(135, 90, 245, 0.2);
    }

    .ab-filter-btn {
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
    .ab-filter-btn:hover {
        border-color: var(--odds-purple);
        color: var(--odds-purple);
        background: var(--tr-selected);
    }
    .ab-filter-btn.active {
        background: var(--odds-purple);
        border-color: var(--odds-purple);
        color: #ffffff !important;
    }

    .ab-table-scroll { flex: 1; overflow-y: auto; }
    .ab-table { width: 100%; border-collapse: collapse; }

    .ab-table thead tr {
        background: var(--bg-sidebar);
        border-bottom: 1px solid var(--border-color);
        position: sticky; top: 0; z-index: 1;
    }
    .ab-table th {
        font-family: var(--font-mono);
        font-size: 0.6rem; text-transform: uppercase;
        letter-spacing: 0.1em; color: var(--text-muted);
        padding: 0.65rem 1rem; text-align: left;
        white-space: nowrap;
    }
    .ab-table td {
        padding: 0.65rem 1rem;
        border-bottom: 1px solid var(--border-color);
        font-size: 0.8125rem; color: var(--text-body);
        vertical-align: middle;
    }
    .ab-table tr:last-child td { border-bottom: none; }
    .ab-table tbody tr { transition: background 0.12s; }
    .ab-table tbody tr:hover { background: var(--tr-hover); }

    .ab-drag-handle {
        color: var(--text-faint);
        cursor: grab;
        padding: 0.25rem;
        border-radius: 0.25rem;
        transition: color 0.15s;
    }
    .ab-drag-handle:hover { color: var(--odds-purple); }
    .ab-drag-handle:active { cursor: grabbing; }

    .ab-thumb {
        width: 64px; height: 36px;
        border-radius: 0.4rem;
        object-fit: cover;
        background: var(--bg-input);
        border: 1px solid var(--border-color);
        flex-shrink: 0;
    }
    .ab-thumb-placeholder {
        width: 64px; height: 36px;
        border-radius: 0.4rem;
        background: var(--bg-input);
        border: 1px solid var(--border-color);
        display: flex; align-items: center; justify-content: center;
        color: var(--text-faint); font-size: 0.75rem;
        flex-shrink: 0;
    }

    .sortable-ghost { opacity: 0.4; background: var(--tr-selected) !important; }
</style>

<div class="mb-6 flex flex-col md:flex-row md:items-center justify-between gap-4">
    <div>
        <div class="flex items-center space-x-2.5">
            <h1 class="text-xl font-extrabold text-white tracking-tight" style="color: var(--text-title);">About Us (Blog) Sections</h1>
            <span class="odds-badge odds-badge-purple">{{ $sections->count() }} {{ Str::plural('SECTION', $sections->count()) }}</span>
        </div>
        <p class="text-xs text-gray-400 mt-0.5" style="color: var(--text-muted);">
            Manage publication chapters and story sections using the rich Notion CMS block editor.
        </p>
    </div>

    <div class="flex items-center gap-2">
        <a href="{{ route('portfolio.about') }}" target="_blank" class="odds-btn-secondary text-xs">
            <i class="fa-solid fa-arrow-up-right-from-square text-[10px]"></i>
            <span>View Live Page</span>
        </a>
        <a href="{{ route('odds.admin.about.create') }}" class="odds-btn-primary text-xs">
            <i class="fa-solid fa-plus text-[10px]"></i>
            <span>Create Section</span>
        </a>
    </div>
</div>

<div class="ab-shell">
    <div class="ab-left">
        <!-- Toolbar: Search & Category Filter -->
        <div class="ab-toolbar">
            <div class="ab-search-wrap">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
                </svg>
                <input type="text" id="section-search" class="ab-search" placeholder="Filter by title, category, or author...">
            </div>

            @php
                $categories = $sections->pluck('category')->filter()->unique()->values();
            @endphp
            <div class="flex items-center overflow-x-auto py-0.5">
                <button type="button" class="ab-filter-btn active" data-cat="all">All ({{ $sections->count() }})</button>
                @foreach($categories as $cat)
                <button type="button" class="ab-filter-btn" data-cat="{{ Str::slug($cat) }}">{{ $cat }}</button>
                @endforeach
            </div>
        </div>

        <!-- Table View -->
        <div class="ab-table-scroll">
            @if($sections->isEmpty())
                <div class="p-12 text-center flex flex-col items-center justify-center">
                    <div class="w-14 h-14 rounded-2xl bg-[#875af5]/10 border border-[#875af5]/20 flex items-center justify-center text-[#875af5] text-xl mb-3">
                        <i class="fa-solid fa-newspaper"></i>
                    </div>
                    <h3 class="text-sm font-bold text-white mb-1" style="color: var(--text-title);">No About Sections Created Yet</h3>
                    <p class="text-xs text-gray-400 max-w-sm mb-4" style="color: var(--text-muted);">
                        Create rich blog-style sections and company stories for your visitors to explore on the About Us page.
                    </p>
                    <a href="{{ route('odds.admin.about.create') }}" class="odds-btn-primary text-xs">
                        <i class="fa-solid fa-plus text-[10px]"></i>
                        <span>Create First Section</span>
                    </a>
                </div>
            @else
                <table class="ab-table">
                    <thead>
                        <tr>
                            <th style="width: 32px;"></th>
                            <th>Section & Story</th>
                            <th>Badge / Category</th>
                            <th>Author / Meta</th>
                            <th>Blocks</th>
                            <th>Status</th>
                            <th style="text-align: right;">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="sortable-about-table">
                        @foreach($sections as $s)
                        @php
                            $blocksCount = 0;
                            if (!empty($s->body_content)) {
                                $bArr = is_array($s->body_content) ? $s->body_content : json_decode($s->body_content, true);
                                $blocksCount = is_array($bArr) ? count($bArr) : 0;
                            }
                        @endphp
                        <tr class="section-row" data-id="{{ $s->id }}" data-cat="{{ Str::slug($s->category ?? 'uncategorized') }}" data-search="{{ strtolower($s->title . ' ' . $s->category . ' ' . $s->author . ' ' . $s->subtitle) }}">
                            <td style="width: 32px;" class="text-center">
                                <i class="fa-solid fa-grip-vertical ab-drag-handle text-xs" title="Drag to reorder"></i>
                            </td>
                            <td>
                                <div class="flex items-center gap-3">
                                    @if(!empty($s->cover_image))
                                        <img src="{{ $s->cover_image }}" alt="{{ $s->title }}" class="ab-thumb">
                                    @else
                                        <div class="ab-thumb-placeholder">
                                            <i class="fa-solid fa-image"></i>
                                        </div>
                                    @endif
                                    <div>
                                        <div class="font-bold text-white text-xs hover:text-[#875af5] transition-colors" style="color: var(--text-title);">
                                            <a href="{{ route('odds.admin.about.edit', $s->id) }}">{{ $s->title }}</a>
                                        </div>
                                        @if($s->subtitle)
                                            <div class="text-[11px] text-gray-400 line-clamp-1 max-w-xs mt-0.5" style="color: var(--text-muted);">{{ $s->subtitle }}</div>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="odds-badge odds-badge-purple">{{ $s->category ?? 'Story' }}</span>
                            </td>
                            <td>
                                <div class="text-xs font-medium text-white" style="color: var(--text-title);">{{ $s->author ?? 'ODDS Core' }}</div>
                                <div class="text-[10px] text-gray-400 font-mono mt-0.5" style="color: var(--text-muted);">{{ $s->read_time ?? '3 min read' }}</div>
                            </td>
                            <td>
                                <span class="text-xs font-mono text-gray-300 flex items-center gap-1.5" style="color: var(--text-body);">
                                    <i class="fa-solid fa-cubes text-[10px] text-[#875af5]"></i>
                                    <span>{{ $blocksCount }} {{ Str::plural('block', $blocksCount) }}</span>
                                </span>
                            </td>
                            <td>
                                @if($s->is_active)
                                    <span class="odds-badge odds-badge-green"><i class="fa-solid fa-circle text-[6px]"></i> Active</span>
                                @else
                                    <span class="odds-badge text-gray-400 bg-gray-500/10 border border-gray-500/20">Draft</span>
                                @endif
                            </td>
                            <td style="text-align: right;">
                                <div class="flex items-center justify-end gap-1.5">
                                    <a href="{{ route('odds.admin.about.edit', $s->id) }}" class="p-1.5 px-2.5 rounded-lg bg-[#181822] hover:bg-[#875af5] text-gray-300 hover:text-white text-xs font-medium transition-colors" title="Edit in Notion Editor">
                                        <i class="fa-solid fa-pen text-[10px] mr-1"></i> Edit
                                    </a>
                                    <form action="{{ route('odds.admin.about.delete', $s->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this section?');" class="inline">
                                        @csrf
                                        <button type="submit" class="p-1.5 px-2 rounded-lg bg-red-950/40 hover:bg-red-900 text-red-400 hover:text-red-100 text-xs transition-colors" title="Delete">
                                            <i class="fa-solid fa-trash text-[10px]"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    // Live Search Filter
    const searchInput = document.getElementById('section-search');
    const rows = document.querySelectorAll('.section-row');
    const filterBtns = document.querySelectorAll('.ab-filter-btn');
    let activeCat = 'all';

    function filterTable() {
        const query = searchInput ? searchInput.value.toLowerCase().trim() : '';
        rows.forEach(r => {
            const matchesCat = activeCat === 'all' || r.dataset.cat === activeCat;
            const matchesSearch = !query || r.dataset.search.includes(query);
            if (matchesCat && matchesSearch) {
                r.style.display = '';
            } else {
                r.style.display = 'none';
            }
        });
    }

    if (searchInput) {
        searchInput.addEventListener('input', filterTable);
    }

    filterBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            filterBtns.forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            activeCat = btn.dataset.cat;
            filterTable();
        });
    });

    // Sortable Drag & Drop Reordering
    const sortableTable = document.getElementById('sortable-about-table');
    if (sortableTable) {
        new Sortable(sortableTable, {
            handle: '.ab-drag-handle',
            animation: 150,
            ghostClass: 'sortable-ghost',
            onEnd: function() {
                const order = [];
                sortableTable.querySelectorAll('.section-row').forEach(row => {
                    order.push(row.dataset.id);
                });

                fetch('{{ route("odds.admin.about.reorder") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ order: order })
                }).then(res => res.json()).then(data => {
                    console.log('Reorder saved successfully');
                }).catch(err => {
                    console.error('Failed to save reorder', err);
                });
            }
        });
    }
});
</script>
@endpush

@endsection
