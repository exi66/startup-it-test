<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\MaterialController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UrlController;
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

Route::get('/', [MaterialController::class, 'index'])->name('materials.list');
Route::get('/material/{id}/show', [MaterialController::class, 'show'])->name('materials.show');
Route::get('/material/create', [MaterialController::class, 'create'])->name('materials.create');
Route::get('/material/{id}/edit', [MaterialController::class, 'edit'])->name('materials.edit');
Route::delete('/material/{id}/destroy', [MaterialController::class, 'destroy'])->name('materials.destroy');
Route::post('/material/store', [MaterialController::class, 'store'])->name('materials.store');
Route::patch('/material/{id}/update', [MaterialController::class, 'update'])->name('materials.update');
Route::post('/material/{id}/add_tag', [MaterialController::class, 'add_tag'])->name('materials.add_tag');
Route::delete('/material/{id}/rm_tag', [MaterialController::class, 'rm_tag'])->name('materials.rm_tag');

Route::get('/category', [CategoryController::class, 'index'])->name('category.list');
Route::get('/category/create', [CategoryController::class, 'create'])->name('category.create');
Route::get('/category/{id}/edit', [CategoryController::class, 'edit'])->name('category.edit');
Route::delete('/category/{id}/destroy', [CategoryController::class, 'destroy'])->name('category.destroy');
Route::post('/category/store', [CategoryController::class, 'store'])->name('category.store');
Route::patch('/category/{id}/update', [CategoryController::class, 'update'])->name('category.update');

Route::get('/tag', [TagController::class, 'index'])->name('tag.list');
Route::get('/tag/create', [TagController::class, 'create'])->name('tag.create');
Route::get('/tag/{id}/edit', [TagController::class, 'edit'])->name('tag.edit');
Route::delete('/tag/{id}/destroy', [TagController::class, 'destroy'])->name('tag.destroy');
Route::post('/tag/store', [TagController::class, 'store'])->name('tag.store');
Route::patch('/tag/{id}/update', [TagController::class, 'update'])->name('tag.update');

//Route::get('/url', [UrlController::class, 'index'])->name('url.list');
//Route::get('/url/create', [UrlController::class, 'create'])->name('url.create');
Route::get('/url/{id}/edit', [UrlController::class, 'edit'])->name('url.edit');
Route::delete('/url/{id}/destroy', [UrlController::class, 'destroy'])->name('url.destroy');
Route::post('/url/store', [UrlController::class, 'store'])->name('url.store');
Route::patch('/url/{id}/update', [UrlController::class, 'update'])->name('url.update');