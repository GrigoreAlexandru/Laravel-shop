@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Dashboard</div>

                    <div class="panel-body">
                        <form method="post" action="{{url('/create')}}" enctype="multipart/form-data">
                             <div class="form-group">
                                <label for="product_title">Title</label>
                                <input class="form-control" id="product_title" rows="3" name="product_title"></input>
                            </div>
                            <div class="form-group">
                                <label for="product_title">Description</label>
                                <textarea class="form-control" id="product_title" rows="3" name="product_description"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="product_title">Price</label>
                                <input step="0.01" type="number" class="form-control" id="product_title" rows="3" name="product_price"></input>
                            </div>
                            <div class="form-group">
                                <label for="product_category">product_category</label>
                                <br>
                                <select name="product_category" id="product_category">
                                    <option value="1">Women's Clothing</option>
                                    <option value="2">Men's Clothing</option>
                                    <option value="3">Phones</option>
                                    <option value="4">Computers</option>
                                    <option value="5">Electronics</option>
                                </select>
                                <br>
                                Select image to upload:
                                <input type="file" name="image" id="fileToUpload">
                            </div>


                            <button type="submit" class="btn btn-primary">Submit</button>
                            <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection