@extends('base')

@section('title')
    Customers
@endsection

@section('content')
        @isset($customers)
            <table class="table table-hover">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Email</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($customers as $customer)
                    <tr>
                        <th scope="row">{{$customer->id}}</th>
                        <td>{{$customer->email}}</td>
                        <td><a href="/api/customer/{{$customer->id}}">Open</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <hr />
            <div class="alert alert-success">
                <h3>Create new customer</h3>
                <form method="POST" action="/api/customer/create">
                    @csrf
                    <input type="text" name="first_name" class="form-control" placeholder="First name: "/>
                    </br>
                    <input type="text" name="last_name" class="form-control" placeholder="Last name: "/>
                    </br>
                    <input type="email" name="email" class="form-control" placeholder="Email: "/>
                    </br>
                    <input type="submit" class="btn btn-success" value="Create"/>
                </form>
            </div>
            <br/>
        @endisset
        @isset($singleCustomer)
            <table class="table table-hover">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">First name</th>
                    <th scope="col">Last name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Created at</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <th scope="row">{{$singleCustomer->id}}</th>
                    <td>{{$singleCustomer->first_name}}</td>
                    <td>{{$singleCustomer->last_name}}</td>
                    <td>{{$singleCustomer->email}}</td>
                    <td>{{$singleCustomer->created_at}}</td>
                </tr>
                </tbody>
            </table>

            <h5>Carts:</h5>
            @if($singleCustomer->carts->count() == 0)
                <h4><i>No carts found</i></h4>
            @else
                <table class="table table-hover">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Status</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($singleCustomer->carts as $cart)
                    <tr>
                        <th scope="row">{{$cart->id}}</th>
                        <td>{{$cart->status}}</td>
                        <td><a href="/api/cart/{{$cart->id}}">Open</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            @endif

            <h5>Orders:</h5>
            @if($singleCustomer->orders->count() == 0)
                <h4><i>No orders found</i></h4>
            @else
                <table class="table table-hover">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Status</th>
                        <th scope="col">Total price</th>
                        <th scope="col"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($singleCustomer->orders as $order)
                        <tr>
                            <th scope="row">{{$order->id}}</th>
                            <td>{{$order->status}}</td>
                            <td>{{$order->total_price}}</td>
                            <td><a href="/api/order/{{$order->id}}">Open</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif
            <hr/>
            <div class="alert alert-warning">
                <h3>Update</h3>
                <form method="POST" action="/api/customer/{{$singleCustomer->id}}/update">
                    @csrf
                    <input type="text" name="first_name" class="form-control" value="{{$singleCustomer->first_name}}" placeholder="First name: "/>
                    </br>
                    <input type="text" name="last_name" class="form-control" value="{{$singleCustomer->last_name}}" placeholder="Last name: "/>
                    </br>
                    <input type="email" name="email" class="form-control" value="{{$singleCustomer->email}}" placeholder="Email: "/>
                    </br>
                    <input type="submit" class="btn btn-warning" value="Update"/>
                </form>

                <h3>Warning</h3>
                <div class="row">
                <form class="col-sm-1" method="POST" action="/api/customer/{{$singleCustomer->id}}/delete">
                    @csrf
                    <input type="submit" class="btn btn-danger" value="Delete"/>
                </form>

                <form class="col-sm-1" method="POST" action="/api/customer/{{$singleCustomer->id}}/carts/delete">
                    @csrf
                    <input type="submit" class="btn btn-danger" value="Delete all carts"/>
                </form>
                </div>
            </div>
            <br/><br/>
        @endisset
@endsection
