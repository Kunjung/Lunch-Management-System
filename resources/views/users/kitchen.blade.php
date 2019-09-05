@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Kitchen Dashboard</div>

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
                <div class="card-header">The Already Set Menu of the Day</div>

                <div class="card-body">
                    <a class="btn btn-primary" href="{{ route('menu.index') }}">View Today's Menu</a>
                </div>
            </div>
        </div>
    </div>

    <br>

    <h1> Responsibilities of the Kitchen Staff </h1>

    <div class="row justify-content-center">
        <div class="col-md-6">
            <h3>Task #1 </h3>
            <div class="card">
                <div class="card-header">Kitchen: Add new Food Items and Set Menu</div>

                <div class="card-body">
                    <a class="btn btn-primary" href="{{ route('food.index') }}">Go to the Kitchen Panel</a>
                </div>
            </div>
        </div>
        
        <div class="col-md-6">
            <h3>Task #2 </h3> 
            <div class="card">
                <div class="card-header">Take some Orders</div>

                <div class="card-body">
                    <a class="btn btn-primary" href="{{ route('takeorder.index') }}">Show Order Todos</a>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
