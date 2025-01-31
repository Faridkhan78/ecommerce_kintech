<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['userid','prodid','quantity','address2','status','payment_method','payment_status','firstname','lastname','mobile'];

    // protected $fillable = [
    //     'userid',
    //     'total',
    //     'status'
    // ];
}
