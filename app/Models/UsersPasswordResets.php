<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsersPasswordResets extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'token',
        'user_id',
        'phone',
    ];

    public static function getUserByEmail($email, $userId)
    {
        return self::where([['email', '=', $email],['user_id', '=', $userId]])->first();
    }

    public function updateByUserid($userId, $userPasswordResetData)
    {
        return $this->where('user_id',$userId)->update($userPasswordResetData);
    }

    public static function getUserByToken($token)
    {
        return self::where('token',$token)->first();
    }
}
