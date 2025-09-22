<?php

use App\Http\Controllers\AllowedMemberController;
use App\Http\Controllers\CandidateController;
use App\Http\Controllers\Dashboard;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

Route::get('/auth/redirect', function () {
    return Socialite::driver('google')->redirect();
});

Route::get('/auth/google/callback', function () {
    $googleUser = Socialite::driver('google')->user();

    $user = User::updateOrCreate([
        'google_id' => $googleUser->id,
    ], [
        'name' => $googleUser->name,
        'email' => $googleUser->email,
        'google_token' => $googleUser->token,
        'google_refresh_token' => $googleUser->refreshToken,
    ]);

    Auth::login($user);

    return redirect('/dashboard');
});

Route::middleware('auth')->group(function (){
    Route::get('/',[Dashboard::class, 'index']);
    Route::get('/dashboard',[Dashboard::class, 'index']);
    Route::post('/pick-organization',[OrganizationController::class, 'store']);
    Route::get('/want-candidate',[CandidateController::class, 'want'])->name('candidate.want');
    Route::post('/store-candidate',[CandidateController::class, 'store'])->name('candidate.store');
    Route::get('/list-organization',[OrganizationController::class, 'list']);
    Route::get('/organization/{id}',[OrganizationController::class, 'show'])->name('organization.show');
    Route::get('/organization/{id}/member',[OrganizationController::class, 'member'])->name('organization.member');
    Route::get('/organization/{id}/candidate',[OrganizationController::class, 'candidate'])->name('organization.candidate');
    Route::get('/organization/{id}/give-role',[OrganizationController::class, 'giveRole'])->name('organization.give-role');
    Route::post('/organization/{id}/give-role',[OrganizationController::class, 'storeRole'])->name('organization.give-role');
    Route::get('/organization/{id}/store-email',[AllowedMemberController::class, 'show'])->name('organization.store-email');
    Route::post('/organization/{id}/store-email',[AllowedMemberController::class, 'store'])->name('organization.store-email');
    Route::get('/organization/{id}/store-candidate',[CandidateController::class, 'show'])->name('organization.store-candidate');
    Route::post('/organization/{id}/store-candidate',[CandidateController::class, 'store'])->name('organization.store-candidate');
    Route::post('/organization/{id}/store-vote',[CandidateController::class, 'storeVote'])->name('organization.store-vote');
    // Route::get('/logout', function (Request $request) {
    //     Auth::logout();
    //     $request->session()->invalidate();
    //     $request->session()->regenerateToken();
    //     return redirect('/login');
    // })->name('logout');

    Route::get('/logout', [AuthController::class, 'logout'])->name('logout.get');
});

// Route::get('/login', function () {
//     return view('auth.login');
// })->name('login');

// Route::get('/register', function () {
//     return view('auth.register');
// })->name('register');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

Route::get('/forgot-password', [AuthController::class, 'showForgotPassword'])->name('forgot-password');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/home', function () {
    return view('home');
})->name('home');

Route::get('/forgot-password', function() {
    return view('auth.forgot-password');
})->name('forgot-password');

Route::get('/change-password', function() {
    return view('auth.change-password');
})->name('change-password');

// Route::post('/logout', function (Request $request) {
//     Auth::logout();
//     $request->session()->invalidate();
//     $request->session()->regenerateToken();
//     return redirect('/login');
// })->name('logout');
