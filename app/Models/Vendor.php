<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;


class Vendor extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'vendors';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['email','name'];


    /**
     * @var string[]
     */



    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function product()
    {
        return $this->hasMany(Product::class,'product_id');
    }


}
