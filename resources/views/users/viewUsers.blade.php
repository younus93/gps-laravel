@extends('layouts.app')

@section('header')

@stop

@section('content')

    <div class="container-fluid">

        <div class="row">
            <div class="col-md-11">
                <h3>User Information</h3>
            </div>
            <div class="col-md-1">
                <a href="{{ URL::previous() }}">
                    <button class="btn btn-primary">Back</button>
                </a>
            </div>
        </div>

        <div class="row">
            <table class="table table-bordered" id="users-table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Created</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>


@stop


@section('ajax')
    <script>
        $(function() {
            $('#users-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! url('userData') !!}',
                columns: [
                    { data: 'name', name: 'name' },
                    { data: 'email', name: 'email' },
                    { data: 'phone', name:'phone'},
                    { data: 'created_at', name: 'created_at'},
                    { data: 'action' , name: 'action'},
                ],

            });
        });
    </script>
@stop