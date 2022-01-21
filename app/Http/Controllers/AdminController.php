<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\User;
use App\Models\Category;
use App\Models\Pinjam;

class AdminController extends Controller
{
  
  public function __construct()
  {
    session_start();
  }
  
  public function index()
  {
    $book = Book::with('category')->latest()->get();
    $pinjam = Pinjam::with(['book', 'user'])->get();
    return view("admin.main", [
      "tittle" => "Admin",
      "books" => $book,
      "pinjams" => $pinjam
    ]);
  }
}
