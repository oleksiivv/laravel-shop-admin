<?php

namespace Database\Seeders\ProductionDatabaseSeeders;

use App\Models\ProductCategory;
use App\Models\Shop;
use App\Models\Speciality;
use App\Models\Worker;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class ProductCategorySeeder extends Seeder
{
    public function run()
    {
        ProductCategory::factory()
            ->state(new Sequence(
                ['name' => 'Fishing rods'], //вудка
                ['name' =>  'Coils'], //котушка
                ['name' => 'Fishing lines'], //ліска
                ['name' => 'Stands'], //підставка
                ['name' => 'Hooks'], //гачков'яз
                ['name' => 'Depth gauges'], //глибиномір
                ['name' => 'Shredder'], //подрібнювач
                ['name' => 'Nets'], //сітки
                ['name' => 'Bait for fishing'], //наживка
                ['name' => 'Fishing float'], //поплавок,
            ))
            ->count(10)
            ->create();
    }
}
