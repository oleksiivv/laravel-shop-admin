@extends('base')

@section('title')
    Specialities
@endsection

@section('content')
        @isset($specialities)
            <table class="table table-bordered">
                    <thead class="thead-dark">
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
                            <td><a href="/api/worker-speciality/{{$speciality->id}}">Choose</a></td>
                        </tr>
                    @endforeach
                    </tbody>
            </table>
            <hr />
            <div class="alert alert-success">
                <h3>Create new speciality</h3>
                <form method="POST" action="/api/worker-speciality/create">
                    @csrf
                    <input type="text" name="speciality_name" class="form-control" placeholder="First name: "/>
                    </br>
                    <input type="submit" class="btn btn-success" value="Create"/>
                </form>
            </div>
        @endisset
        @isset($singleSpeciality)
            <table class="table table-bordered">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Created at</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <th scope="row">{{$singleSpeciality->id}}</th>
                    <td>{{ $singleSpeciality->speciality_name }}</td>
                    <td>{{ $singleSpeciality->created_at }}</td>
                </tr>
                </tbody>
            </table>
            <div class="alert alert-warning">
                <h3>Update</h3>
                <form method="POST" action="/api/worker-speciality/{{$singleSpeciality->id}}/update">
                    @csrf
                    <input type="text" name="speciality_name" class="form-control" value="{{ $singleSpeciality->speciality_name }}" placeholder="Name: "/>
                    </br>
                    <input type="submit" class="btn btn-warning" value="Update"/>
                </form>

                <h3>Warning</h3>
                <div class="row">
                <form class="col-sm-1" method="POST" action="/api/worker-speciality/{{$singleSpeciality->id}}/delete">
                    @csrf
                    <input type="submit" class="btn btn-danger" value="Delete"/>
                </form>
                <!--<form class="col-sm-1" method="POST" action="/api/worker-speciality/{{$singleSpeciality->id}}/delete">
                    @csrf
                    <input type="submit" class="btn btn-danger" value="Delete all workers"/>
                </form>-->
            </div>
        @endisset
@endsection
