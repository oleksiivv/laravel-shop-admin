<?php

namespace App\Repositories;

use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class CartItemRepository
{
    public function getById(int $id): Model|null
    {
        return CartItem::with('cart')->with('promotions')->find($id);
    }

    public function getCartItemsFromCart(int $cartId): Collection
    {
        return CartItem::with('cart')->where('cart_id', $cartId)->get();
    }

    public function getAll(): Collection
    {
        return CartItem::with('cart')->with('promotions')->get();
    }

    public function create(array $data, Cart $cart, int $product_id= null): CartItem
    {
        $cartItem = new CartItem();
        $cartItem->fill($data);

        $cartItem->cart_id = $cart->id;
        $cartItem->product_id = $product_id;

        $cart->status = Cart::STATUS_READY;
        $cart->save();

        $cartItem->save();

        return $cartItem;
    }

    public function update(int $id, array $data, int $cartId = null): CartItem
    {
        $cartItem = CartItem::where('id', $id)->first();
        $cartItem->fill($data);

        $cartItem->save();

        return $cartItem;
    }

    public function delete(int $id)
    {
        $cartItem = CartItem::find($id);

        $cartItem->delete();
    }

    public function deletePromotions(int $id)
    {
        $cartItem = CartItem::find($id);

        $cartItem->promotions()->delete();
    }
}
