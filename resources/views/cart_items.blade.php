@extends('base')

@section('title')
    Cart items
@endsection

@section('content')
        @isset($carts)
            <table class="table table-hover">
                <caption>List of carts</caption>
                <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Status</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($carts as $cart)
                    <tr>
                        <th scope="row">{{$cart->id}}</th>
                        <td>{{ $cart->status }}</td>
                        <td><a href="/api/cart-item/cart/{{$cart->id}}">Choose</a></td>
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
                    <th scope="col">Product</th>
                    <th scope="col">Cart id</th>
                    <th scope="col">Cart status</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($cartItems as $item)
                    <tr>
                        <th scope="row">{{$item->id}}</th>
                        <td><a href="/api/product/{{$item->product_id}}">{{ $item->product->name }}</a></td>
                        <td><a href="/api/cart/{{$currentCart->id}}">{{$currentCart->id}}</a></td>
                        <td>{{$currentCart->status}}</td>
                        <td><a href="/api/cart-item/{{$item->id}}">Open</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <hr/>
        @endisset

        @isset($products)
            @isset($currentCart)
            <h3>Available products</h3>
            <table class="table table-hover">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Product</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($products as $product)
                    <tr>
                        <th scope="row">{{$product->id}}</th>
                        <td>{{$product->name}}</td>
                        <td><a href="/api/cart-item/cart/{{$currentCart->id}}/product/{{$product->id}}">Choose</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <hr/>
            @endisset
        @endisset

        @isset($singleCartItem)
            <table class="table table-bordered">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Product</th>
                    <th scope="col">Price</th>
                    <th scope="col">Product price</th>
                    <th scope="col">Cart</th>
                    <th scope="col">Promotions</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <th scope="row">{{$singleCartItem->id}}</th>
                    <td><a href="/api/product/{{$singleCartItem->product_id}}">{{$singleCartItem->product->name}}</a></td>
                    <td>${{ $singleCartItem->price }}</td>
                    <td>${{ $singleCartItem->product->current_price }}</td>
                    <td><a href="/api/cart/{{$singleCartItem->cart_id}}">Id: {{ $singleCartItem->cart_id }}<br/>Status: {{$singleCartItem->cart->status}}</a></td>
                    <td>
                        <ul>
                            @foreach($singleCartItem->promotions as $promotion)
                                <li><a href="/api/promotion/{{$promotion->id}}">{{$promotion->coupon}}</a></li>
                            @endforeach
                        </ul>
                    </td>
                </tr>
                </tbody>
            </table>
            <hr/>

            <div class="alert alert-warning">
                <h3>Update</h3>
                <form method="POST" action="/api/cart-item/{{$singleCartItem->id}}/update">
                    @csrf
                    <input type="number" name="price" class="form-control" value="{{ $singleCartItem->price }}" placeholder="Current price: "/>
                    </br>
                    <input type="submit" class="btn btn-warning"/>
                </form>

                <h3>Warning</h3>
                <div class="row">
                    <form class="col-sm-1" method="POST" action="/api/cart-item/{{$singleCartItem->id}}/delete">
                        @csrf
                        <input type="submit" class="btn btn-danger" value="Delete"/>
                    </form>

                    <form class="col-sm-1" method="POST" action="/api/cart-item/{{$singleCartItem->id}}/promotions/delete">
                        @csrf
                        <input type="submit" class="btn btn-danger" value="Delete all promotions"/>
                    </form>
                </div>
            </div>
            <hr/>
        @endisset

        @isset($currentCart)
            @isset($currentProduct)
                <table class="table table-bordered">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">Cart</th>
                        <th scope="col">Product</th>
                        <th scope="col">Product price</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td><a href="/api/cart/{{$currentCart->id}}">Id: {{ $currentCart->id }}<br/>Status: {{$currentCart->status}}</a></td>
                        <td><a href="/api/product/{{$currentProduct->id}}">{{$currentProduct->name}}</a></td>
                        <td>${{ $currentProduct->current_price }}</td>
                    </tr>
                    </tbody>
                </table>
                <div class="alert alert-success">
                    <h3>Add to cart</h3>
                    <form method="POST" action="/api/cart-item/cart/{{$currentCart->id}}/product/{{$currentProduct->id}}/create">
                        @csrf
                        <input type="number" name="price" class="form-control" placeholder="Current price: "/>
                        </br>
                        <input type="submit" class="btn btn-success" value="Submit"/>
                    </form>
                </div>
            @endisset
        @endisset
@endsection
