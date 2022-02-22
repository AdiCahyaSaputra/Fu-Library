<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Category;
use App\Models\Order;

class MainController extends Controller
{

  public function checkout(Book $book) {
    return view('auth.checkout', [
      "tittle" => "Checkout",
      "book" => $book
    ]);
  }

  public function addBookmark($bookId) {
    // write order info in json files
    $path = base_path("public/order/bookmarkInfo.json");
    $content = json_decode(file_get_contents($path), true);

    $book = Book::find($bookId);

    $content[] = [
      "book_id" => $book->id,
      "tittle" => $book->tittle,
      "image" => $book->image,
      "slug" => $book->slug,
      "author" => $book->author,
      "desc" => $book->desc,
      "year" => $book->year,
      "pages" => $book->pages,
      "price" => $book->price
    ];

    $newContent = json_encode($content, JSON_PRETTY_PRINT);
    file_put_contents($path, stripcslashes($newContent));

    return redirect()->back();
  }

  public function cancelBookmark($bookId) {
    // write order info in json files
    $path = base_path("public/order/bookmarkInfo.json");
    $content = json_decode(file_get_contents($path), true);

    foreach ($content as $index => $value) {
      // [0] => {}
      if ($value["book_id"] == $bookId) {
        // jika true hapus array nya
        unset($content[$index]);
        break;
      }
    }

    $newContent = json_encode($content, JSON_PRETTY_PRINT);
    file_put_contents($path, stripcslashes($newContent));

    return redirect()->back();
  }

  // rent a book
  public function bookmark(Request $request) {

    if ($request["add"]) {
      return $this->addBookmark($request["book_id"]);
    }
    if ($request["cancel"]) {
      return $this->cancelBookmark($request["book_id"]);
    }

  }

  public function home(Request $request) {

    // ambil data buku terbaru
    $book = Book::latest()->limit(10)->get();

    // jika ada request di url (get) yg isi nya search
    if ($request["search"]) {
      // ambil data buku (urut dari yang terbaru) + query berdasarkan search (ada di scopeSearch() Models Book)
      $book = Book::latest()->search()->get();
    }

    // View nya
    return view('main.home', [
      "tittle" => "Home",
      "newBooks" => Book::latest()->limit(3)->get(),
      "categories" => Category::all(),
      "books" => $book
    ]);
  }

  public function category(Category $category) {

    $categories = Category::with("book")->get();

    return view("main.home", [
      "tittle" => "Home",
      "newBooks" => Book::latest()->limit(3)->get(),
      "categories" => $categories,
      "books" => $category->book
    ]);
  }

  public function singleBook(Book $book) {
    // default nya si bookmarkStatus = false
    $bookmarkStatus = false;
    // write order info in json files
    $path = base_path("public/order/bookmarkInfo.json");
    $content = json_decode(file_get_contents($path), true);
    foreach ($content as $c) {
      // cek di tiap² content di file json
      if ($book->id == $c["book_id"]) {
        $bookmarkStatus = true;
      }
    }
    // set token Csrf
    return view('main.book', [
      "tittle" => "Book",
      "book" => $book,
      "status" => $bookmarkStatus
    ]);
  }

  public function orderHistory($m) {
    $m = ucfirst($m);
    $order = Order::with(["book", "user"])->get();
    $or = [];
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
      
    if ($m != "All") {
      foreach ($month as $mon) {
        foreach ($order as $o) {
          if ($m == $mon && $mon == date("M", strtotime($o->orderDate))) {
            $or = Order::where("orderDate", $o->orderDate)->get();
          } 
        }
      }
    } 
    
    if($m == "All") {
      $or = $order;
    }

    return view('main.orders', [
      "tittle" => "Order History",
      "month" => $month,
      "orders" => $or
    ]);
  }
}