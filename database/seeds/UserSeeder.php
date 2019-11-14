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
            'role_id' => $this->roles->where('name', 'Master')->first()->id,
            'password' => bcrypt('secreto1'),
        ]);


        foreach (range(1, 10) as $i) {
            $user = factory(User::class)->create([
                'role_id' => $this->roles->random()->id,
                'management_id' => rand(0, 2) ? $this->managements->random()->id :  null,
                'active' => false,
                'created_at' => now()->subDays(rand(1, 90))
            ]);
        }

        foreach (range(1, 40) as $i) {
            $user = factory(User::class)->create([
                'role_id' => $this->roles->random()->id,
                'management_id' => rand(0, 2) ? $this->managements->random()->id :  null,
                'created_at' => now()->subDays(rand(1, 90))
            ]);
        }
    }

    protected function fetchRelations()
    {
        $this->roles = Role::all();
        $this->managements = Management::where('selectable', true)->get();

    }
}
