<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /* Role const */
    const ROLE_USER = 'user';
    const ROLE_MANAGER = 'manager';
    const ROLE_ADMIN = 'admin';

    /* Service const lines */
    const SERVICE_STR_ADMIN = ' admin';
    const SERVICE_STR_MANAGER = ' manager';
    const SERVICE_STR_USER = ' user';

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
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Isn't good?
    public function isAdmin(){
       return $this->is_admin;
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
