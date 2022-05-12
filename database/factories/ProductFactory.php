<?php

namespace Database\Factories;

use App\Models\ProductCategory;
use App\Models\ProductGuarantee;
use App\Models\ProductManufacturer;
use App\Models\Shop;
use App\Models\Speciality;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use JetBrains\PhpStorm\ArrayShape;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    public function definition(): array
    {
        $category = $this->faker->randomElement(ProductCategory::all());

        $images = [
            'Fishing rods' => [
                'http://atlas-content-cdn.pixelsquid.com/stock-images/fishing-pole-oJdQQa4-600.jpg',
                'https://www.pngitem.com/pimgs/m/475-4758830_fishing-pole-png-transparent-images-fishing-rod-png.png',
                'https://www.lifepng.com/wp-content/uploads/2020/10/58a1f148c8dd3432c6fa81dc.png',
                'https://static.wixstatic.com/media/2cd43b_c82f4c6caf78411e9ce01b98b9cbc4f1~mv2_d_1200_1200_s_2.png/v1/fill/w_320,h_320,q_90/2cd43b_c82f4c6caf78411e9ce01b98b9cbc4f1~mv2_d_1200_1200_s_2.png',
                'https://www.kindpng.com/picc/m/53-532188_fishing-pole-png-transparent-image-fishing-rod-png.png',
                'https://cutewallpaper.org/24/fishing-pole-png/fishing-pole-png-image-background-fishing-rod-free-transparent-png-download-pngkey.png',
            ],
            'Coils' => [
                'https://w7.pngwing.com/pngs/615/916/png-transparent-fishing-reels-shimano-fishing-tackle-fishing-rods-fishing-rod-fishing-rods-sports-reel.png',
                'https://w7.pngwing.com/pngs/808/747/png-transparent-globeride-fishing-reels-shimano-angling-fishing-tackle-fishing-reel-fishing-rods-angling-shopping.png',
                'https://ae01.alicdn.com/kf/Seab1010384c941ccbe2ea740b3254ddey/Double-Spool-Fishing-coil-Wooden-handshake-12-1BB-Spinning-Fishing-Reel-Professional-Metal-Left-Right-Hand.jpg',
                'https://e7.pngegg.com/pngimages/421/554/png-clipart-fishing-reels-shimano-bass-fishing-casting-fishing-sports-reel.png',
            ],
            'Fishing lines' => [
                'https://toppng.com/uploads/preview/fishing-line-11533034633zjwwsczmgv.png',
                'https://nwscdn.com/media/wysiwyg/3kf/water/Fishing-Line-USP-3.jpg',
            ],
            'Stands' => [
                'https://e7.pngegg.com/pngimages/300/255/png-clipart-stainless-steel-fishing-tackle-box-fishing-rod-stand.png',
                'https://w7.pngwing.com/pngs/377/335/png-transparent-tripod-fishing-rods-rod-pod-surf-fishing-fishing-angle-sport-fishing-rods.png',
                'https://w7.pngwing.com/pngs/752/44/png-transparent-rod-pod-allegro-feeder-carp-bite-indicator-carp-angle-plus-tripod.png',
            ],
            'Hooks' => [
                'https://atlas-content-cdn.pixelsquid.com/stock-images/fishing-hook-fishhook-Je1kyJB-600.jpg',
                'https://upload.wikimedia.org/wikipedia/commons/1/1c/Fish_hook.png',
                'https://www.pngall.com/wp-content/uploads/8/Fish-Hook-Transparent.png',
            ],
            'Depth gauges' => [
                'https://cdn.imgbin.com/2/8/17/imgbin-fish-finders-transducer-high-dynamic-range-imaging-depth-gauge-digital-data-nautica-hxJDMqdc421cfvNB5FcyNPXMh.jpg',
                'https://img.favpng.com/6/19/19/depth-gauge-transducer-echo-sounding-fish-finders-png-favpng-jAFViZeYiUF78zZm1JvSz3nJd.jpg',
                'https://5.imimg.com/data5/SELLER/Default/2022/2/CT/MX/FV/96779923/mitutoyo-absolute-digimatic-depth-gauge-250x250.jpeg',
                'https://shop.mitutoyo.eu/pim/upload/mitutoyoData/image/bigweb/547-212_z_jpg.png',
            ],
            'Shredder' => [
                'https://blog.allo.ua/wp-content/uploads/2020/08/kak-vybrat-rybolovnye-snasti-30.jpg',
            ],
            'Nets' => [
                'https://pngimg.com/uploads/scoop_net/scoop_net_PNG16.png',
                'https://www.adh-fishing.com/media/image/85/a8/e5/mclean_r111_red.jpg',
                'https://images-eu.ssl-images-amazon.com/images/I/51lJ1pJmDJL._SX300_SY300_QL70_ML2_.jpg',
            ],
            'Bait for fishing' => [
                'https://www.nicepng.com/png/detail/134-1343421_fishing-lures-png.png',
                'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT9TsDnqtYYMB4P4fn33HSANXNMhv0Zyy5VDw&usqp=CAU',

            ],
            'Fishing float' => [
                'https://w7.pngwing.com/pngs/98/868/png-transparent-float-fishing-simulator-fishing-floats-stoppers-real-fishing-summer-simulator-ultimate-fishing-simulator-fishing-fishing-rods-sports-angling.png',
                'https://thumbs.dreamstime.com/b/fishing-float-isolated-drawing-white-background-98877897.jpg',
                'https://img.favpng.com/7/10/7/fishing-floats-stoppers-friedfisch-png-favpng-0thrTxDaJ3V9gUsJAj0vkpRBD.jpg',
            ],
        ];

        return [
            'name' => $this->faker->name(),
            'information' => [
                'description' => $this->faker->text()
            ],
            'current_price' => $this->faker->numberBetween(10.5, 350.99),
            'category_id' => $category->id,
            'manufacturer_id' => $this->faker->randomElement(ProductManufacturer::all())->id,
            'guarantee_id' => $this->faker->randomElement(ProductGuarantee::all())->id,
            'image_url' => $this->faker->randomElement($images[$category->name]),
            'amount' => 100,
        ];
    }
}
