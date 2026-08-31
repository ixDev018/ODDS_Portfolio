@extends('admin.odds.layout')

@section('title', 'Edit Service — ' . $service->clean_name)

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
        width: 340px; flex-shrink: 0;
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

    /* Preset Icon Chips */
    .icon-preset-chip {
        display: flex; align-items: center; gap: 0.4rem;
        padding: 0.35rem 0.6rem;
        background: var(--bg-input);
        border: 1px solid var(--border-color);
        border-radius: 0.5rem;
        font-size: 0.7rem; font-weight: 600;
        color: var(--text-muted);
        cursor: pointer; transition: all 0.15s;
    }
    .icon-preset-chip:hover {
        border-color: var(--odds-purple);
        background: var(--tr-selected);
        color: var(--text-title);
    }
    .icon-preset-chip svg {
        width: 14px; height: 14px; stroke: currentColor; flex-shrink: 0;
    }

    @media (max-width: 900px) {
        .pe-shell { flex-direction: column; height: auto; overflow: visible; }
        .pe-sidebar { width: 100%; }
        .pe-editor-col { height: 60vh; }
    }
</style>
@endpush

@section('content')

<a href="{{ route('odds.admin.services.index') }}" class="pe-back">
    <i class="fa-solid fa-arrow-left text-[10px]"></i>
    <span>Back to Services</span>
</a>

