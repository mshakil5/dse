<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Occhealth\OccupationalHealthController;


/*------------------------------------------
--------------------------------------------
All expert Routes List
Occupational Health is_type:3
--------------------------------------------
--------------------------------------------*/
Route::group(['prefix' =>'expert/', 'middleware' => ['auth', 'is_expert']], function(){
  
    Route::get('/dashboard', [HomeController::class, 'expertHome'])->name('expert.dashboard');
    Route::get('/get-active-users', [OccupationalHealthController::class, 'getAllUsers'])->name('health.userlist');
    Route::get('/get-complined-assesment', [OccupationalHealthController::class, 'getComplinedbyOH'])->name('health.complinedassesment');
    Route::get('/get-users-determining-answer/{id}', [OccupationalHealthController::class, 'getUsersDeterminingAnswer'])->name('health.determiniganswer');
    
    Route::get('/assessment/user/{id}', [OccupationalHealthController::class,'showAssessmentUserDetails'])->name('health.assessment.details');
    
    Route::get('/assessment/user/{uid}/{cat_id}', [OccupationalHealthController::class,'showAssessmentUserDetailsbyCategory'])->name('health.assessment.details.category');
    Route::post('/add-rating', [OccupationalHealthController::class, 'addRating']);

    
    Route::post('/transfer-to-manager', [OccupationalHealthController::class, 'transferToManager']);
    Route::post('/occhealth-comment', [OccupationalHealthController::class, 'expertMessageStore']);
    Route::post('/health-suggestion', [OccupationalHealthController::class, 'expertHealthComment']);

    
    Route::get('/support-request', [OccupationalHealthController::class, 'getSupportRequest'])->name('expert.supportRequest');

});
  