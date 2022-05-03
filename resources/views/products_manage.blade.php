@extends('base')

@section('title')
    Shops manage
@endsection

@section('content')
    <center>
        <div class="alert alert-primary" id="links-block">
            <a class="btn btn-outline-primary" href="/api/product">Products</a>
            <a class="btn btn-outline-primary" href="/api/product-manufacturer">Manufacturers</a>
            <a class="btn btn-outline-primary" href="/api/product-category">Categories</a>
            <a class="btn btn-outline-primary" href="/api/product-guarantee">Guaranties</a>
        </div>
    </center>
@endsection
