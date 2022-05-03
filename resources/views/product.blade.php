@extends('base')

@section('title')
    Products
@endsection

@section('content')
        @isset($products)
            @if($products->count() == 0)
                <div class="alert alert-danger">
                    <h3>Products not found</h3>
                </div>
            @else
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
            @endif
            <hr/>
        @endisset
        @isset($currentCategoryId)
            @isset($currentManufacturerId)
                @isset($currentGuaranteeId)
                    <div class="alert alert-success">
                        <h3>Create new product</h3>
                        <form method="POST" action="/api/product/category/{{ $currentCategoryId }}/manufacturer/{{ $currentManufacturerId ?? 1 }}/guarantee/{{ $currentGuaranteeId ?? 1 }}/create">
                            @csrf
                            <input type="text" name="name" class="form-control" placeholder="Title: "/>
                            </br>
                            <input type="text" name="description" class="form-control" placeholder="Description: "/>
                            </br>
                            <input type="number" name="current_price" class="form-control" placeholder="Current price: "/>
                            </br>
                            <input type="submit" class="btn btn-success"/>
                        </form>
                    </div>
                @endisset
            @endisset
        @endisset
        @isset($singleProduct)
            <table class="table table-hover">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Current price</th>
                    <th scope="col">Category</th>
                    <th scope="col">Guarantee</th>
                    <th scope="col">Manufacturer</th>
                    <th scope="col">Description</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <th scope="row">{{ $singleProduct->id }}</th>
                    <td>{{ $singleProduct->name }}</td>
                    <td>{{ $singleProduct->current_price }}</td>
                    <td><a href="/api/product-category/{{$singleProduct->category_id}}">{{ $singleProduct->productCategory->name }}</a></td>
                    <td><a href="/api/product-guarantee/{{$singleProduct->guarantee_id}}">{{ $singleProduct->productGuarantee->name }}</a></td>
                    <td><a href="/api/product-manufacturer/{{$singleProduct->manufacturer_id}}">{{ $singleProduct->productManufacturer->name }}</a></td>
                    <td>{{ $singleProduct->information['description'] }}</td>
                </tr>
                </tbody>
            </table>
            <hr/>
            <div class="alert alert-warning">
                <h3>Update</h3>
                <form method="POST" action="/api/product/{{$singleProduct->id}}/update">
                    @csrf
                    <input type="text" name="name" class="form-control" value="{{ $singleProduct->name }}" placeholder="Title: "/>
                    </br>
                    <input type="text" name="description" class="form-control" value="{{ $singleProduct->information['description'] }}" placeholder="Description: "/>
                    </br>
                    <input type="number" name="current_price" class="form-control" value="{{ (float) $singleProduct->current_price }}" placeholder="Current price: "/>
                    </br>
                    <input type="submit" class="btn btn-warning"/>
                </form>

                <h3>Warning</h3>
                <form method="POST" action="/api/product/{{$singleProduct->id}}/delete">
                    @csrf
                    <input type="submit" class="btn btn-danger" value="Delete"/>
                </form>
            </div>
        @endisset
        @isset($categories)
            <h2>Filter by category</h2>
            <table class="table table-hover">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($categories as $category)
                    <tr>
                        <th scope="row">{{ $category->id }}</th>
                        <td>{{ $category->name }}</td>
                        <td><a href="{{ url()->current().'?'.http_build_query(array_merge(request()->all(),['category' => $category->id]))}}">Choose</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endisset
        @isset($manufacturers)
            <h2>Filter by manufacturer</h2>
            <table class="table table-hover">
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
                        <td><a href="{{ url()->current().'?'.http_build_query(array_merge(request()->all(),['manufacturer' => $manufacturer->id]))}}">Choose</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endisset
        @isset($guaranties)
            <h2>Filter by guarantee</h2>
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
                        <td><a href="{{ url()->current().'?'.http_build_query(array_merge(request()->all(),['guaranty' => $guarantee->id]))}}">Choose</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <br/>
        @endisset
@endsection
