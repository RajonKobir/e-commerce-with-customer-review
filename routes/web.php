<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\BusinessSettingController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\SocialLinksController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\SubscriberController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;
//use Illuminate\Support\Facades\Hash;

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

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/admin/login', [AdminController::class, 'login_view'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'loginPost'])->name('admin.login.post');


Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
Route::get('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

Route::prefix('/admin')->middleware('auth:admin')->name('admin.')->group(function () {

    Route::prefix('/settings')->controller(BusinessSettingController::class)->name('settings.')->group(function () {
        Route::get('/general', 'general')->name('general');
        Route::post('/whatsapp', 'set_whatsapp_number')->name('whatsapp.set');
        Route::post('/app_name', 'set_app_name')->name('app_name.set');
        Route::post('/app_logo', 'set_app_logo')->name('app_logo.set');
        Route::post('/app_icon', 'set_app_icon')->name('app_icon.set');
        Route::post('/meta_description', 'set_meta_description')->name('meta_description.set');
        Route::post('/meta_tags', 'set_meta_tags')->name('meta_tags.set');
    });

    Route::prefix('/categories')->controller(CategoryController::class)->name('categories.')->group(function () {
        Route::get('/', 'index')->name('index');
        // Route::get('/{slug}', 'show')->name('view');
        Route::get('/create', 'create')->name('create');
        Route::post('/', 'store')->name('store');
        Route::get('/{category:slug}/edit', 'edit')->name('edit');
        Route::put('/{category:slug}', 'update')->name('update');
        Route::delete('/{category:slug}', 'destroy')->name('destroy');
    });

    Route::prefix('/subcat')->controller(SubCategoryController::class)->name('subcat.')->group(function () {
        Route::get('/', 'index')->name('index');
        // Route::get('/{slug}', 'show')->name('view');
        Route::get('/create', 'create')->name('create');
        Route::post('/', 'store')->name('store');
        Route::get('/{subcategory:slug}/edit', 'edit')->name('edit');
        Route::put('/{subcategory:slug}', 'update')->name('update');
        Route::delete('/{subcategory:slug}', 'destroy')->name('destroy');
    });


    Route::prefix('/tag')->controller(TagController::class)->name('tag.')->group(function () {
        Route::get('/', 'index')->name('index');
        // Route::get('/{tag:slug}','view')->name('view');
        Route::get('/create', 'create')->name('create');
        Route::post('/', 'store')->name('store');
        Route::get('/{tag:slug}/edit', 'edit')->name('edit');
        Route::put('/{tag:slug}', 'update')->name('update');
        Route::delete('/{tag:slug}', 'destroy')->name('destroy');
    });

    Route::prefix('/blog')->controller(BlogController::class)->name('blog.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/', 'store')->name('store');
        Route::get('/{blog:slug}/show', 'show')->name('show');
        Route::get('/{blog:slug}/edit', 'edit')->name('edit');
        Route::put('/{blog:slug}', 'update')->name('update');
        Route::delete('/{blog:slug}', 'destroy')->name('destroy');
        Route::get('/search', 'search')->name('search');
    });

    Route::post('/ckeditor/upload', [AdminController::class, 'ckeditorUpload'])->name('ckeditor.upload');

    Route::prefix('/user')->controller(UserController::class)->name('user.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/{user}/show', 'show')->name('show');
        Route::delete('/{user}', 'destroy')->name('destroy');
        Route::get('/search', 'search')->name('search');
        Route::get('/download', 'download')->name('download');
        Route::post('/addNote', 'addNote')->name('addNote');
        Route::post('/addNoteToMany', 'addNoteToMany')->name('addNoteToMany');
    });

    Route::prefix('/subscriber')->controller(SubscriberController::class)->name('subscriber.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/{subscriber}/show', 'show')->name('show');
        Route::delete('/{subscriber}', 'destroy')->name('destroy');
        Route::get('/search', 'search')->name('search');
        Route::get('/download', 'download')->name('download');
    });

    Route::prefix('/brand')->controller(BrandController::class)->name('brand.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/', 'store')->name('store');
        Route::get('/{brand}/show', 'show')->name('show');
        Route::get('/{brand}/edit', 'edit')->name('edit');
        Route::put('/{brand}', 'update')->name('update');
        Route::delete('/{brand}', 'destroy')->name('destroy');
        Route::get('/search', 'search')->name('search');
    });

    Route::prefix('/slider')->controller(SliderController::class)->name('slider.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/', 'store')->name('store');
        Route::get('/{slider}/show', 'show')->name('show');
        Route::get('/{slider}/edit', 'edit')->name('edit');
        Route::put('/{slider}', 'update')->name('update');
        Route::delete('/{slider}', 'destroy')->name('destroy');
        Route::get('/search', 'search')->name('search');
    });



    Route::prefix('/socials')->controller(SocialLinksController::class)->name('social.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::put('/{social_link:slug}', 'update')->name('update');
    });

    // Mail Controllers
    Route::prefix('/mails')->controller(MailController::class)->name('mails.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/send', 'sendMail')->name('send');

        Route::get('/selected', 'selectedMail')->name('selectedMail');
        Route::post('/sendSelected', 'sendSelectedMail')->name('sendSelectedMail');
        // Route::get('/send-mail/{type?}', 'sendMailForm')->where(['type' => '^(facebook|twitter)$'])->name('send');
    });

    // Password Reset
    Route::get('/passwordReset', [AdminController::class, 'passwordReset'])->name('passwordReset');
    Route::post('/updatedPassword', [AdminController::class, 'updatePassword'])->name('updatePassword');

    // reviews 
    Route::prefix('/reviews')->controller(ReviewController::class)->name('reviews.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/', 'store')->name('store');
        Route::get('/{review:id}/edit', 'edit')->name('edit');
        Route::post('/{review:id}', 'update')->name('update');
        Route::delete('/{review:id}', 'destroy')->name('destroy');
        // Route::get('/search', 'search')->name('search');
    });


});

