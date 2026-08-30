@extends('admin.odds.layout')

@section('title', 'Create Output')

@push('styles')
<!-- SortableJS -->
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>

<style>
    /* ─── Back Link ─── */
    .pe-back {
        display: inline-flex; align-items: center; gap: 0.35rem;
        font-family: var(--font-mono); font-size: 0.65rem;
        text-transform: uppercase; letter-spacing: 0.1em;
        color: #8a8a99; text-decoration: none;
        transition: color 0.15s; margin-bottom: 0.75rem;
    }
    .pe-back:hover { color: #875af5; }

    /* ─── Shell ─── */
    .pe-shell {
        display: flex; gap: 1.25rem;
        height: calc(100vh - 7.5rem);
        min-height: 0; overflow: hidden;
    }

    /* ─── LEFT: Editor Col ─── */
    .pe-editor-col {
        flex: 1 1 0; min-width: 0;
        display: flex; flex-direction: column;
        background: var(--bg-card); border: 1px solid var(--border-color);
        border-radius: 1rem; overflow: hidden;
    }

    .pe-editor-header {
        padding: 1.25rem 1.5rem 0.5rem;
        flex-shrink: 0;
    }
    .pe-title-input {
        width: 100%; border: none; outline: none;
        font-size: 1.65rem;
        font-weight: 800; color: var(--text-title);
        letter-spacing: -0.02em; background: transparent;
        padding: 0; margin-bottom: 0.35rem;
    }
    .pe-title-input::placeholder { color: var(--text-faint); }
    .pe-desc-input {
        width: 100%; border: none; outline: none;
        font-size: 0.85rem;
        color: var(--text-muted); background: transparent;
        padding: 0; margin-bottom: 0.5rem;
        resize: none; line-height: 1.5;
    }
    .pe-desc-input::placeholder { color: var(--text-faint); }

    .pe-editor-divider {
        height: 1px; background: var(--border-color);
        margin: 0 1.5rem;
    }

    /* ─── Block Editor Area ─── */
    .pe-blocks-scroll {
        flex: 1; overflow-y: auto;
        padding: 1rem 0.75rem 2rem;
    }

    .pe-block {
        position: relative;
        display: flex; align-items: flex-start;
        gap: 0.2rem;
        padding: 0.15rem 0;
        border-radius: 0.4rem;
        transition: background 0.12s;
        margin: 0 0.5rem;
    }
    .pe-block:hover { background: var(--tr-hover); }
    .pe-block:hover .pe-block-handle { opacity: 1; }

    .pe-block-handle {
        opacity: 0;
        display: flex; align-items: center; justify-content: center;
        width: 22px; height: 22px;
        flex-shrink: 0; cursor: grab;
        color: var(--text-muted); border-radius: 0.25rem;
        margin-top: 0.2rem;
        transition: all 0.12s;
    }
    .pe-block-handle:hover { color: var(--odds-purple); background: var(--tr-selected); }
    .pe-block-handle:active { cursor: grabbing; }

    .pe-block-content {
        flex: 1; min-width: 0;
        outline: none;
        font-size: 0.875rem;
        color: var(--text-body);
        line-height: 1.65;
        padding: 0.2rem 0.4rem;
        border-radius: 0.25rem;
        word-break: break-word;
    }
    .pe-block-content:focus { background: var(--tr-selected); }
    .pe-block-content:empty::before {
        content: attr(data-placeholder);
        color: var(--text-faint);
        pointer-events: none;
    }

    .pe-block-content[data-type="heading2"] {
        font-size: 1.25rem; font-weight: 700;
        color: var(--text-title); margin-top: 0.4rem;
    }
    .pe-block-content[data-type="heading3"] {
        font-size: 1.05rem; font-weight: 700;
        color: var(--text-title); margin-top: 0.25rem;
    }
    .pe-block-content[data-type="quote"] {
        border-left: 3px solid var(--odds-purple);
        padding-left: 0.85rem;
        color: var(--text-muted); font-style: italic;
    }
    .pe-block-content[data-type="callout"] {
        background: var(--tr-selected);
        border: 1px solid rgba(135, 90, 245, 0.3);
        border-radius: 0.5rem;
        padding: 0.75rem 1rem;
        color: var(--text-title);
    }
    .pe-block-content[data-type="code"] {
        font-family: var(--font-mono);
        font-size: 0.8rem;
        background: var(--bg-input);
        border: 1px solid var(--border-color);
        border-radius: 0.4rem;
        padding: 0.6rem 0.8rem;
        white-space: pre-wrap;
        color: #0284c7;
    }
    .pe-block.bullet-block .pe-block-bullet {
        display: flex; align-items: center; justify-content: center;
        width: 18px; height: 24px;
        flex-shrink: 0; color: var(--odds-purple); font-size: 1.2rem;
    }
    .pe-block.numbered-block .pe-block-number {
        display: flex; align-items: center;
        min-width: 18px; height: 24px;
        flex-shrink: 0; color: var(--odds-purple);
        font-family: var(--font-mono);
        font-size: 0.72rem; font-weight: 700;
    }
    .pe-block-content[data-type="divider"] {
        height: 1px; background: var(--border-color);
        margin: 0.6rem 0; padding: 0;
        pointer-events: none;
    }

    .pe-block-image-wrap { width: 100%; display: flex; flex-direction: column; gap: 0.35rem; }
    .pe-block-image-upload {
        width: 100%; min-height: 110px;
        background: var(--bg-input); border: 2px dashed var(--border-color);
        border-radius: 0.6rem;
        display: flex; align-items: center; justify-content: center;
        flex-direction: column; gap: 0.35rem;
        cursor: pointer; transition: all 0.15s;
        padding: 1.25rem;
    }
    .pe-block-image-upload:hover { border-color: var(--odds-purple); background: var(--tr-selected); }

    /* Slash menu */
    .pe-slash-menu {
        position: fixed; z-index: 100;
        background: var(--bg-card); border: 1px solid var(--border-color);
        border-radius: 0.75rem;
        box-shadow: 0 10px 30px rgba(0,0,0,0.15);
        min-width: 240px; max-height: 320px;
        overflow-y: auto; padding: 0.35rem;
    }
    .pe-slash-item {
        display: flex; align-items: center; gap: 0.6rem;
        padding: 0.45rem 0.65rem; border-radius: 0.4rem;
        cursor: pointer; transition: background 0.1s;
    }
    .pe-slash-item:hover, .pe-slash-item.active { background: var(--tr-selected); }
    .pe-slash-icon {
        width: 26px; height: 26px;
        display: flex; align-items: center; justify-content: center;
        background: var(--bg-input); border: 1px solid var(--border-color);
        border-radius: 0.35rem; flex-shrink: 0;
        color: var(--odds-purple); font-size: 0.75rem;
    }

    /* ─── RIGHT: Settings Sidebar ─── */
    .pe-sidebar {
        width: 320px; flex-shrink: 0;
        display: flex; flex-direction: column;
        background: var(--bg-card); border: 1px solid var(--border-color);
        border-radius: 1rem; overflow: hidden;
    }
    .pe-sidebar-header {
        display: flex; align-items: center; justify-content: space-between;
        padding: 0.85rem 1.25rem 0.65rem; flex-shrink: 0;
        border-bottom: 1px solid var(--border-color); background: var(--bg-sidebar);
    }
    .pe-sidebar-header-label {
        font-family: var(--font-mono);
        font-size: 0.6rem; text-transform: uppercase;
        letter-spacing: 0.1em; color: var(--text-muted);
    }
    .pe-sidebar-scroll {
        flex: 1; overflow-y: auto;
        padding: 1rem 1.25rem;
        display: flex; flex-direction: column; gap: 0.85rem;
    }

    .pe-sidebar-footer {
        padding: 0.85rem 1.25rem;
        border-top: 1px solid var(--border-color);
        background: var(--bg-sidebar); flex-shrink: 0;
    }

    @media (max-width: 900px) {
        .pe-shell { flex-direction: column; height: auto; overflow: visible; }
        .pe-sidebar { width: 100%; }
        .pe-editor-col { height: 60vh; }
    }
</style>
@endpush

@section('content')

<a href="{{ route('odds.admin.works.index') }}" class="pe-back">
    <i class="fa-solid fa-arrow-left text-[10px]"></i>
    <span>Back to Outputs</span>
</a>

<form id="work-form" action="{{ route('odds.admin.works.store') }}" method="POST" enctype="multipart/form-data" class="pe-shell">
    @csrf
    <input type="hidden" name="body_content" id="body_content_input">

    <!-- ══ LEFT: Seamless Notion Editor ══ -->
    <div class="pe-editor-col">
        <div class="pe-editor-header">
            <input type="text" name="title" required value="{{ old('title') }}" placeholder="Untitled Output..."
                   class="pe-title-input" autofocus>
            <textarea name="description" rows="2" placeholder="Write a short summary or card hook for the 3×3 grid..."
                      class="pe-desc-input">{{ old('description') }}</textarea>
        </div>

        <div class="pe-editor-divider"></div>

        <div id="notion-blocks-container" class="pe-blocks-scroll">
            <!-- Populated via JS -->
        </div>
    </div>

    <!-- ══ RIGHT: Metadata & Publish Sidebar ══ -->
    <div class="pe-sidebar">
        <div class="pe-sidebar-header">
            <span class="pe-sidebar-header-label">Output Settings</span>
            <span class="font-mono text-[9px] text-[#875af5] font-bold">DRAFT</span>
        </div>

        <div class="pe-sidebar-scroll">
            <div>
                <label class="odds-label">Category</label>
                <input type="text" name="category" value="{{ old('category') }}" placeholder="e.g. Web App & AI" class="odds-input">
            </div>

            <div>
                <label class="odds-label">Client / Partner</label>
                <input type="text" name="client" value="{{ old('client') }}" placeholder="e.g. Enterprise Client" class="odds-input">
            </div>

            <div class="grid grid-cols-2 gap-2">
                <div>
                    <label class="odds-label">Role</label>
                    <input type="text" name="role" value="{{ old('role') }}" placeholder="Full Stack" class="odds-input">
                </div>
                <div>
                    <label class="odds-label">Year</label>
                    <input type="text" name="year" value="{{ old('year', date('Y')) }}" placeholder="2024" class="odds-input font-mono">
                </div>
            </div>

            <!-- 16:9 Card Body Cover Image Uploader -->
            <div class="space-y-1.5">
                <div class="flex items-center justify-between">
                    <label class="odds-label mb-0">Card Body Image</label>
                    <span class="text-[9px] font-mono px-1.5 py-0.5 rounded bg-[#875af5]/15 text-[#875af5] font-bold tracking-wider">16:9 RATIO</span>
                </div>
                
                <div id="cover-dropzone" class="relative group aspect-[16/9] w-full rounded-xl border-2 border-dashed border-[#2b2b36] hover:border-[#875af5] bg-[#0d0d12] flex flex-col items-center justify-center p-3 text-center cursor-pointer transition-all overflow-hidden">
                    <div id="cover-placeholder" class="flex flex-col items-center justify-center space-y-2 pointer-events-none">
                        <div class="w-10 h-10 rounded-full bg-[#181822] flex items-center justify-center text-[#875af5] group-hover:scale-110 transition-transform">
                            <i class="fa-solid fa-cloud-arrow-up text-sm"></i>
                        </div>
                        <div>
                            <div class="text-xs font-semibold text-gray-200">Upload 16:9 Image</div>
                            <div class="text-[10px] text-gray-500 font-mono mt-0.5">Click or drag & drop (PNG, JPG, WebP)</div>
                        </div>
                    </div>

                    <div id="cover-preview-container" class="hidden absolute inset-0 w-full h-full">
                        <img id="cover-preview-img" src="" alt="Cover Preview" class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center gap-2">
                            <button type="button" id="btn-change-cover" class="px-2.5 py-1 bg-[#875af5] hover:bg-[#7245e0] text-white rounded text-[11px] font-medium transition-colors">
                                <i class="fa-solid fa-pen mr-1 text-[9px]"></i> Change
                            </button>
                            <button type="button" id="btn-clear-cover" class="px-2.5 py-1 bg-red-900/80 hover:bg-red-800 text-red-200 rounded text-[11px] font-medium transition-colors">
                                <i class="fa-solid fa-trash mr-1 text-[9px]"></i> Remove
                            </button>
                        </div>
                    </div>
                </div>

                <input type="file" id="cover_image_input" name="cover_image" accept="image/*" class="hidden">
                <input type="hidden" name="cover_image_base64" id="cover_image_base64">
                
                <div class="pt-1">
                    <input type="url" name="cover_image_url" id="cover_image_url" placeholder="Or paste 16:9 Image URL (https://...)" class="odds-input text-xs font-mono py-1 px-2.5">
                </div>
            </div>

            <div>
                <label class="odds-label">Live Demo URL</label>
                <input type="url" name="demo_url" value="{{ old('demo_url') }}" placeholder="https://..." class="odds-input font-mono text-xs">
            </div>

            <div>
                <label class="odds-label">GitHub URL</label>
                <input type="url" name="github_url" value="{{ old('github_url') }}" placeholder="https://github.com/..." class="odds-input font-mono text-xs">
            </div>

            <div class="pt-2 border-t border-[#22222a] space-y-2">
                <label class="flex items-center space-x-2 cursor-pointer">
                    <input type="checkbox" name="is_featured" value="1" checked class="rounded bg-[#0b0b0e] border-[#22222a] text-[#875af5] focus:ring-0">
                    <span class="text-xs text-gray-300 font-semibold">Featured on 3×3 Grid</span>
                </label>
                <label class="flex items-center space-x-2 cursor-pointer">
                    <input type="checkbox" name="count_in_kpi" value="1" checked class="rounded bg-[#0b0b0e] border-[#22222a] text-[#875af5] focus:ring-0">
                    <span class="text-xs text-gray-300 font-semibold">Count towards Accomplished KPI</span>
                </label>
                <label class="flex items-center space-x-2 cursor-pointer">
                    <input type="checkbox" name="is_active" value="1" checked class="rounded bg-[#0b0b0e] border-[#22222a] text-[#875af5] focus:ring-0">
                    <span class="text-xs text-gray-300 font-semibold">Active Status</span>
                </label>
            </div>
        </div>

        <div class="pe-sidebar-footer">
            <button type="submit" class="odds-btn-primary w-full">
                <i class="fa-solid fa-plus text-xs"></i>
                <span>Publish Output</span>
            </button>
        </div>
    </div>
</form>

<!-- Slash Floating Menu -->
<div id="slash-menu" class="pe-slash-menu hidden">
    <div class="px-2 py-1 text-[9px] font-bold text-gray-500 uppercase font-mono tracking-wider">Blocks</div>
    <div class="pe-slash-item" data-type="paragraph">
        <div class="pe-slash-icon"><i class="fa-solid fa-paragraph"></i></div>
        <div>
            <div class="text-xs font-bold text-white">Text</div>
            <div class="text-[10px] text-gray-400">Plain text paragraph</div>
        </div>
    </div>
    <div class="pe-slash-item" data-type="heading2">
        <div class="pe-slash-icon font-bold">H2</div>
        <div>
            <div class="text-xs font-bold text-white">Heading 2</div>
            <div class="text-[10px] text-gray-400">Medium section header</div>
        </div>
    </div>
    <div class="pe-slash-item" data-type="heading3">
        <div class="pe-slash-icon font-bold">H3</div>
        <div>
            <div class="text-xs font-bold text-white">Heading 3</div>
            <div class="text-[10px] text-gray-400">Sub-section header</div>
        </div>
    </div>
    <div class="pe-slash-item" data-type="bullet">
        <div class="pe-slash-icon"><i class="fa-solid fa-list-ul"></i></div>
        <div>
            <div class="text-xs font-bold text-white">Bulleted List</div>
            <div class="text-[10px] text-gray-400">Simple bullet point</div>
        </div>
    </div>
    <div class="pe-slash-item" data-type="numbered">
        <div class="pe-slash-icon"><i class="fa-solid fa-list-ol"></i></div>
        <div>
            <div class="text-xs font-bold text-white">Numbered List</div>
            <div class="text-[10px] text-gray-400">Sequential numbered step</div>
        </div>
    </div>
    <div class="pe-slash-item" data-type="quote">
        <div class="pe-slash-icon"><i class="fa-solid fa-quote-left"></i></div>
        <div>
            <div class="text-xs font-bold text-white">Quote</div>
            <div class="text-[10px] text-gray-400">Capture a standout quote</div>
        </div>
    </div>
    <div class="pe-slash-item" data-type="callout">
        <div class="pe-slash-icon"><i class="fa-solid fa-lightbulb"></i></div>
        <div>
            <div class="text-xs font-bold text-white">Callout Box</div>
            <div class="text-[10px] text-gray-400">Highlight key takeaways</div>
        </div>
    </div>
    <div class="pe-slash-item" data-type="code">
        <div class="pe-slash-icon"><i class="fa-solid fa-code"></i></div>
        <div>
            <div class="text-xs font-bold text-white">Code Block</div>
            <div class="text-[10px] text-gray-400">Code snippet or payload</div>
        </div>
    </div>
    <div class="pe-slash-item" data-type="divider">
        <div class="pe-slash-icon"><i class="fa-solid fa-minus"></i></div>
        <div>
            <div class="text-xs font-bold text-white">Divider</div>
            <div class="text-[10px] text-gray-400">Visual separation line</div>
        </div>
    </div>
    <div class="pe-slash-item" data-type="image">
        <div class="pe-slash-icon"><i class="fa-solid fa-image"></i></div>
        <div>
            <div class="text-xs font-bold text-white">Image / Screenshot</div>
            <div class="text-[10px] text-gray-400">Upload inline project image</div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
const container = document.getElementById('notion-blocks-container');
const slashMenu = document.getElementById('slash-menu');
let activeSlashBlock = null;

const initialBlocks = [
    { type: 'heading2', content: 'The Challenge & Context' },
    { type: 'paragraph', content: 'Describe the core business problem, bottlenecks, or architectural requirements this project was built to address.' },
    { type: 'heading2', content: 'The ODDS Engineering Solution' },
    { type: 'paragraph', content: 'Detail how our engineering team developed and deployed the system with velocity and stack-agnostic precision.' },
    { type: 'callout', content: 'Key Outcome: Rapid deployment with measurable performance and zero downtime.' }
];

document.addEventListener('DOMContentLoaded', () => {
    initialBlocks.forEach(b => createBlockElement(b));
    initSortable();
});

function initSortable() {
    new Sortable(container, {
        handle: '.pe-block-handle',
        animation: 150,
        ghostClass: 'opacity-40'
    });
}

function createBlockElement(blockData, insertAfterEl = null) {
    const type = blockData.type || 'paragraph';
    const blockEl = document.createElement('div');
    blockEl.className = `pe-block ${type}-block`;
    blockEl.dataset.type = type;

    const handleEl = document.createElement('div');
    handleEl.className = 'pe-block-handle';
    handleEl.innerHTML = '<i class="fa-solid fa-grip-vertical text-[11px]"></i>';
    blockEl.appendChild(handleEl);

    if (type === 'bullet') {
        const bullet = document.createElement('div');
        bullet.className = 'pe-block-bullet';
        bullet.innerHTML = '•';
        blockEl.appendChild(bullet);
    } else if (type === 'numbered') {
        const num = document.createElement('div');
        num.className = 'pe-block-number';
        num.innerText = '1.';
        blockEl.appendChild(num);
    }

    if (type === 'image') {
        const imgWrap = document.createElement('div');
        imgWrap.className = 'pe-block-image-wrap';

        if (blockData.src) {
            imgWrap.innerHTML = `
                <div class="relative group rounded-xl overflow-hidden border border-[#22222a]">
                    <img src="${blockData.src}" class="w-full h-auto max-h-96 object-contain bg-[#0b0b0e]">
                    <button type="button" onclick="this.closest('.pe-block').remove()" class="absolute top-2 right-2 p-1.5 bg-red-950/80 text-red-300 rounded-lg text-xs hover:bg-red-900 transition-colors">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                </div>
                <input type="text" class="pe-img-caption bg-transparent border-none outline-none text-center text-xs text-gray-400 mt-1 placeholder-gray-600" placeholder="Optional caption..." value="${blockData.caption || ''}">
            `;
            imgWrap.dataset.src = blockData.src;
        } else {
            const uploadBox = document.createElement('div');
            uploadBox.className = 'pe-block-image-upload';
            uploadBox.innerHTML = `
                <i class="fa-solid fa-cloud-arrow-up text-lg text-[#875af5]"></i>
                <span class="text-xs text-gray-300 font-semibold">Click to upload image or drag & drop</span>
                <span class="text-[10px] text-gray-500 font-mono">PNG, JPG, WEBP up to 10MB</span>
                <input type="file" accept="image/*" class="hidden">
            `;
            const fileInput = uploadBox.querySelector('input');
            uploadBox.onclick = () => fileInput.click();
            fileInput.onchange = (e) => handleImageUpload(e.target.files[0], imgWrap, blockEl);
            imgWrap.appendChild(uploadBox);
        }
        blockEl.appendChild(imgWrap);
    } else if (type === 'divider') {
        const divContent = document.createElement('div');
        divContent.className = 'pe-block-content';
        divContent.dataset.type = 'divider';
        blockEl.appendChild(divContent);
    } else {
        const contentEl = document.createElement('div');
        contentEl.className = 'pe-block-content';
        contentEl.contentEditable = true;
        contentEl.dataset.type = type;
        contentEl.dataset.placeholder = getPlaceholder(type);
        contentEl.innerHTML = blockData.content || '';

        attachContentEvents(contentEl, blockEl);
        blockEl.appendChild(contentEl);
    }

    if (insertAfterEl && insertAfterEl.nextSibling) {
        container.insertBefore(blockEl, insertAfterEl.nextSibling);
    } else {
        container.appendChild(blockEl);
    }

    return blockEl;
}

function getPlaceholder(type) {
    switch(type) {
        case 'heading2': return 'Heading 2...';
        case 'heading3': return 'Heading 3...';
        case 'quote': return 'Empty quote...';
        case 'callout': return 'Highlight key outcome or architecture note...';
        case 'code': return '// write or paste code here...';
        case 'bullet': return 'List item...';
        case 'numbered': return 'Numbered step...';
        default: return "Type '/' for commands or start writing...";
    }
}

function attachContentEvents(contentEl, blockEl) {
    contentEl.addEventListener('keydown', (e) => {
        if (e.key === 'Enter' && !e.shiftKey) {
            e.preventDefault();
            const newBlock = createBlockElement({ type: 'paragraph', content: '' }, blockEl);
            const nextEditable = newBlock.querySelector('[contenteditable="true"]');
            if (nextEditable) nextEditable.focus();
        } else if (e.key === 'Backspace' && contentEl.innerText.trim() === '') {
            if (container.children.length > 1) {
                e.preventDefault();
                const prev = blockEl.previousElementSibling;
                blockEl.remove();
                if (prev) {
                    const prevEditable = prev.querySelector('[contenteditable="true"]');
                    if (prevEditable) prevEditable.focus();
                }
            }
        } else if (e.key === '/') {
            setTimeout(() => {
                const rect = contentEl.getBoundingClientRect();
                showSlashMenu(rect.left, rect.bottom + 5, blockEl, contentEl);
            }, 50);
        }
    });

    contentEl.addEventListener('input', () => {
        if (slashMenu && !slashMenu.classList.contains('hidden')) {
            const text = contentEl.innerText;
            if (!text.includes('/')) hideSlashMenu();
        }
    });
}

function showSlashMenu(x, y, blockEl, contentEl) {
    activeSlashBlock = { blockEl, contentEl };
    slashMenu.style.left = `${Math.min(x, window.innerWidth - 260)}px`;
    slashMenu.style.top = `${Math.min(y, window.innerHeight - 340)}px`;
    slashMenu.classList.remove('hidden');
}

function hideSlashMenu() {
    slashMenu.classList.add('hidden');
    activeSlashBlock = null;
}

document.addEventListener('click', (e) => {
    if (!slashMenu.contains(e.target) && (!activeSlashBlock || !activeSlashBlock.contentEl.contains(e.target))) {
        hideSlashMenu();
    }
});

slashMenu.querySelectorAll('.pe-slash-item').forEach(item => {
    item.addEventListener('click', () => {
        const type = item.dataset.type;
        if (activeSlashBlock) {
            const { blockEl, contentEl } = activeSlashBlock;
            contentEl.innerText = contentEl.innerText.replace('/', '');
            const text = contentEl.innerText.trim();

            const newBlock = createBlockElement({ type: type, content: text }, blockEl);
            blockEl.remove();

            const nextEditable = newBlock.querySelector('[contenteditable="true"]');
            if (nextEditable) nextEditable.focus();
        }
        hideSlashMenu();
    });
});

async function handleImageUpload(file, imgWrap, blockEl) {
    if (!file) return;
    const formData = new FormData();
    formData.append('file', file);
    formData.append('_token', '{{ csrf_token() }}');

    const sizeMb = (file.size / (1024 * 1024)).toFixed(1);
    const uploadPhrases = [
        `pushing bytes to orbit (${sizeMb} MB)...`,
        `deploying media payload (${sizeMb} MB)...`,
        `routing to storage (${sizeMb} MB)...`,
        `uploading media (${sizeMb} MB)...`
    ];
    const uploadText = uploadPhrases[Math.floor(Math.random() * uploadPhrases.length)];
    imgWrap.innerHTML = `<div class="p-8 text-center text-xs text-[#875af5] font-mono"><i class="fa-solid fa-spinner fa-spin mr-2"></i>${uploadText}</div>`;

    try {
        const res = await fetch('{{ route("odds.admin.works.upload_body_media") }}', {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            }
        });
        const data = await res.json();
        if (data.url) {
            imgWrap.innerHTML = `
                <div class="relative group rounded-xl overflow-hidden border border-[#22222a]">
                    <img src="${data.url}" class="w-full h-auto max-h-96 object-contain bg-[#0b0b0e]">
                    <button type="button" onclick="this.closest('.pe-block').remove()" class="absolute top-2 right-2 p-1.5 bg-red-950/80 text-red-300 rounded-lg text-xs hover:bg-red-900 transition-colors">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                </div>
                <input type="text" class="pe-img-caption bg-transparent border-none outline-none text-center text-xs text-gray-400 mt-1 placeholder-gray-600" placeholder="Optional caption...">
            `;
            imgWrap.dataset.src = data.url;
        } else {
            const errMsg = data.error || data.message || 'Upload failed. Please try again.';
            imgWrap.innerHTML = `<div class="p-4 text-center text-xs text-red-400 font-mono">${errMsg}</div>`;
        }
    } catch(err) {
        imgWrap.innerHTML = '<div class="p-4 text-center text-xs text-red-400 font-mono">Upload failed. File may exceed server limits (128MB max).</div>';
    }
}

