<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ResultController;

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
    return view('index');
});

Route::get('/mdcat/2021/result', function() {
    return view('mdcat.result');
})->name('mdcat-result');

Route::post('/mdcat/2021/get-result-by-roll-no', [ResultController::class, 'getMdcatResultByRollNoAction'])->name('get-mdcat-result');

Route::get('/mdcat/2021/result-marks-range', function () {
    return view('mdcat.marks-range');
});

Route::post('/mdcat/2021/get-result-marks-range', [ResultController::class, 'getMarksDistributionResultAction']);
