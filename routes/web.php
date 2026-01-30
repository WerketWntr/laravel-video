<?php

use App\Http\Controllers\HomeController;
use App\Livewire\Channel;
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

Route::get('/', HomeController::class)->name('home');
Route::get('/trending', \App\Http\Controllers\TrendingController::class)->name('trending');
Route::get('/channel/{user:username}', \App\Http\Controllers\ShowChannelController::class)->name('channel.show');
Route::get('/videos/{video:uuid}', \App\Livewire\VideoPage::class)->name('video.show');
Route::get('/search', \App\Http\Controllers\SearchController::class)->name('search');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::post('/video/upload', [\App\Livewire\UploadVideo::class, 'handleChunk'])->name('video.upload');
});
