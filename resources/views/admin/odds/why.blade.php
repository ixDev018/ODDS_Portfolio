@extends('admin.odds.layout')

@section('title', 'Why Bet on ODDS')

@section('content')
<div class="space-y-6 max-w-5xl mx-auto">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-extrabold text-white tracking-tight">Value Pillars ("Why Bet on ODDS ?")</h1>
            <p class="text-xs font-mono text-gray-400 uppercase tracking-wider mt-0.5">Configure value proposition cards displayed in the Why fold</p>
        </div>

        <button type="button" onclick="document.getElementById('new-reason-modal').classList.remove('hidden')" class="odds-btn-primary">
            <i class="fa-solid fa-plus text-xs"></i>
            <span>Add Pillar</span>
        </button>
    </div>

    <div class="odds-card overflow-hidden">
        <table class="odds-table">
            <thead>
                <tr>
                    <th>PILLAR TITLE</th>
                    <th>DESCRIPTION TEXT</th>
                    <th class="text-right" style="width: 100px;">ACTION</th>
                </tr>
            </thead>
            <tbody>
                @forelse($reasons as $r)
                <tr class="hover:bg-white/[0.02] transition-colors">
                    <td>
                        <div class="font-bold text-white text-sm">{{ $r->title }}</div>
                    </td>
                    <td>
                        <div class="text-xs text-gray-400 max-w-xl leading-relaxed">{{ $r->text }}</div>
                    </td>
                    <td class="text-right">
                        <div class="flex items-center justify-end space-x-2">
                            <form action="{{ route('odds.admin.why.delete', $r->id) }}" method="POST" onsubmit="return confirm('Delete this reason?');" class="inline">
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
                    <td colspan="3" class="py-12 text-center text-gray-500 font-mono text-xs">No pillars created yet.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- New Reason Modal -->
<div id="new-reason-modal" class="fixed inset-0 bg-black/70 backdrop-blur-sm z-50 flex items-center justify-center hidden">
    <div class="odds-card w-full max-w-lg p-6 space-y-4 m-4 bg-[#141418] border border-[#262632]">
        <div class="flex items-center justify-between border-b border-[#22222a] pb-3">
            <h3 class="font-bold text-base text-white">Add Value Pillar</h3>
            <button type="button" onclick="document.getElementById('new-reason-modal').classList.add('hidden')" class="text-gray-400 hover:text-white">&times;</button>
        </div>

        <form action="{{ route('odds.admin.why.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="odds-label">Pillar Title *</label>
                <input type="text" name="title" required placeholder="e.g. Stack-Agnostic Engineering" class="odds-input">
            </div>

            <div>
                <label class="odds-label">Description Text *</label>
                <textarea name="text" rows="3" required placeholder="Describe this value proposition..." class="odds-input text-xs leading-relaxed"></textarea>
            </div>

            <div class="flex justify-end space-x-3 pt-3">
                <button type="button" onclick="document.getElementById('new-reason-modal').classList.add('hidden')" class="odds-btn-secondary text-xs">Cancel</button>
                <button type="submit" class="odds-btn-primary text-xs">Add Pillar</button>
            </div>
        </form>
    </div>
</div>
@endsection
