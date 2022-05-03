@extends('base')

@section('title')
    Shops
@endsection

@section('content')
        @isset($shops)
            <table class="table table-hover">
                <caption>List of shops</caption>
                <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Address</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($shops as $shop)
                    <tr>
                        <th scope="row">{{$shop->id}}</th>
                        <td>{{ $shop->address }}</td>
                        <td><a href="shop/{{$shop->id}}">Open</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <hr/>
            <div class="alert alert-dark">
                <h3>Create new shop</h3>
                <form method="POST" action="/api/shop/create">
                    @csrf
                    <input type="text" name="address" class="form-control" placeholder="Address: "/>
                    </br>
                    <input type="time" name="open_hour" class="form-control" placeholder="Opens at: "/>
                    </br>
                    <input type="time" name="close_hour" class="form-control" placeholder="Closes at: "/>
                    </br>
                    <input type="submit" class="btn btn-success" value="Create"/>
                </form>
            </div>
            <hr/>
        @endisset
        @isset($singleShop)
            <table class="table table-bordered">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Address</th>
                    <th scope="col">Opens at</th>
                    <th scope="col">Closes at</th>
                    <th scope="col">Created at</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <th scope="row">{{$singleShop->id}}</th>
                    <td>{{ $singleShop->address }}</td>
                    <td>{{ \Carbon\Carbon::parse($singleShop->open_hour)->format("H:i") }}</td>
                    <td>{{ \Carbon\Carbon::parse($singleShop->close_hour)->format("H:i") }}</td>
                    <td>{{ $singleShop->created_at }}</td>
                </tr>
                </tbody>
            </table>
            <hr/>
            <div class="alert alert-warning">
                <h3>Update</h3>
                <form method="POST" action="/api/shop/{{$singleShop->id}}/update">
                    @csrf
                    <input type="text" name="address" class="form-control" value="{{ $singleShop->address }}" placeholder="New address: "/>
                    </br>
                    <input type="time" name="open_hour" class="form-control" value="{{ \Carbon\Carbon::parse($singleShop->open_hour)->format('H:i') }}"  placeholder="Opens at: "/>
                    </br>
                    <input type="time" name="close_hour" class="form-control" value="{{ \Carbon\Carbon::parse($singleShop->close_hour)->format('H:i') }}" placeholder="Closes at: "/>
                    </br>
                    <input type="submit" class="btn btn-warning" value="Update"/>
                </form>
                <br/>
                <h3>Warning</h3>
                <div class="row">
                    <form class="col-sm-1" method="POST" action="/api/shop/{{$singleShop->id}}/delete">
                        @csrf
                        <input type="submit" class="btn btn-danger" value="Delete"/>
                    </form>
                    <br/>
                    <form class="col-sm-1" method="POST" action="/api/shop/{{$singleShop->id}}/workers/delete">
                        @csrf
                        <input type="submit" class="btn btn-danger" value="Delete all workers"/>
                    </form>
                </div>
            </div>
            <hr/>
        @endisset
        @isset($specialities)
            <div class="alert alert-dark">
            <h3>Filter workers by speciality</h3>
            <ul>
            @foreach($specialities as $speciality)
                    <li><a href="/api/worker/shop/{{$currentShopId ?? 1}}/speciality/{{$speciality->id}}">{{ $speciality->speciality_name }}</a></li>
                </br>
            @endforeach
            </ul>
            </div>
            <br/><br/>
        @endisset
@endsection
