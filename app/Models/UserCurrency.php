<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class UserCurrency extends Model
{
    use HasFactory;

    protected $fillable = [
        'currency',
        'user_id'
    ];

    public function __construct(){
        parent::__construct();
        $this->belongsTo(User::class);
    }

    public function getCurrencyAttribute($value){
        return ucfirst($value);
    }

    public function setCurrencyAttribute($value){
        if ($value >= 0){
            //$this->update([ 'currency' => $value ]);
            $this->attributes['currency'] = $value;
        }
    }
}
