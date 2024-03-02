<?php
  
use Illuminate\Support\Facades\Route;
  
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\SurveyController;
use App\Http\Controllers\AssesmentController;
  
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

// cache clear
Route::get('/clear', function() {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    return "Cleared!";
 });
//  cache clear
  
// Route::get('/', function () {
//     return view('welcome');
// });
  
Auth::routes();
Route::get('/', [FrontendController::class, 'index'])->name('homepage');
// Route::get('/', [FrontendController::class, 'index'])->name('home');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/session-clear', [FrontendController::class, 'sessionClear']);
  





/*------------------------------------------
--------------------------------------------
All Normal Users Routes List
--------------------------------------------
--------------------------------------------*/
Route::group(['prefix' =>'user/', 'middleware' => ['auth', 'is_user']], function(){
  
    Route::get('/dashboard', [HomeController::class, 'userDashboard'])->name('user.dashboard');
    Route::get('/survey', [SurveyController::class, 'survey'])->name('user.survey');
    Route::post('/get-sub-question', [SurveyController::class, 'getSubQuery']);
    Route::post('/add-assesment', [AssesmentController::class, 'assesmentStore']);

});
  

/*------------------------------------------
--------------------------------------------
All manager Routes List
--------------------------------------------
--------------------------------------------*/
Route::group(['prefix' =>'manager/', 'middleware' => ['auth', 'is_manager']], function(){
  
    Route::get('/dashboard', [HomeController::class, 'managerHome'])->name('manager.dashboard');
});


/*------------------------------------------
--------------------------------------------
All expert Routes List
--------------------------------------------
--------------------------------------------*/
Route::group(['prefix' =>'expert/', 'middleware' => ['auth', 'is_expert']], function(){
  
    Route::get('/dashboard', [HomeController::class, 'expertHome'])->name('expert.dashboard');
});


/*------------------------------------------
--------------------------------------------
All expert manager Routes List
--------------------------------------------
--------------------------------------------*/
Route::group(['prefix' =>'expert-manager/', 'middleware' => ['auth', 'is_expertlinemanager']], function(){
  
    Route::get('/dashboard', [HomeController::class, 'expertManagerHome'])->name('expertmanager.dashboard');
});
 