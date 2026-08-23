@extends('admin.odds.layout')

@section('title', 'Client Testimonials')

@section('content')
<div class="space-y-6 max-w-6xl mx-auto">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-extrabold text-white tracking-tight">Client Testimonials</h1>
            <p class="text-xs font-mono text-gray-400 uppercase tracking-wider mt-0.5">Manage review cards displayed in the live testimonial marquee</p>
        </div>

        <button type="button" onclick="document.getElementById('new-testimonial-modal').classList.remove('hidden')" class="odds-btn-primary">
            <i class="fa-solid fa-plus text-xs"></i>
            <span>Add Testimonial</span>
        </button>
    </div>

    <div class="odds-card overflow-hidden">
        <table class="odds-table">
            <thead>
                <tr>
                    <th style="width: 40px;"></th>
                    <th>CLIENT</th>
                    <th>ROLE & COMPANY</th>
                    <th>RATING</th>
                    <th>REVIEW QUOTE</th>
                    <th>STATUS</th>
                    <th class="text-right" style="width: 100px;">ACTION</th>
                </tr>
            </thead>
            <tbody id="sortable-testimonials">
                @forelse($testimonials as $t)
                <tr data-id="{{ $t->id }}" class="hover:bg-white/[0.02] transition-colors">
                    <td class="text-center cursor-grab text-gray-600 hover:text-[#875af5]">
                        <i class="fa-solid fa-grip-vertical text-xs"></i>
                    </td>
                    <td>
                        <div class="font-bold text-white text-sm">{{ $t->client_name }}</div>
                    </td>
                    <td>
                        <div class="text-xs text-gray-400">{{ $t->client_role }} <span class="text-gray-600 font-mono">&bull;</span> {{ $t->company }}</div>
                    </td>
                    <td>
                        <div class="flex text-amber-400 text-xs">
                            @for($i = 0; $i < $t->stars; $i++)
                                <i class="fa-solid fa-star"></i>
                            @endfor
                        </div>
                    </td>
                    <td>
                        <div class="text-xs text-gray-400 max-w-sm truncate italic">"{{ $t->quote }}"</div>
                    </td>
                    <td>
                        @if($t->is_active)
                            <span class="odds-badge odds-badge-green text-[9px]">Active</span>
                        @else
                            <span class="odds-badge bg-gray-800/40 text-gray-500 border border-gray-700/30 text-[9px]">Hidden</span>
                        @endif
                    </td>
                    <td class="text-right">
                        <div class="flex items-center justify-end space-x-2">
                            <form action="{{ route('odds.admin.testimonials.delete', $t->id) }}" method="POST" onsubmit="return confirm('Delete this testimonial?');" class="inline">
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
                    <td colspan="7" class="py-12 text-center text-gray-500 font-mono text-xs">No testimonials created yet.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- New Testimonial Modal -->
<div id="new-testimonial-modal" class="fixed inset-0 bg-black/70 backdrop-blur-sm z-50 flex items-center justify-center hidden">
    <div class="odds-card w-full max-w-lg p-6 space-y-4 m-4 bg-[#141418] border border-[#262632]">
        <div class="flex items-center justify-between border-b border-[#22222a] pb-3">
            <h3 class="font-bold text-base text-white">Add Client Testimonial</h3>
            <button type="button" onclick="document.getElementById('new-testimonial-modal').classList.add('hidden')" class="text-gray-400 hover:text-white">&times;</button>
        </div>

        <form action="{{ route('odds.admin.testimonials.store') }}" method="POST" class="space-y-4">
            @csrf
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="odds-label">Client Name *</label>
                    <input type="text" name="client_name" required placeholder="John Doe" class="odds-input">
                </div>
                <div>
                    <label class="odds-label">Initials</label>
                    <input type="text" name="initials" placeholder="JD" class="odds-input font-mono">
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="odds-label">Role</label>
                    <input type="text" name="client_role" placeholder="CTO" class="odds-input">
                </div>
                <div>
                    <label class="odds-label">Company</label>
                    <input type="text" name="company" placeholder="Fintech Corp" class="odds-input">
                </div>
            </div>

            <div>
                <label class="odds-label">Rating (Stars)</label>
                <select name="stars" class="odds-input bg-[#0f0f13]">
                    <option value="5" selected>5 Stars (★★★★★)</option>
                    <option value="4">4 Stars (★★★★☆)</option>
                    <option value="3">3 Stars (★★★☆☆)</option>
                </select>
            </div>

            <div>
                <label class="odds-label">Client Quote *</label>
                <textarea name="quote" rows="3" required placeholder="Working with ODDS was seamless..." class="odds-input text-xs"></textarea>
            </div>

            <div class="flex items-center space-x-2 pt-2">
                <input type="checkbox" name="is_active" value="1" checked id="new_testi_active" class="rounded bg-[#0b0b0e] border-[#22222a] text-[#875af5]">
                <label for="new_testi_active" class="text-xs text-gray-300 font-semibold">Active in Marquee</label>
            </div>

            <div class="flex justify-end space-x-3 pt-3">
                <button type="button" onclick="document.getElementById('new-testimonial-modal').classList.add('hidden')" class="odds-btn-secondary text-xs">Cancel</button>
                <button type="submit" class="odds-btn-primary text-xs">Add Testimonial</button>
            </div>
        </form>
    </div>
</div>
@endsection
