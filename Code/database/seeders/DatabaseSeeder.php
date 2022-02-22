<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Jurusan;
use App\Models\Book;
use App\Models\User;
use App\Models\Category;
use App\Models\Order;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
      // Jurusan
      Jurusan::create([
        "name" => "RPL-SMK",
        "slug" => "rpl-smk"
      ]);
      Jurusan::create([
        "name" => "AKL-SMK",
        "slug" => "akl-smk"
      ]);
      Jurusan::create([
        "name" => "IPA-SMA",
        "slug" => "ipa-sma"
      ]);
      Jurusan::create([
        "name" => "IPS-SMA",
        "slug" => "ips-sma"
      ]);
      
      // category 
      Category::create([
        "name" => "Programming",
        "slug" => "programming"
      ]);
      Category::create([
        "name" => "Design",
        "slug" => "design"
      ]);
      Category::create([
        "name" => "Novel",
        "slug" => "novel"
      ]);
      Category::create([
        "name" => "Science",
        "slug" => "science"
      ]);
      Category::create([
        "name" => "History",
        "slug" => "history"
      ]);
      Category::create([
        "name" => "Biography",
        "slug" => "biography"
      ]);
      
      // Book
      Book::create([
        "category_id" => 1,
        "image" => "images/things-fall-apart.jpg",
        "tittle" => "Things Fall Apart",
        "desc" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras congue hendrerit maximus. Fusce massa velit, mollis et pharetra id, finibus et ante. Proin neque ex, fringilla ut ligula vitae, euismod venenatis ligula. Etiam sodales urna eu urna ultrices auctor. Sed sed condimentum mauris, quis feugiat odio. Phasellus risus dolor, tempus eget libero ac, faucibus pretium est. Curabitur tincidunt leo vitae mattis porttitor. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Ut tincidunt non orci et dictum. Praesent et vulputate diam. Proin erat mi, euismod nec viverra vel, interdum a felis. Nullam vel dapibus nisl.",
        "slug" => "things-fall-apart",
        "author" => "Chinua Achebe",
        "year" => 1958,
        "pages" => 209,
        "price" => 499
      ]);
      Book::create([
        "category_id" => 1,
        "image" => "images/fairy-tales.jpg",
        "tittle" => "Fairy Tales",
        "desc" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras congue hendrerit maximus. Fusce massa velit, mollis et pharetra id, finibus et ante. Proin neque ex, fringilla ut ligula vitae, euismod venenatis ligula. Etiam sodales urna eu urna ultrices auctor. Sed sed condimentum mauris, quis feugiat odio. Phasellus risus dolor, tempus eget libero ac, faucibus pretium est. Curabitur tincidunt leo vitae mattis porttitor. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Ut tincidunt non orci et dictum. Praesent et vulputate diam. Proin erat mi, euismod nec viverra vel, interdum a felis. Nullam vel dapibus nisl.",
        "slug" => "fairy-tales",
        "author" => "Hans Christian Andersen",
        "year" => 1836,
        "pages" => 784,
        "price" => 479
      ]);
      Book::create([
        "category_id" => 3,
        "image" => "images/the-divine-comedy.jpg",
        "tittle" => "The Divine Comedy",
        "slug" => "the-divine-comedy",
        "desc" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras congue hendrerit maximus. Fusce massa velit, mollis et pharetra id, finibus et ante. Proin neque ex, fringilla ut ligula vitae, euismod venenatis ligula. Etiam sodales urna eu urna ultrices auctor. Sed sed condimentum mauris, quis feugiat odio. Phasellus risus dolor, tempus eget libero ac, faucibus pretium est. Curabitur tincidunt leo vitae mattis porttitor. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Ut tincidunt non orci et dictum. Praesent et vulputate diam. Proin erat mi, euismod nec viverra vel, interdum a felis. Nullam vel dapibus nisl.",
        "author" => "Dante Alighieri",
        "year" => 1315,
        "pages" => 928,
        "price" => 322
      ]);
      Book::create([
        "category_id" => 4,
        "image" => "images/pride-and-prejudice.jpg",
        "tittle" => "Pride And Prejudice",
        "slug" => "pride-and-prejudice",
        "desc" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras congue hendrerit maximus. Fusce massa velit, mollis et pharetra id, finibus et ante. Proin neque ex, fringilla ut ligula vitae, euismod venenatis ligula. Etiam sodales urna eu urna ultrices auctor. Sed sed condimentum mauris, quis feugiat odio. Phasellus risus dolor, tempus eget libero ac, faucibus pretium est. Curabitur tincidunt leo vitae mattis porttitor. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Ut tincidunt non orci et dictum. Praesent et vulputate diam. Proin erat mi, euismod nec viverra vel, interdum a felis. Nullam vel dapibus nisl.",
        "author" => "Jane Auston",
        "year" => 1813,
        "pages" => 226,
        "price" => 576
      ]);
      Book::create([
        "category_id" => 4,
        "image" => "images/ficciones.jpg",
        "tittle" => "Ficciones",
        "slug" => "ficciones",
        "desc" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras congue hendrerit maximus. Fusce massa velit, mollis et pharetra id, finibus et ante. Proin neque ex, fringilla ut ligula vitae, euismod venenatis ligula. Etiam sodales urna eu urna ultrices auctor. Sed sed condimentum mauris, quis feugiat odio. Phasellus risus dolor, tempus eget libero ac, faucibus pretium est. Curabitur tincidunt leo vitae mattis porttitor. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Ut tincidunt non orci et dictum. Praesent et vulputate diam. Proin erat mi, euismod nec viverra vel, interdum a felis. Nullam vel dapibus nisl.",
        "author" => "Jorge Luis Borges",
        "year" => 1965,
        "pages" => 224,
        "price" => 335
      ]);
      Book::create([
        "category_id" => 5,
        "image" => "images/the-decameron.jpg",
        "tittle" => "The Decameron",
        "slug" => "the-decameron",
        "desc" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras congue hendrerit maximus. Fusce massa velit, mollis et pharetra id, finibus et ante. Proin neque ex, fringilla ut ligula vitae, euismod venenatis ligula. Etiam sodales urna eu urna ultrices auctor. Sed sed condimentum mauris, quis feugiat odio. Phasellus risus dolor, tempus eget libero ac, faucibus pretium est. Curabitur tincidunt leo vitae mattis porttitor. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Ut tincidunt non orci et dictum. Praesent et vulputate diam. Proin erat mi, euismod nec viverra vel, interdum a felis. Nullam vel dapibus nisl.",
        "author" => "Giovanni Boccaccio",
        "year" => 1351,
        "pages" => 1024,
        "price" => 298
      ]);
      
      // User
      User::create([
        "jurusan_id" => 1,
        "username" => "adics",
        "name" => "Adi Cahya Saputra",
        "class" => "XI",
        "password" => bcrypt("password")
      ]);
      User::create([
        "jurusan_id" => 3,
        "username" => "adijs",
        "name" => "Adi Cahyadi",
        "class" => "X",
        "password" => bcrypt("password")
      ]);
      
      // Rent
      Order::create([
        "user_id" => 1,
        "book_id" => 4,
        "orderDate" => date('Y-m-d'),
        "paymentMethod" => "Dana",
        "totalItems" => 1,
        "totalPrice" => 0
      ]);
      Order::create([
        "user_id" => 1,
        "book_id" => 2,
        "orderDate" => date('Y-m-d'),
        "paymentMethod" => "Shopee Pay",
        "totalItems" => 1,
        "totalPrice" => 0
      ]);
      Order::create([
        "user_id" => 2,
        "book_id" => 6,
        "orderDate" => date('Y-m-d'),
        "paymentMethod" => "Go Pay",
        "totalItems" => 0,
        "totalPrice" => 0
      ]);
        // \App\Models\User::factory(10)->create();
    }
}
