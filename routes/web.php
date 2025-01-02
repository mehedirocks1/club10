<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use App\Models\Team;
use App\Models\Branch;
use App\Models\Gallery;
use App\Models\Contact;
use App\Models\AboutUs;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BackendController;
use App\Http\Controllers\WebsiteController;
use App\Http\Controllers\MemberController;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Http;


// Frontend Routes
Route::get('/', [FrontendController::class, 'home'])->name('frontend.home');
Route::get('/about', [FrontendController::class, 'about'])->name('frontend.about');
Route::get('/branch', [FrontendController::class, 'branch'])->name('frontend.branch');
//Route::get('/contact-us', [FrontendController::class, 'contact'])->name('frontend.contact');
Route::match(['get', 'post'], '/contact-us', [FrontendController::class, 'contact'])->name('frontend.contact');
Route::get('/gallery', [FrontendController::class, 'gallery'])->name('frontend.gallery');

// Backend User Routes
Route::get('/user/dashboard', [DashboardController::class, 'user'])->middleware(['auth'])->name('backend.user.dashboard'); 
Route::get('/staff/dashboard', [DashboardController::class, 'staff'])->middleware(['auth'])->name('backend.staff.dashboard');
Route::get('/admin/dashboard', [DashboardController::class, 'admin'])->middleware(['auth'])->name('backend.admin.dashboard');

// Logout Route
Route::post('/logout', function () { 
    Auth::logout(); 
    return redirect('/login'); 
})->name('logout');

// Backend Admin Routes (Profile, Members, Contacts)
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    // Profile routes
    Route::get('/profile', [BackendController::class, 'viewProfile'])->name('viewProfile');
    Route::get('/profile/edit', [BackendController::class, 'editProfile'])->name('editProfile');
    Route::put('/profile/update', [BackendController::class, 'updateProfile'])->name('updateProfile');
    Route::get('/profile/change-password', [BackendController::class, 'changePasswordForm'])->name('changePasswordForm');
    Route::put('/profile/change-password', [BackendController::class, 'changePassword'])->name('changePassword');

    // Contact info management
    //Route::get('/contacts', [BackendController::class, 'showContacts'])->name('contacts.index');
});


/*

Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('members', [MemberController::class, 'viewMembers'])->name('viewMembers');
    Route::get('members/{id}', [MemberController::class, 'viewMember'])->name('viewMember');
    Route::get('members/{id}/download', [MemberController::class, 'downloadMember'])->name('downloadMember');
    Route::put('members/{id}/reset-password', [MemberController::class, 'resetPassword'])->name('resetPassword');
    Route::post('members/{id}/send-message', [MemberController::class, 'sendMessage'])->name('sendMessage');
    Route::put('members/{id}/status', [MemberController::class, 'updateStatus'])->name('updateStatus');
    Route::get('members/{id}/edit', [MemberController::class, 'edit'])->name('editMember');
    Route::put('members/{id}', [MemberController::class, 'update'])->name('updateMember');
    //Route::delete('members/{id}', [MemberController::class, 'destroy'])->name('destroy');
    Route::delete('members/{id}', [MemberController::class, 'destroy'])->name('destroy');
});

*/



