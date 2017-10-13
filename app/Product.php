<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    protected $fillable = [
        'product_title', 'product_description', 'product_price', 'product_category', 'user_id',
    ];
}
