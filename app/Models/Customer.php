<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'firstName',
        'lastName',
        'contact',
        'address',
        'collectionDate',
        'charge',
        'advance',
        'balance',
        'style',
        'materialType',
    ];

    protected $attributes = [
        'advance'=> 0,
        'balance'=> 0,
    ];

    protected static function newFactory()
    {
        return CustomerFactory::new();
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function suit() {
        return $this->hasOne(Suit::class);
    }

    public function shirt() {
        return $this->hasOne(Shirt::class);
    }

    public function shortTrouser() {
        return $this->hasOne(ShortTrouser::class);
    }

    public function kabaSlit() {
        return $this->hasOne(KabaSlit::class);
    }

    public function blouseDressSkirt() {
        return $this->hasOne(BlouseDressSkirt::class);
    }

    public function getFullNameAttribute() {
        return "{$this->firstName} {$this->lastName}";
    }
}
