<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\ViewController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BusinessController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\ProfileController;

use App\Http\Controllers\Web\WebController;
use App\Http\Controllers\MenuItemController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\LectureController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\HomeworkController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\UserRoleController;
use App\Http\Middleware\AddComponentsToRoute;
use App\Http\Middleware\AddModuleToRoute;
use App\Models\Lecture;


// URL::forceScheme('https');

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



Route::group(['prefix' => 'admin', 'middleware' => 'checkRole:admin'], function () {
    Route::get('/', [UserRoleController::class, 'index'])->name('admin');
    Route::get('/panel', [UserRoleController::class, 'rolePanel'])->name('admin_rolepanel');
});

Route::group(['prefix' => 'student', 'middleware' => 'checkRole:student'], function () {
    Route::get('/', [UserRoleController::class, 'index'])->name('student');
    Route::get('/panel', [UserRoleController::class, 'rolePanel'])->name('student_rolepanel');
});

Route::group(['prefix' => 'teacher', 'middleware' => 'checkRole:teacher'], function () {
    Route::get('/', [UserRoleController::class, 'index'])->name('teacher');
    Route::get('/panel', [UserRoleController::class, 'rolePanel'])->name('teacher_rolepanel');
});

Route::group(['prefix' => 'business', 'middleware' => 'checkRole:business'], function () {
    Route::get('/', [UserRoleController::class, 'index'])->name('business');
    Route::get('/panel', [UserRoleController::class, 'rolePanel'])->name('business_rolepanel');
});


