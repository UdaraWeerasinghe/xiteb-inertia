<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    use HasFactory;

    protected $fillable = [
        'added_by',
        'note',
        'delivery_address',
        'delivery_date',
        'delivery_time_slot',
        'issued_by',
        'issued_at',
        'amount'
    ];

    public function images()
    {
        return $this->hasMany(PrescriptionImage::class);
    }

    public function customer()
    {
        return $this->belongsTo(User::class, 'added_by');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'issued_by');
    }
    public function quetation()
    {
        return $this->hasMany(Quetation::class, 'prescription_id','id');
    }
}
