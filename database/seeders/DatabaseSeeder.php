<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Jurusan;
use App\Models\Book;
use App\Models\User;
use App\Models\Category;
use App\Models\Pinjam;

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
        "slug" => "things-fall-apart",
        "author" => "Chinua Achebe",
        "year" => 1958,
        "pages" => 209
      ]);
      Book::create([
        "category_id" => 1,
        "image" => "images/fairy-tales.jpg",
        "tittle" => "Fairy Tales",
        "slug" => "fairy-tales",
        "author" => "Hans Christian Andersen",
        "year" => 1836,
        "pages" => 784
      ]);
      Book::create([
        "category_id" => 3,
        "image" => "images/the-divine-comedy.jpg",
        "tittle" => "The Divine Comedy",
        "slug" => "the-divine-comedy",
        "author" => "Dante Alighieri",
        "year" => 1315,
        "pages" => 928
      ]);
      Book::create([
        "category_id" => 4,
        "image" => "images/pride-and-prejudice.jpg",
        "tittle" => "Pride And Prejudice",
        "slug" => "pride-and-prejudice",
        "author" => "Jane Auston",
        "year" => 1813,
        "pages" => 226
      ]);
      Book::create([
        "category_id" => 4,
        "image" => "images/ficciones.jpg",
        "tittle" => "Ficciones",
        "slug" => "ficciones",
        "author" => "Jorge Luis Borges",
        "year" => 1965,
        "pages" => 224
      ]);
      Book::create([
        "category_id" => 5,
        "image" => "images/the-decameron.jpg",
        "tittle" => "The Decameron",
        "slug" => "the-decameron",
        "author" => "Giovanni Boccaccio",
        "year" => 1351,
        "pages" => 1024
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
      Pinjam::create([
        "user_id" => 1,
        "book_id" => 4,
        "rentDate" => date('Y-m-d'),
        "returnDate" => "2022-01-21"
      ]);
      Pinjam::create([
        "user_id" => 1,
        "book_id" => 2,
        "rentDate" => date('Y-m-d'),
        "returnDate" => "2022-01-18"
      ]);
      Pinjam::create([
        "user_id" => 2,
        "book_id" => 6,
        "rentDate" => date('Y-m-d'),
        "returnDate" => "2022-01-11"
      ]);
        // \App\Models\User::factory(10)->create();
    }
}
