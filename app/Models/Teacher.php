<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Teacher extends Authenticatable
{
    use Notifiable;

    // Specify the fillable attributes
    protected $fillable = ['name', 'email', 'password'];

    // If needed, you can also specify the hidden attributes
    protected $hidden = ['password', 'remember_token'];

    // If you are using Laravel's default password hashing, 
    // ensure the password is hashed correctly
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }
}
