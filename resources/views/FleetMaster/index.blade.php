@extends('layouts.client')

@section('content')

    <div class="container-fluid"><h2>Vehicle Information Central</h2>

    <table class="table table-striped">

            <thead>
                <tr>
                    <th></th>
                    <th>Vehicle Number</th>
                    <th>Current Location</th>
                    <th>Speed</th>
                    <th>Location update</th>
                    <th>Track</th>
                </tr>
            </thead>
            {{-- */$i=1;/* --}}
            @foreach($details as $detail)
            <tr>
                <td>{{ $i++ }}</td>
                <td>{{ $detail['vehicleNumber'] }}</td>
                <td>{{ $detail['location'] }}</td>
                <td>{{ $detail['speed'] }}</td>
                <td>{{ Carbon\Carbon::createFromTimestamp(strtotime($detail['time']))->diffForHumans() }}</td>
                <td>
                    <a href="{{  url('/plot/'.$detail['vehicleNumber'].'/'.$detail['lat'].'/'.$detail['long'].'/'.$detail['speed']).'/'.$detail['location'] }}" target="_blank">
                        <button class="btn btn-success">Track</button>
                    </a>
                </td>
            </tr>
            @endforeach

    </table>
</div>
@stop