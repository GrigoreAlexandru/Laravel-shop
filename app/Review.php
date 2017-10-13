<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    public $primarykey = 'product_id';

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    protected $fillable = [
        'review', 'user_id', 'product_id',
    ];
}
