@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Employee Dashboard</div>

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
                <div class="card-header">See Today's Menu</div>
                <div class="card-body">
                    <a class="btn btn-primary" href="{{ route('menu.index') }}">View Menu</a>
                </div>
            </div>
        </div>
    </div>

    <br>

    <div>
        
        <h2>Orders Made by Mr/Mrs. {{ $user->name }}</h2>
        <ul>
            @foreach($orders as $order)
                <li>
                    <p>By: {{ $order->user_id }} </p>
                    <p>Food: {{ $order->food_id }} </p>
                    <p>Date: {{ $order->day }} </p>
                    <p>Taken?: {{ $order->is_taken }} </p>
                    <p>Completed: {{ $order->is_completed }} </p>
                    
                </li>
            @endforeach

        </ul>

    </div>

</div>
@endsection
