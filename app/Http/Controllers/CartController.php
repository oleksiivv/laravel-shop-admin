<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCartRequest;
use App\Http\Requests\UpdateCartRequest;
use App\Repositories\CartRepository;
use App\Repositories\CustomerRepository;
use App\Repositories\WorkerRepository;

class CartController extends Controller
{
    public function __construct(
        private CartRepository $cartRepository,
        private WorkerRepository $workerRepository,
        private CustomerRepository $customerRepository,
    ) {
    }

    public function show(int $id)
    {
        $cart = $this->cartRepository->getById($id);

        return view('carts', [
           'singleCart' => $cart,
        ]);

    }

    public function showAll()
    {
        $carts = $this->cartRepository->getAll();

        return view('carts', [
           'carts' => $carts,
        ]);
    }

    public function create(CreateCartRequest $request)
    {
        $cartId = $this->cartRepository->create(
            $request->toArray(),
            $this->workerRepository->getWorkerByEmail($request->toArray()['seller_email'])->id,
            $this->customerRepository->getCustomerByEmail($request->toArray()['customer_email'])->id,
        )->id;

        return redirect("api/cart/$cartId");
    }

    public function update(int $id, UpdateCartRequest $request)
    {
        $cartId = $this->cartRepository->update(
            $id,
            $request->toArray(),
            $this->workerRepository->getWorkerByEmail($request->toArray()['seller_email'])->id,
            $this->customerRepository->getCustomerByEmail($request->toArray()['customer_email'])->id,
        )->id;

        return redirect("api/cart/$cartId");
    }

    public function delete(int $id)
    {
        $this->cartRepository->delete($id);
    }

    public function deleteCartItems(int $id)
    {
        $this->cartRepository->deleteCartItems($id);
    }
}
