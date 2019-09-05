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
        <table class="table table-bordered text-white bg-dark">
            <tr>
                <th> Made by Employee </th>
                <th> Food Name </th>
                <th> Food Category </th>
                <th> Day </th>
                <th> Is Taken? </th>
                <th> Is Completed? </th>
            </tr>

            @foreach($orders_info as $order_info)
                
                @if($order_info[5] == 1)
                    <tr class="text-success">
                @else
                    @if($order_info[4] == 1)
                        <tr class="text-warning">
                    @else
                        <tr class="font-italic text-danger">
                    @endif
                @endif
                        <td> {{ $order_info[0] }} </td>
                        <td> {{ $order_info[1] }} </td>
                        <td> {{ $order_info[2] }} </td>
                        <td> {{ $order_info[3] }} </td>
                        <td> <b>{{ $order_info[4] }}</b> </td>
                        <td> <b>{{ $order_info[5] }}</b> </td>
                    </tr>

            @endforeach             
        </table>

    </div>

</div>
@endsection
