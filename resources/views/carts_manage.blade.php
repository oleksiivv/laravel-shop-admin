@extends('base')

@section('title')
    Shops manage
@endsection

@section('content')
    <center>
        <div class="alert alert-primary" id="links-block">
            <a class="btn btn-outline-primary" href="/api/cart">Carts</a>
            <a class="btn btn-outline-primary" href="/api/cart-item">Cart items</a>
            <a class="btn btn-outline-primary" href="/api/promotion">Promotions</a>
            <a class="btn btn-outline-primary" href="/api/order">Orders</a>
        </div>
    </center>
@endsection
