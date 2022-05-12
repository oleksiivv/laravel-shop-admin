@extends('base')

@section('title')
    Guaranties
@endsection

@section('content')
        @isset($guaranties)
            <table class="table table-hover">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($guaranties as $guarantee)
                    <tr>
                        <th scope="row">{{$guarantee->id}}</th>
                        <td>{{ $guarantee->name }}</td>
                        <td><a href="/api/product-guarantee/{{$guarantee->id}}">Open</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <hr />
            <div class="alert alert-success">
                <h3>Create new guarantee</h3>
                <form method="POST" action="/api/product-guarantee/create">
                    @csrf
                    <input type="text" name="name" class="form-control" placeholder="Title: "/>
                    </br>
                    <input type="text" name="description" class="form-control" placeholder="Description: "/>
                    </br>
                    <input type="datetime-local" name="valid_from" class="form-control" placeholder="Valid from: "/>
                    </br>
                    <input type="datetime-local" name="valid_till" class="form-control" placeholder="Valid till: "/>
                    </br>
                    <input type="number" name="price" class="form-control" min="0.0" step="0.1" max="1000.0" placeholder="Price: "/>
                    </br>
                    <input type="submit" class="btn btn-success"/>
                </form>
            </div>
        @endisset
        @isset($singleGuarantee)
            <table class="table table-bordered">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Price</th>
                    <th scope="col">Valid from</th>
                    <th scope="col">Valid till</th>
                    <th scope="col">Description</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <th scope="row">{{ $singleGuarantee->id }}</th>
                    <td>{{ $singleGuarantee->name }}</td>
                    <td>{{ (float) $singleGuarantee->price }}</td>
                    <td>{{ $singleGuarantee->valid_from }}</td>
                    <td>{{ $singleGuarantee->valid_till }}</td>
                    <td>{{ $singleGuarantee->description }}</td>
                </tr>
                </tbody>
            </table>
            <hr/>
            <div class="alert alert-warning">
                <h3>Update</h3>
                <form method="POST" action="/api/product-guarantee/{{$singleGuarantee->id}}/update">
                    @csrf
                    <input type="text" name="name" value="{{ $singleGuarantee->name }}" class="form-control" placeholder="Title: "/>
                    </br>
                    <input type="text" name="description" value="{{ $singleGuarantee->description }}" class="form-control" placeholder="Description: "/>
                    </br>
                    <input type="datetime-local" name="valid_from" value="{{old('time')?? date('Y-m-d\TH:i', strtotime(\Carbon\Carbon::parse($singleGuarantee->valid_from)->format("d-m-YTH:i"))) }}" class="form-control" placeholder="Valid from: "/>
                    </br>
                    <input type="datetime-local" name="valid_till" value="{{old('time')?? date('Y-m-d\TH:i', strtotime(\Carbon\Carbon::parse($singleGuarantee->valid_till)->format("d-m-YTH:i"))) }}" class="form-control" placeholder="Valid till: "/>
                    </br>
                    <input type="number" name="price" class="form-control" value="{{ (float) $singleGuarantee->price }}" min="0.0" step="0.1" max="1000.0" placeholder="Price: "/>
                    </br>
                    <input type="submit" class="btn btn-warning"/>
                </form>

                <h3>Warning</h3>
                <form method="POST" action="/api/product-guarantee/{{$singleGuarantee->id}}/delete">
                    @csrf
                    <input type="submit" class="btn btn-danger" value="Delete"/>
                </form>
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
