@extends('base')

@section('title')
    Orders
@endsection

@section('content')
        @isset($orders)
            <table class="table table-hover">
                <caption>List of orders</caption>
                <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Status</th>
                    <th scope="col">Created at</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($orders as $order)
                    <tr>
                        <th scope="col">{{$order->id}}</th>
                        <td>{{$order->status}}</td>
                        <td>{{$order->created_at}}</td>
                        <td><a href="/api/order/{{$order->id}}">Open</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <hr/>
        @endisset
        @isset($carts)
            <h1>Carts</h1>
            <table class="table table-hover">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Status</th>
                    <th scope="col">Created at</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($carts as $cart)
                    <tr>
                        <th scope="row"><a href="/api/cart/{{$cart->id}}">{{$cart->id}}</a></th>
                        <td>{{ $cart->status }}</td>
                        <td>{{$cart->created_at}}</td>
                        <td>
                            <a class="btn btn-outline-success" href="/api/order/cart/{{$cart->id}}">
                                Confirm cart
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <hr/>
        @endisset

        @isset($singleOrder)
            <table class="table table-bordered">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Status</th>
                    <th scope="col">Total price</th>
                    <th scope="col">Customer</th>
                    <th scope="col">Cart</th>
                    <th scope="col">Created at</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <th scope="row">{{$singleOrder->id}}</th>
                    <td>{{ $singleOrder->status }}</td>
                    <td>{{ $singleOrder->total_price }}</td>
                    <td><a href="/api/customer/{{$singleOrder->customer_id}}">{{ $singleOrder->customer->email }}</a></td>
                    <td>
                        <a href="/api/cart/{{$singleOrder->cart['id']}}">
                            @json($singleOrder->cart, JSON_PRETTY_PRINT)
                        </a>
                    </td>
                    <td>{{ $singleOrder->created_at }}</td>
                </tr>
                </tbody>
            </table>
            <hr/>
        @endisset

        @isset($currentCustomerId)
            @isset($currentCartId)
                <div class="alert alert-success">
                    <h3>Create order</h3>
                    <h4><i><a class="btn btn-outline-success" href="/api/cart/{{$currentCartId}}">View cart</a></i></h4>
                    <form method="POST" action="/api/order/cart/{{$currentCartId}}/create">
                        @csrf
                        <input type="submit" value="Submit" class="btn btn-success"/>
                    </form>
                </div>
            @endisset
        @endisset
@endsection
