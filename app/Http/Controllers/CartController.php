<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Product;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\ChangeQuantityProductCartRequest;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        if(!Session::has('cart'))
            Session::put('cart',array());
    }

    public function cardShow()
    {
        $products = Session::get('cart');
        $total = $this->total();
        return view('shopping.cart-view',compact(['products','total']));
    }

    public function addCart(Request $request,$id)
    {
        $cart = Session::get('cart');
        $product = Product::findOrFail($id);
        $quantity =$request->input('quantity');
        $product->quantity = $quantity;
        
        if(array_key_exists($product->id,$cart))
        {
            $cart[$product->id]['quantity'] +=$product->quantity;
        }else
        {
            $cart[$product->id] =$product;
        }
        Session::put('cart',$cart);
        return redirect()->route('cart');
        
    }

    public function cartDropItem($id)
    {
        $cart = Session::get('cart');
        unset($cart[$id]);
        Session::put('cart',$cart);
        return back()->with('info','El producto se quitó de la lista');
    }

    public function clearCart()
    {
        Session::forget('cart');
        return back();
    }

    public function changeQuantityCart(ChangeQuantityProductCartRequest $request,$id)
    {
        $cart = Session::get('cart');
        $quantity = $request->input('quantity');
        if($quantity <= $cart[$id]->stock)
        {
            $cart[$id]->quantity = $quantity;
            Session::put('cart',$cart);
            return back()->with('info','Se ha cambiado la catidad.');
        }
        return back()->with('info','La cantidad supera lo disponible.');
    }

    public function cartDetail()
    {
        $products = Session::get('cart');
        if(count($products))
        {
            $isAvalible = $this->isAvalible($products);
            if($isAvalible)
            {
                $user = Auth::user();
                $total = $this->total();
                $costSend = 100;
                return view('shopping.cart-detail',compact(['products','total','costSend','user']));
            }
            return back()->with('info','Un producto de la lista supera lo disponible, recarga la página para ver el producto.');
        }
        return back()->with('info','Necesitas hacer por lo menos una compra.');
    }

    private function isAvalible($products)
    {
        $flag = true;
        foreach ($products as $prod) 
        {
            if($prod->quantity > $prod->stock)
            {
                $flag = false;
                break;
            }
        }
        return $flag;
    }

    private function total()
    {
        $products = Session::get('cart');
        $total =0;
        foreach($products as $product)
        {
           if(($product->wholesale_price && $product->quantity_wholesale_price) != null)
           {
                if($product->quantity >= $product->quantity_wholesale_price)
                {
                    $total +=( $product->quantity * $product->wholesale_price );
                    continue;
                }    
           }
           $total +=( $product->quantity * $product->price );
        }
        return $total;
    }
}
