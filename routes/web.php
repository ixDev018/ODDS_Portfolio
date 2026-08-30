<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OddsAdminController;
use App\Models\OddsSetting;
use App\Models\OddsService;
use App\Models\OddsWork;
use App\Models\OddsTestimonial;
use App\Models\OddsWhyReason;
use App\Models\OddsInquiry;
use App\Models\OddsAboutSection;
use App\Http\Middleware\AdminAuthMiddleware;

/*
|--------------------------------------------------------------------------
| Public Frontend Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    $settings = OddsSetting::current();
    $services = OddsService::where('is_active', true)->orderBy('sort_order')->get();
    $works = OddsWork::where('is_active', true)->orderBy('sort_order')->get();
    $testimonials = OddsTestimonial::where('is_active', true)->orderBy('sort_order')->get();
    $whyReasons = OddsWhyReason::where('is_active', true)->orderBy('sort_order')->get();

    // Actual projects count summed only if toggled to be counted
    $hasCustomWorks = OddsWork::exists();
    if ($hasCustomWorks) {
        $accomplishedCount = OddsWork::where('is_active', true)->where('count_in_kpi', true)->count();
    } else {
        $accomplishedCount = 9; // Fallback mock items count
    }

    // Client satisfaction averaged on active testimonial ratings
    $activeTestimonials = OddsTestimonial::where('is_active', true)->get();
    if ($activeTestimonials->isNotEmpty()) {
        $avg = round($activeTestimonials->avg('stars'), 1);
        $clientSatisfactionAvg = (int)$avg == $avg ? (int)$avg : $avg;
    } else {
        $clientSatisfactionAvg = 5; // Default 5-star rating fallback
    }
    $clientSatisfactionDenom = '/5';

    return view('home', compact(
        'settings',
        'services',
        'works',
        'testimonials',
        'whyReasons',
        'accomplishedCount',
        'clientSatisfactionAvg',
        'clientSatisfactionDenom'
    ));
})->name('portfolio.index');

// Public About Us Blog-Style Page
Route::get('/about', function () {
    $settings = OddsSetting::current();
    $sections = OddsAboutSection::where('is_active', true)->orderBy('sort_order')->get();
    return view('about', compact('settings', 'sections'));
})->name('portfolio.about');

// Public Contact / Lead Form Submission
Route::post('/contact', function (\Illuminate\Http\Request $request) {
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'message' => 'required|string|max:5000',
        'company' => 'nullable|string|max:255',
        'service_needed' => 'nullable|string|max:255',
    ]);

    $validated['ip_address'] = $request->ip();
    OddsInquiry::create($validated);

    if ($request->wantsJson()) {
        return response()->json(['success' => true, 'message' => 'Message received. We will respond within 24 hours.']);
    }

    return redirect()->back()->with('success', 'Thank you! The ODDS team will get back to you shortly.');
})->name('portfolio.contact');

// Media & Storage File Serving
Route::get('/storage/{path}', function ($path) {
    $filePath = storage_path('app/public/' . $path);
    if (file_exists($filePath)) {
        return response()->file($filePath);
    }
    abort(404);
})->where('path', '.*')->name('storage.serve');

Route::get('/media/{path}', function ($path) {
    $filePath = storage_path('app/public/' . $path);
    if (file_exists($filePath)) {
        return response()->file($filePath);
    }
    abort(404);
})->where('path', '.*')->name('media.serve');

// Cache clearing utility
Route::get('/clear-cache', function() {
    \Illuminate\Support\Facades\Artisan::call('optimize:clear');
    return 'Cache cleared successfully. You can now access /admin/login';
});

/*
|--------------------------------------------------------------------------
| Dedicated ODDS Studio Admin CMS Routes
|--------------------------------------------------------------------------
*/

// Admin Auth
Route::get('/admin/login', [OddsAdminController::class, 'showLogin'])->name('odds.admin.login');
Route::post('/admin/login', [OddsAdminController::class, 'login'])->name('odds.admin.login.submit');
Route::post('/admin/logout', [OddsAdminController::class, 'logout'])->name('odds.admin.logout');

// Aliases for /odds-admin
Route::get('/odds-admin', fn() => redirect()->route('odds.admin.dashboard'));
Route::get('/odds-admin/login', [OddsAdminController::class, 'showLogin']);

