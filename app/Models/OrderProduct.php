<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'order_products';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['quantity', 'price'];




//    public function vendor()
//    {
//        return $this->belongsTo(Vendor::class);
//    }

    public function prod()
    {
        return $this->belongsTo(Product::class);
    }
}
