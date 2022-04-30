<?php

namespace Database\Seeders\ProductionDatabaseSeeders;

use App\Models\Shop;
use App\Models\Speciality;
use App\Models\Worker;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class SpecialitySeeder extends Seeder
{
    public function run()
    {
        Speciality::factory()
            ->count(6)->state(
                new Sequence(
                    ['speciality_name' => 'seller'],
                    ['speciality_name' => 'warehouseman'],
                    ['speciality_name' => 'manager'],
                    ['speciality_name' => 'marketer'],
                    ['speciality_name' => 'head_of_salesmen_department'],
                    ['speciality_name' => 'head_of_warehouse'],
                )
            )->create();
    }
}