Route::middleware(['web', AddComponentsToRoute::class])->group(function () {
    Route::controller(AuthController::class)->group(function() {
        Route::get('/login', 'login')->name('show_form');
        Route::post('/login', 'login_post')->name('login');
        Route::get('/register', 'register')->name('register');
        Route::post('/register-user', 'registerUser')->name('registerUser');
        Route::get('/forgot_password', 'index')->name('forgot_password');
        Route::post('/forgot_password', 'forgotPassword')->name('forgot_password_post');
        Route::get('/reset_password/{token}', 'resetPassword')->name('reset_password');
        Route::post('/reset_password', 'resetPasswordPost')->name('reset_password_post');
        Route::get('/logout', 'logout')->name('logout');
    });

    Route::controller(WebController::class)->group(function() {
        Route::get('/', 'home')->name('home');
        Route::get('/about', 'about')->name('about');
        Route::get('/contact', 'contact')->name('contact');
        Route::get('/contact2', 'contact2')->name('contact2');
    });


    Route::controller(MenuItemController::class)->group(function() {
        Route::get('/menu', 'index')->name('menuItem.index');
        Route::get('/menu/create', 'create')->name('menuItem.create');
        Route::post('/menu', 'store')->name('menuItem.store');
        Route::get('/menu/{menuItem}', 'show')->name('menuItem.show');
        Route::get('/menu/{menuItem}/edit', 'edit')->name('menuItem.edit');
        Route::put('/menu/{menuItem}', 'update')->name('menuItem.update');
        Route::delete('/menu/{menuItem}', 'destroy')->name('menuItem.destroy');

    });


    Route::controller(UserController::class)->group(function() {
        Route::get('/user', 'index')->name('user.index');
        Route::get('/user/create', 'create')->name('user.create');
        Route::post('/user', 'store')->name('user.store');
        Route::get('/user/{user}', 'show')->name('user.show');
        Route::get('/user/{user}/edit', 'edit')->name('user.edit');
        Route::put('/user/{user}', 'update')->name('user.update');
        Route::delete('/user/{user}', 'destroy')->name('user.destroy');

        Route::get('/user/show/profile/{user}', 'show')->name('user.profile.show');
        Route::get('/user/edit/profile/{user}', 'edit')->name('user.profile.edit');
        Route::put('/user/update/profile/{user}', 'update')->name('user.profile.update');

        Route::delete('/users/{user}/detail/{detail}/id/{id}', 'deleteDetail')->name('user.detail.delete');

        Route::put('/avatar/{user}', 'update_avatar')->name('user.update_avatar');
        Route::put('/cv/{user}', 'update_cv')->name('user.update_cv');

        Route::get('/update_password', 'updatePassword')->name('user_update_password');
        Route::post('/update_password', 'updatePasswordPost')->name('user_update_password_post');
        Route::get('/up_email', 'updateEmail')->name('user_update_email');
        Route::get('/update_email', 'updateEmailGet')->name('user_update_email_get');
        Route::post('/update_email', 'updateEmailPost')->name('user_update_email_post');
    });



    Route::controller(StudentController::class)->group(function() {
        Route::get('/student', 'index')->name('student.index');
        Route::get('/student/{user}', 'show')->name('student.show');
        Route::get('/students/approve/', 'approveList')->name('students.approve.list');
        Route::put('/student/approve/{id}', 'approve')->name('student.approve');

    });



    Route::controller(CourseController::class)->group(function() {
        Route::get('/course', 'index')->name('course.index');
        Route::get('/course/create', 'create')->name('course.create');
        Route::post('/course', 'store')->name('course.store');
        Route::get('/course/{course}', 'show')->name('course.show');
        Route::get('/course/{course}/edit', 'edit')->name('course.edit');
        Route::put('/course/{course}', 'update')->name('course.update');
        Route::put('/logo/{course}', 'update_course_logo')->name('course.update_logo');
        Route::delete('/course/{course}', 'destroy')->name('course.destroy');
        Route::get('/course/enrolling/{course}/{user}', 'enrolling')->name('course.enrolling');
    });



    Route::controller(ModuleController::class)->group(function() {
        Route::get('/module', 'index')->name('module.index');
        Route::get('/module/create', 'create')->name('module.create');
        Route::post('/module', 'store')->name('module.store');
        Route::get('/module/{module}/{course}', 'show')->name('module.show');

        Route::put('/module/{module}', 'update')->name('module.update');
        Route::delete('/module/{module}', 'destroy')->name('module.destroy');
    });

    Route::get('/module/{module}edit', [ModuleController::class, 'edit'])->name('module.edit');




    Route::controller(LectureController::class)->group(function() {
        Route::get('/lecture', 'index')->name('lecture.index');
        Route::get('/lecture/create', 'create')->name('lecture.create');
        Route::post('/lecture', 'store')->name('lecture.store');
        Route::get('/lecture/{lecture}/{module}', 'show')->name('lecture.show');
        Route::get('/lecture/{lecture}edit', 'edit')->name('lecture.edit');
        Route::put('/lecture/{lecture}', 'update')->name('lecture.update');
        Route::delete('/lecture/{lecture}', 'destroy')->name('lecture.destroy');

    });

    Route::controller(GradeController::class)->group(function() {

        Route::get('/grade', 'index')->name('grade.index');
        Route::get('/grade/create', 'create')->name('grade.create');
        Route::post('/grade', 'store')->name('grade.store');
        Route::get('/grade/{grade}', 'show')->name('grade.show');
        Route::get('/grade/{grade}/edit', 'edit')->name('grade.edit');
        Route::put('/grade/{grade}', 'update')->name('grade.update');
        Route::delete('/grade/{grade}', 'destroy')->name('grade.destroy');
        Route::get('/modules/{courseId}', [GradeController::class, 'modules']);
        Route::get('/lectures/{moduleId}', [GradeController::class, 'lectures']);
        Route::get('/grades/{studentId}/{moduleId}', [GradeController::class, 'grades']);
        Route::get('/date/lecture/{lectureId}', [GradeController::class, 'getDate']);
        Route::post('/save-absence', [GradeController::class, 'saveAbsence']);
        Route::get('/students/results/{studentId}', [GradeController::class, 'getStudentResults']);
        Route::post('/save-grades', [GradeController::class, 'saveGrades']);


        Route::get('/getStudents/{lectureId}', [GradeController::class, 'getStudents']);


    });

    Route::controller(HomeworkController::class)->group(function() {
        Route::get('/homework', 'index')->name('homework.index');
        Route::get('/homework/create', 'create')->name('homework.create');
        Route::post('/homework', 'store')->name('homework.store');
        Route::get('/homework/{homework}', 'show')->name('homework.show');
        Route::get('/homework/{homework}/edit', 'edit')->name('homework.edit');
        Route::put('/homework/{homework}', 'update')->name('homework.update');
        Route::delete('/homework/{homework}', 'destroy')->name('homework.destroy');

    });
    Route::post('/homework/{homework}/uploadFile', [HomeworkController::class, 'upload_homework_file'])->name('homework.uploadFile');

});

