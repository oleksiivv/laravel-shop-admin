<?php

namespace Database\Seeders\ProductionDatabaseSeeders;

use App\Models\Customer;
use App\Models\Shop;
use App\Models\Speciality;
use App\Models\Worker;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    public function run()
    {
        Customer::factory()
            ->count(10)
            ->create();
    }
}
