<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\CreatePromotionRequest;
use App\Http\Requests\UpdatePromotionRequest;
use App\Repositories\CartItemRepository;
use App\Repositories\CartRepository;
use App\Repositories\PromotionRepository;

class PromotionController extends Controller
{
    public function __construct(
        private PromotionRepository $promotionRepository,
        private CartItemRepository $cartItemRepository,
    ) {
    }

    public function show(int $id)
    {
        $promotion = $this->promotionRepository->getById($id);

        return view('promotions',[
            'singlePromotion' => $promotion,
        ]);
    }

    public function getPromotionsForCartItem(int $cartItemId)
    {
        $promotions = $this->promotionRepository->getPromotionsForCartItem($cartItemId);

        return view('promotions', [
           'promotions' => $promotions,
           'currentCartItemId' => $cartItemId,
        ]);
    }

    public function showAll()
    {
        $promotions = $this->promotionRepository->getAll();
        $cartItems = $this->cartItemRepository->getAll();

        return view('promotions', [
            'promotions' => $promotions,
            'cartItems' => $cartItems,
        ]);
    }

    public function create(int $cartItemId, CreatePromotionRequest $request)
    {
        $promotionId = $this->promotionRepository->create($request->toArray(), $cartItemId)->id;

        return redirect("/api/promotion/$promotionId");
    }

    public function update(int $id, UpdatePromotionRequest $request)
    {
        $promotionId = $this->promotionRepository->update($id, $request->toArray())->id;

        return redirect("/api/promotion/$promotionId");
    }

    public function delete(int $id)
    {
        $this->promotionRepository->delete($id);

        return redirect("/api/promotion");
    }
}
