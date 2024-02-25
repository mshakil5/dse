<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AgentController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\DivisionController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\QnCategoryController;
use App\Http\Controllers\Admin\QuestionController;
use App\Http\Controllers\Admin\ExpertController;
use App\Http\Controllers\Admin\SubQuestionController;


/*------------------------------------------
--------------------------------------------
All Admin Routes List
--------------------------------------------
--------------------------------------------*/
Route::group(['prefix' =>'admin/', 'middleware' => ['auth', 'is_admin']], function(){
  
    Route::get('/dashboard', [HomeController::class, 'adminHome'])->name('admin.dashboard');
    //profile
    Route::get('/profile', [AdminController::class, 'profile'])->name('profile');
    Route::put('profile/{id}', [AdminController::class, 'adminProfileUpdate']);
    Route::post('changepassword', [AdminController::class, 'changeAdminPassword']);
    Route::put('image/{id}', [AdminController::class, 'adminImageUpload']);
    //profile end

    Route::get('/new-admin', [AdminController::class, 'getAdmin'])->name('alladmin');
    Route::post('/new-admin', [AdminController::class, 'adminStore']);
    Route::get('/new-admin/{id}/edit', [AdminController::class, 'adminEdit']);
    Route::post('/new-admin-update', [AdminController::class, 'adminUpdate']);
    Route::get('/new-admin/{id}', [AdminController::class, 'adminDelete']);
    
    Route::get('/line-manager', [AgentController::class, 'index'])->name('admin.linemanager');
    Route::post('/line-manager', [AgentController::class, 'store']);
    Route::get('/line-manager/{id}/edit', [AgentController::class, 'edit']);
    Route::post('/line-manager-update', [AgentController::class, 'update']);
    Route::get('/line-manager/{id}', [AgentController::class, 'delete']);

    Route::get('/user', [UserController::class, 'index'])->name('admin.user');
    Route::post('/user', [UserController::class, 'store']);
    Route::get('/user/{id}/edit', [UserController::class, 'edit']);
    Route::post('/user-update', [UserController::class, 'update']);
    Route::get('/user/{id}', [UserController::class, 'delete']);

    
    Route::get('/expert', [ExpertController::class, 'index'])->name('admin.expert');
    Route::post('/expert', [ExpertController::class, 'store']);
    Route::get('/expert/{id}/edit', [ExpertController::class, 'edit']);
    Route::post('/expert-update', [ExpertController::class, 'update']);
    Route::get('/expert/{id}', [ExpertController::class, 'delete']);

    Route::get('/country', [CountryController::class, 'index'])->name('admin.country');
    Route::post('/country', [CountryController::class, 'store']);
    Route::get('/country/{id}/edit', [CountryController::class, 'edit']);
    Route::post('/country-update', [CountryController::class, 'update']);
    Route::get('/country/{id}', [CountryController::class, 'delete']);

    Route::get('/department', [DepartmentController::class, 'index'])->name('admin.department');
    Route::post('/department', [DepartmentController::class, 'store']);
    Route::get('/department/{id}/edit', [DepartmentController::class, 'edit']);
    Route::post('/department-update', [DepartmentController::class, 'update']);
    Route::get('/department/{id}', [DepartmentController::class, 'delete']);

    Route::get('/division', [DivisionController::class, 'index'])->name('admin.division');
    Route::post('/division', [DivisionController::class, 'store']);
    Route::get('/division/{id}/edit', [DivisionController::class, 'edit']);
    Route::post('/division-update', [DivisionController::class, 'update']);
    Route::get('/division/{id}', [DivisionController::class, 'delete']);

    
    Route::get('/qn-category', [QnCategoryController::class, 'index'])->name('admin.qncategory');
    Route::post('/qn-category', [QnCategoryController::class, 'store']);
    Route::get('/qn-category/{id}/edit', [QnCategoryController::class, 'edit']);
    Route::post('/qn-category-update', [QnCategoryController::class, 'update']);
    Route::get('/qn-category/{id}', [QnCategoryController::class, 'delete']);

    
    Route::get('/question', [QuestionController::class, 'index'])->name('admin.question');
    Route::post('/question', [QuestionController::class, 'store']);
    Route::get('/question/{id}/edit', [QuestionController::class, 'edit']);
    Route::post('/question-update', [QuestionController::class, 'update']);
    Route::get('/question/{id}', [QuestionController::class, 'delete']);

    
    Route::get('/sub-question', [SubQuestionController::class, 'index'])->name('admin.subquestion');
    Route::post('/sub-question', [SubQuestionController::class, 'store']);
    Route::get('/sub-question/{id}/edit', [SubQuestionController::class, 'edit']);
    Route::post('/sub-question-update', [SubQuestionController::class, 'update']);
    Route::get('/sub-question/{id}', [SubQuestionController::class, 'delete']);

    
});
  