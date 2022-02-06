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
use App\Http\Controllers\Admin\HomeController;

use App\Http\Controllers\ResultController;

/**
 * route by shaheen reza
 */

use App\Http\Controllers\QuestionsController;
use App\Http\Controllers\QuestionLimitController;
use App\Http\Controllers\CategoryController;
// use App\Http\Controllers\LoginController;
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
$user_id = 1;
Route::view('info','exam.personalInfo', compact('user_id'));


Route::get('/', [RegistrationController::class, 'showPage'])->name('register.showPage');
// Route::get('/login', [LoginController::class, 'index'])->name('login.index');
// Route::post('/login/check', [LoginController::class, 'login'])->name('login.check');
Route::get('/registration', [RegistrationController::class, 'showPage'])->name('register.showPage');
Route::post('/user/register', [RegistrationController::class, 'register'])->name('user.register');
Route::get('/user/exam/{user_id}', [ExamController::class, 'getQuestion'])->name('user.exam');
Route::post('user/question/answer/store', [ExamController::class, 'questionAnswerStore'])->name('user.question.answer.store');
Route::get('get/next/question/{id}',[ExamController::class, 'getQuestion'])->name('get.next.question');
Route::post('/store/personal/info', [UserController::class, 'store'])->name('store.personal.info');
Route::get('/get/examinee/result/{id}', [UserController::class, 'getExamineeResult'])->name('get.examinee.result');
Route::get('/user/suspended/{user_id}',[UserController::class,'userSuspend'])->name('user.suspended');

//code editor route
Route::post('file/write', [CodeEditorController::class, 'codeWrite']);

// route by MI Rajin

Route::group(['namespace' => 'Admin', 'middleware' => ['auth:admin'], 'prefix' => '/admin'], function () {
    // Route::get('/dashboard', [HomeController::class, 'index'])->name('admin.home');
    // admin route
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/add-new-question', [QuestionsController::class, 'add_question_view'])->name('admin.add-new-question');
    Route::get('/show/question', [QuestionsController::class, 'showQuestion'])->name('admin.show.question');
    Route::post('/add-new-question', [QuestionsController::class, 'add_question_store'])->name('admin.add-new-question');
    Route::post('/edit/question', [QuestionsController::class, 'editQuestion'])->name('admin.edit.question');
    Route::post('/update/question', [QuestionsController::class, 'updateQuestion'])->name('admin.update.question');

    Route::get('/add-answer', [QuestionsController::class, 'add_answer_view'])->name('add-answer');
    Route::post('/add-answer', [QuestionsController::class, 'add_answer_store'])->name('add-answer');
    //settings route
    Route::get('/add/setting',[SettingController::class,'index'])->name('admin.add.setting');
    Route::post('/add/setting',[SettingController::class,'store_setting'])->name('admin.add.setting');
    Route::get('/show/setting',[SettingController::class,'show_setting'])->name('admin.show.setting');
    Route::post('/update/setting',[SettingController::class,'update_setting'])->name('admin.update.setting');

    Route::get('/add-category', [CategoryController::class, 'add_category_view'])->name('admin.add-category');
    Route::post('/add-category', [CategoryController::class, 'add_category_store'])->name('admin.add-category');
    Route::get('/show/category', [CategoryController::class, 'show_category'])->name('admin.show.category');
    Route::post('/update/category', [CategoryController::class, 'update_category'])->name('admin.update.category');
    Route::post('/delete/category', [CategoryController::class, 'delete_category'])->name('admin.delete.category');

    Route::get('/view-cv', [ResultController::class, 'viewCv'])->name('admin.view-cv');
});

Route::namespace('Auth')->group(function () {

    //Login Routes
    Route::get('/admin/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/admin/login', [LoginController::class, 'login'])->name('login');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    // Register Routes
    Route::get('/admin/register', [RegisterController::class, 'showRegisterForm'])->name('register');
    Route::post('/admin/register', [RegisterController::class, 'register'])->name('register');

    //Forgot Password Routes
    Route::get('/password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('/password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.email');

    //Reset Password Routes
    Route::get('/password/reset/{token}', 'ResetPasswordController@showResetForm')->name('password.reset');
    Route::post('/password/reset', 'ResetPasswordController@reset')->name('password.update');
});
