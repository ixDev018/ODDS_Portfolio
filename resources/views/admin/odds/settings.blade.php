@extends('admin.odds.layout')

@section('title', 'Studio Contact & Terminal Settings')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-extrabold text-white tracking-tight">Studio Contact Channels</h1>
            <p class="text-xs font-mono text-gray-400 uppercase tracking-wider mt-0.5">Terminal CTA links & social channels</p>
        </div>
    </div>

    <form action="{{ route('odds.admin.settings.update') }}" method="POST" class="space-y-6">
        @csrf

        <!-- Terminal CTA Contact Channels -->
        <div class="odds-card p-6 space-y-5">
            <div class="border-b border-[#22222a] pb-3 flex items-center justify-between">
                <h2 class="text-xs font-bold text-[#875af5] uppercase font-mono tracking-wider">Terminal Contact & Social Handles</h2>
                <span class="text-[10px] font-mono text-gray-500 uppercase">Footer Terminal</span>
            </div>

            <div class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="odds-label">
                            <i class="fa-solid fa-envelope mr-1.5 text-[#875af5]"></i>Contact Email
                        </label>
                        <input type="email" name="cta_email" value="{{ old('cta_email', $settings->cta_email) }}"
                               placeholder="hello@odds.dev"
                               class="odds-input">
                    </div>
                    <div>
                        <label class="odds-label">
                            <i class="fa-solid fa-phone mr-1.5 text-[#875af5]"></i>Contact Phone
                        </label>
                        <input type="text" name="cta_phone" value="{{ old('cta_phone', $settings->cta_phone) }}"
                               placeholder="0999999999"
                               class="odds-input font-mono">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 pt-2 border-t border-[#22222a]/60">
                    <div>
                        <label class="odds-label">
                            <i class="fa-brands fa-facebook mr-1.5 text-[#875af5]"></i>Facebook
                        </label>
                        <input type="text" name="cta_facebook" value="{{ old('cta_facebook', $settings->cta_facebook) }}"
                               placeholder="ODDS Comp."
                               class="odds-input">
                    </div>
                    <div>
                        <label class="odds-label">
                            <i class="fa-brands fa-instagram mr-1.5 text-[#875af5]"></i>Instagram
                        </label>
                        <input type="text" name="cta_instagram" value="{{ old('cta_instagram', $settings->cta_instagram) }}"
                               placeholder="ODDS Comp."
                               class="odds-input">
                    </div>
                    <div>
                        <label class="odds-label">
                            <i class="fa-brands fa-youtube mr-1.5 text-[#875af5]"></i>YouTube
                        </label>
                        <input type="text" name="cta_youtube" value="{{ old('cta_youtube', $settings->cta_youtube) }}"
                               placeholder="ODDS Comp."
                               class="odds-input">
                    </div>
                </div>
            </div>
        </div>

        <div class="flex items-center justify-end space-x-4 pt-2">
            <button type="submit" class="odds-btn-primary px-8">
                <i class="fa-solid fa-floppy-disk text-xs"></i>
                <span>Save Channels</span>
            </button>
        </div>
    </form>
</div>
@endsection
