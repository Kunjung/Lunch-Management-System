@extends('layouts.app')

@section('content')


<div class="container">
    
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Admin Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in! {{ $user }}
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Add New Kitchen Staff</div>

                <div class="card-body">
                    <a class="btn btn-primary" href="{{ route('user.create') }}">Add New</a>
                </div>
            </div>
        </div>

    </div>
    
    
    <h2 class="text-white bg-dark">Employees List</h2>
        
    @if($employees->count() == 0)

        <p class="lead text-danger">No Employee in the system.</p>

    @else

        <ol>
        @foreach($employees as $employee)
            <li>
                <div>
                
                    <h4> Name: {{ $employee->name }} </h4>
                    <p> Email: {{ $employee->email }} </p>

                    @if($employee->is_active)
                        <p> Active </p>

                    @else
                        <p> Not Activated </p>

                    @endif

                </div>
            </li>

        @endforeach
        </ol>

    @endif

    <br>

    <h2 class="text-white bg-dark">Kitchen Staff List</h2>
        
    @if($kitchen_staffs->count() == 0)

        <p class="lead text-danger">No Kitchen Staff in the system</p>

    @else
        <ol>
        @foreach($kitchen_staffs as $kitchen_staff)

            <li>
                <div>
                
                    <h4> {{ $kitchen_staff->name }} </h4>
                    <p> {{ $kitchen_staff->email }} </p>
                    
                    @if($kitchen_staff->is_active)
                        <p> Active </p>

                    @else
                        <p> Not Activated </p>

                    @endif

                </div>
            </li>

        @endforeach
        </ol>        

    @endif

    <br>
    <h2 class="text-white bg-dark">Waiting for Verification</h2>
        
    @if($not_activated_users->count() == 0)

        <p class="lead text-success">All done.</p>

    @else

        <ol>
        @foreach($not_activated_users as $not_activated_user)
            <li>
                <div>
                
                    <div class="row">
                        <div class="col col-sm-4"> 
                            <h3>Name: {{ $not_activated_user->name }}</h3>
                        </div>
                        <div class="col col-sm-8">
                        {!! Form::open(['route' => ['user.update', $not_activated_user->id], 'method' => 'PUT']) !!}
                            <h3><button type="submit" class="btn btn-sm btn-primary">Activate</button></h3>
                        {!! Form::close() !!}
                        </div>
                    </div>
                    
                    <p> Email: {{ $not_activated_user->email }} </p>

                    <p>Status <span class="text-danger">Not active</span></p>
                    

                </div>
            </li>
        @endforeach
        </ol>

    @endif


</div>
@endsection
