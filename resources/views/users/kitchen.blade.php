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
    </div>

    <br>

    <div class="row justify-content-center">
        <div class="col-md-4"> 
            <div class="card">
                <div class="card-header">Food Items</div>

                <div class="card-body">
                    <a class="btn btn-primary" href="{{ route('food.index') }}">View Food items</a>
                </div>
            </div>
        </div>
        <div class="col-md-4"> 
            <div class="card">
                <div class="card-header">Menu of the Day</div>

                <div class="card-body">
                    <a class="btn btn-primary" href="{{ route('menu.index') }}">View Menu</a>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
