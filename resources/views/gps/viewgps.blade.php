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

    <div class="container-fluid">

        <table class="table table-bordered" id="devices-table">
            <thead>
            <tr>
                <th>IMEI</th>
                <th>Vehicle Number</th>
                <th>User</th>
                <th>Recharged At</th>
                <th>Action</th>
            </tr>
            </thead>
        </table>

        @stop


        @section('ajax')
            <script>
                $(function() {
                    $('#devices-table').DataTable({
                        processing: true,
                        serverSide: true,
                        ajax: '{!! url('gpsData') !!}',
                        columns: [
                            { data: 'imei', name: 'IMEI' },
                            { data: 'vehicle_number', name: 'Vehicle Number' },
                            { data: 'user', name:'user'},
                            { data: 'recharged_at', name:'Recharged at'},
                            { data: 'action' , name: 'action'},
                        ],

                    });
                });
            </script>
@stop