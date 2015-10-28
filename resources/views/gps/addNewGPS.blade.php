@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-md-4">
            <h3>User Info</h3>
            <table class="table table-condensed table-hover">
                <tr>
                    <td>Name</td>
                    <td>{{ $user->name }}</td>
                </tr>
                <tr>
                    <td>Phone</td>
                    <td>{{ $user->phone }}</td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>{{ $user->email }}</td>
                </tr>
            </table>

            <form method="POST" action="{{ url('imei/add') }}">
                {!! csrf_field() !!}

                <div class="form-group">
                    IMEI Number
                    <input class="form-control"  type="text" name="imei" value="{{ old('imei') }}">
                </div>

                <div class="form-group">
                    <input class="form-control"  type="hidden" name="user_id" value="{{ $user->id }}">
                </div>

                <div class="form-group">
                    Sim Phone Number
                    <input class="form-control"  type="text" name="phone_number" value="{{ old('phone_number')  }}">
                </div>

                <div class="form-group">
                    Vehicle Number <br> (eg) TN-02-AL-9576
                    <input class="form-control"  type="text" name="vehicle_number" value="{{ old('vehicle_number') }}">
                </div>

                <div class="form-group">
                    <button class="btn btn-primary" type="submit">Register</button>
                </div>
            </form>
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>

        <div class="col-md-2"></div>

        <div class="col-md-6">
            <h3>Existing Devices</h3>
            <table class="table table-condensed">
                <thead>
                <tr>
                    <th>IMEI Number</th>
                    <th>Vehicle Number</th>
                    <th>Sim card number</th>
                </tr>
                </thead>
                @foreach($devices as $device)
                    <tr>
                        <td>{{ $device->imei}}</td>
                        <td>{{ $device->vehicle_number }}</td>
                        <td>{{ $device->phone_number }}</td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>

@stop