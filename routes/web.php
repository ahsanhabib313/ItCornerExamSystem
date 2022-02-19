<?php

/*route by ahsan*/
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\CodeEditorController;

//* route by MI Rajin*//
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Auth\RegisterController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ResultController;

/**
 * route by shaheen reza
 */

use App\Http\Controllers\QuestionsController;
use App\Http\Controllers\CategoryController;
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
//demo

Route::prefix('/user')->name('user.')->group(function(){

    Route::middleware(['guest:web','preventBackHistory'])->group(function(){

        Route::get('/registration', [RegistrationController::class, 'showPage'])->name('registration.showPage');
        Route::post('/registration', [RegistrationController::class, 'register'])->name('registration');
        Route::get('user/login', [LoginController::class, 'index'])->name('login.index');
        Route::post('user/login/check', [LoginController::class, 'login'])->name('login.check');

    });
    
    Route::middleware(['auth:web','preventBackHistory'])->group(function(){

        Route::get('/exam/{user_id}', [ExamController::class, 'getQuestion'])->name('exam');
        Route::post('question/answer/store', [ExamController::class, 'questionAnswerStore'])->name('question.answer.store');
        Route::get('get/next/question/{id}',[ExamController::class, 'getQuestion'])->name('get.next.question');
        Route::post('/store/personal/info', [UserController::class, 'store'])->name('store.personal.info');
        Route::get('/get/examinee/result/{id}', [UserController::class, 'getExamineeResult'])->name('get.examinee.result');
        Route::get('/suspended/{user_id}',[UserController::class,'userSuspend'])->name('suspended');

        //code editor route
        Route::post('file/write', [CodeEditorController::class, 'codeWrite']);
        


    });


});




// route by MI Rajin

Route::group(['namespace' => 'Admin', 'middleware' => ['auth:admin','preventBackHistory'], 'prefix' => '/admin'], function () {
    
    // admin route
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/add-new-question', [QuestionsController::class, 'add_question_view'])->name('admin.add-new-question');
    Route::get('/show/question', [QuestionsController::class, 'showQuestion'])->name('admin.show.question');
    Route::post('/add-new-question', [QuestionsController::class, 'add_question_store'])->name('admin.add-new-question');
    Route::post('/edit/question', [QuestionsController::class, 'editQuestion'])->name('admin.edit.question');
    Route::post('/update/question', [QuestionsController::class, 'updateQuestion'])->name('admin.update.question');
    Route::post('/delete/question', [QuestionsController::class, 'deleteQuestion'])->name('admin.delete.question');

    Route::get('/add-answer', [QuestionsController::class, 'add_answer_view'])->name('admin.add-answer');
    Route::post('/add-answer', [QuestionsController::class, 'add_answer_store'])->name('admin.add-answer');
    //settings route
    Route::get('/add/setting',[SettingController::class,'index'])->name('admin.add.setting');
    Route::post('/add/setting',[SettingController::class,'store_setting'])->name('admin.add.setting');
    Route::get('/show/setting',[SettingController::class,'show_setting'])->name('admin.show.setting');
    Route::post('/update/setting',[SettingController::class,'update_setting'])->name('admin.update.setting');
    Route::post('/delete/setting',[SettingController::class,'destroy'])->name('admin.delete.setting');

    Route::get('/add-category', [CategoryController::class, 'add_category_view'])->name('admin.add-category');
    Route::post('/add-category', [CategoryController::class, 'add_category_store'])->name('admin.add-category');
    Route::get('/show/category', [CategoryController::class, 'show_category'])->name('admin.show.category');
    Route::post('/update/category', [CategoryController::class, 'update_category'])->name('admin.update.category');
    Route::post('/delete/category', [CategoryController::class, 'delete_category'])->name('admin.delete.category');
    Route::get('/view-cv', [ResultController::class, 'viewCv'])->name('admin.view-cv');
    //logout the admin
    Route::post('/logout', [LoginController::class, 'logout'])->name('admin.logout');

    
});

Route::namespace('Auth')->name('admin.')->group(function () {

    Route::middleware(['guest:admin','preventBackHistory'])->group(function(){

    //Login Routes
    Route::get('/admin/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/admin/login', [LoginController::class, 'login'])->name('login');

    // Register Routes
    Route::get('/admin/register', [RegisterController::class, 'showRegisterForm'])->name('register');
    Route::post('/admin/register', [RegisterController::class, 'register'])->name('register');



    });

   /*  Route::middleware(['auth:admin']) */
   
   

    
   /*  //Forgot Password Routes
    Route::get('/password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('/password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.email');

    //Reset Password Routes
    Route::get('/password/reset/{token}', 'ResetPasswordController@showResetForm')->name('password.reset');
    Route::post('/password/reset', 'ResetPasswordController@reset')->name('password.update');
 */

});
