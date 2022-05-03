@extends('base')

@section('title')
    Workers
@endsection

@section('content')
        @isset($workers)
            <table class="table table-hover">
                <caption>List of workers</caption>
                <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Email</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($workers as $worker)
                    <tr>
                        <th scope="row">{{$worker->id}}</th>
                        <td>{{ $worker->email }}</td>
                        <td><a href="/api/worker/{{$worker->id}}">Open</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            @if($workers->count() == 0)
                <div class="alert alert-danger"><h1>No workers found</h1></div>
            @endif
        @endisset

        <hr/>
        @isset($singleWorker)
            <table class="table table-hover">
                <caption>List of workers</caption>
                <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Email</th>
                    <th scope="col">First name</th>
                    <th scope="col">Last name</th>
                    <th scope="col">Experience</th>
                    <th scope="col">Shop</th>
                    <th scope="col">Speciality</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <th scope="row">{{ $singleWorker->id }}</th>
                    <td>{{ $singleWorker->email }}</td>
                    <td>{{ $singleWorker->first_name }}</td>
                    <td>{{ $singleWorker->last_name }}</td>
                    <td>{{ $singleWorker->month_of_experience }}m</td>
                    <td><a href="/api/shop/{{$singleWorker->shop_id}}">{{$singleWorker->shop->address}}</a></td>
                    <td><a href="/api/worker-speciality/{{$singleWorker->speciality_id}}">{{$singleWorker->speciality->speciality_name}}</a></td>
                </tr>
                </tbody>
            </table>
            <div class="alert alert-warning">
                <h3>Update</h3>
                <form method="POST" action="/api/worker/{{$singleWorker->id}}/update">
                    @csrf
                    <input type="text" name="first_name" class="form-control" value="{{ $singleWorker->first_name }}" placeholder="First name: "/>
                    </br>
                    <input type="text" name="last_name" class="form-control" value="{{ $singleWorker->last_name }}" placeholder="Last name: "/>
                    </br>
                    <input type="email" name="email" class="form-control" value="{{ $singleWorker->email }}" placeholder="Email: "/>
                    </br>
                    <input type="text" name="month_of_experience" class="form-control" value="{{ $singleWorker->month_of_experience }}" placeholder="Month of experience: "/>
                    </br>
                    <input type="submit" class="btn btn-warning" value="Update"/>
                </form>

                <h3>Warning</h3>
                <form method="POST" action="/api/worker/{{$singleWorker->id}}/delete">
                    @csrf
                    <input type="submit" class="btn btn-danger" value="Delete"/>
                </form>
            </div>
        @endisset
        <hr/>
        @isset($shops)
            <h2>Filter by shop</h2>
            <table class="table table-bordered">
                <thead>
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
                        <td><a href="/api/worker/shop/{{$shop->id}}">Choose</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endisset
        <hr/>
        @isset($specialities)
            <h2>Filter by speciality</h2>
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($specialities as $speciality)
                    <tr>
                        <th scope="row">{{$speciality->id}}</th>
                        <td>{{ $speciality->speciality_name }}</td>
                        <td><a href="/api/worker/shop/{{$currentShopId ?? 1}}/speciality/{{$speciality->id}}">Choose</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endisset
        <hr />
        @isset($currentSpecialityId)
            @isset($currentShopId)
            <div class="alert alert-success">
                <h3>Create new worker</h3>
                <form method="POST" action="/api/worker/shop/{{$currentShopId ?? 1}}/speciality/{{$currentSpecialityId ?? 1}}/create">
                    @csrf
                    <input type="text" name="first_name" class="form-control" placeholder="First name: "/>
                    </br>
                    <input type="text" name="last_name" class="form-control" placeholder="Last name: "/>
                    </br>
                    <input type="email" name="email" class="form-control" placeholder="Email: "/>
                    </br>
                    <input type="text" name="month_of_experience" class="form-control" placeholder="Month of experience: "/>
                    </br>
                    <input type="submit" class="btn btn-success" value="Create"/>
                </form>
            </div>
            <br/><br/>
            @endisset
        @endisset
@endsection
