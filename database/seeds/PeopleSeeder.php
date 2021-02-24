<?php

use App\Model\{People};
use Illuminate\Database\Seeder;

class PeopleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (range(1, 5) as $i) {
            factory(People::class)->create();
        }
    }
}
