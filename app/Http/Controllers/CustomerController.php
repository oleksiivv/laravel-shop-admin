<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCartRequest;
use App\Http\Requests\CreateCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Repositories\CustomerRepository;
use App\Repositories\ShopRepository;
use App\Repositories\WorkerRepository;

class CustomerController extends Controller
{
    public function __construct(private CustomerRepository $customerRepository)
    {
    }

    public function show(int $id)
    {
        return view('customers', [
            'singleCustomer' => $this->customerRepository->getById($id),
        ]);
    }

    public function showAll()
    {
        return view('customers', [
            'customers' => $this->customerRepository->getAll(),
        ]);
    }

    public function create(CreateCustomerRequest $request)
    {
        $customerId = $this->customerRepository->create($request->toArray())->id;

        return redirect("/api/customer/$customerId");
    }

    public function update(int $id, UpdateCustomerRequest $request)
    {
        $customerId = $this->customerRepository->update($id, $request->validated())->id;

        return redirect("/api/customer/$customerId");
    }

    public function delete(int $id)
    {
        $this->customerRepository->delete($id);

        return redirect("/api/customer");
    }
}
