<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

class Book extends Model
{
    use HasFactory;
    protected $guarded = ["id"];
    
    public function scopeSearch($query)
    {
        return $query->where('tittle',
        'like', 
        '%' . request('search') . '%');
    }
    
    public function category()
    {
      return $this->belongsTo(Category::class);
    }
    
    public function pinjam()
    {
      return $this->hasMany(Pinjam::class);
    }
}
