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

    <form action="{{ route('odds.admin.settings.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <!-- Who We Are Team Photograph -->
        <div class="odds-card p-6 space-y-5">
            <div class="border-b border-[#22222a] pb-3 flex items-center justify-between">
                <h2 class="text-xs font-bold text-[#875af5] uppercase font-mono tracking-wider">Who We Are — Team Photograph</h2>
                <span class="text-[10px] font-mono text-gray-500 uppercase">Database-Synced</span>
            </div>

            <div class="space-y-4">
                @if(!empty($settings->who_we_are_image))
                    <div class="space-y-2">
                        <label class="odds-label">Current Photo</label>
                        <div class="max-w-md rounded-xl overflow-hidden border border-[#22222a] bg-[#111116]">
                            <img src="{{ $settings->who_we_are_image }}" alt="Team Preview" class="w-full h-48 object-cover">
                        </div>
                    </div>
                @endif

                <div>
                    <label class="odds-label">
                        <i class="fa-solid fa-image mr-1.5 text-[#875af5]"></i>Upload Replacement Photograph (Saved directly to database)
                    </label>
                    <input type="file" name="who_we_are_image_file" accept="image/*" class="odds-input file:mr-3 file:py-1 file:px-3 file:rounded-md file:border-0 file:text-xs file:font-semibold file:bg-[#875af5]/20 file:text-[#875af5] hover:file:bg-[#875af5]/30">
                    <p class="text-[11px] text-gray-500 mt-1">Image is converted and saved directly to the database so it never gets lost across deployments.</p>
                </div>
            </div>
        </div>

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
                <span>Save Settings</span>
            </button>
        </div>
    </form>
</div>
@endsection
