<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    protected $myFKNGToken;
   
    public function __construct() {
      $this->myFKNGToken = base64_encode(openssl_random_pseudo_bytes(32));
    }
    
    public function test(Request $request) {
      session_start();
      if($request->isMethod("post") && !empty($request["token"])) {
        if($request["token"] == $_SESSION["token"]) {
          return "bbener";
        }
      }
      $token = $this->myFKNGToken;
      $_SESSION["token"] = $token;
      return view("test", ["token" => $token]);
    }
}
