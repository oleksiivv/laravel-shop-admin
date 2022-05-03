@extends('base')

@section('title')
    Categories
@endsection

@section('content')
        @isset($categories)
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
                        <td><a href="/api/product-category/{{$category->id}}">Open</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <hr />
            <div class="alert alert-success">
                <h3>Create new category</h3>
                <form method="POST" action="/api/product-category/create">
                    @csrf
                    <input type="text" name="name" class="form-control" placeholder="Title: "/>
                    </br>
                    <input type="text" name="description" class="form-control" placeholder="Description: "/>
                    </br>
                    <input type="submit" class="btn btn-success"/>
                </form>
            </div>
        @endisset
        @isset($singleCategory)
            <table class="table table-bordered">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Description</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <th scope="row">{{ $singleCategory->id }}</th>
                    <td>{{ $singleCategory->name }}</td>
                    <td>{{ $singleCategory->description }}</td>
                </tr>
                </tbody>
            </table>
            <hr/>

            <div class="alert alert-warning">
                <h3>Update</h3>
                <form method="POST" action="/api/product-category/{{$singleCategory->id}}/update">
                    @csrf
                    <input type="text" name="name" class="form-control" value="{{$singleCategory->name}}" placeholder="Title: "/>
                    </br>
                    <input type="text" name="description" class="form-control" value="{{$singleCategory->description}}" placeholder="Description: "/>
                    </br>
                    <input type="submit" class="btn btn-warning"/>
                </form>

                <h3>Warning</h3>
                <div class="row">
                    <form class="col-sm-1" method="POST" action="/api/product-category/{{$singleCategory->id}}/delete">
                        @csrf
                        <input type="submit" class="btn btn-danger" value="Delete"/>
                    </form>

                    <form class="col-sm-1" method="POST" action="/api/product-category/{{$singleCategory->id}}/products/delete">
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
