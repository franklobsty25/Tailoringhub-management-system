<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShortTrouser extends Model
{
    use HasFactory;

    protected $fillable = [
        'waist',
        'length',
        'thighs',
        'bass_bottom',
        'seat',
        'knee',
        'flap_fly',
        'hip',
        'waist_knee',
    ];

    public function customer() {
        return $this->belongsTo(Customer::class);
    }
}
