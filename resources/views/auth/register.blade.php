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
        <div class="row">
            @if($msg = \Illuminate\Support\Facades\Session::get('registerSuccess'))
                <div class="alert alert-success">
                    <strong>Success!</strong> New user <strong>{{ $msg['name'] }}</strong> has been registered.
                    <br>
                    Details for confirmation
                    <table class="table table-condensed">
                        <tr>
                            <td>Name</td>
                            <td>{{$msg['name']}}</td>
                        </tr>
                        <tr>
                            <td>Registered Email</td>
                            <td>{{$msg['email']}}</td>
                        </tr>
                        <tr>
                            <td>Registered Mobile</td>
                            <td>{{$msg['phone']}}</td>
                        </tr>
                        <tr>
                            <td>Address</td>
                            <td>{{$msg['address']}}</td>
                        </tr>
                    </table>
                </div>
            @endif


            <div class="row">
                <div class="col-md-6">
                    <form method="POST" action="/auth/register">
                        {!! csrf_field() !!}

                        <div class="form-group">
                            Name
                            <input class="form-control"  type="text" name="name" value="{{ old('name') }}">
                        </div>

                        <div class="form-group">
                            Email
                            <input class="form-control"  type="email" name="email" value="{{ old('email') }}">
                        </div>



                        <div class="form-group">
                            Phone
                            <div class="input-group">
                                <div class="input-group-addon">+91</div>
                                <input type="text" class="form-control" name="phone" value ="{{ old('phone') }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="comment">Address</label>
                            <textarea class="form-control" rows="5" name="address" >{{ old('address') }}</textarea>
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
                <div class="col-md-6">
                    <h3>Please ensure the details are correct</h3>
                    <p>List of things to remember</p>
                    <ul>
                        <li>Email address and phone number must be unique</li>
                        <li>By default, the phone number is the password</li>
                        <li>3</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>


@stop