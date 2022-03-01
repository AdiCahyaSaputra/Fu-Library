<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jurusan;
use App\Models\User;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{

  // view login
  public function login() {
    return view('auth.login', [
      "tittle" => "Login"
    ]);
  }

  // view register
  public function register() {
    return view('auth.register', [
      "tittle" => "Register"
    ]);
  }

  // logic register
  public function registering(Request $request) {
    // jangan di apa apain lagi, yg ini udh terkutuk juga
    $allData = $request->validate([
      "username" => ['required', 'min:5', 'max:14', 'unique:users', 'alpha_dash', 'regex:/^\S*$/u'],
      "password" => ['required', 'min:5', 'max:14'],
      "name" => ['required', 'min:5', 'max:255']
    ]);

    $allData["password"] = bcrypt($allData["password"]);
    $allData["jurusan"] = $request->jurusan;
    $allData["jurusan"] = Jurusan::where("name", $allData["jurusan"])->get('id');
    $allData["jurusan"] = $allData["jurusan"][0]->id;
    $allData["classNum"] = $request->classNum;

    User::create([
      "jurusan_id" => $allData["jurusan"],
      "username" => $allData["username"],
      "name" => $allData["name"],
      "class" => $allData["classNum"],
      "password" => $allData["password"]
    ]);
    
    return redirect('/login')->with('statusRegistration', 'Registration Complete!');
  }

  // logic login terkutuk
  public function authLogin(Request $request) {
    $remember = $request["remember-me"] == null ? false : true;
    // dd($remember);
    $credentials = $request->validate([
      "username" => ["required"],
      "password" => ["required"]
    ]);

    if (Auth::attempt($credentials, $remember)) {
      $request->session()->regenerate();

      return redirect()->intended('/home');
    }

    return back()->with("loginFailed", "Username or Password is wrong!");
  }

  public function logout(Request $request) {
    Auth::logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();

    return redirect('/login');
  }
  
  public function checkout(Request $request)
  {
    // dd($request->all());
    $request = $request->validate([
      "user" => ["required"],
      "book" => ["required"],
      "items" => ["required"],
      "wallet" => ["required"],
      "total" => ["required"]
    ]);
    
    Order::create([
      "user_id" => $request["user"],
      "book_id" => $request["book"],
      "orderDate" => date('Y-m-d'),
      "paymentMethod" => $request["wallet"],
      "totalItems" => $request["items"],
      "totalPrice" => $request["total"]
    ]);
    
    return back()->with('checkout', "Checkout succed!");
  }
  
}