// ─── 16:9 Card Cover Image Live Preview & Upload Handling ───
const coverDropzone = document.getElementById('cover-dropzone');
const coverInput = document.getElementById('cover_image_input');
const coverPlaceholder = document.getElementById('cover-placeholder');
const coverPreviewContainer = document.getElementById('cover-preview-container');
const coverPreviewImg = document.getElementById('cover-preview-img');
const coverUrlInput = document.getElementById('cover_image_url');
const btnChangeCover = document.getElementById('btn-change-cover');
const btnClearCover = document.getElementById('btn-clear-cover');

if (coverDropzone && coverInput) {
    coverDropzone.addEventListener('click', (e) => {
        if (e.target.closest('#btn-clear-cover') || e.target.closest('#btn-change-cover')) return;
        coverInput.click();
    });

    if (btnChangeCover) {
        btnChangeCover.addEventListener('click', (e) => {
            e.stopPropagation();
            coverInput.click();
        });
    }

    if (btnClearCover) {
        btnClearCover.addEventListener('click', (e) => {
            e.stopPropagation();
            coverInput.value = '';
            if (coverUrlInput) coverUrlInput.value = '';
            document.getElementById('cover_image_base64').value = '';
            coverPreviewImg.src = '';
            coverPreviewContainer.classList.add('hidden');
            coverPlaceholder.classList.remove('hidden');
        });
    }

    coverInput.addEventListener('change', () => {
        const file = coverInput.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = (e) => {
                coverPreviewImg.src = e.target.result;
                coverPreviewContainer.classList.remove('hidden');
                coverPlaceholder.classList.add('hidden');
                if (coverUrlInput) coverUrlInput.value = '';
            };
            reader.readAsDataURL(file);
        }
    });

    // Drag & Drop
    coverDropzone.addEventListener('dragover', (e) => {
        e.preventDefault();
        coverDropzone.classList.add('border-[#875af5]', 'bg-[#12121a]');
    });

    coverDropzone.addEventListener('dragleave', (e) => {
        e.preventDefault();
        coverDropzone.classList.remove('border-[#875af5]', 'bg-[#12121a]');
    });

    coverDropzone.addEventListener('drop', (e) => {
        e.preventDefault();
        coverDropzone.classList.remove('border-[#875af5]', 'bg-[#12121a]');
        if (e.dataTransfer.files && e.dataTransfer.files[0]) {
            coverInput.files = e.dataTransfer.files;
            const file = e.dataTransfer.files[0];
            const reader = new FileReader();
            reader.onload = (ev) => {
                coverPreviewImg.src = ev.target.result;
                coverPreviewContainer.classList.remove('hidden');
                coverPlaceholder.classList.add('hidden');
                if (coverUrlInput) coverUrlInput.value = '';
            };
            reader.readAsDataURL(file);
        }
    });

    if (coverUrlInput) {
        coverUrlInput.addEventListener('input', () => {
            const val = coverUrlInput.value.trim();
            if (val) {
                coverPreviewImg.src = val;
                coverPreviewContainer.classList.remove('hidden');
                coverPlaceholder.classList.add('hidden');
                coverInput.value = '';
            } else if (!coverInput.files.length) {
                coverPreviewImg.src = '';
                coverPreviewContainer.classList.add('hidden');
                coverPlaceholder.classList.remove('hidden');
            }
        });
    }
}

document.getElementById('work-form').addEventListener('submit', function() {
    const blocks = [];
    container.querySelectorAll('.pe-block').forEach(blockEl => {
        const type = blockEl.dataset.type;
        if (type === 'image') {
            const imgWrap = blockEl.querySelector('.pe-block-image-wrap');
            const src = imgWrap ? imgWrap.dataset.src : '';
            const captionInput = blockEl.querySelector('.pe-img-caption');
            const caption = captionInput ? captionInput.value : '';
            if (src) blocks.push({ type: 'image', src, caption });
        } else if (type === 'divider') {
            blocks.push({ type: 'divider' });
        } else {
            const contentEl = blockEl.querySelector('.pe-block-content');
            if (contentEl) {
                const content = contentEl.innerHTML;
                blocks.push({ type, content });
            }
        }
    });

    document.getElementById('body_content_input').value = JSON.stringify(blocks);
});
</script>
@endpush
