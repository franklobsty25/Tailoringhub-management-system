<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KabaSlit extends Model
{
    use HasFactory;

    protected $fillable = [
        'bust',
        'waist',
        'hip',
        'shoulder',
        'shoulder_nipple',
        'nipple_nipple',
        'nape_waist',
        'shoulder_waist',
        'shoulder_hip',
        'across_chest',
        'kaba_length',
        'sleeve_length',
        'around_arm',
        'across_back',
        'slit_length',
      ];

      public function customer() {
          return $this->belongsTo(Customer::class);
      }
}
