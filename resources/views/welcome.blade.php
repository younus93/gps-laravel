@extends('layouts.app')

@section('content')
    <h2>Hello world</h2>
    <div class="row">
        <div class="col-md-8">

        </div>
        <div class="col-md-4">

            @if(!auth()->user())
                @include('auth.login')
            @endif
        </div>
    </div>
@stop