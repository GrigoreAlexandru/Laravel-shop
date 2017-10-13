@extends('layouts.app')
@section('titel', 'Product')
@section('content')

    <div class="col-md-2">
        <ul class="list-group">
            <li class="list-group-item">
                <a href="{{url('/')}}">All</a>
            </li>
            <li class="list-group-item">
                <a href="{{url('/category/1')}}">Women's Clothing <span class="badge pull-right">{{$count[0]}}</span></a>
            </li>
            <li class="list-group-item">
                <a href="{{url('/category/2')}}">Men's Clothing <span class="badge pull-right">{{$count[1]}}</span></a>
            </li>
            <li class="list-group-item">
                <a href="{{url('/category/3')}}">Phones <span class="badge pull-right">{{$count[2]}}</span></a>
            </li>
            <li class="list-group-item">
                <a href="{{url('/category/4')}}">Computers <span class="badge pull-right">{{$count[3]}}</span></a>
            </li>
            <li class="list-group-item">
                <a href="{{url('/category/5')}}">Electronics <span class="badge pull-right">{{$count[4]}}</span></a>
            </li>
        </ul>
    </div>
    <div class="container">


        <div class="row">

            {{--<form method="post" action="{{action('ProductsController@index')}}">--}}
            {{--<select name="category">--}}
                {{--<option value="1">Women's Clothing</option>--}}
                {{--<option value="2">Men's Clothing</option>--}}
                {{--<option value="3">Phones</option>--}}
                {{--<option value="4">Computers</option>--}}
                {{--<option value="5">Electronics</option>--}}
            {{--</select>--}}
                {{--<button type="submit" class="btn btn-primary">remove</button>--}}
                {{--<input name="_token" type="hidden" value="{{ csrf_token() }}"/>--}}
            {{--</form>--}}
            @if(Session::has('message'))
                <p class="alert alert-info">{{ Session::get('message') }}</p>
            @endif

            <div class="col-md-10">
                    @if(count($products) > 0)
                        @foreach($products as $product)
                    <div class="col-md-4">
                        <div class="panel panel-default clearfix">
                            <div class="panel-heading"><a href="product/{{$product->id}}">{{$product->product_title}}</a></div>
                            <div class="panel-body" style="overflow: hidden;">
                                <a href="product/{{$product->id}}"> <img style="max-width: 200px;" src="{{asset('storage/images/'.$product->id.'.jpg')}}" alt=""></a>
                                {{$product->product_description}}
                            </div>
                            <form method="post" action="{{action('ProductsController@addToCart', $product->id)}}">
                                <button type="submit" class="btn btn-primary pull-right" style="margin: 1rem;">Add to cart</button>
                                <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                            </form>
                        </div>
                    </div>
                        @endforeach

                    @endif
            </div>


        </div>

        {{ $products->links() }}
    </div>

    {{--<script>--}}
        {{--$( document ).ready(function() {--}}
            {{--$('#review-btn').on( "click", function () {--}}
                {{--$('#review-btn').hide();--}}
                {{--$('#hidden-form').show();--}}
            {{--} )--}}
        {{--});--}}

    {{--</script>--}}
@endsection