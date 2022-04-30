<?php

namespace App\Repositories;

use App\Models\Cart;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Worker;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class CustomerRepository
{
    public function getById(int $id): Model|null
    {
        return Customer::with('carts')
            ->with('orders')
            ->find($id);
    }

    public function getCustomerByEmail(string $email): \Illuminate\Database\Eloquent\Builder|Model
    {
        return Customer::with('carts')
            ->with('orders')
            ->where([
                ['email', '=', $email]
            ])
            ->firstOrFail();
    }

    public function getAll(): Collection
    {
        return Customer::with('carts')
            ->with('orders')
            ->get();
    }

    public function create(array $data): Customer
    {
        $customer = new Customer();
        $customer->fill($data);

        $customer->save();

        return $customer;
    }

    public function update(int $id, array $data): Customer
    {
        $customer = Customer::where('id', $id)->first();
        $customer->fill($data);

        $customer->save();

        return $customer;
    }

    public function delete(int $id)
    {
        $customer = Customer::find($id);

        $customer->delete();
    }
}
