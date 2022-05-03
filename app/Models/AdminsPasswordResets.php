<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminsPasswordResets extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'token',
        'admin_id',
        'phone',
    ];

    public static function getAdminByEmail($email, $adminId)
    {
        return self::where([['email', '=', $email],['admin_id', '=', $adminId]])->first();
    }

    public function updateByAdminid($adminId, $adminPasswordResetData)
    {
        return $this->where('admin_id',$adminId)->update($adminPasswordResetData);
    }

    public static function getAdminByToken($token)
    {
        return self::where('token',$token)->first();
    }
}
