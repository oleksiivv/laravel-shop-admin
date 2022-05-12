@extends('base')

@section('title')
    Promotions
@endsection

@section('content')
        @isset($promotions)
            <table class="table table-hover">
                <caption>List of promotions</caption>
                <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Coupon</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($promotions as $promotion)
                    <tr>
                        <th scope="row">{{$promotion->id}}</th>
                        <th>{{$promotion->coupon}}</th>
                        <th><a href="/api/promotion/{{$promotion->id}}">Open</a></th>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <hr/>
        @endisset

        @isset($cartItems)
            <h1>Cart items</h1>
            <table class="table table-hover">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Cart</th>
                    <th scope="col">Cart item</th>
                    <th scope="col">Product</th>
                    <th scope="col">Price</th>
                    <th scope="col">Cart status</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($cartItems as $cartItem)
                    <tr>
                        <th scope="row">{{$cartItem->id}}</th>
                        <td><a href="/api/cart/{{$cartItem->cart_id}}">{{$cartItem->cart_id}}</a></td>
                        <td><a href="/api/cart-item/{{$cartItem->id}}">{{$cartItem->id}}</a></td>
                        <td><a href="/api/product/{{$cartItem->product_id}}">{{$cartItem->product->name}}</a></td>
                        <td>${{(float) $cartItem->price}}</td>
                        <td>{{$cartItem->status}}</td>
                        <td><a class="btn btn-outline-success" href="/api/promotion/cart-item/{{$cartItem->id}}">Add promotion</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <hr/>
        @endisset
        @isset($singlePromotion)
            <table class="table table-bordered">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Coupon</th>
                    <th scope="col">Amount</th>
                    <th scope="col">Cart item</th>
                    <th scope="col">Description</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <th scope="row">{{$singlePromotion->id}}</th>
                    <td>{{$singlePromotion->coupon}}</td>
                    <td>${{$singlePromotion->amount}}</td>
                    <td><a href="/api/cart-item/{{$singlePromotion->cartItem->id}}">{{$singlePromotion->cartItem->product->name}}</a></td>
                    <td>{{$singlePromotion->description}}</td>
                </tr>
                </tbody>
            </table>
            <hr/>

            <div class="alert alert-warning">
                <h3>Update</h3>
                <form method="POST" action="/api/promotion/{{$singlePromotion->id}}/update">
                    @csrf
                    <input type="text" name="coupon" class="form-control" value="{{$singlePromotion->coupon}}" placeholder="Coupon: "/>
                    </br>
                    <input type="text" name="description" class="form-control" value="{{$singlePromotion->description}}" placeholder="Description: "/>
                    </br>
                    <input type="number" name="amount" class="form-control" value="{{$singlePromotion->amount}}" min="0" max="1250.5" step="0.1" placeholder="Amount: "/>
                    </br>
                    <input type="submit" class="btn btn-warning" value="Update"/>
                </form>

                <h3>Warning</h3>
                <form method="POST" action="/api/promotion/{{$singlePromotion->id}}/delete">
                    @csrf
                    <input type="submit" class="btn btn-danger" value="Delete"/>
                </form>
            </div>
        @endisset
        <hr/>

        @isset($currentCartItemId)
            <div class="alert alert-success">
                <h3>Create new promotion</h3>
                <form method="POST" action="/api/promotion/cart-item/{{$currentCartItemId}}/create">
                    @csrf
                    <input type="text" name="coupon" class="form-control" placeholder="Coupon: "/>
                    </br>
                    <input type="text" name="description" class="form-control" placeholder="Description: "/>
                    </br>
                    <input type="number" name="amount" class="form-control" min="0" max="1250.5" step="0.1" placeholder="Amount: "/>
                    </br>
                    <input type="submit" class="btn btn-success" value="Create"/>
                </form>
            </div>
        @endisset
@endsection
