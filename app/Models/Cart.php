<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    public $timestamps = false;

    protected $table = 'cart';
    protected $fillable = ['userid', 'prodid', 'quantity'];
    
}
