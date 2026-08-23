@extends('admin.odds.layout')

@section('title', 'Hero & General Settings')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-extrabold text-white tracking-tight">Hero & Studio Settings</h1>
            <p class="text-xs font-mono text-gray-400 uppercase tracking-wider mt-0.5">Configure landing headline, KPI counters, and terminal channels</p>
        </div>
    </div>

    <form action="{{ route('odds.admin.settings.update') }}" method="POST" class="space-y-6">
        @csrf

        <!-- 1. Hero Section Settings -->
        <div class="odds-card p-6 space-y-4">
            <div class="border-b border-[#22222a] pb-3 flex items-center justify-between">
                <h2 class="text-xs font-bold text-[#875af5] uppercase font-mono tracking-wider">1. Hero Landing Fold</h2>
                <span class="text-[10px] font-mono text-gray-500 uppercase">Above the Fold</span>
            </div>

            <div class="space-y-4">
                <div>
                    <label class="odds-label">Hero Headline</label>
                    <textarea name="hero_title" rows="2" required 
                              class="odds-input font-bold text-lg leading-snug">{{ old('hero_title', $settings->hero_title) }}</textarea>
                    <span class="text-[10px] text-gray-500 font-mono">Use Enter for line breaks.</span>
                </div>

                <div>
                    <label class="odds-label">Hero Subtitle / Mission Statement</label>
                    <textarea name="hero_subtitle" rows="3" 
                              class="odds-input leading-relaxed text-xs">{{ old('hero_subtitle', $settings->hero_subtitle) }}</textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="odds-label">CTA Button Label</label>
                        <input type="text" name="hero_btn_text" value="{{ old('hero_btn_text', $settings->hero_btn_text) }}"
                               class="odds-input font-bold">
                    </div>
                    <div>
                        <label class="odds-label">CTA Button Link</label>
                        <input type="text" name="hero_btn_link" value="{{ old('hero_btn_link', $settings->hero_btn_link) }}"
                               class="odds-input font-mono text-xs">
                    </div>
                </div>
            </div>
        </div>

        <!-- 2. Works Section & KPI Stats -->
        <div class="odds-card p-6 space-y-4">
            <div class="border-b border-[#22222a] pb-3 flex items-center justify-between">
                <h2 class="text-xs font-bold text-[#875af5] uppercase font-mono tracking-wider">2. Works Showcase & Live KPIs</h2>
                <span class="text-[10px] font-mono text-gray-500 uppercase">3×3 Grid Fold</span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="odds-label">Accomplished Projects</label>
                    <input type="text" name="kpi_projects_accomplished" value="{{ old('kpi_projects_accomplished', $settings->kpi_projects_accomplished) }}"
                           class="odds-input font-mono font-bold text-base">
                </div>
                <div>
                    <label class="odds-label">Client Satisfaction</label>
                    <div class="flex space-x-2">
                        <input type="text" name="kpi_client_satisfaction" value="{{ old('kpi_client_satisfaction', $settings->kpi_client_satisfaction) }}"
                               class="odds-input font-mono font-bold text-base w-1/2">
                        <input type="text" name="kpi_satisfaction_denom" value="{{ old('kpi_satisfaction_denom', $settings->kpi_satisfaction_denom) }}"
                               class="odds-input font-mono text-base w-1/2">
                    </div>
                </div>
                <div>
                    <label class="odds-label">Reliability Angle %</label>
                    <input type="text" name="kpi_reliability" value="{{ old('kpi_reliability', $settings->kpi_reliability) }}"
                           class="odds-input font-mono font-bold text-base">
                </div>
            </div>

            <div>
                <label class="odds-label">Works Sub-description</label>
                <textarea name="works_description" rows="2" 
                          class="odds-input text-xs">{{ old('works_description', $settings->works_description) }}</textarea>
            </div>
        </div>

        <!-- 3. Terminal & Contact Settings -->
        <div class="odds-card p-6 space-y-4">
            <div class="border-b border-[#22222a] pb-3 flex items-center justify-between">
                <h2 class="text-xs font-bold text-[#875af5] uppercase font-mono tracking-wider">3. Terminal CTA & Channels</h2>
                <span class="text-[10px] font-mono text-gray-500 uppercase">Footer Fold</span>
            </div>

            <div class="space-y-4">
                <div>
                    <label class="odds-label">CTA Headline</label>
                    <textarea name="cta_title" rows="2" 
                              class="odds-input font-bold text-base">{{ old('cta_title', $settings->cta_title) }}</textarea>
                </div>

                <div>
                    <label class="odds-label">CTA Description</label>
                    <textarea name="cta_desc" rows="3" 
                              class="odds-input text-xs leading-relaxed">{{ old('cta_desc', $settings->cta_desc) }}</textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="odds-label">Contact Email</label>
                        <input type="email" name="cta_email" value="{{ old('cta_email', $settings->cta_email) }}"
                               class="odds-input">
                    </div>
                    <div>
                        <label class="odds-label">Contact Phone</label>
                        <input type="text" name="cta_phone" value="{{ old('cta_phone', $settings->cta_phone) }}"
                               class="odds-input font-mono">
                    </div>
                    <div>
                        <label class="odds-label">Facebook Handle</label>
                        <input type="text" name="cta_facebook" value="{{ old('cta_facebook', $settings->cta_facebook) }}"
                               class="odds-input">
                    </div>
                    <div>
                        <label class="odds-label">Instagram Handle</label>
                        <input type="text" name="cta_instagram" value="{{ old('cta_instagram', $settings->cta_instagram) }}"
                               class="odds-input">
                    </div>
                    <div>
                        <label class="odds-label">YouTube Handle</label>
                        <input type="text" name="cta_youtube" value="{{ old('cta_youtube', $settings->cta_youtube) }}"
                               class="odds-input">
                    </div>
                    <div>
                        <label class="odds-label">Terminal Prompt</label>
                        <input type="text" name="cta_terminal_prompt" value="{{ old('cta_terminal_prompt', $settings->cta_terminal_prompt) }}"
                               class="odds-input font-mono">
                    </div>
                </div>
            </div>
        </div>

        <div class="flex items-center justify-end space-x-4 pt-2">
            <button type="submit" class="odds-btn-primary px-8">
                <i class="fa-solid fa-floppy-disk text-xs"></i>
                <span>Save Studio Settings</span>
            </button>
        </div>
    </form>
</div>
@endsection
