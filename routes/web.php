<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ChildCategorieController;
use App\Http\Controllers\ParentCategorieController;
use App\Http\Controllers\SubCategorieController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
});



Route::group(['middleware' => 'prevent-back-history'],function (){
    Auth::routes();
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});
   





//=================== all admin routes here==============//
Route::group(['prefix'=>'admin','middleware'=>'isAdmin','auth','prevent-back-history'],function (){
    Route::get('/dashboard',[AdminController::class,'index'])->name('admin.dashboard');
    Route::get('/profile',[AdminController::class,'profile'])->name('admin.profile');
    Route::get('/setting',[AdminController::class,'setting'])->name('admin.setting');


    //================= all parent categories routes here=============//
    Route::get('/parent-categories',[ParentCategorieController::class,'index'])->name('parent-categories');
    Route::post('/parent-categorie-store',[ParentCategorieController::class,'store'])->name('parent_categorie_store');
    Route::get('/parent_categorie_delete/{id}',[ParentCategorieController::class,'delete'])->name('parent_categorie_delete');
    Route::get('/parent-categorie-edit/{id}',[ParentCategorieController::class,'edit'])->name('parent_categorie_edit');
    Route::post('/parent-categorie-update/{id}',[ParentCategorieController::class,'update'])->name('parent_categorie_update');


    //============= all sub categories routes here ================//
    Route::get('/sub-categories',[SubCategorieController::class,'index'])->name('sub_categories');
    Route::post('/sub-categorie-store',[SubCategorieController::class,'store'])->name('sub_categorie_store');
    Route::get('/sub-categorie-delete/{id}',[SubCategorieController::class,'delete'])->name('sub_categorie_delete');
    Route::get('/sub-categorie-edit/{id}',[SubCategorieController::class,'edit'])->name('sub_categorie_edit');
    Route::post('/sub-categorie-update/{id}',[SubCategorieController::class,'update'])->name('sub_categorie_update');


    //================ all child categories routes here==============//
    Route::get('/child-categories',[ChildCategorieController::class,'index'])->name('child_categories');
    Route::post('/child-categorie-store',[ChildCategorieController::class,'store'])->name('child_categorie_store');
    Route::get('/get-subcategorie/{parent_categorie_id}',[ChildCategorieController::class,'getSubCategorie']);
    Route::get('/child-categorie-delete/{id}',[ChildCategorieController::class,'delete'])->name('child_categorie_delete');
    Route::get('/child-categorie-edit/{id}',[ChildCategorieController::class,'edit'])->name('child_categorie_edit');
    Route::get('/get-subs',[ChildCategorieController::class,'getSubCategoriesForEdit'])->name('get_sub_categories_including_parent_categorie');
    Route::post('/child-categorie-update/{id}',[ChildCategorieController::class,'update'])->name('child_categorie_update');
});


//================ all user routes here=================//
Route::group(['prefix'=>'user','middleware'=>'isUser','auth','prevent-back-history'],function (){
    Route::get('/dashboard',[UserController::class,'index'])->name('user.dashboard');
    Route::get('/profile',[UserController::class,'profile'])->name('user.profile');
    Route::get('/setting',[UserController::class,'setting'])->name('user.setting');
});

//============== all public routes will be here=========//