<form id="service-form" action="{{ route('odds.admin.services.update', $service->id) }}" method="POST" enctype="multipart/form-data" class="pe-shell">
    @csrf
    <input type="hidden" name="body_content" id="body_content_input">

    <!-- ══ LEFT: Seamless Notion Editor ══ -->
    <div class="pe-editor-col">
        <div class="pe-editor-header">
            <input type="text" name="name" required value="{{ old('name', $service->name) }}" placeholder="Service Name (e.g. Software Development)..."
                   class="pe-title-input" autofocus>
            <textarea name="description" rows="2" placeholder="Write a short summary or card hook for the services marquee..."
                      class="pe-desc-input">{{ old('description', $service->description) }}</textarea>
        </div>

        <div class="pe-editor-divider"></div>

        <div id="notion-blocks-container" class="pe-blocks-scroll">
            <!-- Populated via JS with existing blocks -->
        </div>
    </div>

    <!-- ══ RIGHT: Metadata & Publish Sidebar ══ -->
    <div class="pe-sidebar">
        <div class="pe-sidebar-header">
            <span class="pe-sidebar-header-label">Service Settings</span>
            <span class="font-mono text-[9px] text-[#875af5] font-bold">
                {{ $service->is_active ? 'ACTIVE' : 'HIDDEN' }}
            </span>
        </div>

        <div class="pe-sidebar-scroll">
            <div>
                <label class="odds-label">Tagline</label>
                <input type="text" name="tagline" value="{{ old('tagline', $service->tagline) }}" placeholder="e.g. Logic. Built to last." class="odds-input">
            </div>

            <!-- SVG Icon Picker & Presets -->
            <div class="space-y-2">
                <div class="flex items-center justify-between">
                    <label class="odds-label mb-0">Card SVG Icon</label>
                    <span class="text-[9px] font-mono px-1.5 py-0.5 rounded bg-[#875af5]/15 text-[#875af5] font-bold tracking-wider">MARQUEE & MODAL</span>
                </div>

                <div class="flex items-center gap-3">
                    <div id="svg-preview-box" class="w-12 h-12 rounded-xl bg-[#875af5]/10 border border-[#875af5]/30 flex items-center justify-center text-[#875af5] flex-shrink-0">
                        @if(!empty($service->icon_svg))
                            {!! $service->icon_svg !!}
                        @else
                            <i class="fa-solid fa-cube text-lg"></i>
                        @endif
                    </div>
                    <div class="flex-1 text-[11px] text-gray-400">
                        Select a standard icon below or paste custom inline SVG.
                    </div>
                </div>

                <div>
                    <label class="text-[10px] font-mono uppercase text-gray-400 mb-1 block">Icons Used in ODDS (Click to Apply):</label>
                    <div class="grid grid-cols-2 gap-1.5" id="used-icons-presets">
                        <button type="button" class="icon-preset-chip" data-name="Software Development" data-svg='<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><polyline points="16 18 22 12 16 6"></polyline><polyline points="8 6 2 12 8 18"></polyline><line x1="14" y1="4" x2="10" y2="20"></line></svg>'>
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><polyline points="16 18 22 12 16 6"></polyline><polyline points="8 6 2 12 8 18"></polyline><line x1="14" y1="4" x2="10" y2="20"></line></svg>
                            <span>Software (&lt; / &gt;)</span>
                        </button>

                        <button type="button" class="icon-preset-chip" data-name="Web-App Development" data-svg='<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect><line x1="8" y1="21" x2="16" y2="21"></line><line x1="12" y1="17" x2="12" y2="21"></line><line x1="2" y1="8" x2="22" y2="8"></line></svg>'>
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect><line x1="8" y1="21" x2="16" y2="21"></line><line x1="12" y1="17" x2="12" y2="21"></line></svg>
                            <span>Web-App</span>
                        </button>

                        <button type="button" class="icon-preset-chip" data-name="Mobile Applications" data-svg='<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><rect x="5" y="2" width="14" height="20" rx="3" ry="3"></rect><line x1="12" y1="18" x2="12.01" y2="18"></line><line x1="10" y1="5" x2="14" y2="5"></line></svg>'>
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><rect x="5" y="2" width="14" height="20" rx="3" ry="3"></rect><line x1="12" y1="18" x2="12.01" y2="18"></line></svg>
                            <span>Mobile App</span>
                        </button>

                        <button type="button" class="icon-preset-chip" data-name="Backend & DevOps" data-svg='<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="2" width="20" height="8" rx="2" ry="2"></rect><rect x="2" y="14" width="20" height="8" rx="2" ry="2"></rect><line x1="6" y1="6" x2="6.01" y2="6"></line><line x1="6" y1="18" x2="6.01" y2="18"></line></svg>'>
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><rect x="2" y="2" width="20" height="8" rx="2" ry="2"></rect><rect x="2" y="14" width="20" height="8" rx="2" ry="2"></rect></svg>
                            <span>Backend / Ops</span>
                        </button>

                        <button type="button" class="icon-preset-chip" data-name="Game Development" data-svg='<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><line x1="6" y1="12" x2="10" y2="12"></line><line x1="8" y1="10" x2="8" y2="14"></line><circle cx="15" cy="13" r="1"></circle><circle cx="18" cy="11" r="1"></circle><rect x="2" y="6" width="20" height="12" rx="6"></rect></svg>'>
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><circle cx="15" cy="13" r="1"></circle><rect x="2" y="6" width="20" height="12" rx="6"></rect></svg>
                            <span>Game Dev</span>
                        </button>

                        <button type="button" class="icon-preset-chip" data-name="Hardware Solutions" data-svg='<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><rect x="4" y="4" width="16" height="16" rx="2" ry="2"></rect><rect x="9" y="9" width="6" height="6"></rect><line x1="9" y1="1" x2="9" y2="4"></line><line x1="15" y1="1" x2="15" y2="4"></line><line x1="9" y1="20" x2="9" y2="23"></line><line x1="15" y1="20" x2="15" y2="23"></line><line x1="20" y1="9" x2="23" y2="9"></line><line x1="20" y1="15" x2="23" y2="15"></line><line x1="1" y1="9" x2="4" y2="9"></line><line x1="1" y1="15" x2="4" y2="15"></line></svg>'>
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><rect x="4" y="4" width="16" height="16" rx="2" ry="2"></rect><rect x="9" y="9" width="6" height="6"></rect></svg>
                            <span>Hardware / IoT</span>
                        </button>
                    </div>
                </div>

                <div>
                    <label class="text-[10px] font-mono uppercase text-gray-400 mb-1 block">Custom SVG Code:</label>
                    <textarea name="icon_svg" id="icon_svg_input" rows="3" 
                              placeholder='e.g. <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"...><polyline points="16 18 22 12 16 6"></polyline><polyline points="8 6 2 12 8 18"></polyline><line x1="14" y1="4" x2="10" y2="20"></line></svg>'
                              class="odds-input font-mono text-[11px]">{{ old('icon_svg', $service->icon_svg) }}</textarea>
                </div>
            </div>

            <!-- 16:9 Cover Image Uploader -->
            <div class="space-y-1.5">
                <div class="flex items-center justify-between">
                    <label class="odds-label mb-0">Modal Cover Image</label>
                    <span class="text-[9px] font-mono px-1.5 py-0.5 rounded bg-gray-800 text-gray-400 font-bold tracking-wider">OPTIONAL (16:9)</span>
                </div>
                
                @php $hasCover = !empty($service->cover_image_url ?? $service->cover_image); @endphp
                <div id="cover-dropzone" class="relative group aspect-[16/9] w-full rounded-xl border-2 border-dashed border-[#2b2b36] hover:border-[#875af5] bg-[#0d0d12] flex flex-col items-center justify-center p-3 text-center cursor-pointer transition-all overflow-hidden">
                    <div id="cover-placeholder" class="{{ $hasCover ? 'hidden' : '' }} flex flex-col items-center justify-center space-y-2 pointer-events-none">
                        <div class="w-10 h-10 rounded-full bg-[#181822] flex items-center justify-center text-[#875af5] group-hover:scale-110 transition-transform">
                            <i class="fa-solid fa-cloud-arrow-up text-sm"></i>
                        </div>
                        <div>
                            <div class="text-xs font-semibold text-gray-200">Upload 16:9 Image</div>
                            <div class="text-[10px] text-gray-500 font-mono mt-0.5">Click or drag & drop (PNG, JPG, WebP)</div>
                        </div>
                    </div>

                    <div id="cover-preview-container" class="{{ $hasCover ? '' : 'hidden' }} absolute inset-0 w-full h-full">
                        <img id="cover-preview-img" src="{{ $service->cover_image_url ?? $service->cover_image }}" alt="Cover Preview" class="w-full h-full object-cover">
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
                <input type="hidden" name="remove_cover_image" id="remove_cover_image" value="0">
                
                <div class="pt-1">
                    <input type="url" name="cover_image_url" id="cover_image_url" value="{{ old('cover_image_url', $service->cover_image) }}" placeholder="Or paste 16:9 Image URL (https://...)" class="odds-input text-xs font-mono py-1 px-2.5">
                </div>
            </div>

            @php
                $featuresString = is_array($service->features) ? implode(', ', $service->features) : ($service->features ?? '');
            @endphp
            <div>
                <label class="odds-label">Key Deliverables (Comma-Separated)</label>
                <input type="text" name="features" value="{{ old('features', $featuresString) }}" placeholder="e.g. Microservices, High Concurrency, Zero Downtime" class="odds-input text-xs">
            </div>

            <div class="grid grid-cols-2 gap-2">
                <div>
                    <label class="odds-label">CTA Button Text</label>
                    <input type="text" name="action_btn_text" value="{{ old('action_btn_text', $service->action_btn_text ?? "Let's Build") }}" placeholder="Let's Build" class="odds-input text-xs">
                </div>
                <div>
                    <label class="odds-label">CTA Target URL</label>
                    <input type="text" name="action_btn_url" value="{{ old('action_btn_url', $service->action_btn_url ?? '#cta') }}" placeholder="#cta" class="odds-input font-mono text-xs">
                </div>
            </div>

            <div class="pt-2 border-t border-[#22222a] space-y-2">
                <label class="flex items-center space-x-2 cursor-pointer">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $service->is_active) ? 'checked' : '' }} class="rounded bg-[#0b0b0e] border-[#22222a] text-[#875af5] focus:ring-0">
                    <span class="text-xs text-gray-300 font-semibold">Active in Marquee</span>
                </label>
            </div>
        </div>

        <div class="pe-sidebar-footer flex items-center justify-between gap-2">
            <a href="{{ route('odds.admin.services.index') }}" class="odds-btn-secondary text-xs">
                Cancel
            </a>
            <button type="submit" id="btn-submit-service" class="odds-btn-primary text-xs">
                <i class="fa-solid fa-floppy-disk mr-1 text-[10px]"></i>
                <span>Save Changes</span>
            </button>
        </div>
    </div>
