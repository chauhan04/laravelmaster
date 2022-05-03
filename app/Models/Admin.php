<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Hash;

class Admin extends Authenticatable
{
    use Notifiable;
    
    protected $guard = 'admin';
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'username',
        'password',
        'phone',
        'address_line1',
        'address_line2',
        'country',
        'state',
        'city',
        'zipcode',
        'status',
    ];
    
    protected $hidden = [
        'password',
    ];
    
    /**
     * Always encrypt password when it is updated.
     *
     * @param $value
     * @return string
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    public static function getAdminByEmail($email)
    {
        return Self::where('email', $email)->first();
    }

    public static function getAdmins()
    {
        return self::orderBy('id','desc')->paginate(10)->setPath('users');
    }

    public static function deleteAdmin($id)
    {
        return self::where('id',$id)->delete();
    }
}
