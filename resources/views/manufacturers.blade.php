@extends('base')

@section('title')
    Manufacturers
@endsection

@section('content')
        @isset($manufacturers)
            <table class="table table-bordered">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($manufacturers as $manufacturer)
                    <tr>
                        <th scope="row">{{$manufacturer->id}}</th>
                        <td>{{ $manufacturer->name }}</td>
                        <td><a href="/api/product-manufacturer/{{$manufacturer->id}}">Open</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <hr />
            <div class="alert alert-success">
                <h3>Create new manufacturer</h3>
                <form method="POST" action="/api/product-manufacturer/create">
                    @csrf
                    <input type="text" name="name" class="form-control" placeholder="Title: "/>
                    </br>
                    <input type="number" name="raiting" min="0.0" max="5.0" step="0.05" class="form-control" placeholder="Raiting: "/>
                    </br>
                    <input type="text" name="address" class="form-control" placeholder="Address: "/>
                    </br>
                    <input type="url" name="address" class="form-control" placeholder="Site: "/>
                    </br>
                    <input type="submit" class="btn btn-success"/>
                </form>
            </div>
        @endisset
        @isset($singleManufacturer)
            <table class="table table-bordered">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Raiting</th>
                    <th scope="col">Site</th>
                    <th scope="col">Address</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <th scope="row">{{ $singleManufacturer->id }}</th>
                    <td>{{ $singleManufacturer->name }}</td>
                    <td>{{ $singleManufacturer->raiting }}</td>
                    <td>{{ $singleManufacturer->information['site'] }}</td>
                    <td>{{ $singleManufacturer->information['address'] }}</td>
                </tr>
                </tbody>
            </table>
            <hr/>
            <div class="alert alert-warning">
                <h3>Update</h3>
                <form method="POST" action="/api/product-manufacturer/{{$singleManufacturer->id}}/update">
                    @csrf
                    <input type="text" name="name" class="form-control" value="{{ $singleManufacturer->name }}" placeholder="Title: "/>
                    </br>
                    <input type="number" name="raiting" min="0.0" max="5.0" step="0.05" class="form-control" value="{{ $singleManufacturer->raiting }}" placeholder="Raiting: "/>
                    </br>
                    <input type="text" name="address" class="form-control" value="{{ $singleManufacturer->information['address'] }}" placeholder="Address: "/>
                    </br>
                    <input type="url" name="site" class="form-control" value="{{ $singleManufacturer->information['site'] }}" placeholder="Site: "/>
                    </br>
                    <input type="submit" class="btn btn-warning"/>
                </form>

                <h3>Warning</h3>
                <div class="row">
                <form class="col-sm-1" method="POST" action="/api/product-manufacturer/{{$singleManufacturer->id}}/delete">
                    @csrf
                    <input type="submit" class="btn btn-danger" value="Delete"/>
                </form>

                <form class="col-sm-1" method="POST" action="/api/product-manufacturer/{{$singleManufacturer->id}}/products/delete">
                    @csrf
                    <input type="submit" class="btn btn-danger" value="Delete all products"/>
                </form>
                </div>
            </div>
        @endisset
        @isset($products)
            <h1>Products</h1>
            <table class="table table-hover">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($products as $product)
                    <tr>
                        <th scope="row">{{ $product->id }}</th>
                        <td>{{ $product->name }}</td>
                        <td><a href="/api/product/{{$product->id}}">Open</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <br/>
        @endisset
@endsection
