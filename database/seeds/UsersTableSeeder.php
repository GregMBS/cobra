<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Greg B',
            'completo' => 'Greg B',
            'usuaria' => 'gregb',
            'iniciales' => 'gregb',
            'tipo' => 'admin',
            'password' => bcrypt('AwRats'),
        ]);
    }
}
