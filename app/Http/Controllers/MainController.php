<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Category;
use App\Models\Pinjam;

class MainController extends Controller
{
  public function calcDateRent($returnDate) {
    $today = (int) implode("", explode("-", date('Y-m-d')));
    $returnDate = (int) implode("", explode("-", $returnDate));

    return $returnDate - $today;
  }

  // rent a book
  public function rent(Request $request) {
    
    if(isset($request["order"])) {
      return redirect()->back()->with;
    }
    
    $pinjam = Pinjam::where("book_id", $request["book_id"])->get();
    if (isset($pinjamID)) {
      return redirect()->back();
    }

    Pinjam::create([
      "user_id" => $request["user_id"],
      "book_id" => $request["book_id"],
      "rentDate" => $request["rentDate"],
      "returnDate" => $request["returnDate"]
    ]);

    return redirect()->back();
  }

  // cancel rent
  public function cancel(Request $request) {
    Pinjam::find($request["pinjamID"])->delete();
    return redirect()->back();
  }

  public function home(Request $request) {

    // ambil data buku terbaru
    $book = Book::latest();

    // jika ada request di url (get) yg isi nya search
    if ($request["search"]) {
      // ambil data buku (urut dari yang terbaru) + query berdasarkan search (ada di scopeSearch() Models Book)
      $book = Book::latest()->search();
    }

    // View nya
    return view('main.home', [
      "tittle" => "Home",
      "newBooks" => $book->get(),
      "categories" => Category::all(),
      "books" => $book->get()
    ]);
  }

  public function category(Category $category) {

    $categories = Category::all();

    return view("main.home", [
      "tittle" => "Home",
      "newBooks" => Book::latest()->get(),
      "categories" => $categories,
      "books" => $category->book
    ]);
  }

  public function singleBook(Book $book) {
    
    $status = "Available";
    if (isset($book->pinjam[0]->returnDate)) {
      if ($this->calcDateRent($book->pinjam[0]->returnDate) > 0) {
        $status = "Is Order";
      }
    }

    // set token Csrf
    return view('main.book', [
      "tittle" => "Book",
      "book" => $book,
      "status" => $status
    ]);
  }

  public function dashboard() {

    return view('main.dashboard', [
      "tittle" => "dashboard"
    ]);
  }
}