<?php

  

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\siteController;
use App\Http\Controllers\ContratController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\CandidateController;
use App\Http\Controllers\DashboardController;







  

/*

|--------------------------------------------------------------------------

| Web Routes

|--------------------------------------------------------------------------

|

| Here is where you can register web routes for your application. These

| routes are loaded by the RouteServiceProvider within a group which

| contains the "web" middleware group. Now create something great!

|

*/

  

// Route::get('/', function () {

//     return view('sites/index');

// });
 // sites
 
 // site web

  Route::get('/', [SiteController::class, 'index'])->name('index');
Route::get('about', [SiteController::class, 'about'])->name('about');
Route::get('browsejobs', [SiteController::class, 'browsejobs'])->name('browsejobs');
Route::get('candidates', [SiteController::class, 'candidates'])->name('candidates');
Route::get('new_post', [SiteController::class, 'new_post'])->name('new_post');
Route::get('job_post', [SiteController::class, 'job_post'])->name('job_post');
Route::get('prime', [DashboardController::class, 'prime'])->name('prime');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
Route::post('/newsletter', [NewsletterController::class, 'store'])->name('newsletter.store');
Route::get('demande',[SiteController::class, 'demande'])->name('demande');
Route::resource('contrats', ContratController::class);
Route::post('/contrats', [ContratController::class, 'store'])->name('contrats.store');
Route::get('/candidates', [CandidateController::class, 'index']);
Route::resource('candidates', CandidateController::class);
Route::resource('events', EventController::class);

Route::middleware(['auth'])->group(function () {
    Route::get('/admin/candidates/create', [CandidateController::class, 'create'])->name('admin.candidates.create');
    Route::post('/admin/candidates/store', [CandidateController::class, 'store'])->name('admin.candidates.store');
});


Auth::routes();

  

Route::get('/home', [HomeController::class, 'index'])->name('home');

  

Route::group(['middleware' => ['auth']], function() {

    Route::resource('roles', RoleController::class);

    Route::resource('users', UserController::class);
    Route::resource('newsletters', NewsletterController::class);

    Route::resource('products', ProductController::class);

});
// dashboard route

Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');


Route::get('/logout', [LoginController::class, 'logout'])->name('logout');


//profile de l'utilisateur
Route::get('/profile/account',[ProfileController::class,'account'])->name('profile.account');
Route::get('/profile/user',[ProfileController::class,'user'])->name('profile.user.user');
Route::POST('/profile/update',[ProfileController::class,'update'])->name('profile.update');
Route::POST('/update-password',[ProfileController::class,'updatePassword'])->name('update.password');







Route::POST('/users/user/upload/{user}', [UserController::class , 'updateProfile'])->name('users.upload');

//status users
Route::POST('/heartbeat', function(Request $request){
    $user =Auth::user();
    if($user){
        $user->status='Active';
        $user->save();
    }
});

Route::get('/activities', [ActivityController::class, 'index'])->name('admin.pages.activities.index');


// sites
Route::get('/header',[SiteController::class, 'showmenus'])->name('header.index');

Route::get('/register-worker', function () {
    return view('sites/pages/register-wizard'); // Créons cette vue
})->name('register.worker');