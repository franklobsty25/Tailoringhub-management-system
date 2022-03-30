<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shirt extends Model
{
    use HasFactory;

    protected $fillable = [
        'length',
        'chest',
        'back',
        'sleeve',
        'around_arm',
        'cuff',
        'collar',
        'across_chest',
    ];

    public function customer() {
        return $this->belongsTo(Customer::class);
    }
}
