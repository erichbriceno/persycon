<?php

use App\Model\{User, Role};
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    protected $roles;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $this->fetchRelations();

        factory(User::class)->create([
            'name' => 'Erich Briceno',
            'email' => 'erichbriceno@gmail.com',
            'role_id' => $this->roles->where('description', 'Master')->first()->id,
            'password' => bcrypt('secreto1'),
        ]);

        factory(User::class)->times(25)->create([
            'role_id' => $this->roles->where('description', 'User')->first()->id,
        ]);
    }

    protected function fetchRelations()
    {
        $this->roles = Role::all();
    }
}
