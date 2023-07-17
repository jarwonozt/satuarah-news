<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FileController;
use App\Http\Controllers\Admin\FileCategoryController;
use App\Http\Controllers\Admin\ImageCategoryController;
use App\Http\Controllers\Admin\ImageController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\OfficeCategoryController;
use App\Http\Controllers\Admin\OfficeController;
use App\Http\Controllers\Admin\PageCategoryController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\PhotoController;
use App\Http\Controllers\Admin\PhotoLinkageController;
use App\Http\Controllers\Admin\PointController;
use App\Http\Controllers\Admin\PointSettingController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\ServiceCategoryController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\VideoCategoryController;
use App\Http\Controllers\Admin\VideoController;
use App\Http\Controllers\Admin\VideoLinkageController;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Client\ScreenController;
use App\Http\Controllers\Client\ScreensController;
use App\Http\Controllers\PostCategoryController;
use App\Http\Controllers\PostLinkageController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    return "Cache is cleared";
});

Route::get('/clear-view', function() {
    Artisan::call('view:clear');
    return "View is cleared";
});

Route::prefix('admin')->middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::prefix('posts')->group(function() {
        Route::resource('posts', PostController::class);
        Route::resource('postcategories', PostCategoryController::class);
        Route::resource('postlinkages', PostLinkageController::class);
        Route::resource('tags', TagController::class);
        Route::post('new-tags', [TagController::class, 'newTag'])->name('new-tag');
    });

    Route::prefix('pages')->group(function() {
        Route::resource('pages', PageController::class);
        Route::resource('pagecategories', PageCategoryController::class);
    });

    Route::prefix('files')->group(function() {
        Route::get('delete-file/{id}', [FileController::class, 'deleteFile'])->name('file.delete');
        Route::resource('files', FileController::class);
        Route::resource('filecategories', FileCategoryController::class);
    });

    Route::prefix('services')->group(function() {
        Route::resource('services', ServiceController::class);
        Route::resource('servicecategories', ServiceCategoryController::class);
    });


    Route::prefix('points')->group(function() {
        Route::resource('points', PointController::class);
        Route::resource('pointsettings', PointSettingController::class);
    });

    Route::prefix('videos')->group(function() {
        Route::resource('videos', VideoController::class);
        Route::resource('videocategories', VideoCategoryController::class);
        Route::resource('videolinkages', VideoLinkageController::class);
    });

    Route::prefix('images')->group(function() {
        Route::resource('images', ImageController::class);
        Route::resource('imagecategories', ImageCategoryController::class);
    });

    Route::prefix('photos')->group(function() {
        Route::resource('photos', PhotoController::class);
        Route::resource('photolinkages', PhotoLinkageController::class);
    });

    Route::prefix('offices')->group(function (){
        Route::resource('offices', OfficeController::class);
        Route::resource('officecategories', OfficeCategoryController::class);
    });

    Route::resource('menus', MenuController::class);
    Route::resource('users', UserController::class);
    Route::get('profile', [UserController::class, 'show'])->name('profile');
    Route::get('security', [UserController::class, 'security'])->name('security');
    Route::post('security-change', [UserController::class, 'securityChange'])->name('security.change');
    Route::post('update-data-profile', [UserController::class, 'updateProfileSetting'])->name('update.profile.setting');
    Route::post('reset-password-profile', [UserController::class, 'updatePassword'])->name('password-profile');

});


/* FRONTEND */
Route::get('/', [HomeController::class, 'index']);
Route::get('rss', [HomeController::class, 'rss']);
Route::get('sitemap.xml', [MetaController::class, 'sitemap'])->name('sitemap');

Route::get('search', [ScreensController::class, 'search'])->name('search');
Route::get('tags/{q}', [ScreensController::class, 'tags']);
Route::get('author/{slug}', [ScreenController::class, 'author']);

Route::get('dumas', [ScreenController::class, 'complaint'])->name('complaint');
Route::post('dumas', [ScreenController::class, 'saveComplaint'])->name('save-complaint');
Route::get('maps', [ScreenController::class, 'maps'])->name('maps');

Route::get('page/{slug}', [ScreenController::class, 'page']);
Route::get('informasi', [ScreensController::class, 'files']);
Route::get('informasi/{slug}', [ScreenController::class, 'file']);
Route::get('layanan', [ScreensController::class, 'services']);
Route::get('bimwin', [ScreenController::class, 'bimwin']);
Route::get('bimwin/{document}', [ScreenController::class, 'bimwinDocument']);
Route::get('sertifikat-bimwin/{document}', [ScreenController::class, 'BimwinCertificate']);
Route::get('pakh-online', [ScreenController::class, 'religiousEducation']);
Route::get('pakh-online/{document}', [ScreenController::class, 'ReligiousEducationDocument']);
Route::get('sertifikat-pakh-online/{document}', [ScreenController::class, 'PakhOnlineCertificate']);
Route::get('daicu', [ScreenController::class, 'daicu']);
Route::get('kantor', [ScreensController::class, 'offices']);
Route::get('kantor/{slug}', [ScreenController::class, 'office']);
Route::get('arsip', [ScreensController::class, 'archives']);
Route::get('arsip/{category}', [ScreenController::class, 'archive']);
Route::get('arsip-detail/{slug}', [ScreenController::class, 'archiveDetail']);
Route::get('infografis', [ScreensController::class, 'infografis']);
Route::get('foto', [ScreensController::class, 'foto']);
Route::get('podcasts', [ScreensController::class, 'podcasts']);
Route::get('photos', [ScreensController::class, 'photos']);
Route::get('video/{slug}', [ScreenController::class, 'video']);
Route::get('videos', [ScreensController::class, 'videos']);
Route::get('pages/{category}', [ScreensController::class, 'pages']);
Route::get('photo/{slug}', [ScreenController::class, 'photo']);

Route::get('berita/{category?}/{slug}', [ScreenController::class, 'redirect']);

Route::get('{category}', [ScreensController::class, 'posts']);
Route::get('{category?}/{slug}-{code}', [ScreenController::class, 'post'])->where('slug', '(.*)');
Route::get('{category}/sitemap.xml', [MetaController::class, 'sitemapDetail'])->name('sitemap-detail');


