<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCartItemRequest;
use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\UpdateCartItemRequest;
use App\Http\Requests\UpdateCartRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Repositories\CartItemRepository;
use App\Repositories\CartRepository;
use App\Repositories\ProductRepository;

class CartItemController extends Controller
{
    public function __construct(
        private CartItemRepository $cartItemRepository,
        private CartRepository $cartRepository,
        private ProductRepository $productRepository,
    ) {
    }

    public function show(int $id)
    {
        $cartItem = $this->cartItemRepository->getById($id);

        return view('cart_items', [
            'singleCartItem' => $cartItem,
        ]);
    }

    public function getProductAndCartItemsFromCart(int $cartId, int $productId)
    {
        $product = $this->productRepository->getById($productId);

        $cart = $this->cartRepository->getById($cartId);

        return view('cart_items', [
            'currentCart' => $cart,
            'currentProduct' => $product,
        ]);
    }

    public function getCartItemsFromCart(int $cartId)
    {
        $cartItems = $this->cartItemRepository->getCartItemsFromCart($cartId);

        $cart = $this->cartRepository->getById($cartId);

        $products = $this->productRepository->getInAlphabeticOrder();

        return view('cart_items', [
           'currentCart' => $cart,
           'cartItems' => $cartItems,
            'products' => $products,
        ]);
    }

    public function showAll()
    {
        $cartItems = $this->cartItemRepository->getAll();

        $carts = $this->cartRepository->getAll();

        $products = $this->productRepository->getInAlphabeticOrder();

        return view('cart_items', [
            'carts' => $carts,
            'products' => $products,
        ]);
    }

    public function create(CreateCartItemRequest $request)
    {
        $this->cartItemRepository->create(data: $request->toArray());
    }

    public function update(int $id, UpdateCartRequest $request)
    {
        $cartItemId = $this->cartItemRepository->update($id, $request->toArray())->id;

        return redirect("api/cart-item/$cartItemId");
    }

    public function createWithCart(int $cartId, int $productId, CreateCartItemRequest $request)
    {
        $cart = $this->cartRepository->getById($cartId);
        $cartItemId = $this->cartItemRepository->create($request->toArray(), $cart, $productId)->id;

        return redirect("api/cart-item/$cartItemId");
    }

    public function updateWithCart(int $id, int $cartId, UpdateCartItemRequest $request)
    {
        $this->cartItemRepository->update($id, $request->toArray(), $cartId);
    }

    public function delete(int $id)
    {
        $this->cartItemRepository->delete($id);

        return redirect('/api/cart-item');
    }

    public function deletePromotions(int $id)
    {
        $this->cartItemRepository->deletePromotions($id);

        return redirect("/api/cart-item/$id");
    }
}
