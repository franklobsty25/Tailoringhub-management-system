<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suit extends Model
{
    use HasFactory;

    protected $fillable = [
        'half_back',
        'shoulder',
        'elbow',
        'sleeve',
        'chest',
        'suit_length',
    ];

    public function customer() {
        return $this->belongsTo(Customer::class);
    }
}
