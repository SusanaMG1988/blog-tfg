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
        factory(App\User::class, 29)->create();
        App\User::create([
            'name' => 'Susana Moreno',
            'email' => 'susana@mg.com',
            'password' => bcrypt('123')
        ]);
    }
}
