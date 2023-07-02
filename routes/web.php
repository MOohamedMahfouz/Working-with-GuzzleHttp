<?php

use App\Http\Controllers\UserController;
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
    return view('login');
})->name('home');

Route::get('rate-based-recommended-problmes/{type}',[UserController::class,'getRateBasedRecommendedProblems'])->name('recommended-problems')->middleware('checkHandle');
Route::get('latest-solved-based-recommended-problmes/{type}',[UserController::class,'getLatestSolvedBasedRecommendedProblems'])->name('latest-solved-based-recommended-problems')->middleware('checkHandle');
Route::get('solved-problems',[UserController::class,'getSolvedProblems'])->name('get_solved_problems')->middleware('checkHandle');
Route::get('unsolved-problems',[UserController::class,'getUnsolvedProblems'])->name('get_un_solved_problems')->middleware('checkHandle');
Route::get('latest-contests',[UserController::class,'getLatestContests'])->name('latest_contests')->middleware('checkHandle');

Route::post('/search',[UserController::class,'search'])->name('search')->middleware('checkHandle');
Route::post('/specific-tags',[UserController::class,'getChoseTagsProblems'])->name('chose-tags')->middleware('checkHandle');
Route::post('/',[UserController::class,'login'])->name('login');

