<?php

namespace App\Http\Controllers;

use App\Product;
use App\Review;
use Illuminate\Http\Request;
use DB;
use App\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class ProductsController extends Controller
{
    protected function create(Request $request)
    {
        Product::create([
            'product_title' => $request['product_title'],
            'product_description' => $request['product_description'],
            'product_price' => $request['product_price'],
            'product_category' => $request['product_category'],
            'user_id' => auth()->user()->id,
        ]);
//        return url('ProductsController@show', ['id' => $this->create($request)->id]);
//        return redirect()->route('show', ['id' => $this->create()->id]);
//        $input = $request->all();
//        $id = $this->create($request)->id;
//        $extension = $request->file('image')->getClientOriginalExtension();
//        $request->file('image')->storeAs('public/images', "a.jpg");
//        Storage::putFileAs('/images', $request->file('image'),'file.jpg');
//        Storage::putFileAs(
//            'images', $request->file('image'), $request->user()->id
//        );
        $id = DB::getPdo()->lastInsertId();
        $request->file('image')->storeAs('public/images', $id.'.jpg');
        return redirect('product/'.$id);
    }

    public function show($id)
    {
        $product = Product::find($id);
        $reviews = Review::where('product_id', $id)->get();

        return view('pages.product')->with(['product' => $product, 'reviews' => $reviews, 'bought' => Session::get('bought') ?? '']);
    }

    public function createReview(Request $request, $id)
    {
        Review::create([
            'review' => $request['review'],
            'product_id' => $id,
            'user_id' => auth()->user()->id,
        ]);
        return back();
    }

    public function index(Request $request)
    {
        //Session::flush();
        $count = [];
        for ($i=1;$i<6;$i++)  {
//                    $count = [];
//                $ar = Product::withCount([ 'category' => function ($query) {
//                    $query->where('product_category', '=', $i);
//                }])->get();
//                $arr = array($i => Product::where('product_category', '=', $i)->count());
//                array_add($count, '1' , Product::where('product_category', '=', '1')->count());
            $push = Product::where('product_category', '=', $i)->count();
            array_push($count, $push);
        }
        if ($request['category']){
            $products = Product::where('product_category', '=', $request['category'])->paginate(10);
//            $count = Product::count('product_category', 'where', '=', $request['category']);
//            $count = array('a'=>'b');

            return view('pages.products')->with(['products'=> $products,'count'=>$count]);
        } else {
            $products = Product::orderBy('created_at', 'asc')->paginate(10);

            return view('pages.products')->with(['products'=> $products,'count'=>$count]);
        }


    }

    public function addToCart(Request $request, $id)
    {
       //Session::flush();
//        $product = Product::find($id);
//        $user = User::find(auth()->user()->id);
//        $user->cart = $user->cart.','.$product->id;
//        $user->save();

//        if ($request->session()->has('cart')) {
//            $ses = Session::get('cart');
//            array_push($ses, $id);
//            session('cart', $id);
//            $id = array($id, '1');
//            $request->session()->push('cart', $id);


            Session::push('cart', $id);
//        } else {
//            $request->session()->put('cart', $id);
//        }
//        return back()->with(Session::flash('message', 'Items added to cart!'));
        return back()->with('message', 'Items added to cart!');
    }

    public function viewCart(Request $request)
    {
//        var_dump(Session::get('cart'));
//        foreach (Session::get('cart') as $cart => $prod)
//
//                var_dump($prod);
//           echo $prod;
        $products = array();
        if (Session::has('cart'))
            foreach (Session::get('cart') as $id){
                array_push($products, Product::find($id));
            }

        return view('pages.cart')->with('products', $products);

//        } else {
//            return view('pages.cart')->with('products', $products);
//        }
    }

    public function removeFromCart($id)
    {
        // search for id in session, make copy, delete id, replace session
        for ($i = 0;$i < count(Session::get('cart'));$i++) {
            if (Session::get('cart')[$i] == $id) {
                $arr = Session::get('cart');
                array_splice($arr, $i, 1);
//                unset($arr[$i]);
                break;
            }
        }
        Session::put('cart', $arr);
        return back();
    }

    public function checkout()
    {
        $a=Session::get('cart');
        Session::push('bought', $a);
        Session::forget('cart');
//        return back()->with(Session::flash('message', 'Congratulations, items bought successfully!'));
        return redirect('home')->with('message', 'Congratulations, items bought successfully, leave a review!');
    }

    public function delete($id)
    {
       Product::find($id)->delete();
        return redirect('/')->with('message', 'Item deleted!');
    }

//    public function category(Request $request)
//    {
//
//       $products = Product::where('product_category', '=', $request['category'])->paginate(10);
////        return view('pages.products')->with('products', $products);
//        return redirect()->route('category', $request['category'])->with('products', $products);
//    }
}
