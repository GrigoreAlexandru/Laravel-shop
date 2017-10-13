@extends('layouts.app')
@section('titel', 'Product')
@section('content')
    <div class="container">


        <div class="row">



            @if(Session::has('message'))
                <p class="alert alert-success">{{ Session::get('message') }}</p>
            @endif
            @if(count($products) > 0)
                @foreach($products as $product)
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading"><a href="product/{{$product->id}}">{{$product->product_title}}</a></div>
                            <div class="panel-body">
                                {{--{{$product->product_title}} <br>--}}
                                <p style="display: block;">{{$product->product_price}}</p>

                                <form method="post" action="{{action('ProductsController@removeFromCart', $product->id)}}">
                                    <button type="submit" class="btn btn-danger pull-right" style="margin: 1rem;display: block;">remove</button>
                                    <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                                </form>

                                {{--<a href="{{url('/checkout')}}">check</a>--}}
                            </div>
                        </div>

                    </div>

                @endforeach
                    <form class="pull-right" method="post" action="{{action('ProductsController@checkout')}}">
                        <button type="submit" class="btn btn-success">Buy all</button>
                        <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                    </form>
            @else
                <div class="col-md-6 col-md-offset-5">
                <h3>Your cart is empty</h3>
                </div>
            @endif



        </div>


    </div>

@endsection