@extends('base')

@section('title')
    Carts
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
                        <td><a href="/api/cart/{{$cart->id}}">Open</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <hr/>
        @endisset

        @isset($singleCart)
            <table class="table table-hover">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Status</th>
                    <th scope="col">Created at</th>
                    <th scope="col">Customer</th>
                    <th scope="col">Seller</th>
                </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">{{$singleCart->id}}</th>
                        <td>{{ $singleCart->status }}</td>
                        <td>{{ $singleCart->created_at }}</td>
                        <td><a href="/api/customer/{{$singleCart->customer_id}}">{{ $singleCart->customer?->email }}</a></td>
                        <td><a href="/api/worker/{{$singleCart->seller_id}}">{{ $singleCart->worker?->email }}</a></td>
                    </tr>
                </tbody>
            </table>
            <br/>
            <h3>Cart items</h3>
            <table class="table table-hover">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Product</th>
                    <th scope="col">Price</th>
                    <th scope="col">Promotions</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($singleCart->cartItems as $item)
                    <tr>
                        <th scope="row">{{$item->id}}</th>
                        <td><a href="/api/product/{{$item->product_id}}">{{$item->product->name}}</a></td>
                        <td>${{$item->price}}</td>
                        <td>
                            <h6>Promotions</h6>
                            <ul>
                                @foreach($item->promotions as $promotion)
                                    <li><a href="/api/promotion/{{$promotion->id}}">{{$promotion->coupon}}</a></li>
                                @endforeach
                            </ul>
                        </td>
                        <td><a href="/api/cart-item/{{$item->id}}">Open</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <hr/>
            <a class="btn btn-outline-success" href="/api/cart-item/cart/{{$singleCart->id}}">Add items</a>

            <hr/>
            <div class="alert alert-warning">
                <h3>Update</h3>
                <form method="POST" action="/api/cart/{{$singleCart->id}}/update">
                    @csrf
                    <input type="email" name="seller_email" class="form-control" value="{{$singleCart->worker?->email}}" placeholder="Seller: "/>
                    </br>
                    <input type="email" name="customer_email" class="form-control" value="{{$singleCart->customer->email}}" placeholder="Customer: "/>
                    </br>
                    <input type="submit" class="btn btn-warning" value="Update"/>
                </form>

                <h3>Warning</h3>
                <div class="row">
                <form class="col-sm-1" method="POST" action="/api/cart/{{$singleCart->id}}/delete">
                    @csrf
                    <input type="submit" class="btn btn-danger" value="Delete"/>
                </form>

                <form class="col-sm-1" method="POST" action="/api/cart/{{$singleCart->id}}/cart-items/delete">
                    @csrf
                    <input type="submit" class="btn btn-danger" value="Delete all promotions"/>
                </form>
                </div>
            </div>
        @endisset
        <hr/>
        <div class="alert alert-success">
            <h3>Create new cart</h3>
            <form method="POST" action="/api/cart/create">
                @csrf
                <input type="email" name="seller_email" class="form-control" placeholder="Seller: "/>
                </br>
                <input type="email" name="customer_email" class="form-control" placeholder="Customer: "/>
                </br>
                <input type="submit" class="btn btn-success" value="Create"/>
            </form>
        </div>
    <br/>
@endsection
