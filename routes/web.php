<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\InstructorController;
use App\Http\Controllers\ClubController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\MarketController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\StudentPaymentController;
use Illuminate\Support\Facades\Route;

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

Route::get('test', function () {
    return view('test');
})->name('test');

Route::post('test', function () {
    dd([
        request()->input('filters|is_admin', ''),
        request()->input('filters|gender', )
    ]);
});

Route::redirect('/', 'login')->middleware('guest');


// Auth routes

Route::group([
    'controller' => AuthController::class
], function () {
    Route::group([
        'middleware' => 'guest'
    ], function () {
        Route::view('login', 'login')
            ->name('login')
            ->middleware('prevent-back');
        
        Route::post('auth', 'authenticate')
            ->name('auth');
    });
    
    Route::get('logout', 'logout')
        ->name('logout')
        ->middleware('auth');
});


// Password recovery

Route::group([
    'controller' => PasswordController::class,
    'middleware' => 'guest',
    'as' => 'password.',
],
function () {
    Route::get('forgot-password', 'forgot')
        ->name('forgot');
    
    Route::post('forgot-password', 'mail')
        ->name('email');
    
    Route::get('reset-password/{token}/{email}', 'edit')
        ->name('edit');
    
    Route::post('reset-password', 'reset')
        ->name('reset');
});


// Signup routes

Route::get('signup', [RegisterController::class, 'create'])
    ->name('students.create');

Route::post('register', [RegisterController::class, 'store'])
    ->name('students.store');


// Instructors routes

Route::resource('instructors', InstructorController::class)
    ->middleware('auth:instructor', 'admin');


// Areas routes

Route::resource('areas', AreaController::class)
    ->except('create')
    ->middleware('auth:instructor');


// Courses routes

Route::resource('courses', CourseController::class)
    ->middleware('auth:instructor', 'admin');


// Students routes

Route::resource('students', StudentController::class)
    ->middleware('auth:instructor', 'admin');

Route::get('students/{student}/payments', [StudentPaymentController::class, 'index'])
    ->middleware('auth:student')
    ->name('students.payments.index');

//Club routes

//Route::resource('club', ClubController::class);

Route::group([
    'controller'=> ClubController::class,
    'prefix'=>'club'
], function(){
    Route::get('/', 'index')
        ->name('club.index');

    Route::get('register', 'create')
        ->name('club.create');

    Route::post('guardar', 'store')
        ->name('club.store');

});


// Course market

Route::group([
    'middleware' => 'auth:student',
    'prefix' => 'market',
    'as' => 'market.'
], function () {
    Route::get('/', [MarketController::class, 'index'])
        ->name('index');

    Route::get('{course}', [MarketController::class, 'show'])
        ->name('show');
});


// Course enrollment

Route::group([
    'controller' => EnrollmentController::class,
    'middleware' => 'auth:student',
    'prefix' => 'enrollment',
    'as' => 'enrollment.',
], function () {
    Route::get('{course}', 'create')
        ->name('create');

    Route::post('{course}', 'store')
        ->name('store');
    
    Route::get('{registry}/download', 'download')
        ->name('download');
});


// Misc

Route::view('home', 'home')->name('home')
    ->middleware('auth', 'prevent-back');

Route::view('pagos', 'pagos')->name('pagos')
    ->middleware('auth');