Route::get('/contact-us', [HomeController::class, 'contactPage'])->name('contactPage');
Route::get('/about-us', [HomeController::class, 'aboutPage'])->name('aboutPage');
Route::get('/privacy-policy', [HomeController::class, 'privacyPage'])->name('privacyPage');
Route::get('/term-condition', [HomeController::class, 'termsPage'])->name('termsPage');

Route::get('/blogs', [HomeController::class, 'blogs'])->name('blog.index');
Route::get('/blogs/search', [HomeController::class, 'search'])->name('blog.search');
Route::get('/tag/{tag:slug}', [HomeController::class, 'blogsByTag'])->name('blog.tag');
Route::get('/subs/{subcategory:slug}', [HomeController::class, 'blogsBySubCat'])->name('blog.subs');

Route::post('/subscriber/store/{blog:slug?}', [SubscriberController::class, 'store'])->name('subscriber.store');

// Route::get('/download/{blog:slug}', [HomeController::class, 'downloadView'])->name('download.view');

Route::get('/login', [HomeController::class, 'login_view'])->name('login');
Route::post('/register', [HomeController::class, 'registerPost'])->name('user.register.post');

Route::post('/login', [HomeController::class, 'loginPost'])->name('user.login.post');
Route::get('/logout', [HomeController::class, 'logout'])->name('user.logout');

// all users route 
Route::get('/allUsers', [HomeController::class, 'allUsers'])->name('user.allUsers');

// Route::get('/test-r', function(){
//     return Hash::make('lFaneNoYxDSQ');
// });

Route::get('/{blog:slug}', [HomeController::class, 'blog'])->name('blog.show');


// store reviews
Route::post('/reviews', [ReviewController::class, 'storeFromFront'])->name('reviews.store');