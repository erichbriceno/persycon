<?php

use App\Model\{
        User,
        Role,
        Management
    };
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
            'role_id' => $this->roles->where('description', 'Master')->first()->id,
            'password' => bcrypt('secreto1'),
        ]);


        foreach (range(1, 50) as $i) {
            $user = factory(User::class)->create([
                'role_id' => $this->roles->where('description', 'User')->first()->id,
                'management_id' => rand(0, 2) ? $this->managements->random()->id :  null,
            ]);
        }
    }

    protected function fetchRelations()
    {
        $this->roles = Role::all();
        $this->managements = Management::all();

    }
}
