<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
  /**
  * Run the migrations.
  *
  * @return void
  */
  public function up() {
    Schema::create('orders', function (Blueprint $table) {
      $table->id();
      $table->foreignId("user_id");
      $table->foreignId("book_id");
      $table->date("orderDate");
      $table->string("paymentMethod");
      $table->integer("totalItems");
      $table->integer("totalPrice");
      $table->timestamps();
    });
  }

  /**
  * Reverse the migrations.
  *
  * @return void
  */
  public function down() {
    Schema::dropIfExists('orders');
  }
}