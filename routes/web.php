<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TaskCategoryController;
use App\Http\Controllers\TaskController;
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



// Admin
Route::group(['prefix' => 'dashboard', 'middleware' => ['admin','auth']], function () {
    // User and Account
    Route::get('/users', [UserController::class, 'index'])->name('users');
    Route::get('/users/create', [UserController::class, 'show_create_user'])->name('show.create.user');
    Route::post('/users/add', [UserController::class, 'create_user'])->name('create.user');
    
    // Delete User
    Route::post('/users/delete/{id}', [UserController::class, 'delete_user'])->name('delete.user');
    

    // Department
    Route::resource('departments', DepartmentController::class);
    
    Route::get('/activity/log', [HomeController::class, 'activityLog'])->name('activity.log');
    Route::post('/activity/delete', [HomeController::class, 'activityDelete'])->name('activity.delete.date');
});

// Manager
Route::group(['prefix' => 'dashboard', 'middleware' =>  ['manager','auth']], function () {
    
    // Projects
    
    Route::get('projects/create', [ProjectController::class, 'create'])->name('projects.create');
    Route::post('projects', [ProjectController::class, 'store'])->name('projects.store');
    Route::get('projects/{project}', [ProjectController::class, 'show'])->name('projects.show');
    Route::get('projects/{project}/edit', [ProjectController::class, 'edit'])->name('projects.edit');
    Route::put('projects/{project}', [ProjectController::class, 'update'])->name('projects.update');
    Route::delete('projects/{project}', [ProjectController::class, 'destroy'])->name('projects.destroy');
    


    // Project Categories
    Route::resource('categories', CategoryController::class);

    // Task Categories
    Route::resource('task-categories', TaskCategoryController::class);

    // Clients
    Route::get('clients', [ClientController::class, 'index'])->name('clients.index');
    Route::post('clients', [ClientController::class, 'store'])->name('clients.store');
    Route::get('clients/{client}/edit', [ClientController::class, 'edit'])->name('clients.edit');
    Route::put('clients/{client}', [ClientController::class, 'update'])->name('clients.update');
    Route::delete('clients/{client}', [ClientController::class, 'destroy'])->name('clients.destroy');


    // Tasks
    Route::get('tasks/create/step/1', [TaskController::class, 'createStepOne'])->name('tasks.create.one');
    Route::get('tasks/create/step/2/{project_id}', [TaskController::class, 'createStepTwo'])->name('tasks.create.two');
    Route::post('tasks', [TaskController::class, 'store'])->name('tasks.store');
    Route::get('tasks/{task}', [TaskController::class, 'show'])->name('tasks.show');
    Route::get('tasks/{task}/edit', [TaskController::class, 'edit'])->name('tasks.edit');
    Route::put('tasks/{task}', [TaskController::class, 'update'])->name('tasks.update');
    Route::delete('tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');

});

// Employee
Route::group(['prefix' => 'dashboard', 'middleware' =>  ['employee','auth']], function () {
    // Edit User
    Route::get('user/{id}', [UserController::class, 'show'])->name('users.detail');
            
            
    Route::put('/users/update/{id}', [UserController::class, 'update'])->name('update.user');

    // change password
    Route::put('/change_password/{id}', [UserController::class, 'change_password'])->name('change.password');

    // Show Client
    Route::get('clients/{client}', [ClientController::class, 'show'])->name('clients.show');

    // Show Project
    Route::get('projects', [ProjectController::class, 'index'])->name('projects.index');
    Route::get('projects/{project}', [ProjectController::class, 'show'])->name('projects.show');
    Route::get('projects/{id}/{field}', [ProjectController::class, 'showField'])->name('projects.show.field');
    

    // attachments
    Route::post('attachments/project/{id}', [ProjectController::class, 'storeAttachment'])->name('attachment.storeProject');
    Route::post('attachments/task/{id}', [TaskController::class, 'storeAttachment'])->name('attachment.storeTask');
    Route::delete('attachments/{id}', [ProjectController::class, 'destroyAttachment'])->name('attachment.destroy');

    // Show Task
    Route::get('tasks', [TaskController::class, 'index'])->name('tasks.index');
    Route::get('tasks/{task}', [TaskController::class, 'show'])->name('tasks.show');
    Route::get('tasks/change/{task}', [TaskController::class, 'changeStatus'])->name('tasks.change.status');
    Route::get('tasks/{id}/{field}', [TaskController::class, 'showField'])->name('tasks.show.field');


    // Comments
    Route::post('comments', [CommentController::class, 'store'])->name('comments.store');
    Route::put('comments/{client}', [CommentController::class, 'update'])->name('comments.update');
    Route::delete('comments/{client}', [CommentController::class, 'destroy'])->name('comments.destroy');

    // Change Grid and list Veiw
    Route::get('/projectStyle/{styleDetail}', [ProjectController::class, 'viewStyle'])->name('project.style');
    Route::get('/taskStyle/{styleDetail}', [TaskController::class, 'viewStyle'])->name('task.style');

    // noti Delete
    Route::get('/notification/delete/{id}', [HomeController::class, 'deleteNoti'])->name('notification.delete');
    
    Route::get('/dashboard', [HomeController::class, 'index'])->name('home');
    
});
Route::get('/', [HomeController::class, 'welcome'])->middleware('auth')->name('welcome');
Auth::routes(['register' => false]);

Route::get('/task/share/{id}', [HomeController::class, 'shareTask'])->name('share.task');
