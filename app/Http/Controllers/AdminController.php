<?php

namespace App\Http\Controllers;

use App\Carousel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Category;
use App\Product;
use App\Http\Requests\AddProductResquest;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\EditProductRequest;
use App\Role;
use App\User;
use App\Http\Requests\AddNewUserRequest;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\AddNewImageRequest;
use App\Http\Requests\editedCarouselContentRequest;
use App\Http\Requests\SaveProductCategoryRequest;
class AdminController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if($request->user()->autorize([1,3]))
        {
            $products = Product::all();
            return view('admin.index',compact(['products']));
        }
        return back()->with('info','Usted no esta autorizado');
    }

    public function createProduct(Request $request)
    {
        if($request->user()->autorize(1))
        {
            $categories = Category::all();
            return view('admin.create-product',compact('categories'));
        } 
        return back()->with('info','Usted no esta autorizado');
    }

    public function addNewProduct(AddProductResquest $request)
    {
        if($request->user()->autorize(1))
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
            return redirect()->route('panel.admin')->with('info','Producto agregar exitosamente');
        } 
        return back()->with('info','Usted no esta autorizado');
    }

    public function deleteProduct(Request $request,$id)
    {
        if($request->user()->autorize(1))
        {
            $product = Product::findOrFail($id);
            Storage::disk('public')->delete($product->image);
            $product->delete();
            return redirect()->route('panel.admin')->with('info','Producto eliminado con éxito');
        } 
        return back()->with('info','Usted no esta autorizado');
    }

    public function editProductView(Request $request,$id)
    {
        if($request->user()->autorize([1,3]))
        {
            $product = Product::findOrFail($id);
            $categories = Category::all();
           return view('admin.edit-product',compact(['product','categories']));
        }
        return back()->with('info','Usted no esta autorizado');
    }

    public function editProduct(EditProductRequest $request,$id)
    {
        if($request->user()->autorize([1,3]))
        {
            $product = Product::findOrFail($id);
            $product->description =$request->input('description');
            $product->price =$request->input('price');
            $product->stock =$request->input('stock');
            $product->code =$request->input('code');
            $product->long_description =$request->input('long_description');
            $product->id_categories =$request->input('id_categories');
            if($request->hasFile('image') !=null)
            {
                $oldImage = $product->image;
                $image = $request->file('image');
                $path = 'img/categories/'.$request->input('id_categories');
                $time = time();
                $image->move($path,$time.$image->getClientOriginalName()); //save image 
                Storage::disk('public')->delete($oldImage); 
                $product->image= $path.'/'.$time.$image->getClientOriginalName();
            }
            $product->save();
            return redirect()->route('panel.admin')->with('info','Producto actualizado con éxito');
        }
        return back()->with('info','Usted no esta autorizado');
    }

    public function AdministrateUsers(Request $request)
    {
        if($request->user()->autorize([1,3]))
        {
            $users = User::orderBy('created_at','desc')->get();
            return view('admin.users',compact('users'));
        }
        return back()->with('info','Usted no esta autorizado');
    }

    public function createUserView(Request $request)
    {
        if($request->user()->autorize(1))
        {
            $roles = Role::all();
            return view('admin.create-user',compact('roles'));
        }
        return back()->with('info','Usted no esta autorizado');
    }

    public function newUser(AddNewUserRequest $request)
    {
        if($request->user()->autorize(1))
        {
           $user = new User();
           $user->fill($request->except('password'));
           $user->password =Hash::make($request->input('password'));
           $user->save();
           return redirect()->route('admin.users')->with('info','Usario creado con éxito');
        }
        return back()->with('info','Usted no esta autorizado');
    }

    public function deleteUser(Request $request, $id)
    {
        if($request->user()->autorize(1))
        {
            $user = User::findOrFail($id);
            $user->delete();
            return redirect()->route('admin.users')->with('info','Usuario eleminado con éxito');
        }
        return back()->with('info','Usted no esta autorizado');
    }

    public function carouselViewPanel(Request $request)
    {
        if($request->user()->autorize([1,3]))
        {
            $carousels = Carousel::all();
            return view('admin.carousel-view',compact('carousels'));
        }
        return back()->with('info','Usted no esta autorizado');
    }

    public function addCarouselImage(Request $request)
    {
        if($request->user()->autorize(1))
        {
            return view('admin.carousel-new');
        }
        return back()->with('info','Usted no esta autorizado');
    }

    public function addNewImageCarousel(AddNewImageRequest $request)
    {
        if($request->user()->autorize(1))
        {
            $image = $request->file('image');
            $time = time();
            $path = 'img/carousel';
            $image->move($path,$time.$image->getClientOriginalName());

            $carousel= new Carousel();
            $carousel->fill($request->except('image'));
            $carousel->image= $path.'/'.$time.$image->getClientOriginalName();
            $carousel->save();
            return redirect()->route('admin.carousel.view')->with('info','Imágen agregada con éxito');
        }
        return back()->with('info','Usted no esta autorizado');
    }

    public function editCarouselContent(Request $request,$id)
    {
        if($request->user()->autorize([1,3]))
        {
            $carousel=Carousel::findOrFail($id);
            return view('admin.carousel-edit',compact('carousel'));
        }   
        return back()->with('info','Usted no esta autorizado');
    }

    public function editedCarouselContent(editedCarouselContentRequest $request,$id)
    {
        if($request->user()->autorize([1,3]))
        {
            $carousel = Carousel::findOrFail($id);
            $carousel->title=$request->input('title');
            $carousel->description=$request->input('description');
            if($request->hasFile('image') !=null)
            {
                $oldImage = $carousel->image;
                $image = $request->file('image');
                $time= time();
                $path = 'img/carousel';
                $image->move($path,$time.$image->getClientOriginalName());
                $carousel->image =$path.'/'.$time.$image->getClientOriginalName();
                Storage::disk('public')->delete($oldImage);
            }
            $carousel->save();
           return redirect()->route('admin.carousel.view')->with('info','Contenido del carrusel altualizado con éxito');
        }
        return back()->with('info','Usted no esta autorizado');
    }

    public function deleteCarouselContent(Request $request,$id)
    {
        if($request->user()->autorize(1))
        {
            $carousel = Carousel::findOrFail($id);
            Storage::disk('public')->delete($carousel->image);
            $carousel->delete();
            return back()->with('info','Contenido del carrusel eliminado con éxito');
        }
        return back()->with('info','Usted no esta autorizado');
    }

    public function categoriesView(Request $request)
    {
        if($request->user()->autorize([1,3]))
        {
            $categories = Category::all();
            return view('admin.categories-view',compact('categories'));
        }
        return back()->with('info','Usted no esta autorizado');
    }

    public function AddCategory(SaveProductCategoryRequest $request)
    {
        if($request->user()->autorize(1))
        {
            $category = new Category();
            $category->fill($request->all());
            $category->save();
            return back()->with('info','Se agregó una nueva categoría');
        }
        return back()->with('info','Usted no esta autorizado');
    }

    public function editCategoryView(Request $request,$id)
    {
        if($request->user()->autorize([1,3]))
        {
            $category = Category::findOrFail($id);
            return view('admin.category-edit',compact('category'));
        }
        return back()->with('info','Usted no esta autorizado');
    }

    public function editedCategory(SaveProductCategoryRequest $request,$id)
    {
        if($request->user()->autorize([1,3]))
        {
            $category = Category::findOrFail($id);
            $category->category=$request->input('category');
            $category->save();
            return redirect()->route('admin.categories.view')->with('info','Se actualizó una categoría');
        }
        return back()->with('info','Usted no esta autorizado');
    }

    public function deleteCategory(Request $request,$id)
    {
        if($request->user()->autorize(1))
        {
            $category = Category::findOrFail($id);
            $category->delete();
            return redirect()->route('admin.categories.view')->with('info','Se eliminó una categoría');
        }
        return back()->with('info','Usted no esta autorizado');
    }
    
}
