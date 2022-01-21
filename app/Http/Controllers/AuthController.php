<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jurusan;
use App\Models\User;
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
    
    return redirect('/login')->with('status', 'Registration Complete! You can Login now');
  }

  // logic login terkutuk
  public function authLogin(Request $request) {
    $credentials = $request->validate([
      "username" => ["required"],
      "password" => ["required"]
    ]);

    if (Auth::attempt($credentials)) {
      $request->session()->regenerate();

      return redirect()->intended('/home');
    }

    return back()->with("gagal", "Login Failed! Maybe the Username or Password is wrong");
  }

  /**
  // logic login (untuk saat ini masih kebal terhadap kutukan)
  public function authLogin(Request $request)
  {
  // validate
  $cred = $request->validate([
  "username" => ["required"],
  "password" => ["required"]
  ]);

  // get user
  $user = User::where("username", $cred["username"])->get();

  // if user & password correct
  if (Auth::attempt($cred)) {
  $_SESSION["loginCheck"] = $request["token"] == $_SESSION["token"] ? true : false;
  $_SESSION["userID"] = $user[0];

  // ini error gk jelas emang Si Laravel mah
  // return redirect('/home')->with("nama", "Adi");

  return redirect("/home");
  } else {
  $_SESSION["gagal"] = "Maybe Username & Password Is Wrong!";
  return redirect("/login");
  }

  }

  **/

  /**
  // logic logout
  public function logout(Request $request)
  {
  Auth::logout();
  session_destroy();

  return redirect('/login');
  }
  **/

  public function logout(Request $request) {
    Auth::logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();

    return redirect('/login');
  }
}