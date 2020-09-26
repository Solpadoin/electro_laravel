<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use LamaLama\Wishlist\HasWishlists;
use LamaLama\Wishlist\Wishlistable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasWishlists; //, Wishlistable;

    /* Role const */
    const ROLE_USER = 'user';
    const ROLE_MANAGER = 'manager';
    const ROLE_ADMIN = 'admin';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'is_admin', 'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function currency(){
        return $this->hasOne(UserCurrency::class);
    }

    public function address(){
        return $this->hasOne(UserAdress::class);
    }

    public function contacts(){
        return $this->hasOne(UserContact::class);
    }

    public function isAdmin(){
       return $this->is_admin;
    }

    public function hasAdminPanelAccess(){
        if ($this->is_admin || $this->hasRole(self::ROLE_MANAGER)){
            return true;
        }

        return false;
    }

    /* get user roles as array */
    public function getUserRoles(){
        return explode(" ", $this->role);
    }

    /* get raw user roles */
    public function getUserRolesRaw(){
        return $this->role;
    }

    /* check if user has selected role */
    public function hasRole(string $role){
        return str_contains($this->role, $role);
    }

    public function giveRole(string $role){
        if (! $this->hasRole($role)) {
            $this->role .= " ".$role;
            $this->save();
        }
    }

    public function takeRole(string $role){
        if ($this->hasRole($role)){
            $this->role = str_replace(" ".$role, "", $this->role);
            $this->save();
        }
    }

    /* Give Admin rights */
    public function giveAdmin(){
        if (! $this->is_admin){
            $this->is_admin = !$this->is_admin;
            $this->giveRole(self::ROLE_ADMIN);
        }
    }

    /* Take Admin rights */
    public function takeAdmin(){
        if ($this->is_admin) {
            $this->is_admin = !$this->is_admin;
            $this->takeRole(self::ROLE_ADMIN);
        }
    }

    /* Give Manager rights */
    public function giveManager(){
        $this->giveRole(self::ROLE_MANAGER);
    }

    /* Take Manager rights */
    public function takeManager(){
        $this->takeRole(self::ROLE_MANAGER);
    }
}
