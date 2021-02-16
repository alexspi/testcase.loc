<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Partner extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'partners';

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
    public function order()
    {
        return $this->hasMany(Order::class,'partner_id');
    }
}
