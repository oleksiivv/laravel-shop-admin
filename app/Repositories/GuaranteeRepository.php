<?php

namespace App\Repositories;

use App\Models\Cart;
use App\Models\Product;
use App\Models\ProductGuarantee;
use App\Models\ProductManufacturer;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class GuaranteeRepository
{
    public function getById(int $id): Model|null
    {
        return ProductGuarantee::with('products')
            ->find($id);
    }

    public function getAll(): Collection
    {
        return ProductGuarantee::with('products')
            ->get();
    }

    public function getMostPopular()
    {
        $topCategory = DB::select('
            select TOP 1 COUNT([products].[id]) AS products_count, [product_guarantees].[id] AS guarantee_id
            from [product_guarantees]
            left join [products]
            on [product_guarantees].[id] = [products].[guarantee_id]
            WHERE [products].[guarantee_id] IS NOT NULL
            GROUP BY [products].[category_id], [product_guarantees].[id]
            ORDER BY products_count DESC
        ')[0];

        return $topCategory;
    }

    public function create(array $data): ProductGuarantee
    {
        $guarantee = new ProductGuarantee();
        $guarantee->fill($data);

        $guarantee->valid_from = Carbon::parse($data['valid_from']);
        $guarantee->valid_till = Carbon::parse($data['valid_till']);

        $guarantee->save();

        return $guarantee;
    }

    public function update(int $id, array $data): ProductGuarantee
    {
        $guarantee = ProductGuarantee::where('id', $id)->first();
        $guarantee->fill($data);

        $guarantee->valid_from = Carbon::parse($data['valid_from']);
        $guarantee->valid_till = Carbon::parse($data['valid_till']);

        $guarantee->save();

        return $guarantee;
    }

    public function delete(int $id)
    {
        $guarantee = ProductGuarantee::find($id);

        $guarantee->delete();
    }

    public function deleteProducts(int $id): ProductGuarantee
    {
        $guarantee = ProductGuarantee::find($id);

        $guarantee->products()->delete();

        return $guarantee;
    }

    public function getProducts(int $id): Collection
    {
        return Product::with('productManufacturer')
            ->with('productGuarantee')
            ->with('productCategory')
            ->where('guarantee_id', $id)
            ->get();
    }
}
