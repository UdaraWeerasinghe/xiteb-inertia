<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quetation extends Model
{
    use HasFactory;

    protected $fillable = [
        'prescription_id',
        'product_id',
        'qty',
        'amount'
    ];

    public function product()
    {
        return $this->hasOne(Product::class, 'id', 'product_id' );
    }

}
