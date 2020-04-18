<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Category;
use App\Product;
use App\Http\Requests\addProductResquest;
use Illuminate\Support\Facades\Storage;
use PhpParser\Node\Expr\New_;

class AdminController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    private function isAdmin()
    {
        $flag = false;
        if(auth()->user()->level==1)
            $flag=true;
        return $flag;
    }

    public function index()
    {
        if($this->isAdmin()){
            $products = Product::all();
            return view('admin.index',compact(['products']));
        } 
        return redirect()->route('index')->with('info','Credenciales insuficientes');
    }

    public function createProduct()
    {
        if($this->isAdmin()){
            $categories = Category::all();
            return view('admin.create-product',compact('categories'));
        } 
        return redirect()->route('index')->with('info','Credenciales insuficientes');
    }

    public function addNewProduct(addProductResquest $request)
    {
        $image = $request->file('image');
        $path = 'img/categories/'.$request->input('id_categories');
        $time = time();
        $image->move($path,$time.$image->getClientOriginalName());

        //insert into db
        $product = new Product();
        $product->description =$request->input('description');
        $product->price =$request->input('price');
        $product->stock =$request->input('stock');
        $product->image =$path.'/'.$time.$image->getClientOriginalName();
        $product->code =$request->input('code');
        $product->long_description =$request->input('long_description');
        $product->id_categories =$request->input('id_categories');
        $product->save();
        return redirect()->route('panel.admin')->with('admin.info','Producto agregar exitosamente');
    }

    public function deleteProduct($id)
    {
       $product = Product::findOrFail($id);
       Storage::disk('public')->delete($product->image);
       $product->delete();
       return redirect()->route('panel.admin')->with('admin.info','Producto eliminado con éxito');
    }

    public function editProduct($id)
    {
        if($this->isAdmin()){
            $product = Product::findOrFail($id);
            $categories = Category::all();
           return view('admin.edit-product',compact(['product','categories']));
        } 
        return redirect()->route('index')->with('info','Credenciales insuficientes');
    }

}
