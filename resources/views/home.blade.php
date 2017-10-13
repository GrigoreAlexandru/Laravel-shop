@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @if(Session::has('message'))
            <p class="alert alert-success">{{ Session::get('message') }}</p>
        @endif
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">

                    @if(session('bought'))
                    <div class="panel-heading">You can now leave reviews for the items you bought:</div>

                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                            @foreach($products as $product)
                                {{--@for($i=0;$i<count($product);$i++)--}}
                                    {{--@if($product[$i] ==$product[$i + 1])--}}
                                @foreach($product as $prod)
                                    <ul class="list-group">
                                        <a href="product/{{$prod['id']}}"><li class="list-group-item">
                                            {{$prod['product_title']}}
                                        </li></a>
                                    </ul>

                                @endforeach
                            @endforeach
                    @else
                                <div class="panel-heading">You can now leave reviews for the items you bought:</div>

                                <div class="panel-body">
                    @endif
                        @if(auth()->user()->role > 0)
                            <a class="btn btn-default" href="{{url('/submit')}}">Create new product</a>
                        @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
