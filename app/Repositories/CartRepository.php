<?php

namespace App\Repositories;

use App\Models\Cart;
use App\Models\ProductGuarantee;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class CartRepository
{
    public function getById(int $id): Model|null
    {
        return Cart::with('cartItems')
            ->with('customer')
            ->with('worker')
            ->with('cartItems.promotions')
            ->find($id);
    }

    public function getAll(): Collection
    {
        return Cart::with('cartItems')
            ->with('customer')
            ->with('worker')
            ->with('cartItems.promotions')
            ->get();
    }

    public function create(array $data, int $seller_id, int $customer_id): Cart
    {
        $cart = new Cart();
        $cart->seller_id = $seller_id;
        $cart->customer_id = $customer_id;

        $cart->status = Cart::STATUS_CREATED;

        $cart->save();

        return $cart;
    }

    public function update(int $id, array $data, int $seller_id, int $customer_id): Cart
    {
        $cart = Cart::where('id', $id)->first();
        $cart->seller_id = $seller_id;
        $cart->customer_id = $customer_id;

        $cart->save();

        return $cart;
    }

    public function delete(int $id)
    {
        $cart = Cart::find($id);

        $cart->delete();
    }

    public function deleteCartItems(int $id)
    {
        $cart = Cart::find($id);

        $cart->cartItems()->delete();
    }
}
