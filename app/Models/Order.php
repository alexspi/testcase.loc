<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Order extends Model
{


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'orders';


    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['status', 'client_email', 'partner_id','delivery_dt'];
    /**
     * @var mixed
     */

    public function scopeOfStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function partner(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Partner::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function product(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'order_products', 'order_id', 'product_id');
    }
}
