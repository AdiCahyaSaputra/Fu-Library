<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Order;
use App\Models\Bookmark;

class Book extends Model
{
  use HasFactory;
  protected $guarded = ["id"];
  
  public function bookmark()
  {
    return $this->hasMany(Bookmark::class);
  }

  public function scopeSearch($query) {
    return $query->where('tittle',
      'like',
      '%' . request("search") . '%');
  }

  public function category() {
    return $this->belongsTo(Category::class);
  }

  public function order() {
    return $this->hasMany(Order::class);
  }
}