// Protected ODDS Studio Admin Area
Route::middleware([AdminAuthMiddleware::class])->prefix('admin')->group(function () {
    // Dashboard
    Route::get('/', [OddsAdminController::class, 'dashboard'])->name('odds.admin.dashboard');

    // General & Hero Settings
    Route::get('/settings', [OddsAdminController::class, 'settings'])->name('odds.admin.settings');
    Route::post('/settings', [OddsAdminController::class, 'updateSettings'])->name('odds.admin.settings.update');

    // Services CRUD
    Route::get('/services', [OddsAdminController::class, 'servicesIndex'])->name('odds.admin.services.index');
    Route::post('/services/store', [OddsAdminController::class, 'servicesStore'])->name('odds.admin.services.store');
    Route::post('/services/update/{id}', [OddsAdminController::class, 'servicesUpdate'])->name('odds.admin.services.update');
    Route::post('/services/delete/{id}', [OddsAdminController::class, 'servicesDestroy'])->name('odds.admin.services.delete');
    Route::post('/services/reorder', [OddsAdminController::class, 'servicesReorder'])->name('odds.admin.services.reorder');

    // Works / Projects CRUD
    Route::get('/works', [OddsAdminController::class, 'worksIndex'])->name('odds.admin.works.index');
    Route::get('/works/create', [OddsAdminController::class, 'worksCreate'])->name('odds.admin.works.create');
    Route::post('/works/store', [OddsAdminController::class, 'worksStore'])->name('odds.admin.works.store');
    Route::get('/works/edit/{id}', [OddsAdminController::class, 'worksEdit'])->name('odds.admin.works.edit');
    Route::post('/works/update/{id}', [OddsAdminController::class, 'worksUpdate'])->name('odds.admin.works.update');
    Route::post('/works/delete/{id}', [OddsAdminController::class, 'worksDestroy'])->name('odds.admin.works.delete');
    Route::post('/works/reorder', [OddsAdminController::class, 'worksReorder'])->name('odds.admin.works.reorder');
    Route::post('/works/upload-body-media', [OddsAdminController::class, 'uploadBodyMedia'])->name('odds.admin.works.upload_body_media');

    // Testimonials CRUD
    Route::get('/testimonials', [OddsAdminController::class, 'testimonialsIndex'])->name('odds.admin.testimonials.index');
    Route::post('/testimonials/store', [OddsAdminController::class, 'testimonialsStore'])->name('odds.admin.testimonials.store');
    Route::post('/testimonials/update/{id}', [OddsAdminController::class, 'testimonialsUpdate'])->name('odds.admin.testimonials.update');
    Route::post('/testimonials/delete/{id}', [OddsAdminController::class, 'testimonialsDestroy'])->name('odds.admin.testimonials.delete');
    Route::post('/testimonials/reorder', [OddsAdminController::class, 'testimonialsReorder'])->name('odds.admin.testimonials.reorder');

    // About Us Sections CRUD (Notion CMS Editor)
    Route::get('/about', [OddsAdminController::class, 'aboutIndex'])->name('odds.admin.about.index');
    Route::get('/about/create', [OddsAdminController::class, 'aboutCreate'])->name('odds.admin.about.create');
    Route::post('/about/store', [OddsAdminController::class, 'aboutStore'])->name('odds.admin.about.store');
    Route::get('/about/edit/{id}', [OddsAdminController::class, 'aboutEdit'])->name('odds.admin.about.edit');
    Route::post('/about/update/{id}', [OddsAdminController::class, 'aboutUpdate'])->name('odds.admin.about.update');
    Route::post('/about/delete/{id}', [OddsAdminController::class, 'aboutDestroy'])->name('odds.admin.about.delete');
    Route::post('/about/reorder', [OddsAdminController::class, 'aboutReorder'])->name('odds.admin.about.reorder');
    Route::post('/about/upload-body-media', [OddsAdminController::class, 'uploadAboutBodyMedia'])->name('odds.admin.about.upload_body_media');

    // Why Reasons CRUD
    Route::get('/why', [OddsAdminController::class, 'whyReasonsIndex'])->name('odds.admin.why.index');
    Route::post('/why/store', [OddsAdminController::class, 'whyReasonsStore'])->name('odds.admin.why.store');
    Route::post('/why/update/{id}', [OddsAdminController::class, 'whyReasonsUpdate'])->name('odds.admin.why.update');
    Route::post('/why/delete/{id}', [OddsAdminController::class, 'whyReasonsDestroy'])->name('odds.admin.why.delete');

    // Inquiries / Inbox
    Route::get('/inquiries', [OddsAdminController::class, 'inquiriesIndex'])->name('odds.admin.inquiries.index');
    Route::get('/inquiries/{id}', [OddsAdminController::class, 'inquiriesShow'])->name('odds.admin.inquiries.show');
    Route::post('/inquiries/delete/{id}', [OddsAdminController::class, 'inquiriesDestroy'])->name('odds.admin.inquiries.delete');
});
