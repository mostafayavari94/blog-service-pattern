<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ProfileController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->prefix('article')->group(function (){
    Route::get('/',[ArticleController::class,'index'])->name('article.index');
    Route::get('/create',[ArticleController::class,'create'])->name('article.create');
    Route::post('/store',[ArticleController::class,'store'])->name('article.store');
    Route::get('/edit/{id}',[ArticleController::class,'edit'])->name('article.edit');
    Route::post('/update/{id}',[ArticleController::class,'update'])->name('article.update');
    Route::post('/destroy/{id}', [ArticleController::class,'destroy'])->name('article.destroy');
    Route::post('/publish/{id}', [ArticleController::class,'publish'])->name('article.publish');
    Route::post('/draft/{id}', [ArticleController::class,'draft'])->name('article.draft');


});

require __DIR__.'/auth.php';
