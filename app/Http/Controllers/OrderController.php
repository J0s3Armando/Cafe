<?php

namespace App\Http\Controllers;
use App\Order;
use App\Product;
use App\User;
use Barryvdh\DomPDF\PDF;
use Illuminate\Foundation\Console\DownCommand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        if(!Session::has('cart'))
             Session::put('cart',array());
    }

    public function downloadOrderPDF($id)
    {
        $user = Auth::user();
        $order = Order::findOrFail($id);

        if($order->user->id == $user->id)
        {   
            $products = $order->Products;
            $pdf = \PDF::loadView('orders.order-relationPDF',['products'=>$products,'order'=>$order]);
            return $pdf->download('Pedido_'.$id.'_pago_'.now()->format('d-m-Y-H-i-s').'.pdf');
        }
        return back();
    }

    public function ordersView()
    {
        $user = Auth::user();
        $orders = $user->Orders->where('status',Order::PENDING);
        return view('orders.orders',compact('orders'));
    }

    public function userListOrder($id)
    {
        $user = Auth::user();
        $order = Order::findOrFail($id);

        if($order->user->id == $user->id)
        {   $total =0;
            $products = $order->Products;
            
            foreach($products as $product)
            {
               $total += $product->pivot->total;
            }
            return view('orders.list-products',compact(['products','total']));
        }
        return back();
    }

    public function  createOrder()
    {
        $products = Session::get('cart');
        if(count($products))
        {
            $total = $this->total();
            $order = Order::create(
                [
                    'id_user' =>Auth::user()->id,
                    'subTotal' =>$total,
                    'send' =>Order::SEND,
                    'total' =>Order::SEND + $total,
                ]
            );
    
            foreach($products as $product)
            {
               $this->reduceQuantity($product);
               $this->newOrder($product,$order);
            }
            Session::forget('cart'); 
            return redirect()->route('orders')->with('info','Se ha realizado su pedido. 
            Descarga el PDF para realizar tu pago en cualquier sucursal bancaria y/o tienda
             de conveniencia de tu preferencia. Contáctanos cuando hayas realizado el pago para enviar tu pedido.');
        }
        return redirect()->route('orders')->with('info','Este pedido ya se ha realizado.'); 
    }

    private function newOrder($product,$order)
    {
        $price_sold=0;
        $total =0;
        if(($product->wholesale_price && $product->quantity_wholesale_price) != null)
        {
            if($product->quantity >= $product->quantity_wholesale_price)
            {
                $total =( $product->quantity * $product->wholesale_price );
                $price_sold = $product->wholesale_price ;
            }
            else{
                $total =( $product->quantity * $product->price );
                $price_sold = $product->price ;
            }
        }
        else{
            $total =( $product->quantity * $product->price );
            $price_sold = $product->price ;
        }
        
       $order->Products()->attach(
                                    $order->id,[
                                    'id_product'=> $product->id,
                                    'price_sold' => $price_sold,
                                    'quantity' => $product->quantity,
                                    'total' => $total]
                                 );
    }

    private function reduceQuantity($product)
    {
        $prod = Product::findOrFail($product->id);
        $prod->stock -= $product->quantity;
        $prod->save();
    }

    private function total()
    {
        $products =Session::get('cart');
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
