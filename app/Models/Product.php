<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Product extends Model
{


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'products';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'price', 'vendor_id'];


    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function order()
    {
        return $this->belongsToMany(Order::class, 'order_products', 'order_id', 'product_id');
    }


    public function scopeOfPrice($query,$id)
    {
//        $pr=$query->whereId($id)->first();
        return $query->whereId($id)->first()->price;

    }
}
