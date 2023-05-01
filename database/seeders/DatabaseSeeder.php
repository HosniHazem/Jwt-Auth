<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
'name'=>'Admin',
'email'=>'admin@timdesk.tn',
'password'=>bcrypt('admin'),
'RoleID'=>'1'
]
        );
    }
}
