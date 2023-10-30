<?php
use App\Livewire\Pages\TodosPage;
use App\Livewire\Pages\TodoPage;
use App\Livewire\Pages\ProfilePage;
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
Route::get(
    '/todos',
    TodosPage::class
)->middleware(['auth', 'verified'])->name('todos.index');
Route::get(
    '/profile/{user}',
    ProfilePage::class
)->middleware(['auth', 'verified'])->name('users.profile');
Route::get('todos/{todo}', TodoPage::class)->name('todos.show');
require __DIR__ . '/auth.php';
