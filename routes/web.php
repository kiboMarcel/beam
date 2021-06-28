<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\backend\UserController;
use App\Http\Controllers\backend\ProfileController;
use App\Http\Controllers\backend\setup\StudentClassController;
use App\Http\Controllers\backend\setup\StudentYearController;
use App\Http\Controllers\backend\setup\StudentBranchController;
use App\Http\Controllers\backend\setup\StudentGroupController;
use App\Http\Controllers\backend\setup\FeeCategoryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| http://beam.test
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('admin.index');
})->name('dashboard');

Route::get('/admin/logout', [AdminController::class, 'Logout']) -> name('admin.logout');

//User Routes

Route::prefix('users')->group( function() {
    
Route::get('/view', [UserController::class, 'UserView']) -> name('user.view');

Route::get('/add', [UserController::class, 'UserAdd']) -> name('user.add');

Route::post('/store', [UserController::class, 'UserStore']) -> name('user.store');

Route::get('/edit/{id}', [UserController::class, 'UserEdit']) -> name('user.edit');

Route::post('/update/{id}', [UserController::class, 'UserUpdate']) -> name('user.update');

Route::get('/delete/{id}', [UserController::class, 'UserDelete']) -> name('user.delete');

} );


// User Account Setting

Route::prefix('profile')->group( function() {
    
Route::get('/view', [ProfileController::class, 'ProfileView']) -> name('profil.view');

Route::post('/update', [ProfileController::class, 'ProfileUpdate']) -> name('profil.update');

Route::get('/password/view', [ProfileController::class, 'ProfilePasswordView']) -> name('profil.password');

Route::post('/password/update', [ProfileController::class, 'PasswordUpdate']) -> name('password.update');
    
} );


// Set Account Setting

Route::prefix('setups')->group( function() {
    

    //student class 
    Route::get('/student/class/view', [StudentClassController::class, 'ViewStudentClass']) -> name('student.class.view');
    
    Route::get('/student/class/add', [StudentClassController::class, 'StudentClassAdd']) -> name('student.class.add');
    
    Route::post('/student/class/store', [StudentClassController::class, 'StudentClassStore']) -> name('student.class.store');
    
    Route::get('/student/class/edit/{id}', [StudentClassController::class, 'StudentClassEdit']) -> name('student.class.edit');
    
    Route::post('/student/class/update/{id} ', [StudentClassController::class, 'StudentClassUpdate']) -> name('student.class.update');
    
    Route::get('/student/class/delete/{id}', [StudentClassController::class, 'StudentClassDelete']) -> name('student.class.delete');
    

    //student year
    Route::get('/student/year/view', [StudentYearController::class, 'ViewStudentYear']) -> name('student.year.view');
    
    Route::get('/student/year/add', [StudentYearController::class, 'StudentYearAdd']) -> name('student.year.add');
    
    Route::post('/student/year/store', [StudentYearController::class, 'StudentYearStore']) -> name('student.year.store');
    
    Route::get('/student/year/edit/{id}', [StudentYearController::class, 'StudentYearEdit']) -> name('student.year.edit');
    
    Route::post('/student/year/update/{id} ', [StudentYearController::class, 'StudentYearUpdate']) -> name('student.year.update');
    
    Route::get('/student/year/delete/{id}', [StudentYearController::class, 'StudentYearDelete']) -> name('student.year.delete');
    

    //student branch
    Route::get('/student/branch/view', [StudentBranchController::class, 'ViewStudentBranch']) -> name('student.branch.view');
    
    Route::get('/student/branch/add', [StudentBranchController::class, 'StudentBranchAdd']) -> name('student.branch.add');
    
    Route::post('/student/branch/store', [StudentBranchController::class, 'StudentBranchStore']) -> name('student.branch.store');
    
    Route::get('/student/branch/edit/{id}', [StudentBranchController::class, 'StudentBranchEdit']) -> name('student.branch.edit');
    
    Route::post('/student/branch/update/{id} ', [StudentBranchController::class, 'StudentBranchUpdate']) -> name('student.branch.update');
    
    Route::get('/student/branch/delete/{id}', [StudentBranchController::class, 'StudentBranchDelete']) -> name('student.branch.delete');
    

    //student group
    Route::get('/student/group/view', [StudentGroupController::class, 'ViewStudentGroup']) -> name('student.group.view');
    
    Route::get('/student/group/add', [StudentGroupController::class, 'StudentGroupAdd']) -> name('student.group.add');
    
    Route::post('/student/group/store', [StudentGroupController::class, 'StudentGroupStore']) -> name('student.group.store');
    
    Route::get('/student/group/edit/{id}', [StudentGroupController::class, 'StudentGroupEdit']) -> name('student.group.edit');
    
    Route::post('/student/group/update/{id} ', [StudentGroupController::class, 'StudentGroupUpdate']) -> name('student.group.update');
    
    Route::get('/student/group/delete/{id}', [StudentGroupController::class, 'StudentGroupDelete']) -> name('student.group.delete');
    

    //fee category
    Route::get('/fee/category/view', [FeeCategoryController::class, 'ViewFeeCat']) -> name('fee.category.view');
    
    Route::get('/fee/category/add', [FeeCategoryController::class, 'FeeCatAdd']) -> name('fee.category.add');
    
    Route::post('/fee/category/store', [FeeCategoryController::class, 'FeeCatStore']) -> name('fee.category.store');
    
    Route::get('/fee/category/edit/{id}', [FeeCategoryController::class, 'FeeCatEdit']) -> name('fee.category.edit');
    
    Route::post('/fee/category/update/{id} ', [FeeCategoryController::class, 'FeeCatUpdate']) -> name('fee.category.update');
    
    Route::get('/fee/category/delete/{id}', [FeeCategoryController::class, 'FeeCatDelete']) -> name('fee.category.delete');
    

    //fee amount
    Route::get('/fee/category/view', [FeeCategoryController::class, 'ViewFeeCat']) -> name('fee.amount.view');
    
    Route::get('/fee/category/add', [FeeCategoryController::class, 'FeeCatAdd']) -> name('fee.category.add');
    
    Route::post('/fee/category/store', [FeeCategoryController::class, 'FeeCatStore']) -> name('fee.category.store');
    
    Route::get('/fee/category/edit/{id}', [FeeCategoryController::class, 'FeeCatEdit']) -> name('fee.category.edit');
    
    Route::post('/fee/category/update/{id} ', [FeeCategoryController::class, 'FeeCatUpdate']) -> name('fee.category.update');
    
    Route::get('/fee/category/delete/{id}', [FeeCategoryController::class, 'FeeCatDelete']) -> name('fee.category.delete');
    
   
        
    } );