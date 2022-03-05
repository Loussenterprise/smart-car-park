<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $u=new User();
        $u->name="Admin";
        $u->password=Hash::make("app-admin");
        $u->email="admin@users.app";
        $u->is_admin=true;
        $u->save();
    }
}
