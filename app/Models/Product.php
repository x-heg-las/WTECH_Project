<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description', 'price', 'stock'];

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function parameters()
    {
        return $this->hasMany(Parameter::class);
    }
}