Route::middleware('auth')->prefix('admin')->group(function () {
    // View all members
    Route::get('/members', [MemberController::class, 'viewMembers'])->name('admin.viewMembers');
    
    // View a single member
    Route::get('/members/{id}/view', [MemberController::class, 'viewMember'])->name('admin.viewMember');
    
    // Download a member's details as PDF
    Route::get('/members/{id}/download', [MemberController::class, 'downloadMember'])->name('admin.downloadMember');
    
    // Update member status
    Route::put('/members/{id}/status', [MemberController::class, 'updateStatus'])->name('admin.updateStatus');
    
    // Edit a member
    Route::get('/members/{id}/edit', [MemberController::class, 'edit'])->name('admin.editMember');
    
    // Update a member's details
    Route::put('/members/{id}', [MemberController::class, 'update'])->name('admin.updateMember');
    
    // Reset a member's password
    Route::post('/members/{id}/reset-password', [MemberController::class, 'resetPassword'])->name('admin.resetPassword');
    
    // Send a message to a member
    //Route::post('/members/{id}/message', [MemberController::class, 'sendMessage'])->name('admin.sendMessage');
    Route::post('/members/{id}/submit-message', [MemberController::class, 'sendSMS'])->name('admin.submitMessage');
    Route::get('/members/{id}/message', [MemberController::class, 'showMessageForm'])->name('admin.sendMessage');

    // Delete a member
    Route::delete('/members/{id}', [MemberController::class, 'destroy'])->name('admin.destroyMember');

});







Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::match(['get', 'post'], '/change-logo', [WebsiteController::class, 'changeLogo'])->name('changeLogo');
    Route::get('/view-contact', [WebsiteController::class, 'viewContact'])->name('viewContact');
    Route::get('/view-slider', [WebsiteController::class, 'viewSlider'])->name('viewSlider');
    Route::match(['get', 'post'], '/change-slider', [WebsiteController::class, 'changeSlider'])->name('changeSlider');
    Route::get('/branches', [WebsiteController::class, 'branches'])->name('branches');
    //Route::get('/view-about', [WebsiteController::class, 'viewAbout'])->name('viewAbout');
    //Route::get('/gallery', [WebsiteController::class, 'gallery'])->name('gallery');
    Route::get('/create-branch', [WebsiteController::class, 'createBranch'])->name('createBranch');
    Route::post('/store-branch', [WebsiteController::class, 'storeBranch'])->name('storeBranch');
    Route::get('/edit-branch/{id}', [WebsiteController::class, 'editBranch'])->name('editBranch');
    Route::put('/update-branch/{id}', [WebsiteController::class, 'updateBranch'])->name('updateBranch');
    Route::delete('/delete-branch/{id}', [WebsiteController::class, 'destroyBranch'])->name('deleteBranch');



    Route::get('/view-about', [WebsiteController::class, 'viewAbout'])->name('viewAbout');
    Route::match(['get', 'post'], '/store-about', [WebsiteController::class, 'storeAbout'])->name('storeAbout');
    Route::get('/edit-about/{id}', [WebsiteController::class, 'editAbout'])->name('editAbout');
    Route::put('/update-about/{id}', [WebsiteController::class, 'updateAbout'])->name('updateAbout');
    Route::delete('/delete-about/{id}', [WebsiteController::class, 'destroyAbout'])->name('deleteAbout');





    Route::get('/view-team', [WebsiteController::class, 'viewTeam'])->name('viewTeam');
    Route::get('/create-team', [WebsiteController::class, 'createTeam'])->name('createTeam');
    Route::post('/store-team', [WebsiteController::class, 'storeTeam'])->name('storeTeam');
    Route::get('/edit-team/{id}', [WebsiteController::class, 'editTeam'])->name('editTeam');
    Route::put('/update-team/{id}', [WebsiteController::class, 'updateTeam'])->name('updateTeam');
    Route::delete('/delete-team/{id}', [WebsiteController::class, 'destroyTeam'])->name('deleteTeam');



    Route::get('/gallery', [WebsiteController::class, 'gallery'])->name('gallery');
    Route::post('/gallery/store', [WebsiteController::class, 'storeGallery'])->name('storeGallery');
    Route::put('/gallery/update/{id}', [WebsiteController::class, 'updateGallery'])->name('updateGallery');
    Route::delete('/gallery/delete/{id}', [WebsiteController::class, 'destroyGallery'])->name('deleteGallery');







});







// Registration Routes
Route::get('/register', [RegistrationController::class, 'showForm'])->name('register.form');
Route::get('/register/success', [RegistrationController::class, 'success'])->name('register.success');
Route::post('/register', [RegistrationController::class, 'register'])->name('register.submit');

// Login Routes
Route::get('/login', [LoginController::class, 'showForm'])->name('login.form');
Route::post('/login', [LoginController::class, 'login'])->name('login.store');
