<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\Category;
use App\Models\Order;
use App\Models\Book;
use App\Models\Bookmark;
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
Route::get('/', function() {
  return redirect('/home');
})->middleware('auth');

Route::get('/login', [AuthController::class, 'login'])->name('login')->middleware('guest');
Route::get('/register', [AuthController::class, 'register'])->middleware('guest');

Route::get('/orders/{month}', [MainController::class, 'orderHistory'])->middleware('auth');
Route::get('/home', [MainController::class, 'home'])->middleware('auth');
Route::get('/home/{book:slug}', [MainController::class, 'singleBook'])->middleware('auth');
Route::get('/home/c/{category:slug}', [MainController::class, 'category'])->middleware('auth');
Route::get('/bookmark', [MainController::class, 'bookmark'])->middleware('auth');
Route::get('/credits', [MainController::class, 'credits'])->middleware('auth');

Route::get('/checkout/{book:slug}', [MainController::class, 'checkout'])->middleware('auth');

Route::post('/login', [AuthController::class, 'authLogin']);
Route::post('/register', [AuthController::class, 'registering']);
Route::post('/logout', [AuthController::class, 'logout']);

Route::post('/bookmark/{book:slug}', [MainController::class, "addBookmark"]);
Route::delete('/bookmark/{book:slug}', [MainController::class, "cancelBookmark"]);
Route::post('/cancel', [MainController::class, "cancel"]);
Route::post('/checkout', [AuthController::class, "checkout"]);

// Test Area

/** Route::get('/test-bm', function() {
  $bm = Bookmark::with(["book", "user"])->get();
  $tmpBM = [];
  foreach ($bm as $b) {
    if ($b->user->id == 1) {
      $tmpBM[] = $b->book;
    }
  }
  
  dd($tmpBM);
  
}); **/

/**
Route::get("/test", function(Request $request) {
return $request->get('search');
});

Route::get("/test-pop", function() {
$book = Book::recomend();
dd($book);
});

Route::get('/test-date', function() {
$date1 = (int) implode("", explode("-", "2022-01-25"));
$date2 = (int) implode("", explode("-", "2022-01-30"));
return $date2 - $date1;
// return view("testDate");
});

Route::get('/test-rent', function() {
$rent = Book::find(6)->Order[0]->returnDate;
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

$now = date('Y-m-d');
echo $now;
echo '<br>';
$now = explode("-", $now);
$now[count($now) -1] += 1;
var_dump(implode("-", $now));

$now = new DateTime();
$week = $now->format("Y-m-d");
echo $week;
// dd((int) $now[2]);

});

Route::get('/test-csrf', [TestController::class, "test"]);
Route::post('/test-csrf', [TestController::class, "test"]);
**/