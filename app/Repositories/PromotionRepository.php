<?php

namespace App\Repositories;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\Promotion;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class PromotionRepository
{
    public function getById(int $id): Model|null
    {
        return Promotion::with('cartItem')
            ->with('cartItem.cart')
            ->find($id);
    }

    public function getPromotionsForCartItem(int $cartItemId): Collection
    {
        return Promotion::with('cartItem')
            ->with('cartItem.cart')
            ->where('cart_item_id', $cartItemId)
            ->get();
    }

    public function getAll(): Collection
    {
        return Promotion::with('cartItem')
            ->with('cartItem.cart')
            ->get();
    }

    public function create(array $data, int $cartItemId = null): Promotion
    {
        $promotion = new Promotion();
        $promotion->fill($data);

        $promotion->cart_item_id = $cartItemId;

        $promotion->save();

        return $promotion;
    }

    public function update(int $id, array $data, int $cartItemId = null): void
    {
        $promotion = Promotion::where('id', $id)->first();
        $promotion->fill($data);

        $promotion->cart_item_id = $cartItemId;

        $promotion->save();
    }

    public function delete(int $id)
    {
        $promotion = Promotion::find($id);

        $promotion->delete();
    }
}
