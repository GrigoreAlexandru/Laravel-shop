<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use phpDocumentor\Reflection\DocBlock\Tags\See;
use App\Product;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        print_r(Session::get('bought'));

        if (Session::get('bought')){
            $products = [];
            foreach (Session::get('bought') as $id){
                $push = Product::find($id);
                array_push($products, $push);
            }
//            $items = Product::orderBy('created_at', 'desc')->where('id','=',$id);
            return view('home')->with('products',$products);
        }
        return view('home');
    }
}
