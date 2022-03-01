<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Category;
use App\Models\Order;
use App\Models\Bookmark;

class MainController extends Controller
{

  public function checkout(Book $book) {
    return view('auth.checkout', [
      "tittle" => "Checkout",
      "book" => $book
    ]);
  }
  
  public function bookmark()
  {
    $bookmark = Bookmark::with(["user", "book"])->where("user_id", auth()->user()->id)->get();
    return view('main.bookmark', [
      "tittle" => "Bookmark",
      "bookmarks" => $bookmark
    ]);
  }
  
  public function credits()
  {
    return view('main.credits', [
      "tittle" => "Credits"
    ]);
  }

  public function addBookmark(Book $book) {
    Bookmark::create([
      "user_id" => auth()->user()->id,
      "book_id" => $book->id
    ]);
    return back()->with("add", "This book has been Bookmarked");
  }

  public function cancelBookmark(Book $book) {
    Bookmark::where([
      ["book_id", $book->id],
      ["user_id", auth()->user()->id]
    ])->delete();
    return back()->with("cancel", "Bookmark for this book has been deleted!");
  }

  public function home(Request $request) {
    $book;
    $newBook = 0;
    $category = 0;
    // jika ada request di url (get) yg isi nya search
    if ($request["search"]) {
      // ambil data buku (urut dari yang terbaru) + query berdasarkan search (ada di scopeSearch() Models Book)
      $book = Book::latest()->search()->get();
    } else {
      // ambil data buku terbaru
      $book = Book::latest()->limit(10)->get();
      $newBook = Book::latest()->limit(3)->get();
      $category = Category::all();
    }
    
    // View nya
    return view('main.home', [
      "tittle" => "Home",
      "newBooks" => $newBook,
      "categories" => $category,
      "books" => $book
    ]);
  }

  public function category(Category $category) {

    $categories = Category::all();

    return view("main.home", [
      "tittle" => "Home",
      "categories" => $categories,
      "books" => $category->book
    ]);
  }

  public function singleBook(Book $book) {
    // default nya si bookmarkStatus = false
    $bookmarkStatus = false;

    $bm = Bookmark::where([
      ["book_id", $book->id],
      ["user_id", auth()->user()->id]
    ])->get();

    if (count($bm) > 0) {
      $bookmarkStatus = true;
    }

    // set token Csrf
    return view('main.book', [
      "tittle" => "Book",
      "book" => $book,
      "status" => $bookmarkStatus
    ]);
  }

  public function orderHistory($m) {
    $monthURL = ucfirst($m);
    $tmpOrder = Order::with(["book", "user"])->where('user_id', auth()->user()->id)->get();

    $order = [];
    $month = ["Jan",
      "Feb",
      "Mar",
      "Apr",
      "May",
      "Jun",
      "Jul",
      "Aug",
      "Sep",
      "Oct",
      "Nov",
      "Des"];
    
    //dd($order);
    
    if ($monthURL != "All") {
      foreach ($month as $m) {
        foreach ($tmpOrder as $o) {
          if ($monthURL == $m && $m == date("M", strtotime($o->orderDate))) {
            $order[] = $o;
          }
        }
      }
    }

    if ($monthURL == "All") {
      $order = $tmpOrder;
    }
    
    return view('main.orders', [
      "tittle" => "Order History",
      "month" => $month,
      "orders" => $order
    ]);
  }
}