<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Category;
use App\Product;
use App\Order;
use Illuminate\Http\Request;

use App\Http\Requests;
use Session;
use Auth;
use Stripe\Charge;
use Stripe\Stripe;

class ProductController extends Controller
{
    public function getIndex()
    {
        $products = Product::paginate(6);
        return view('shop.index', ['products' => $products]);
    }

    public function getAddToCart(Request $request, $id)
    {
        $product = Product::find($id);
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->add($product, $product->id);

        $request->session()->put('cart', $cart);
        return redirect()->route('product.index');
    }

    public function getReduceByOne($id) {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->reduceByOne($id);

        if (count($cart->items) > 0) {
            Session::put('cart', $cart);
        } else {
            Session::forget('cart');
        }
        return redirect()->route('product.shoppingCart');
    }

    public function getRemoveItem($id) {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->removeItem($id);

        if (count($cart->items) > 0) {
            Session::put('cart', $cart);
        } else {
            Session::forget('cart');
        }

        return redirect()->route('product.shoppingCart');
    }

    public function getCart()
    {
        if (!Session::has('cart')) {
            return view('shop.shopping-cart');
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        return view('shop.shopping-cart', ['products' => $cart->items, 'totalPrice' => $cart->totalPrice]);
    }

    public function getCheckout()
    {
        if (!Session::has('cart')) {
            return view('shop.shopping-cart');
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        $total = $cart->totalPrice;
        return view('shop.checkout', ['total' => $total]);
    }

    public function postCheckout(Request $request)
    {
        if (!Session::has('cart')) {
            return redirect()->route('shop.shoppingCart');
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);

        Stripe::setApiKey('sk_test_fwmVPdJfpkmwlQRedXec5IxR');
        try {
           /* $charge = Charge::create(array(
                "amount" => $cart->totalPrice * 100,
                "currency" => "usd",
                "source" => $request->input('stripeToken'), // obtained with Stripe.js
                "description" => "Test Charge"
            ));*/
            $order = new Order();
            $order->cart = serialize($cart);
            $order->address = $request->input('address');
            $order->name = $request->input('name');
            //$order->payment_id = $charge->id;
            
            Auth::user()->orders()->save($order);
        } catch (\Exception $e) {
            return redirect()->route('checkout')->with('error', $e->getMessage());
        }

        Session::forget('cart');
        return redirect()->route('product.index')->with('success', 'Successfully purchased products!');
    }

    /*=============== Admin for add , remove , update products ============*/

    /*===================================================================*/

    public function getProducts(){
        $products=Product::all();

        return view('admin.products',['products'=>$products]);

    }


    /* ================ search for products===========*/


    public function getSearch(Request $request){
        $search=request()->input('search');


        $products=Product::where('title','LIKE','%'.$search.'%')->get();

        if (!count($products)>0){

            $products=Product::all();
        }


        return view('admin.products',[
            'products'=>$products
        ]);





    }









    public function getProductsByCategory($id){
        $category=Category::find($id);
            $products=$category->products;
            $category_name=$category->name;
            $category_id=$category->id;


        return view('admin.products-by-category',[
            'products'=>$products,
            'category_name'=>$category_name,
            'category_id'=>$category_id

        ]);
       /* return view('admin.products-by-category');
        return "sorry No items ";*/

    }


    public function postDeleteOrUpdate(Request $request){

        $data = $request->all();
        $product=Product::find($request->input('id'));


        if(isset($data['delete'])){

            if($product)
                $product->delete();
            return redirect()->back();
        }

        if(isset($data['update'])){

            $product->title=$request->input('title');
            $product->update();
            return redirect()->back();
        }

    }

    public function postAdd(Request $request){
        $data=$request->all();

        if(isset($data['add'])){
            $product=new Product();
            $product->title=$request->input('title');
            $product->category_id=$request->input('category_id');

            $product->save();
            return redirect()->back();
        }

    }





}
