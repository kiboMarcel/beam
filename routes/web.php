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
use App\Http\Controllers\backend\setup\FeeAmountController;
use App\Http\Controllers\backend\setup\ExamTypeController;
use App\Http\Controllers\backend\setup\SchoolSubjectController;
use App\Http\Controllers\backend\setup\AssignSubjectController;
use App\Http\Controllers\backend\setup\DesignationController;

use App\Http\Controllers\backend\student\StudentRegistrationController;

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


// general set up 

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
    

    //type fee amount 
    Route::get('/fee/amount/view', [FeeAmountController::class, 'ViewFeeAmount']) -> name('fee.amount.view');
    
    Route::get('/fee/amount/add', [FeeAmountController::class, 'FeeAmountAdd']) -> name('fee.amount.add');
    
    Route::post('/fee/amount/store', [FeeAmountController::class, 'FeeAmountStore']) -> name('fee.amount.store');
    
    Route::get('/fee/amount/edit/{fee_category_id}', [FeeAmountController::class, 'FeeAmountEdit']) -> name('fee.amount.edit');
    
    Route::post('/fee/amount/update/{fee_category_id} ', [FeeAmountController::class, 'FeeAmountUpdate']) -> name('fee.amount.update');
    
    Route::get('/fee/amount/detail/{fee_category_id}', [FeeAmountController::class, 'FeeAmountDetail']) -> name('fee.amount.detail');
    
    Route::get('/fee/amount/delete/{fee_category_id}', [FeeAmountController::class, 'FeeAmountDelete']) -> name('fee.amount.delete');
    
   //exam type
   Route::get('/exam/type/view', [ExamTypeController::class, 'ViewExamType']) -> name('exam.type.view');
    
   Route::get('/exam/type/add', [ExamTypeController::class, 'ExamTypeAdd']) -> name('exam.type.add');
   
   Route::post('/exam/category/store', [ExamTypeController::class, 'ExamTypeStore']) -> name('exam.type.store');
   
   Route::get('/exam/category/edit/{id}', [ExamTypeController::class, 'ExamTypeEdit']) -> name('exam.type.edit');
   
   Route::post('/exam/category/update/{id} ', [ExamTypeController::class, 'ExamTypeUpdate']) -> name('exam.type.update');
   
   Route::get('/exam/category/delete/{id}', [ExamTypeController::class, 'ExamTypeDelete']) -> name('exam.type.delete');
   
   //subject type
   Route::get('/subject/type/view', [SchoolSubjectController::class, 'ViewSchoolType']) -> name('subject.type.view');
    
   Route::get('/subject/type/add', [SchoolSubjectController::class, 'SchoolTypeAdd']) -> name('subject.type.add');
   
   Route::post('/subject/category/store', [SchoolSubjectController::class, 'SchoolTypeStore']) -> name('subject.type.store');
   
   Route::get('/subject/category/edit/{id}', [SchoolSubjectController::class, 'SchoolTypeEdit']) -> name('subject.type.edit');
   
   Route::post('/subject/category/update/{id} ', [SchoolSubjectController::class, 'SchoolTypeUpdate']) -> name('subject.type.update');
   
   Route::get('/subject/category/delete/{id}', [SchoolSubjectController::class, 'SchoolTypeDelete']) -> name('subject.type.delete');
   
   //assign subject
   Route::get('/assign/subject/view', [AssignSubjectController::class, 'ViewAssignSubject']) -> name('assign.subject.view');
    
   Route::get('/assign/subject/add', [AssignSubjectController::class, 'AssignSubjectAdd']) -> name('assign.subject.add');
   
   Route::post('/assign/subject/store', [AssignSubjectController::class, 'AssignSubjectStore']) -> name('assign.subject.store');
   
   Route::get('/assign/subject/edit/{class_id}/{branch_id}', [AssignSubjectController::class, 'AssignSubjectEdit']) -> name('assign.subject.edit');
   
   Route::post('/assign/subject/update/{class_id}/{branch_id} ', [AssignSubjectController::class, 'AssignSubjectUpdate']) -> name('assign.subject.update');
   
   Route::get('/assign/subject/detail/{class_id}/{branch_id} ', [AssignSubjectController::class, 'AssignSubjectDetail']) -> name('assign.subject.detail');
   
   //subject type
   Route::get('/designation/view', [DesignationController::class, 'ViewDesignation']) -> name('designation.view');
    
   Route::get('/designation/add', [DesignationController::class, 'DesignationAdd']) -> name('designation.add');
   
   Route::post('/designation/store', [DesignationController::class, 'DesignationStore']) -> name('designation.store');
   
   Route::get('/designation/edit/{id}', [DesignationController::class, 'DesignationEdit']) -> name('designation.edit');
   
   Route::post('/designation/update/{id} ', [DesignationController::class, 'DesignationUpdate']) -> name('designation.update');
   
   Route::get('/designation/delete/{id}', [DesignationController::class, 'DesignationDelete']) -> name('designation.delete');
   
} );


Route::prefix('students')->group( function(){

        //student registration
   Route::get('/reg/view', [StudentRegistrationController::class, 'ViewRegistration']) -> name('student.registration.view');
    
   Route::get('/reg/add', [StudentRegistrationController::class, 'RegistrationAdd']) -> name('student.registration.add');
   
   Route::get('/year/class/search', [StudentRegistrationController::class, 'StudentSearch']) -> name('student.year.class.wise');
   
   Route::post('/reg/store', [StudentRegistrationController::class, 'RegistrationStore']) -> name('student.registration.store');
   
   Route::get('/reg/edit/{student_id}', [StudentRegistrationController::class, 'RegistrationEdit']) -> name('student.registration.edit');
   
   Route::post('/reg/update/{student_id} ', [StudentRegistrationController::class, 'RegistrationUpdate']) -> name('student.registration.update');
   
   Route::get('/reg/promotion/{student_id} ', [StudentRegistrationController::class, 'StudentPromotionView']) -> name('student.registration.promotion');
   
   Route::post('/reg/promote/{student_id} ', [StudentRegistrationController::class, 'StudentPromotion']) -> name('student.promote');
   
});