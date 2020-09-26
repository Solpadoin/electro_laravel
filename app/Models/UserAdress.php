<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAdress extends Model
{
    use HasFactory;

    protected $fillable = [
        'address',
        'city',
        'country'
    ];

    public function __construct(){
        parent::__construct();
        $this->belongsTo(User::class);
    }

    public function getAddressAttribute($value){
        return ucfirst($value);
    }

    public function getCityAttribute($value){
        return ucfirst($value);
    }

    public function getCountryAttribute($value){
        return ucfirst($value);
    }
}
