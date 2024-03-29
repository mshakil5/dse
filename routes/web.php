<?php
  
// use Illuminate\Support\Facades\Auth;
  
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SurveyController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\LinemanagerController;
use App\Http\Controllers\AssesmentController;
use App\Http\Controllers\HealthSafetyController;
  
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
    Route::get('/survey/{program_number}', [SurveyController::class, 'survey'])->name('user.survey');
    Route::get('/determining-question', [SurveyController::class, 'determiningQuestion'])->name('user.determinigQn');
    Route::post('/determining-question', [SurveyController::class, 'determiningQuestionStore'])->name('user.determinigQnStore');
    Route::post('/determining-answer-update', [SurveyController::class, 'determiningQuestionUpdate']);


    Route::post('/work-station-assesment-store', [SurveyController::class, 'workStationAssesmentStore'])->name('user.workStationAssesmentStore');
    Route::post('/assesment-answer-store', [AssesmentController::class, 'assesmentAnswerStore'])->name('assesment.answer.store');
    Route::post('/add-assesment', [AssesmentController::class, 'assesmentStore'])->name('add.assessment');

    
    Route::post('/user-comment', [AssesmentController::class, 'userCommentStore'])->name('question.usercomment');


});
  

/*------------------------------------------
--------------------------------------------
All manager Routes List
--------------------------------------------
--------------------------------------------*/
Route::group(['prefix' =>'manager/', 'middleware' => ['auth', 'is_manager']], function(){
  
    Route::get('/dashboard', [HomeController::class, 'managerHome'])->name('manager.dashboard');
    
    Route::get('/get-active-users', [LinemanagerController::class, 'getAllUsers'])->name('linemanager.userlist');
    Route::get('/get-users-determining-answer/{id}', [LinemanagerController::class, 'getUsersDeterminingAnswer'])->name('linemanager.determiniganswer');

    Route::get('/get-assesment', [AssesmentController::class, 'getAssesmentbyLineManager'])->name('manager.assesment');
    Route::get('/assessment/user/{id}', [AssesmentController::class,'showAssessmentUserDetails'])->name('assessment.user.details');

    Route::get('/get-complined-assesment', [LinemanagerController::class, 'getComplinedbyLineManager'])->name('manager.complinedassesment');

    Route::get('/assessment/user/{uid}/{cat_id}', [AssesmentController::class,'showAssessmentUserDetailsbyCategory'])->name('assessment.details.category');

    Route::post('/manager-comment', [AssesmentController::class, 'managerCommentStore'])->name('question.managercomment');
    Route::post('/assesment-approved', [AssesmentController::class, 'managerAssesmentApproved']);
    Route::post('/assesment-reject', [AssesmentController::class, 'managerAssesmentReject']);
    Route::post('/add-rating', [AssesmentController::class, 'managerAddRating']);
    Route::post('/managers-comment', [AssesmentController::class, 'managerMessageStore']);
    Route::post('/add-new-schedule', [LinemanagerController::class, 'addNewSchedule']);
    Route::post('/transfer-to-health', [LinemanagerController::class, 'transferToHealth']);


});


/*------------------------------------------
--------------------------------------------
All expert Routes List
--------------------------------------------
--------------------------------------------*/
Route::group(['prefix' =>'expert/', 'middleware' => ['auth', 'is_expert']], function(){
  
    Route::get('/dashboard', [HomeController::class, 'expertHome'])->name('expert.dashboard');
    Route::get('/get-active-users', [HealthSafetyController::class, 'getAllUsers'])->name('health.userlist');
    Route::get('/get-complined-assesment', [HealthSafetyController::class, 'getComplinedbyLineManager'])->name('health.complinedassesment');
    Route::get('/get-users-determining-answer/{id}', [HealthSafetyController::class, 'getUsersDeterminingAnswer'])->name('health.determiniganswer');
    
    Route::get('/assessment/user/{id}', [HealthSafetyController::class,'showAssessmentUserDetails'])->name('health.assessment.details');
    
    Route::get('/assessment/user/{uid}/{cat_id}', [HealthSafetyController::class,'showAssessmentUserDetailsbyCategory'])->name('health.assessment.details.category');
    Route::post('/add-rating', [HealthSafetyController::class, 'addRating']);

});


/*------------------------------------------
--------------------------------------------
All expert manager Routes List
--------------------------------------------
--------------------------------------------*/
Route::group(['prefix' =>'expert-manager/', 'middleware' => ['auth', 'is_expertlinemanager']], function(){
  
    Route::get('/dashboard', [HomeController::class, 'expertManagerHome'])->name('expertmanager.dashboard');
});
 