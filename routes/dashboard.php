<?php
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\ProductController;
use App\Http\Controllers\Dashboard\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\OrderController;

Route::get('/dashboard', [DashboardController::class , 'create']
)->middleware(['auth' , 'check.type'])->name('dashboard');

Route::get('/profileEdit' , [ProfileController::class , 'edit'])
->middleware(['auth'])->name('profileEdit');

Route::put('/profileUpdate' , [ProfileController::class , 'update'])
->middleware(['auth'])->name('profileUpdate');



// Route::resource('dashboard/categories', CategoryController::class);

Route::get('/index', [CategoryController::class , 'index']
)->middleware(['auth'])->name('index');

Route::get('/createCategory', [CategoryController::class , 'create']
)->middleware(['auth'])->name('createCategory');

Route::post('/storeCategory', [CategoryController::class , 'store']
)->middleware(['auth'])->name('storeCategory');

Route::get('/showCategory/{id}' , [CategoryController::class , 'show']
)->middleware(['auth'])->name('showCategory');

Route::get('/editCategory/{id}', [CategoryController::class , 'edit']
)->middleware(['auth'])->name('edite');

Route::post('/updateCategory/{id}', [CategoryController::class , 'update']
)->middleware(['auth'])->name('updateCategory');

Route::get('/delete/{id}', [CategoryController::class , 'destroy']
)->middleware(['auth'])->name('delete');

Route::get('/trachCategories' , [CategoryController::class , 'getTrach']
)->middleware(['auth'])->name('trachCategories');

Route::get('/restoreCategory/{id}' , [CategoryController::class , 'restoreCategory']
)->middleware(['auth'])->name('restoreCategory');

Route::get('/deleteTrachCategory/{id}' , [CategoryController::class , 'forceDelete']
)->middleware(['auth'])->name('deleteTrachCategory');

//             ---------------- Product ---------------

Route::get('/indexProduct' , [ProductController::class , 'index']
)->middleware(['auth'])->name('indexProduct');

Route::get('/createProduct' , [ProductController::class , 'create']
)->middleware(['auth'])->name('createProduct');

Route::get('/editProduct' , [ProductController::class , 'edit']
)->middleware(['auth'])->name('editProduct');

Route::get('/deleteProduct' , [ProductController::class , 'delete']
)->middleware(['auth'])->name('deleteProduct');

//             ---------------- Order ---------------

Route::get('/indexOrder' , [OrderController::class , 'index']
)->middleware(['auth'])->name('indexOrder');
?>
