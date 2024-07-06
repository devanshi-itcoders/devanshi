<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ConfigurationController;
use App\Http\Controllers\ImagesController;
use App\Http\Controllers\PagesController;


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

Route::get('/', function () {
    return redirect('/login');
})->name('main');

Auth::routes(['register' => false]);

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth']], function() {
  Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');
  Route::resource('roles', RoleController::class);
  Route::resource('users', UserController::class);
  Route::resource('configurations', ConfigurationController::class);
  Route::resource('pages', PagesController::class);
  Route::resource('images', ImagesController::class);

  Route::get('/page/{pages:slug}', [PagesController::class, 'description'])->name('slug');
  Route::get('/media/{images:image}', [ImagesController::class, 'showImage'])->name('image');

  Route::post('/changePassword', [UserController::class, 'updatePassword'])->name('update-password');
});
