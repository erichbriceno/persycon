<?php

use App\Model\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class)->create([
            'name' => 'Erich Briceno',
            'email' => 'erichbriceno@gmail.com',
            'password' => bcrypt('secreto1'),
            'role' => 'master',
        ]);

        factory(User::class)->times(6)->create([
            'role' => 'user',
        ]);
    }
}
