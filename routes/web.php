<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\Category;
use App\Models\Pinjam;
use App\Models\Book;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\AdminController;
use Illuminate\Http\Request;


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

// Jangan sentuh sentuh script ini. Kalo mau debug ke Test Area aja
Route::get('/', [MainController::class, 'home'])->middleware('auth');

Route::get('/login', [AuthController::class, 'login'])->name('login')->middleware('guest');
Route::get('/register', [AuthController::class, 'register'])->middleware('guest');

Route::get('/dashboard', [MainController::class, 'dashboard'])->middleware('auth');
Route::get('/home', [MainController::class, 'home'])->middleware('auth');
Route::get('/home/{book:slug}', [MainController::class, 'singleBook'])->middleware('auth');
Route::get('/home/c/{category:slug}', [MainController::class, 'category'])->middleware('auth');

Route::post('/login', [AuthController::class, 'authLogin']);
Route::post('/register', [AuthController::class, 'registering']);
Route::post('/logout', [AuthController::class, 'logout']);

Route::post('/rent', [MainController::class, "rent"]);
Route::post('/cancel', [MainController::class, "cancel"]);

Route::get('/admin', [AdminController::class, "index"]);

// Test Area
Route::get("/test-book", function() {
  
});

Route::get('/test-date', function() {
  $date1 = (int) implode("", explode("-", "2022-01-25"));
  $date2 = (int) implode("", explode("-", "2022-01-30"));
  return $date2 - $date1;
  // return view("testDate");
});

Route::get('/test-rent', function() {
  $rent = Book::find(6)->pinjam[0]->returnDate;
  return $rent;
});

Route::post('/date', function(Request $request) {
  // dd-mm-yy
  return array_reverse(explode("-", $request["rentDate"]));
});

Route::get('/test-user', function() {
  return view('user', [
    "users" => User::all()
  ]);
});

Route::get("/test-session", function() {
  session_start();
  return $_SESSION;
});

Route::get('/datetest', function() {
  /**
  $now = date('Y-m-d');
  echo $now;
  echo '<br>';
  $now = explode("-", $now);
  $now[count($now) -1] += 1;
  var_dump(implode("-", $now));
  **/
  $now = new DateTime();
  $week = $now->format("Y-m-d");
  echo $week;
  // dd((int) $now[2]);
  
});

Route::get('/test-csrf', [TestController::class, "test"]);
Route::post('/test-csrf', [TestController::class, "test"]);