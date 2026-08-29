<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OddsSetting;
use App\Models\OddsService;
use App\Models\OddsWork;
use App\Models\OddsTestimonial;
use App\Models\OddsWhyReason;
use App\Models\OddsInquiry;
use App\Models\OddsAboutSection;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class OddsAdminController extends Controller
{
    protected function uploadMedia($data, string $folder): string
    {
        try {
            if ($data instanceof \Illuminate\Http\UploadedFile) {
                if (function_exists('cloudinary') && env('CLOUDINARY_URL')) {
                    $uploaded = cloudinary()->uploadApi()->upload(
                        $data->getRealPath(),
                        ['folder' => "odds/{$folder}", 'resource_type' => 'auto']
                    );
                    return $uploaded['secure_url'];
                }
                $path = $data->store("odds/{$folder}", 'public');
                return asset("storage/{$path}");
            }
            if (is_string($data) && preg_match('/^data:(\w+)\/(\w+);base64,/', $data, $matches)) {
                if (function_exists('cloudinary') && env('CLOUDINARY_URL')) {
                    $uploaded = cloudinary()->uploadApi()->upload(
                        $data,
                        ['folder' => "odds/{$folder}", 'resource_type' => 'auto']
                    );
                    return $uploaded['secure_url'];
                }
                $fileData = base64_decode(preg_replace('#^data:(\w+)\/(\w+);base64,#i', '', $data));
                $ext = $matches[2] === 'jpeg' ? 'jpg' : $matches[2];
                $filename = "odds/{$folder}/" . Str::random(20) . '.' . $ext;
                Storage::disk('public')->put($filename, $fileData);
                return asset("storage/{$filename}");
            }
        } catch (\Exception $e) {
            \Log::error("Media upload failed [{$folder}]: " . $e->getMessage());
            if ($data instanceof \Illuminate\Http\UploadedFile) {
                $path = $data->store("odds/{$folder}", 'public');
                return asset("storage/{$path}");
            }
        }
        return '';
    }

    protected function deleteMedia(string $path): void
    {
        if (empty($path)) return;
        if (Str::startsWith($path, 'http')) {
            try {
                if (function_exists('cloudinary') && env('CLOUDINARY_URL')) {
                    if (preg_match('/\/upload\/(?:v\d+\/)?(.+?)(?:\.\w+)?$/', $path, $matches)) {
                        cloudinary()->uploadApi()->destroy($matches[1], ['resource_type' => 'image']);
                    }
                }
            } catch (\Exception $e) {}
            $relativePath = str_replace(asset('storage/'), '', $path);
            Storage::disk('public')->delete($relativePath);
            return;
        }
        Storage::disk(config('filesystems.default'))->delete($path);
    }

    /*
    |--------------------------------------------------------------------------
    | Auth Handlers
    |--------------------------------------------------------------------------
    */
    public function showLogin()
    {
        if (session('odds_admin_logged_in') || session('admin_logged_in')) {
            return redirect()->route('odds.admin.dashboard');
        }
        return view('admin.odds.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $envUsername = env('ADMIN_USERNAME', 'admin');
        $envPassword = env('ADMIN_PASSWORD', 'adminpassword');

        if ($request->username === $envUsername && $request->password === $envPassword) {
            session(['odds_admin_logged_in' => true, 'admin_logged_in' => true]);
            return redirect()->route('odds.admin.dashboard')->with('success', 'Welcome to ODDS Studio Admin!');
        }

        return redirect()->back()->withErrors(['auth' => 'Invalid credentials provided.']);
    }

    public function logout()
    {
        session()->forget(['odds_admin_logged_in', 'admin_logged_in']);
        return redirect()->route('portfolio.index')->with('success', 'Logged out.');
    }

    /*
    |--------------------------------------------------------------------------
    | Dashboard
    |--------------------------------------------------------------------------
    */
    public function dashboard()
    {
        $settings = OddsSetting::current();
        $worksCount = OddsWork::count();
        $servicesCount = OddsService::where('is_active', true)->count();
        $testimonialsCount = OddsTestimonial::count();
        $inquiriesCount = OddsInquiry::count();
        $unreadInquiriesCount = OddsInquiry::where('is_read', false)->count();
        $recentInquiries = OddsInquiry::latest()->take(5)->get();
        $recentWorks = OddsWork::orderBy('sort_order')->take(6)->get();

        return view('admin.odds.dashboard', compact(
            'settings',
            'worksCount',
            'servicesCount',
            'testimonialsCount',
            'inquiriesCount',
            'unreadInquiriesCount',
            'recentInquiries',
            'recentWorks'
        ));
    }

    /*
    |--------------------------------------------------------------------------
    | General Studio Settings
    |--------------------------------------------------------------------------
    */
    public function settings()
    {
        $settings = OddsSetting::current();
        return view('admin.odds.settings', compact('settings'));
    }

    public function updateSettings(Request $request)
    {
        $settings = OddsSetting::current();

        $validated = $request->validate([
            'hero_title' => 'nullable|string',
            'hero_subtitle' => 'nullable|string',
            'hero_btn_text' => 'nullable|string|max:100',
            'hero_btn_link' => 'nullable|string|max:255',
            'kpi_projects_accomplished' => 'nullable|string|max:50',
            'kpi_client_satisfaction' => 'nullable|string|max:50',
            'kpi_satisfaction_denom' => 'nullable|string|max:50',
            'kpi_reliability' => 'nullable|string|max:50',
            'kpi_reliability_label' => 'nullable|string|max:100',
            'works_description' => 'nullable|string',
            'services_title' => 'nullable|string|max:255',
            'services_desc' => 'nullable|string',
            'why_title' => 'nullable|string|max:255',
            'why_desc' => 'nullable|string',
            'testimonials_title' => 'nullable|string|max:255',
            'testimonials_desc' => 'nullable|string',
            'cta_title' => 'nullable|string',
            'cta_desc' => 'nullable|string',
            'cta_email' => 'nullable|email|max:255',
            'cta_phone' => 'nullable|string|max:100',
            'cta_facebook' => 'nullable|string|max:255',
            'cta_instagram' => 'nullable|string|max:255',
            'cta_youtube' => 'nullable|string|max:255',
            'cta_terminal_prompt' => 'nullable|string|max:255',
            'cta_meta_line' => 'nullable|string|max:255',
            'lorenzo_system_prompt' => 'nullable|string',
        ]);

        $settings->update($validated);

        return redirect()->back()->with('success', 'ODDS Studio Settings updated successfully!');
    }

    /*
    |--------------------------------------------------------------------------
    | Services Management
    |--------------------------------------------------------------------------
    */
    public function servicesIndex()
    {
        $services = OddsService::orderBy('sort_order')->get();
        return view('admin.odds.services', compact('services'));
    }

    public function servicesStore(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'icon_svg' => 'nullable|string',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');
        $validated['sort_order'] = OddsService::max('sort_order') + 1;

        OddsService::create($validated);
        return redirect()->route('odds.admin.services.index')->with('success', 'Service added successfully!');
    }

    public function servicesUpdate(Request $request, $id)
    {
        $service = OddsService::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'icon_svg' => 'nullable|string',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');
        $service->update($validated);

        return redirect()->route('odds.admin.services.index')->with('success', 'Service updated!');
    }

    public function servicesDestroy($id)
    {
        $service = OddsService::findOrFail($id);
        $service->delete();
        return redirect()->route('odds.admin.services.index')->with('success', 'Service deleted.');
    }

    public function servicesReorder(Request $request)
    {
        $request->validate(['order' => 'required|array']);
        foreach ($request->order as $position => $id) {
            OddsService::where('id', $id)->update(['sort_order' => $position + 1]);
        }
        return response()->json(['ok' => true]);
    }

    /*
    |--------------------------------------------------------------------------
    | Works & Case Studies Management
    |--------------------------------------------------------------------------
    */
    public function worksIndex()
    {
        $works = OddsWork::orderBy('sort_order')->get();
        return view('admin.odds.works.index', compact('works'));
    }

    public function worksCreate()
    {
        return view('admin.odds.works.create');
    }

    public function worksStore(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'nullable|string|max:100',
            'client' => 'nullable|string|max:255',
            'role' => 'nullable|string|max:255',
            'year' => 'nullable|string|max:50',
            'description' => 'nullable|string',
            'story_content' => 'nullable|string',
            'body_content' => 'nullable|string',
            'cover_image' => 'nullable|image|max:10240',
            'cover_image_url' => 'nullable|string|max:1000',
            'cover_image_base64' => 'nullable|string',
            'demo_url' => 'nullable|url',
            'github_url' => 'nullable|url',
            'is_featured' => 'nullable|boolean',
            'is_active' => 'nullable|boolean',
            'count_in_kpi' => 'nullable|boolean',
        ]);

        $validated['slug'] = Str::slug($validated['title'] . '-' . Str::random(4));
        $validated['is_featured'] = $request->has('is_featured');
        $validated['is_active'] = $request->has('is_active');
        $validated['count_in_kpi'] = $request->has('count_in_kpi');
        $validated['sort_order'] = OddsWork::max('sort_order') + 1;

        if (!empty($validated['body_content'])) {
            $decoded = json_decode($validated['body_content'], true);
            $validated['body_content'] = is_array($decoded) ? $decoded : null;
        }

        if ($request->filled('cover_image_base64')) {
            $url = $this->uploadMedia($request->input('cover_image_base64'), 'works');
            if ($url) $validated['cover_image'] = $url;
        } elseif ($request->hasFile('cover_image')) {
            $url = $this->uploadMedia($request->file('cover_image'), 'works');
            if ($url) $validated['cover_image'] = $url;
        } elseif ($request->filled('cover_image_url')) {
            $validated['cover_image'] = $request->input('cover_image_url');
        }

        unset($validated['cover_image_base64'], $validated['cover_image_url']);
        OddsWork::create($validated);

        return redirect()->route('odds.admin.works.index')->with('success', 'Work project created successfully with Notion story!');
    }

    public function worksEdit($id)
    {
        $work = OddsWork::findOrFail($id);
        return view('admin.odds.works.edit', compact('work'));
    }

    public function worksUpdate(Request $request, $id)
    {
        $work = OddsWork::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'nullable|string|max:100',
            'client' => 'nullable|string|max:255',
            'role' => 'nullable|string|max:255',
            'year' => 'nullable|string|max:50',
            'description' => 'nullable|string',
            'story_content' => 'nullable|string',
            'body_content' => 'nullable|string',
            'cover_image' => 'nullable|image|max:10240',
            'cover_image_url' => 'nullable|string|max:1000',
            'cover_image_base64' => 'nullable|string',
            'remove_cover_image' => 'nullable|string',
            'demo_url' => 'nullable|url',
            'github_url' => 'nullable|url',
            'is_featured' => 'nullable|boolean',
            'is_active' => 'nullable|boolean',
            'count_in_kpi' => 'nullable|boolean',
        ]);

        $validated['is_featured'] = $request->has('is_featured');
        $validated['is_active'] = $request->has('is_active');
        $validated['count_in_kpi'] = $request->has('count_in_kpi');

        if (!empty($validated['body_content'])) {
            $decoded = json_decode($validated['body_content'], true);
            $validated['body_content'] = is_array($decoded) ? $decoded : null;
        } else {
            $validated['body_content'] = null;
        }

        if ($request->input('remove_cover_image') === '1') {
            if ($work->cover_image) $this->deleteMedia($work->cover_image);
            $validated['cover_image'] = null;
        } elseif ($request->filled('cover_image_base64')) {
            if ($work->cover_image) $this->deleteMedia($work->cover_image);
            $url = $this->uploadMedia($request->input('cover_image_base64'), 'works');
            if ($url) $validated['cover_image'] = $url;
        } elseif ($request->hasFile('cover_image')) {
            if ($work->cover_image) $this->deleteMedia($work->cover_image);
            $url = $this->uploadMedia($request->file('cover_image'), 'works');
            if ($url) $validated['cover_image'] = $url;
        } elseif ($request->filled('cover_image_url')) {
            if ($work->cover_image && $work->cover_image !== $request->input('cover_image_url')) {
                $this->deleteMedia($work->cover_image);
            }
            $validated['cover_image'] = $request->input('cover_image_url');
        }

        unset($validated['cover_image_base64'], $validated['cover_image_url'], $validated['remove_cover_image']);
        $work->update($validated);

        return redirect()->route('odds.admin.works.index')->with('success', 'Work project updated successfully!');
    }

    public function uploadBodyMedia(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:jpeg,png,jpg,gif,svg,webp,mp4,mov,webm|max:102400',
        ]);

        $url = $this->uploadMedia($request->file('file'), 'works/body');
        return response()->json(['url' => $url]);
    }

    public function worksDestroy($id)
    {
        $work = OddsWork::findOrFail($id);
        if ($work->cover_image) $this->deleteMedia($work->cover_image);
        $work->delete();
        return redirect()->route('odds.admin.works.index')->with('success', 'Project deleted.');
    }

    public function worksReorder(Request $request)
    {
        $request->validate(['order' => 'required|array']);
        foreach ($request->order as $position => $id) {
            OddsWork::where('id', $id)->update(['sort_order' => $position + 1]);
        }
        return response()->json(['ok' => true]);
    }

    /*
    |--------------------------------------------------------------------------
    | Testimonials Management
    |--------------------------------------------------------------------------
    */
    public function testimonialsIndex()
    {
        $testimonials = OddsTestimonial::orderBy('sort_order')->get();
        return view('admin.odds.testimonials', compact('testimonials'));
    }

    public function testimonialsStore(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'nullable|string|max:255',
            'company' => 'nullable|string|max:255',
            'initials' => 'nullable|string|max:10',
            'stars' => 'required|integer|min:1|max:5',
            'text' => 'required|string',
            'avatar' => 'nullable|image|max:6144',
            'avatar_url' => 'nullable|string|max:1000',
            'avatar_base64' => 'nullable|string',
            'is_active' => 'nullable|boolean',
        ]);

        if (empty($validated['initials'])) {
            $parts = preg_split('/\s+/', trim($validated['name']));
            $first = isset($parts[0]) && $parts[0] !== '' ? mb_substr($parts[0], 0, 1) : 'J';
            $second = isset($parts[1]) && $parts[1] !== '' ? mb_substr($parts[1], 0, 1) : '';
            $validated['initials'] = strtoupper($first . $second);
        }

        $validated['is_active'] = $request->has('is_active');
        $validated['sort_order'] = OddsTestimonial::max('sort_order') + 1;

        if ($request->filled('avatar_base64')) {
            $url = $this->uploadMedia($request->input('avatar_base64'), 'testimonials');
            if ($url) $validated['avatar_path'] = $url;
        } elseif ($request->hasFile('avatar')) {
            $url = $this->uploadMedia($request->file('avatar'), 'testimonials');
            if ($url) $validated['avatar_path'] = $url;
        } elseif ($request->filled('avatar_url')) {
            $validated['avatar_path'] = $request->input('avatar_url');
        }

        unset($validated['avatar'], $validated['avatar_url'], $validated['avatar_base64']);
        OddsTestimonial::create($validated);

        return redirect()->route('odds.admin.testimonials.index')->with('success', 'Testimonial added successfully!');
    }

    public function testimonialsUpdate(Request $request, $id)
    {
        $testimonial = OddsTestimonial::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'nullable|string|max:255',
            'company' => 'nullable|string|max:255',
            'initials' => 'nullable|string|max:10',
            'stars' => 'required|integer|min:1|max:5',
            'text' => 'required|string',
            'avatar' => 'nullable|image|max:6144',
            'avatar_url' => 'nullable|string|max:1000',
            'avatar_base64' => 'nullable|string',
            'remove_avatar' => 'nullable|string',
            'is_active' => 'nullable|boolean',
        ]);

        if (empty($validated['initials'])) {
            $parts = preg_split('/\s+/', trim($validated['name']));
            $first = isset($parts[0]) && $parts[0] !== '' ? mb_substr($parts[0], 0, 1) : 'J';
            $second = isset($parts[1]) && $parts[1] !== '' ? mb_substr($parts[1], 0, 1) : '';
            $validated['initials'] = strtoupper($first . $second);
        }

        $validated['is_active'] = $request->has('is_active');

        if ($request->input('remove_avatar') === '1') {
            if ($testimonial->avatar_path) $this->deleteMedia($testimonial->avatar_path);
            $validated['avatar_path'] = null;
        } elseif ($request->filled('avatar_base64')) {
            if ($testimonial->avatar_path) $this->deleteMedia($testimonial->avatar_path);
            $url = $this->uploadMedia($request->input('avatar_base64'), 'testimonials');
            if ($url) $validated['avatar_path'] = $url;
        } elseif ($request->hasFile('avatar')) {
            if ($testimonial->avatar_path) $this->deleteMedia($testimonial->avatar_path);
            $url = $this->uploadMedia($request->file('avatar'), 'testimonials');
            if ($url) $validated['avatar_path'] = $url;
        } elseif ($request->filled('avatar_url')) {
            if ($testimonial->avatar_path && $testimonial->avatar_path !== $request->input('avatar_url')) {
                $this->deleteMedia($testimonial->avatar_path);
            }
            $validated['avatar_path'] = $request->input('avatar_url');
        }

        unset($validated['avatar'], $validated['avatar_url'], $validated['avatar_base64'], $validated['remove_avatar']);
        $testimonial->update($validated);

        return redirect()->route('odds.admin.testimonials.index')->with('success', 'Testimonial updated successfully!');
    }

    public function testimonialsDestroy($id)
    {
        $testimonial = OddsTestimonial::findOrFail($id);
        if ($testimonial->avatar_path) $this->deleteMedia($testimonial->avatar_path);
        $testimonial->delete();
        return redirect()->route('odds.admin.testimonials.index')->with('success', 'Testimonial deleted.');
    }

    public function testimonialsReorder(Request $request)
    {
        $request->validate(['order' => 'required|array']);
        foreach ($request->order as $position => $id) {
            OddsTestimonial::where('id', $id)->update(['sort_order' => $position + 1]);
        }
        return response()->json(['ok' => true]);
    }

    /*
    |--------------------------------------------------------------------------
    | Why Reasons Management
    |--------------------------------------------------------------------------
    */
    public function whyReasonsIndex()
    {
        $reasons = OddsWhyReason::orderBy('sort_order')->get();
        return view('admin.odds.why', compact('reasons'));
    }

    public function whyReasonsStore(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'text' => 'required|string',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');
        $validated['sort_order'] = OddsWhyReason::max('sort_order') + 1;

        OddsWhyReason::create($validated);
        return redirect()->route('odds.admin.why.index')->with('success', 'Reason added!');
    }

    public function whyReasonsUpdate(Request $request, $id)
    {
        $reason = OddsWhyReason::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'text' => 'required|string',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');
        $reason->update($validated);

        return redirect()->route('odds.admin.why.index')->with('success', 'Reason updated!');
    }

    public function whyReasonsDestroy($id)
    {
        $reason = OddsWhyReason::findOrFail($id);
        $reason->delete();
        return redirect()->route('odds.admin.why.index')->with('success', 'Reason deleted.');
    }

    /*
    |--------------------------------------------------------------------------
    | Inquiries / Inbox
    |--------------------------------------------------------------------------
    */
    public function inquiriesIndex()
    {
        $inquiries = OddsInquiry::latest()->get();
        return view('admin.odds.inquiries', compact('inquiries'));
    }

    public function inquiriesShow($id)
    {
        $inquiry = OddsInquiry::findOrFail($id);
        $inquiry->update(['is_read' => true]);
        return view('admin.odds.inquiry_show', compact('inquiry'));
    }

    public function inquiriesDestroy($id)
    {
        $inquiry = OddsInquiry::findOrFail($id);
        $inquiry->delete();
        return redirect()->route('odds.admin.inquiries.index')->with('success', 'Inquiry deleted.');
    }

    /*
    |--------------------------------------------------------------------------
    | About Us Sections Management (Notion CMS Editor)
    |--------------------------------------------------------------------------
    */
    public function aboutIndex()
    {
        $sections = OddsAboutSection::orderBy('sort_order')->get();
        return view('admin.odds.about.index', compact('sections'));
    }

    public function aboutCreate()
    {
        return view('admin.odds.about.create');
    }

    public function aboutStore(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string',
            'category' => 'nullable|string|max:100',
            'author' => 'nullable|string|max:255',
            'read_time' => 'nullable|string|max:100',
            'body_content' => 'nullable|string',
            'cover_image' => 'nullable|image|max:10240',
            'cover_image_url' => 'nullable|string|max:1000',
            'cover_image_base64' => 'nullable|string',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['slug'] = Str::slug($validated['title'] . '-' . Str::random(4));
        $validated['is_active'] = $request->has('is_active');
        $validated['sort_order'] = OddsAboutSection::max('sort_order') + 1;

        if (!empty($validated['body_content'])) {
            $decoded = json_decode($validated['body_content'], true);
            $validated['body_content'] = is_array($decoded) ? $decoded : null;
        }

        if ($request->filled('cover_image_base64')) {
            $url = $this->uploadMedia($request->input('cover_image_base64'), 'about');
            if ($url) $validated['cover_image'] = $url;
        } elseif ($request->hasFile('cover_image')) {
            $url = $this->uploadMedia($request->file('cover_image'), 'about');
            if ($url) $validated['cover_image'] = $url;
        } elseif ($request->filled('cover_image_url')) {
            $validated['cover_image'] = $request->input('cover_image_url');
        }

        unset($validated['cover_image_base64'], $validated['cover_image_url']);
        OddsAboutSection::create($validated);

        return redirect()->route('odds.admin.about.index')->with('success', 'About section published successfully!');
    }

    public function aboutEdit($id)
    {
        $section = OddsAboutSection::findOrFail($id);
        return view('admin.odds.about.edit', compact('section'));
    }

    public function aboutUpdate(Request $request, $id)
    {
        $section = OddsAboutSection::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string',
            'category' => 'nullable|string|max:100',
            'author' => 'nullable|string|max:255',
            'read_time' => 'nullable|string|max:100',
            'body_content' => 'nullable|string',
            'cover_image' => 'nullable|image|max:10240',
            'cover_image_url' => 'nullable|string|max:1000',
            'cover_image_base64' => 'nullable|string',
            'remove_cover_image' => 'nullable|string',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        if (!empty($validated['body_content'])) {
            $decoded = json_decode($validated['body_content'], true);
            $validated['body_content'] = is_array($decoded) ? $decoded : null;
        } else {
            $validated['body_content'] = null;
        }

        if ($request->filled('remove_cover_image') && $request->input('remove_cover_image') === '1') {
            if ($section->cover_image) $this->deleteMedia($section->cover_image);
            $validated['cover_image'] = null;
        } elseif ($request->filled('cover_image_base64')) {
            if ($section->cover_image) $this->deleteMedia($section->cover_image);
            $url = $this->uploadMedia($request->input('cover_image_base64'), 'about');
            if ($url) $validated['cover_image'] = $url;
        } elseif ($request->hasFile('cover_image')) {
            if ($section->cover_image) $this->deleteMedia($section->cover_image);
            $url = $this->uploadMedia($request->file('cover_image'), 'about');
            if ($url) $validated['cover_image'] = $url;
        } elseif ($request->filled('cover_image_url')) {
            $validated['cover_image'] = $request->input('cover_image_url');
        }

        unset($validated['cover_image_base64'], $validated['cover_image_url'], $validated['remove_cover_image']);
        $section->update($validated);

        return redirect()->route('odds.admin.about.index')->with('success', 'About section updated successfully!');
    }

    public function aboutDestroy($id)
    {
        $section = OddsAboutSection::findOrFail($id);
        if ($section->cover_image) $this->deleteMedia($section->cover_image);
        $section->delete();
        return redirect()->route('odds.admin.about.index')->with('success', 'About section deleted.');
    }

    public function aboutReorder(Request $request)
    {
        $request->validate(['order' => 'required|array']);
        foreach ($request->order as $position => $id) {
            OddsAboutSection::where('id', $id)->update(['sort_order' => $position + 1]);
        }
        return response()->json(['ok' => true]);
    }

    public function uploadAboutBodyMedia(Request $request)
    {
        $request->validate([
            'file' => 'required|image|max:10240'
        ]);

        $url = $this->uploadMedia($request->file('file'), 'about/body');
        return response()->json(['url' => $url]);
    }
}
