@extends('layouts.app')
@section('titel', 'Product')
@section('content')
    <div class="container">
        @if(Session::has('message'))
            <p class="alert alert-info">{{ Session::get('message') }}</p>
        @endif
        <div class="row">
            <div class="col-md-12 ">
                <div class="panel panel-default clearfix">
                    <div class="panel-heading">{{$product->product_title}}</div>

                    <div class="panel-body ">
                        <div class="col-md-6 ">
                            <img style="max-width:50rem" src="{{asset('storage/images/'.$product->id.'.jpg')}}" alt="">
                        </div>
                        <div class="col-md-6 ">
                            <h4>{{$product->product_description}}</h4>

                    </div>
                    <form method="post" action="{{action('ProductsController@addToCart', $product->id)}}" >
                        <button type="submit" class="btn btn-primary pull-right" style="margin: 1rem;">Add to cart</button>
                        <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                    </form>
                    @if(auth()->user()->role > 0)
                    <form method="post" action="{{action('ProductsController@delete', $product->id)}}" >
                        <button type="submit" class="btn btn-danger pull-left" style="margin: 1rem;">delete</button>
                        <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                    </form>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Reviews</div>


                        @if(count($reviews) > 0)
                            @foreach($reviews as $review)
                            <div class="panel-body">
                                {{$review->review}}

                            </div>
                            @endforeach
                        @endif

                </div>
            </div>
        </div>

            @if(Session::get('bought'))
        @foreach($bought as $ids)

                    @foreach($ids as $id)
            @if($id == $product->id)
        <div>
            <button id="review-btn" class="btn btn-default">New Review</button>
            {{--<a class="btn btn-default" href="{{action('ProductsController@addToCart', $product->id)}}">Add to cart</a>--}}

            <div id="hidden-form" class="row" style="display:none;">
                <div class="col-md8">
                    <form method="post" action="{{action('ProductsController@createReview', $product->id)}}">
                        <div class="form-group">
                            <label for="product_title">review</label>
                            <textarea class="form-control" id="review" rows="3" name="review"></textarea>

                        </div>



                        <button type="submit" class="btn btn-primary">Submit</button>
                        <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        $( document ).ready(function() {
            $('#review-btn').on( "click", function () {
                $('#review-btn').hide();
                $('#hidden-form').show();
            } )
        });

    </script>
            @endif
    @endforeach
    @endforeach
    @endif
@endsection