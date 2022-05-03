@extends('base')

@section('title')
    Shops manage
@endsection

@section('content')
    <center>
        <div class="alert alert-primary" id="links-block">
            <a class="btn btn-outline-primary" href="/api/shop">Shops</a>
            <a class="btn btn-outline-primary" href="/api/worker">Workers</a>
            <a class="btn btn-outline-primary" href="/api/worker-speciality">Specialities</a>
            <a class="btn btn-outline-primary" href="/api/customer">Customer</a>
        </div>
    </center>
@endsection
