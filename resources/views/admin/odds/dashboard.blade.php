@extends('admin.odds.layout')

@section('title', 'Dashboard')

@section('content')
<div class="space-y-6 max-w-7xl mx-auto">

    <!-- Top Hero Banner Card -->
    <div class="odds-card p-6 md:p-8 relative overflow-hidden bg-gradient-to-r from-[#141418] via-[#171720] to-[#121217] border border-[#262632]">
        <div class="absolute -right-16 -top-16 w-64 h-64 bg-[#875af5]/10 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute right-32 -bottom-16 w-48 h-48 bg-[#f359b0]/10 rounded-full blur-3xl pointer-events-none"></div>

        <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-6 relative z-10">
            <div class="space-y-2">
                <div class="inline-flex items-center space-x-2 px-3 py-1 rounded-full bg-[#875af5]/10 border border-[#875af5]/25 text-[#875af5] text-[10px] font-mono font-bold tracking-wider uppercase">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                    <span>Studio Core Active</span>
                </div>
                <h1 class="text-2xl md:text-3xl font-extrabold text-white tracking-tight">
                    ODDS Studio Control Hub
                </h1>
                <p class="text-xs text-gray-400 max-w-xl leading-relaxed">
                    Live telemetry and content orchestrator for the ODDS 3×3 project showcase, services marquee, value propositions, and visitor leads.
                </p>
            </div>

            <div class="flex items-center gap-3">
                <a href="{{ route('odds.admin.works.create') }}" class="odds-btn-primary">
                    <i class="fa-solid fa-plus text-xs"></i>
                    <span>Add Project</span>
                </a>
                <a href="{{ route('portfolio.index') }}" target="_blank" class="odds-btn-secondary">
                    <i class="fa-solid fa-arrow-up-right-from-square text-xs"></i>
                    <span>Front Page</span>
                </a>
            </div>
        </div>
    </div>

    <!-- 4 Metric Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
        
        <!-- Outputs / Works -->
        <div class="odds-card p-5 space-y-3">
            <div class="flex items-center justify-between">
                <span class="text-[11px] font-mono text-gray-400 uppercase font-semibold">Works / Outputs</span>
                <span class="w-7 h-7 rounded-lg bg-[#875af5]/15 text-[#875af5] flex items-center justify-center text-xs"><i class="fa-solid fa-folder-tree"></i></span>
            </div>
            <div>
                <div class="text-3xl font-extrabold text-white">{{ $worksCount }}</div>
                <div class="text-[10px] font-mono text-gray-500 mt-0.5">3×3 Grid Cards</div>
            </div>
            <div class="pt-2.5 border-t border-[#22222a] flex items-center justify-between text-[11px]">
                <span class="text-gray-500 font-mono">KPI: {{ $settings->kpi_projects_accomplished }}</span>
                <a href="{{ route('odds.admin.works.index') }}" class="font-bold text-[#875af5] hover:underline">Manage &rarr;</a>
            </div>
        </div>

        <!-- Services -->
        <div class="odds-card p-5 space-y-3">
            <div class="flex items-center justify-between">
                <span class="text-[11px] font-mono text-gray-400 uppercase font-semibold">Active Services</span>
                <span class="w-7 h-7 rounded-lg bg-[#f359b0]/15 text-[#f359b0] flex items-center justify-center text-xs"><i class="fa-solid fa-cubes"></i></span>
            </div>
            <div>
                <div class="text-3xl font-extrabold text-white">{{ $servicesCount }}</div>
                <div class="text-[10px] font-mono text-gray-500 mt-0.5">Marquee Offerings</div>
            </div>
            <div class="pt-2.5 border-t border-[#22222a] flex items-center justify-between text-[11px]">
                <span class="text-gray-500 font-mono">Status: Ready</span>
                <a href="{{ route('odds.admin.services.index') }}" class="font-bold text-[#875af5] hover:underline">Manage &rarr;</a>
            </div>
        </div>

        <!-- Testimonials -->
        <div class="odds-card p-5 space-y-3">
            <div class="flex items-center justify-between">
                <span class="text-[11px] font-mono text-gray-400 uppercase font-semibold">Client Reviews</span>
                <span class="w-7 h-7 rounded-lg bg-amber-500/15 text-amber-400 flex items-center justify-center text-xs"><i class="fa-solid fa-star"></i></span>
            </div>
            <div>
                <div class="text-3xl font-extrabold text-white">{{ $testimonialsCount }}</div>
                <div class="text-[10px] font-mono text-gray-500 mt-0.5">Verified Testimonials</div>
            </div>
            <div class="pt-2.5 border-t border-[#22222a] flex items-center justify-between text-[11px]">
                <span class="text-gray-500 font-mono">Rating: {{ $settings->kpi_client_satisfaction }}{{ $settings->kpi_satisfaction_denom }}</span>
                <a href="{{ route('odds.admin.testimonials.index') }}" class="font-bold text-[#875af5] hover:underline">Manage &rarr;</a>
            </div>
        </div>

        <!-- Inbox -->
        <div class="odds-card p-5 space-y-3">
            <div class="flex items-center justify-between">
                <span class="text-[11px] font-mono text-gray-400 uppercase font-semibold">Visitor Inbox</span>
                <span class="w-7 h-7 rounded-lg bg-emerald-500/15 text-emerald-400 flex items-center justify-center text-xs"><i class="fa-solid fa-inbox"></i></span>
            </div>
            <div class="flex items-baseline space-x-2">
                <div class="text-3xl font-extrabold text-white">{{ $inquiriesCount }}</div>
                @if($unreadInquiriesCount > 0)
                <span class="text-xs font-bold text-[#f359b0] font-mono">({{ $unreadInquiriesCount }} new)</span>
                @endif
            </div>
            <div class="pt-2.5 border-t border-[#22222a] flex items-center justify-between text-[11px]">
                <span class="text-gray-500 font-mono">Reliability: {{ $settings->kpi_reliability }}</span>
                <a href="{{ route('odds.admin.inquiries.index') }}" class="font-bold text-[#875af5] hover:underline">View &rarr;</a>
            </div>
        </div>

    </div>

    <!-- 2-Column Split: Recent Outputs & Terminal Settings -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- Left 2-Cols: Recent Works Table -->
        <div class="lg:col-span-2 odds-card p-6 space-y-4">
            <div class="flex items-center justify-between border-b border-[#22222a] pb-3">
                <div>
                    <h2 class="text-sm font-bold text-white uppercase font-mono tracking-wide">Project Outputs (3×3 Showcase)</h2>
                    <p class="text-xs text-gray-400">Live project cards in order of appearance</p>
                </div>
                <a href="{{ route('odds.admin.works.create') }}" class="odds-btn-secondary text-xs">
                    + Add Output
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="odds-table">
                    <thead>
                        <tr>
                            <th style="width: 40px;">#</th>
                            <th>PROJECT TITLE</th>
                            <th>CATEGORY</th>
                            <th>YEAR</th>
                            <th class="text-right" style="width: 80px;">ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentWorks as $work)
                        <tr class="hover:bg-white/[0.02] transition-colors">
                            <td class="font-mono text-gray-500 font-bold text-xs">{{ $work->sort_order }}</td>
                            <td>
                                <span class="font-bold text-white">{{ $work->title }}</span>
                                @if($work->is_featured)
                                    <span class="ml-2 odds-badge odds-badge-purple text-[9px]">3×3 Grid</span>
                                @endif
                            </td>
                            <td><span class="text-xs text-gray-400">{{ $work->category ?? 'Software' }}</span></td>
                            <td><span class="font-mono text-xs text-gray-500">{{ $work->year ?? '2024' }}</span></td>
                            <td class="text-right">
                                <a href="{{ route('odds.admin.works.edit', $work->id) }}" class="p-1.5 text-gray-400 hover:text-[#875af5] transition-colors">
                                    <i class="fa-solid fa-pen-to-square text-xs"></i>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="py-8 text-center text-gray-500 font-mono text-xs">No project works configured yet.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="pt-2 text-right">
                <a href="{{ route('odds.admin.works.index') }}" class="text-xs text-[#875af5] hover:underline font-bold">
                    View all outputs in split panel &rarr;
                </a>
            </div>
        </div>

        <!-- Right 1-Col: Terminal CTA & Inbox -->
        <div class="space-y-6">
            <!-- Terminal Params -->
            <div class="odds-card p-6 space-y-3">
                <h2 class="text-xs font-bold text-white uppercase font-mono tracking-wider">Terminal Output Parameters</h2>
                <div class="p-3.5 rounded-xl bg-[#0f0f13] border border-[#22222a] text-xs font-mono space-y-1.5 text-gray-400">
                    <div><span class="text-gray-500">EMAIL:</span> <span class="text-white">{{ $settings->cta_email }}</span></div>
                    <div><span class="text-gray-500">PHONE:</span> <span class="text-white">{{ $settings->cta_phone }}</span></div>
                    <div><span class="text-gray-500">PROMPT:</span> <span class="text-emerald-400">{{ $settings->cta_terminal_prompt }}</span></div>
                </div>
                <a href="{{ route('odds.admin.settings') }}" class="odds-btn-secondary w-full justify-center text-xs">
                    Edit Studio Settings
                </a>
            </div>

            <!-- Recent Inquiries -->
            <div class="odds-card p-6 space-y-3">
                <div class="flex items-center justify-between border-b border-[#22222a] pb-3">
                    <h2 class="text-xs font-bold text-white uppercase font-mono tracking-wider">Recent Leads</h2>
                    <a href="{{ route('odds.admin.inquiries.index') }}" class="text-xs text-[#875af5] hover:underline font-semibold">View All</a>
                </div>

                <div class="space-y-2">
                    @forelse($recentInquiries as $inquiry)
                    <a href="{{ route('odds.admin.inquiries.show', $inquiry->id) }}" class="block p-3 rounded-xl bg-[#0f0f13] hover:bg-[#191922] border border-[#22222a] transition-colors">
                        <div class="flex items-center justify-between text-xs">
                            <span class="font-bold {{ !$inquiry->is_read ? 'text-[#875af5]' : 'text-white' }}">{{ $inquiry->name }}</span>
                            <span class="text-[10px] text-gray-500 font-mono">{{ $inquiry->created_at->diffForHumans() }}</span>
                        </div>
                        <p class="text-[11px] text-gray-400 truncate mt-1">{{ $inquiry->message }}</p>
                    </a>
                    @empty
                    <div class="py-4 text-center text-xs text-gray-500 font-mono">No incoming inquiries.</div>
                    @endforelse
                </div>
            </div>
        </div>

    </div>

</div>
@endsection
