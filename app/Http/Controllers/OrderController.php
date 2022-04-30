<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Repositories\CartRepository;
use App\Repositories\OrderRepository;

class OrderController extends Controller
{
    public function __construct(
        private OrderRepository $orderRepository,
        private CartRepository $cartRepository,
    ) {
    }

    public function show(int $id)
    {
        $order = $this->orderRepository->getById($id);

        return view('orders', [
           'singleOrder' => $order,
        ]);
    }

    public function showCartForCreateOrder(int $cartId)
    {
        $cart = $this->cartRepository->getById($cartId);

        return view('orders', [
            'currentCartId' => $cart->id,
            'currentCustomerId' => $cart->customer_id,
        ]);
    }

    public function showAll()
    {
        $orders = $this->orderRepository->getAll();
        $carts = $this->cartRepository->getAll();

        return view('orders', [
            'orders' => $orders,
            'carts' => $carts,
        ]);
    }

    public function create(int $cartId, CreateOrderRequest $request)
    {
        $cart = $this->cartRepository->getById($cartId);

        $orderId = $this->orderRepository->create($cart, $request->toArray())->id;

        return redirect("/api/order/$orderId");
    }

    public function update(int $id, UpdateOrderRequest $request)
    {
        $this->orderRepository->update($id, $request->toArray());
    }

    public function delete(int $id)
    {
        $this->orderRepository->delete($id);
    }
}
