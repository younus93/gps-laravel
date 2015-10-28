@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-md-11">

        </div>
        <div class="col-md-1">
            <a href="{{ URL::previous() }}">
                <button class="btn btn-primary">Back</button>
            </a>
        </div>
    </div>


    @if($msg = \Illuminate\Support\Facades\Session::get('registerSuccess'))
        <div class="alert alert-success">
            <strong>Success!</strong> GPS Device <strong>{{ $msg['imei'] }}</strong> added to user.
            <br>

        </div>
    @endif
    <div class="row">
        <div class="col-md-4">
            <h3>User Information</h3>
            <table class="table table-condensed">
                <tr>
                    <td><b>Name</b></td>
                    <td>{{ $user->name }}</td>
                </tr>
                <tr>
                    <td><b>Email</b></td>
                    <td>{{ $user->email }}</td>
                </tr>
                <tr>
                    <td><b>Phone</b></td>
                    <td>+91-{{ $user->phone }}</td>
                </tr>
                <tr>
                    <td><b>Address</b></td>
                    <td>{{ $user->address }}</td>
                </tr>
                <tr>
                    <td><b>Created</b></td>
                    <td>{{ Carbon\Carbon::createFromTimestamp(strtotime($user->created_at))->toCookieString() }}</td>
                </tr>
            </table>
        </div>
        <div class="col-md-8">
            <h3>Device Information</h3>
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>IMEI Number</th>
                        <th>Vehicle Number</th>
                        <th>Sim number</th>
                        <th>Recharged at</th>
                        <th>Next Recharge</th>
                    </tr>
                </thead>
                @foreach($devices as $device)
                    <tr>
                        <td>{{ $device->imei}}</td>
                        <td>{{ $device->phone_number }}</td>
                        <td>{{ $device->vehicle_number }}</td>
                        <td>{{ $device->recharged_at }}</td>
                        <td>{{ $device->next_recharge }}</td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>

@stop