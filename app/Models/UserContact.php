<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserContact extends Model
{
    use HasFactory;

    protected $fillable = [
        'number',
        'user_id'
    ];

    public function __construct(){
        parent::__construct();
        $this->belongsTo(User::class);
    }

    public function getNumberAttribute($value){
        return ucfirst($value);
    }

    public function setNumberAttribute($value){
        if ($value >= 0){
            $this->attributes['number'] = $value;
        }
    }
}
