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

    public static function init($user_id, $currency){
        $user_currency = new self;
        $user_currency->user_id = $user_id;
        $user_currency->currency = $currency;
        $user_currency->save();
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
