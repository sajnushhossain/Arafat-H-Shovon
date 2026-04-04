<?php

use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Admin\BlogController as AdminBlogController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\Admin\AchievementController as AdminAchievementController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\GalleryController as AdminGalleryController;
use App\Http\Controllers\Admin\InternationalProjectController as AdminInternationalProjectController;
use App\Http\Controllers\Admin\InternationalProjectPhotoController as AdminInternationalProjectPhotoController;
use App\Http\Controllers\Admin\PhotoController as AdminPhotoController;
use App\Http\Controllers\Admin\PortfolioController as AdminPortfolioController;
use App\Http\Controllers\Admin\QualificationController as AdminQualificationController;
use App\Http\Controllers\Admin\SettingController as AdminSettingController;
use App\Http\Controllers\Admin\TeamMemberController as AdminTeamMemberController;
use App\Http\Controllers\Admin\TestimonialController as AdminTestimonialController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InternationalProjectController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about-myself', [AboutController::class, 'index'])->name('about-myself');
Route::get('/blogs', [BlogController::class, 'index'])->name('blogs.index');
Route::get('/blogs/{blog}', [BlogController::class, 'show'])->name('blogs.show');
Route::get('/galleries', [GalleryController::class, 'index'])->name('galleries.index');
Route::get('/galleries/{gallery}', [GalleryController::class, 'show'])->name('galleries.show');
Route::get('/international-projects/{internationalProject}', [InternationalProjectController::class, 'show'])->name('international-projects.show');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login']);
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');

    Route::middleware('auth.admin')->group(function () {
        Route::get('dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');

        Route::resource('galleries', AdminGalleryController::class);
        Route::resource('galleries.photos', AdminPhotoController::class);
        Route::resource('achievements', AdminAchievementController::class);
        Route::resource('qualifications', AdminQualificationController::class);
        Route::resource('team-members', AdminTeamMemberController::class);
        Route::resource('testimonials', AdminTestimonialController::class);
        Route::resource('portfolios', AdminPortfolioController::class);
        Route::resource('international-projects', AdminInternationalProjectController::class);
        Route::resource('blogs', AdminBlogController::class);
        Route::resource('international-projects.photos', AdminInternationalProjectPhotoController::class)->only(['store', 'destroy']);

        Route::get('profile', [AdminProfileController::class, 'edit'])->name('profile.edit');
        Route::put('profile', [AdminProfileController::class, 'update'])->name('profile.update');

        Route::get('settings', [AdminSettingController::class, 'edit'])->name('settings.edit');
        Route::put('settings', [AdminSettingController::class, 'update'])->name('settings.update');
        
        Route::post('settings/about-photos', [AdminSettingController::class, 'storeAboutPhoto'])->name('settings.about-photos.store');
        Route::delete('settings/about-photos/{aboutPhoto}', [AdminSettingController::class, 'destroyAboutPhoto'])->name('settings.about-photos.destroy');
        
        Route::post('settings/education', [AdminSettingController::class, 'storeEducation'])->name('settings.education.store');
        Route::delete('settings/education/{education}', [AdminSettingController::class, 'destroyEducation'])->name('settings.education.destroy');
        
        Route::post('settings/languages', [AdminSettingController::class, 'storeLanguage'])->name('settings.languages.store');
        Route::delete('settings/languages/{language}', [AdminSettingController::class, 'destroyLanguage'])->name('settings.languages.destroy');
        
        Route::post('settings/references', [AdminSettingController::class, 'storeReference'])->name('settings.references.store');
        Route::delete('settings/references/{reference}', [AdminSettingController::class, 'destroyReference'])->name('settings.references.destroy');

        Route::post('settings/skills', [AdminSettingController::class, 'storeSkill'])->name('settings.skills.store');
        Route::delete('settings/skills/{skill}', [AdminSettingController::class, 'destroySkill'])->name('settings.skills.destroy');

        Route::post('settings/softwares', [AdminSettingController::class, 'storeSoftware'])->name('settings.softwares.store');
        Route::delete('settings/softwares/{software}', [AdminSettingController::class, 'destroySoftware'])->name('settings.softwares.destroy');

        Route::post('profile/update-profile-picture', [AdminSettingController::class, 'updateProfilePicture'])->name('profile.updateProfilePicture');
        Route::post('settings/update-about-me-picture', [AdminSettingController::class, 'updateAboutMePicture'])->name('settings.updateAboutMePicture');
    });
});