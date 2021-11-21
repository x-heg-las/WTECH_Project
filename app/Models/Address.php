<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = ['customer_id', 'street_and_number', 'city', 'zip_code', 'country', 'optional_address'];

    use HasFactory;
}