</form>

<!-- Slash Command Floating Menu -->
<div id="slash-menu" class="pe-slash-menu hidden">
    <div class="text-[9px] font-mono uppercase text-gray-500 px-2 py-1">Basic Blocks</div>
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
            <div class="text-xs font-bold text-white">Image / Diagram</div>
            <div class="text-[10px] text-gray-400">Upload inline service visual</div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
const container = document.getElementById('notion-blocks-container');
const slashMenu = document.getElementById('slash-menu');
let activeSlashBlock = null;

let rawBlocks = @json($service->body_content);
if (typeof rawBlocks === 'string' && rawBlocks.trim() !== '') {
    try { rawBlocks = JSON.parse(rawBlocks); } catch(e) { rawBlocks = []; }
}

document.addEventListener('DOMContentLoaded', () => {
    if (rawBlocks && Array.isArray(rawBlocks) && rawBlocks.length > 0) {
        rawBlocks.forEach(b => createBlockElement(b));
    } else {
        const initialBlocks = [
            { type: 'heading2', content: 'Engineered For Enterprise Scale' },
            { type: 'paragraph', content: {!! json_encode($service->description ?? 'Describe what this service solves and how ODDS delivers it.') !!} },
            { type: 'callout', content: '<strong>The ODDS Standard:</strong> Stack-agnostic architecture, high test coverage, and immediate production readiness.' },
            { type: 'heading3', content: 'Core Capabilities & Deliverables' },
            { type: 'bullet', content: 'High-performance bespoke engineering tailored to operational workflows' },
            { type: 'bullet', content: 'Scalable cloud infrastructure and low-latency API communication' },
            { type: 'bullet', content: 'Continuous testing, automated deployment, and post-launch telemetry' }
        ];
        initialBlocks.forEach(b => createBlockElement(b));
    }
    initSortable();
    initSvgPresetHandlers();
});

