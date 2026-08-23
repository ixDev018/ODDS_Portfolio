@extends('admin.odds.layout')

@section('title', 'Visitor Inbox')

@section('content')
<div class="space-y-6 max-w-6xl mx-auto">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-extrabold text-white tracking-tight">Visitor & Client Inbox</h1>
            <p class="text-xs font-mono text-gray-400 uppercase tracking-wider mt-0.5">Inquiries submitted through the public website</p>
        </div>
    </div>

    <div class="odds-card overflow-hidden">
        <table class="odds-table">
            <thead>
                <tr>
                    <th>SENDER</th>
                    <th>EMAIL / PHONE</th>
                    <th>PROJECT TYPE</th>
                    <th>RECEIVED</th>
                    <th>STATUS</th>
                    <th class="text-right" style="width: 100px;">ACTION</th>
                </tr>
            </thead>
            <tbody>
                @forelse($inquiries as $inq)
                <tr class="hover:bg-white/[0.02] transition-colors {{ !$inq->is_read ? 'bg-[#875af5]/[0.05]' : '' }}">
                    <td>
                        <div class="font-bold text-white text-sm">{{ $inq->name }}</div>
                        <div class="text-xs text-gray-400 truncate max-w-sm">{{ $inq->message }}</div>
                    </td>
                    <td>
                        <div class="text-xs font-mono text-gray-300">{{ $inq->email }}</div>
                        @if($inq->phone)
                            <div class="text-[10px] font-mono text-gray-500">{{ $inq->phone }}</div>
                        @endif
                    </td>
                    <td>
                        <span class="text-xs text-gray-400">{{ $inq->project_type ?? 'General' }}</span>
                    </td>
                    <td>
                        <span class="text-xs text-gray-500 font-mono">{{ $inq->created_at->diffForHumans() }}</span>
                    </td>
                    <td>
                        @if(!$inq->is_read)
                            <span class="odds-badge odds-badge-pink text-[9px]">New</span>
                        @else
                            <span class="odds-badge bg-gray-800/40 text-gray-500 border border-gray-700/30 text-[9px]">Read</span>
                        @endif
                    </td>
                    <td class="text-right">
                        <div class="flex items-center justify-end space-x-2">
                            <a href="{{ route('odds.admin.inquiries.show', $inq->id) }}" class="p-1.5 text-gray-400 hover:text-[#875af5] transition-colors" title="View Details">
                                <i class="fa-solid fa-eye text-xs"></i>
                            </a>
                            <form action="{{ route('odds.admin.inquiries.delete', $inq->id) }}" method="POST" onsubmit="return confirm('Delete this inquiry?');" class="inline">
                                @csrf
                                <button type="submit" class="p-1.5 text-gray-400 hover:text-red-400 transition-colors" title="Delete">
                                    <i class="fa-solid fa-trash text-xs"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="py-12 text-center text-gray-500 font-mono text-xs">No visitor inquiries received yet.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
