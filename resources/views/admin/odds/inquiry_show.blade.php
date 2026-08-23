@extends('admin.odds.layout')

@section('title', 'View Inquiry')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">
    <div class="flex items-center justify-between">
        <a href="{{ route('odds.admin.inquiries.index') }}" class="text-xs text-gray-400 hover:text-[#875af5] font-mono flex items-center space-x-1">
            <i class="fa-solid fa-arrow-left text-[10px]"></i>
            <span>Back to Inbox</span>
        </a>
    </div>

    <div class="odds-card p-6 md:p-8 space-y-6">
        <div class="border-b border-[#22222a] pb-4 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h1 class="text-xl font-bold text-white">{{ $inquiry->name }}</h1>
                <p class="text-xs text-gray-400 font-mono mt-0.5">Received {{ $inquiry->created_at->format('F d, Y \a\t h:i A') }} ({{ $inquiry->created_at->diffForHumans() }})</p>
            </div>

            <div class="flex items-center space-x-3">
                <a href="mailto:{{ $inquiry->email }}?subject=RE: Project Inquiry - ODDS Studio" class="odds-btn-primary text-xs">
                    <i class="fa-solid fa-reply text-xs"></i>
                    <span>Reply via Email</span>
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-xs">
            <div class="p-4 rounded-xl bg-[#0f0f13] border border-[#22222a] space-y-1">
                <span class="odds-label">Email Address</span>
                <div class="font-mono text-sm text-white font-bold">{{ $inquiry->email }}</div>
            </div>

            <div class="p-4 rounded-xl bg-[#0f0f13] border border-[#22222a] space-y-1">
                <span class="odds-label">Phone / Contact</span>
                <div class="font-mono text-sm text-white font-bold">{{ $inquiry->phone ?? 'Not provided' }}</div>
            </div>
        </div>

        @if($inquiry->project_type)
        <div class="p-4 rounded-xl bg-[#0f0f13] border border-[#22222a] text-xs space-y-1">
            <span class="odds-label">Project Type / Category</span>
            <div class="font-bold text-white text-sm">{{ $inquiry->project_type }}</div>
        </div>
        @endif

        <div class="space-y-2">
            <span class="odds-label">Client Message Payload</span>
            <div class="p-6 rounded-xl bg-[#0f0f13] border border-[#22222a] text-gray-300 text-sm leading-relaxed whitespace-pre-wrap">
                {{ $inquiry->message }}
            </div>
        </div>

        <div class="pt-4 border-t border-[#22222a] flex justify-between items-center">
            <a href="{{ route('odds.admin.inquiries.index') }}" class="odds-btn-secondary text-xs">
                Back to Inbox
            </a>

            <form action="{{ route('odds.admin.inquiries.delete', $inquiry->id) }}" method="POST" onsubmit="return confirm('Permanently delete this inquiry?');">
                @csrf
                <button type="submit" class="text-xs text-red-400 hover:text-red-300 font-bold font-mono">
                    <i class="fa-solid fa-trash mr-1 text-xs"></i> Delete Inquiry
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
