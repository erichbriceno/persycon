<?php

use App\Model\{Login, User, Role, Management};
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    protected $roles;
    protected $managements;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $this->fetchRelations();

        factory(User::class)->create([
            'management_id' => $this->managements->where('name', 'PO')->first()->id,
            'names' => 'Erich Javier',
            'surnames' => 'Briceño',
            'email' => 'erichbriceno@gmail.com',
            'role_id' => $this->roles->where('name', 'Master')->first()->id,
            'password' => bcrypt('secreto1'),
        ]);

        foreach (range(1, 10) as $i) {
            $this->createRandomUser(false);
        }

        foreach (range(1, 40) as $i) {
            $this->createRandomUser(true);
        }
    }

    protected function fetchRelations()
    {
        $this->roles = Role::all();
        $this->managements = Management::where('selectable', true)->get();

    }

    public function createRandomUser($active): void
    {
        $user = factory(User::class)->create([
            'role_id' => $this->roles->random()->id,
            'management_id' => rand(0, 2) ? $this->managements->random()->id : null,
            'active' => $active,
            'created_at' => now()->subDays(rand(1, 90))
        ]);

        factory(Login::class)->times(rand(1, 10))->create([
            'user_id' => $user->id,
        ]);
    }
}
