<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::create([
            'first_name'=>'admin',
            'last_name'=>'admin',
            'email'=>'developer8here@gmail.com',
            'username'=>'admin',
            'password'=> 'master99', //Hash::make('thinker99'),
            'phone'=>'9898989898',
            'address_line1'=>'admin',
            'address_line2'=>'admin',
            'country'=>'IN',
            'state'=>'Gujarat',
            'city'=>'Ahmedabad',
            'zipcode'=>'380015',
            'status'=>1,
            'created_at'=>Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'=>Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }
}
