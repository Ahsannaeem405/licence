<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        DB::table('users')->insert([
            'name' =>'admin',
            'email' =>'admin@gmail.com',
            'role' =>'admin',
            'user_role' =>'super_admin',

            'password' => Hash::make('12345678'),
        ]);

        DB::table('user_roles')->insert(
            [
                [
                    'role' =>'admin',
                    'super_admin' =>'1',
                    'admin' =>'0',
                    'csr' =>'0',
                    ],
                    [
                        'role' =>'csr',
                        'super_admin' =>'1',
                        'admin' =>'1',
                        'csr' =>'0',
                    ],
                    [
                        'role' =>'client',
                        'super_admin' =>'1',
                        'admin' =>'1',
                        'csr' =>'1',
                    ],
            ]              
          
    );
    }
}