function initSortable() {
    new Sortable(container, {
        handle: '.pe-block-handle',
        animation: 150,
        ghostClass: 'opacity-40'
    });
}

function initSvgPresetHandlers() {
    const svgInput = document.getElementById('icon_svg_input');
    const svgPreviewBox = document.getElementById('svg-preview-box');
    const presetButtons = document.querySelectorAll('#used-icons-presets .icon-preset-chip');

    function updatePreview() {
        const val = svgInput.value.trim();
        if (val.startsWith('<svg') && val.endsWith('</svg>')) {
            svgPreviewBox.innerHTML = val;
            const svgEl = svgPreviewBox.querySelector('svg');
            if (svgEl) {
                svgEl.style.width = '24px';
                svgEl.style.height = '24px';
                svgEl.style.stroke = '#875af5';
            }
        } else {
            svgPreviewBox.innerHTML = '<i class="fa-solid fa-cube text-lg"></i>';
        }
    }

    if (svgInput) {
        svgInput.addEventListener('input', updatePreview);
    }

    presetButtons.forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.preventDefault();
            const svgCode = btn.dataset.svg;
            if (svgInput && svgCode) {
                svgInput.value = svgCode;
                updatePreview();
            }
        });
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
                <span class="text-xs text-gray-300 font-semibold">Click to upload diagram or drag & drop</span>
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
    imgWrap.innerHTML = `<div class="p-8 text-center text-xs text-[#875af5] font-mono"><i class="fa-solid fa-spinner fa-spin mr-2"></i>uploading media (${sizeMb} MB)...</div>`;

    try {
        const res = await fetch('{{ route("odds.admin.services.upload_body_media") }}', {
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

// ─── Cover Image Uploader ───
const coverDropzone = document.getElementById('cover-dropzone');
const coverInput = document.getElementById('cover_image_input');
const coverPlaceholder = document.getElementById('cover-placeholder');
const coverPreviewContainer = document.getElementById('cover-preview-container');
const coverPreviewImg = document.getElementById('cover-preview-img');
const coverUrlInput = document.getElementById('cover_image_url');
const btnChangeCover = document.getElementById('btn-change-cover');
const btnClearCover = document.getElementById('btn-clear-cover');
const removeCoverInput = document.getElementById('remove_cover_image');

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
            if (removeCoverInput) removeCoverInput.value = '1';
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
                if (removeCoverInput) removeCoverInput.value = '0';
                document.getElementById('cover_image_base64').value = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    });

    if (coverUrlInput) {
        coverUrlInput.addEventListener('input', () => {
            const url = coverUrlInput.value.trim();
            if (url) {
                coverPreviewImg.src = url;
                coverPreviewContainer.classList.remove('hidden');
                coverPlaceholder.classList.add('hidden');
                coverInput.value = '';
                document.getElementById('cover_image_base64').value = '';
                if (removeCoverInput) removeCoverInput.value = '0';
            } else {
                coverPreviewContainer.classList.add('hidden');
                coverPlaceholder.classList.remove('hidden');
            }
        });
    }
}

// ─── Form Submission Serializer ───
const serviceForm = document.getElementById('service-form');
if (serviceForm) {
    serviceForm.addEventListener('submit', (e) => {
        const blocks = [];
        container.querySelectorAll('.pe-block').forEach(b => {
            const type = b.dataset.type;
            if (type === 'image') {
                const imgWrap = b.querySelector('.pe-block-image-wrap');
                const src = imgWrap ? imgWrap.dataset.src : '';
                const captionInput = b.querySelector('.pe-img-caption');
                const caption = captionInput ? captionInput.value.trim() : '';
                if (src) {
                    blocks.push({ type: 'image', src, caption });
                }
            } else if (type === 'divider') {
                blocks.push({ type: 'divider' });
            } else {
                const contentEl = b.querySelector('.pe-block-content');
                if (contentEl) {
                    const content = contentEl.innerHTML.trim();
                    if (content !== '') {
                        blocks.push({ type, content });
                    }
                }
            }
        });

        document.getElementById('body_content_input').value = JSON.stringify(blocks);
    });
}
</script>
@endpush
