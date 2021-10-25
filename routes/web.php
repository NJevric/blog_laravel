<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\front\PostController;
use App\Http\Controllers\front\IndexController;
use App\Http\Controllers\front\ContactController;
use App\Http\Controllers\front\AuthorController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostCommentsController;
use App\Http\Controllers\SocialsController;

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

Auth::routes();

Route::get('/', [IndexController::class, 'index'])->name('home');

Route::get('/post/{post}',[PostController::class, 'show'])->name('post');
Route::get('/contact',[ContactController::class, 'index'])->name('contact');
Route::post('/contact/mail',[ContactController::class, 'mailSend'])->name('contact.mail');
Route::get('/author',[AuthorController::class, 'index'])->name('author');


Route::get('/posts/categories/{category}',[IndexController::class,'filterByCategory'])->name('home.filter');
Route::get('/search',[IndexController::class,'search'])->name('home.search');

Route::middleware('auth')->group(function(){

    Route::group(['prefix' => '/admin'],function(){
        Route::get('/', [AdminController::class, 'index'])->name('admin.index');
        Route::get('sort', [AdminController::class, 'sort'])->name('admin.sort');

        Route::group(['prefix'=>'/posts'],function(){
            Route::get('/index',[PostController::class, 'index'])->name('post.index');
            Route::get('/create',[PostController::class, 'create'])->name('post.create');
            Route::post('/store',[PostController::class, 'store'])->name('post.store');
            Route::get('/{post}/edit',[PostController::class, 'edit'])->name('post.edit');
            Route::patch('/{post}/update',[PostController::class, 'update'])->name('post.update');
            Route::delete('/{post}/delete',[PostController::class, 'destroy'])->name('post.destroy');    
        });

        Route::group(['prefix'=>'/categories'],function(){
            Route::get('/',[CategoryController::class, 'index'])->name('categories.index');
            Route::post('/store',[CategoryController::class,'store'])->name('category.store');
            Route::get('/{category}/edit',[CategoryController::class, 'edit'])->name('category.edit');
            Route::put('/{category}/update',[CategoryController::class, 'update'])->name('category.update');
            Route::delete('/{category}/delete',[CategoryController::class, 'destroy'])->name('category.destroy');
        });
        Route::group(['prefix'=>'/users'],function(){
            Route::get('/{user}/profile', [UserController::class, 'show'])->name('user.profile.show');
            Route::put('/{user}/update',[UserController::class, 'update'])->name('user.profile.update');
            Route::delete('/{user}/delete',[UserController::class,'destroy'])->name('user.destroy');
        });
        Route::group(['prefix'=>'/comments'],function(){
            Route::post('/store',[PostCommentsController::class, 'store'])->name('comments.store');
        });
        Route::get('/logout',function(){
            Auth::logout();
            return redirect()->route('home');
        })->name('logout');
    });

});

Route::middleware('role:admin')->group(function(){

    Route::group(['prefix'=>'/admin'],function(){
        Route::group(['prefix'=>'/users'],function(){
            Route::get('/',[UserController::class, 'index'])->name('users.index');
            Route::put('/{user}/addRole',[UserController::class, 'addRole'])->name('user.addRole');
            Route::delete('/{user}/removeRole',[UserController::class, 'removeRole'])->name('user.removeRole');
        });
        Route::group(['prefix'=>'/roles'],function(){
            Route::get('/',[RoleController::class, 'index'])->name('roles.index');
            Route::post('/store',[RoleController::class,'store'])->name('roles.store');
            Route::get('/{role}/edit',[RoleController::class, 'edit'])->name('roles.edit');
            Route::put('/{role}/update',[RoleController::class, 'update'])->name('roles.update');
            Route::delete('/{role}/delete',[RoleController::class, 'destroy'])->name('roles.destroy');

            Route::put('/{role}/addPermission',[RoleController::class, 'addPermission'])->name('role.addPermission');
            Route::delete('/{role}/removePermission',[RoleController::class, 'removePermission'])->name('role.removePermission');
        });
        Route::group(['prefix'=>'/permissions'],function(){
            Route::get('/',[PermissionController::class, 'index'])->name('permissions.index');
            Route::post('/store',[PermissionController::class,'store'])->name('permissions.store');
            Route::get('/{permission}/edit',[PermissionController::class, 'edit'])->name('permission.edit');
            Route::put('/{permission}/update',[PermissionController::class, 'update'])->name('permission.update');
            Route::delete('/{permission}/delete',[PermissionController::class, 'destroy'])->name('permission.destroy');
        });

        Route::group(['prefix'=>'/comments'],function(){
            Route::get('/',[ PostCommentsController::class, 'index'])->name('comments.index');
            Route::get('/{post}/filter',[ PostCommentsController::class, 'filterPostComments'])->name('comments.filter');
            Route::put('/{comment}/update',[PostCommentsController::class, 'update'])->name('comments.update');
            Route::delete('/{comment}/destroy',[PostCommentsController::class, 'destroy'])->name('comments.destroy');
        });

        Route::group(['prefix'=>'/socials'],function(){
            Route::get('/',[SocialsController::class, 'index'])->name('socials.index');
            Route::post('/store',[SocialsController::class, 'store'])->name('socials.store');
            Route::get('/{social}/edit',[SocialsController::class, 'edit'])->name('social.edit');
            Route::put('/{social}/update',[SocialsController::class, 'update'])->name('social.update');
            Route::delete('/{social}/destroy',[SocialsController::class, 'destroy'])->name('social.destroy');
        });
    });

});