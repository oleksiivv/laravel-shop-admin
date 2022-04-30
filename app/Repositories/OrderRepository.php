<?php

namespace App\Repositories;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Promotion;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class OrderRepository
{
    public function getById(int $id): Model|null
    {
        return Order::with('customer')->find($id);
    }

    public function getAll(): Collection
    {
        return Order::with('customer')->get();
    }

    public function create(Cart $cart, array $data): Order
    {
        $order = new Order();
        $order->cart = json_encode($cart->toArray());

        $order->total_price = 0;

        $order->status = Order::STATUS_SUCCESS;
        $order->customer_id = $cart->customer->id;

        $cart->status = Cart::STATUS_COMPLETED;

        $cart->save();

        $order->save();

        return $order;
    }

    public function update(int $id, array $data): void
    {
        $order = Order::where('id', $id)->first();
        $order->fill($data);

        $order->save();
    }

    public function delete(int $id)
    {
        $order = Order::find($id);

        $order->delete();
    }
}
