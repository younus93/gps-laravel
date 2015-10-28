@extends('layouts.app')

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <h3>Your Profile</h3>

                <table class="table table-bordered">
                    <tr>
                        <td>Name</td>
                        <td>{{ $user->name }}</td>
                    </tr>
                    <tr>
                        <td>Address</td>
                        <td>{{ $user->address }}</td>
                    </tr>
                   <tr>
                        <td>Phone</td>
                        <td>{{ $user->phone }}</td>
                    </tr>
                </table>

                <form action="{{ url('users/edituserpass') }}" method="POST">
                    {!! csrf_field() !!}
                    <input type="hidden" name="id" value="{{ $user->id }}">
                    <div class="form-group">
                        <label class="col-md-4 control-label">Current Password</label>

                        <div class="col-md-6">
                            <input type="password" class="form-control" name="password">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">New Password</label>

                        <div class="col-md-6">
                            <input type="password" class="form-control" name="new_password">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Confirm</label>

                        <div class="col-md-6">
                            <input type="password" class="form-control" name="password_confirm">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label"></label>

                        <div class="col-md-6">
                            <button class="btn btn-primary" type="submit">Change Password</button>
                        </div>

                    </div>
                </form>
            </div>
            <div class="col-md-6">
                <h3>Your Vehicles</h3>
                <table class="table table-bordered">
                    <thead>
                        <th>Vehicle Number</th>
                    </thead>
                    @foreach($vs as $v)
                        <tr>
                            <td>{{$v->vehicle_number}}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>

@stop