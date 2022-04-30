<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Worker;
use Database\Seeders\ProductionDatabaseSeeders\CartSeeder;
use Database\Seeders\ProductionDatabaseSeeders\CustomerSeeder;
use Database\Seeders\ProductionDatabaseSeeders\ProductCategorySeeder;
use Database\Seeders\ProductionDatabaseSeeders\ProductGuaranteeSeeder;
use Database\Seeders\ProductionDatabaseSeeders\ProductManufacturerSeeder;
use Database\Seeders\ProductionDatabaseSeeders\ProductSeeder;
use Database\Seeders\ProductionDatabaseSeeders\PromotionSeeder;
use Database\Seeders\ProductionDatabaseSeeders\ShopSeeder;
use Database\Seeders\ProductionDatabaseSeeders\SpecialitySeeder;
use Database\Seeders\ProductionDatabaseSeeders\WorkerSeeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            CustomerSeeder::class,
            SpecialitySeeder::class,
            ShopSeeder::class,
            ProductCategorySeeder::class,
            ProductManufacturerSeeder::class,
            ProductGuaranteeSeeder::class,
            //PromotionSeeder::class,
            ProductSeeder::class,
            CartSeeder::class,
            CustomerSeeder::class,
        ]);
    }
}
