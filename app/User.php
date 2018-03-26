<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

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

    public function setPasswordAttribute()
    {
        $this->attributes['password'] = bcrypt('password');
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'assigned_roles');
    }

    public function hasRoles(array $roles)
    {
        return $this->roles->pluck('name')->intersect($roles)->count();
        /* foreach ($roles as $role) {
            foreach ($this->roles as $userRole) {
                if ($userRole->name === $role) {
                    return true;
                }
            }

        }
        return false; */
    }

    public function isAdmin()
    {
        return $this->hasRoles(['admin']);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function note()
    {
        return $this->morphOne(Note::class, 'notable');
    }

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable')->withTimestamps();
    }
}
