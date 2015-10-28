@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-11">

            </div>
            <div class="col-md-1">
                <a href="{{ URL::previous() }}">
                    <button class="btn btn-primary">Back</button>
                </a>
            </div>
        </div>

        <div class="row">
            @if($msg = \Illuminate\Support\Facades\Session::get('rechargeSuccess'))
                <div class="alert alert-success">
                    <strong>Success!</strong> {{ $msg }}
                    <br>

                </div>
            @endif

        <div class="row">
            <div class="col-md-6">
                <h4>GPS Device Information</h4>
                <table class="table table-bordered">
                    <tr>
                        <td><b>IMEI</b></td>
                        <td>{{ $device->imei }}</td>
                    </tr>
                    <tr>
                        <td><b>User</b></td>
                        <td>{{$user}}</td>
                    </tr>
                    <tr>
                        <td><b>Vehicle number</b></td>
                        <td>{{ $device->vehicle_number }}</td>
                    </tr>
                    <tr>
                        <td><b>Created</b></td>
                        <td>{{ Carbon\Carbon::createFromTimestamp(strtotime($device->created_at))->toCookieString() }}</td>
                    </tr>
                </table>

                <h4>Recharge Device</h4>

                <form action="{{url('gps/recharge')}}" method="POST">
                    {!! csrf_field() !!}
                    <input type="hidden" name="imei_id" value="{{$device->id}}">
                    <div class="form-group">
                        <label class="col-md-4 control-label">Recharge Method*</label>

                        <div class="col-md-6">
                            <input type="text" class="form-control" name="recharge_method">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-4 control-label">Transaction ID</label>

                        <div class="col-md-6">
                            <input type="text" class="form-control" name="transaction_id">
                        </div>
                    </div>
                    <div class="form-group">

                        <div class="col-md-6">
                            <button class="btn btn-primary">
                                Submit Recharge
                            </button>
                        </div>
                    </div>

                </form>
            </div>
            <div class="col-md-6">
                <h4>Recharge History</h4>
                <table class="table table-bordered">
                    <thead>
                        <th>Date</th>
                        <th>Method</th>
                    </thead>
                    @foreach($recharges as $r)
                        <tr>
                            <td>{{ Carbon\Carbon::createFromTimestamp(strtotime($r->recharge_date))->toCookieString() }}</td>
                            <td>{{ $r->recharge_method }}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@stop