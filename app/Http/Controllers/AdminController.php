<?php

namespace App\Http\Controllers;
use App\Image;
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
use App\Http\Requests\editedImageContentRequest;
use App\Http\Requests\SaveProductCategoryRequest;
use App\SubCategory;
use App\Http\Requests\SaveSubCategoryRequest;
use App\Order;
use App\Unit;
use App\Http\Requests\AddUnitRequest;
use App\State;

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
            $units = Unit::all();
            $categories = Category::all();
            return view('admin.create-product',compact(['categories','units']));
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
            $product->wholesale_price =$request->input('wholesale_price');
            $product->quantity_wholesale_price =$request->input('quantity_wholesale_price');
            $product->stock =$request->input('stock');
            $product->image =$path.'/'.$time.$image->getClientOriginalName();
            $product->code =$request->input('code');
            $product->long_description =$request->input('long_description');
            $product->id_categories =$request->input('id_categories');
            $product->id_units =$request->input('id_units');
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
            $units = Unit::all();
            $product = Product::findOrFail($id);
            $categories = Category::all();
           return view('admin.edit-product',compact(['product','categories','units']));
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
            $product->wholesale_price =$request->input('wholesale_price');
            $product->quantity_wholesale_price =$request->input('quantity_wholesale_price');
            $product->stock =$request->input('stock');
            $product->code =$request->input('code');
            $product->long_description =$request->input('long_description');
            $product->id_categories =$request->input('id_categories');
            $product->id_units =$request->input('id_units');
            if($request->hasFile('image') !=null)
            {
                $oldImage = $product->image;
                $image = $request->file('image');
                $path = 'img/categories/'.$request->input('id_categories');
                $time = time();
                $image->move($path,$time.$image->getClientOriginalName()); //save image 
                Storage::disk('public')->delete($oldImage); //delete old image
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
            $states = State::all();
            return view('admin.create-user',compact(['roles','states']));
        }
        return back()->with('info','Usted no esta autorizado');
    }

    public function newUser(AddNewUserRequest $request)
    {
        if($request->user()->autorize(1))
        {
           $user = new User();
           $user->fill($request->except(['password','state_id']));
           $user->state_id = $request->input('state');
           $user->password =Hash::make($request->input('password'));
           $user->save();
           return redirect()->route('admin.users')->with('info','Usuario creado con éxito');
        }
        return back()->with('info','Usted no esta autorizado');
    }

    public function userMovements(Request $request,$id)
    {
        if($request->user()->autorize([1,3]))
        {
            $user = User::findOrFail($id);
            $orders = Order::where('id_user',$id)->get();
            return view('admin.user-movements',compact(['user','orders']));
        }
        return back()->with('info','Usted no esta autorizado');
    }

    public function deleteUser(Request $request, $id)
    {
        if($request->user()->autorize(1))
        {
           $user = User::findOrFail($id);
           $orders = $user->Orders->where('status',Order::PENDING)->first();
           if(is_null($orders))
           {
                $user->delete();
                return redirect()->route('admin.users')->with('info','Usuario eleminado con éxito');
           }
           return back()->with('info',$user->name.' '.$user->last_name.' tiene pedidos por entregar.');
        }
        return back()->with('info','Usted no esta autorizado');
    }

    public function imageViewPanel(Request $request)
    {
        if($request->user()->autorize([1,3]))
        {
            $carousels = Image::where('type',Image::CAROUSEL)->get();
            $galeries = Image::where('type',Image::GALERY)->get();
            return view('admin.image-view',compact(['carousels','galeries']));
        }
        return back()->with('info','Usted no esta autorizado');
    }

    public function addImage(Request $request)
    {
        if($request->user()->autorize(1))
        {
            return view('admin.image-new');
        }
        return back()->with('info','Usted no esta autorizado');
    }

    public function addNewImage(AddNewImageRequest $request)
    {
        if($request->user()->autorize(1))
        {
            $image = $request->file('image');
            $time = time();
            $path = 'img/';
            $type = $request->input('type');
            if($type == Image::GALERY)
            {
                $path .='galery';
            }
            else{
                $path .='carousel';
            }
            $image->move($path,$time.$image->getClientOriginalName());
            $imageType= new Image();
            $imageType->fill($request->except('image'));
            $imageType->image= $path.'/'.$time.$image->getClientOriginalName();
            $imageType->save();
            return redirect()->route('admin.image.view')->with('info','Imágen agregada con éxito');
        }
        return back()->with('info','Usted no esta autorizado');
    }

    public function editImageContent(Request $request,$id)
    {
        if($request->user()->autorize([1,3]))
        {
            $image=Image::findOrFail($id);
            return view('admin.image-edit',compact('image'));
        }   
        return back()->with('info','Usted no esta autorizado');
    }

    public function editedImageContent(editedImageContentRequest $request,$id)
    {
        if($request->user()->autorize([1,3]))
        {
            $carousel = Image::findOrFail($id);
            $carousel->title=$request->input('title');
            $carousel->description=$request->input('description');
            if($request->hasFile('image') !=null)
            {
                $oldImage = $carousel->image;
                $image = $request->file('image');
                $time= time();
                $path = 'img/';
                $type = $request->input('type');
                if($type == Image::GALERY)
                {
                    $path .='galery';
                }
                else{
                    $path .='carousel';
                }
                $image->move($path,$time.$image->getClientOriginalName());
                $carousel->image =$path.'/'.$time.$image->getClientOriginalName();
                Storage::disk('public')->delete($oldImage);
            }
            $carousel->save();
           return redirect()->route('admin.image.view')->with('info','Contenido del carrusel actualizado con éxito');
        }
        return back()->with('info','Usted no esta autorizado');
    }

    public function deleteImageContent(Request $request,$id)
    {
        if($request->user()->autorize(1))
        {
            $image = Image::findOrFail($id);
            Storage::disk('public')->delete($image->image);
            $image->delete();
            return back()->with('info','Contenido del carrusel eliminado con éxito');
        }
        return back()->with('info','Usted no esta autorizado');
    }

    public function categoriesView(Request $request)
    {
        if($request->user()->autorize([1,3]))
        {
            $categories = Category::orderBy('created_at','desc')->paginate(8);
            $subCategories = SubCategory::orderBy('created_at','desc')->paginate(8);
            return view('admin.categories-view',compact(['categories','subCategories']));
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
            $subCategories = SubCategory::all();
            return view('admin.category-edit',compact(['category','subCategories']));
        }
        return back()->with('info','Usted no esta autorizado');
    }

    public function editedCategory(SaveProductCategoryRequest $request,$id)
    {
        if($request->user()->autorize([1,3]))
        {
            $category = Category::findOrFail($id);
            $category->category=$request->input('category');
            $category->id_SubCategory=$request->input('id_SubCategory');
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
            $products = $category->Product->where('id_categories',$id)->first();
            if($products != null)
            {
                return back()->with('info','No puedes eliminar esta categoría, ya que está en uso.');
            }
            $category->delete();
            return redirect()->route('admin.categories.view')->with('info','Se eliminó una categoría');
        }
        return back()->with('info','Usted no esta autorizado');
    }

    public function addSubcategory(SaveSubCategoryRequest $request)
    {
        if($request->user()->autorize(1))
        {
            $subCategory = new SubCategory();
            $subCategory->fill($request->all());
            $subCategory->save();
            return back()->with('info','Se agregó una subcategoría');
        }
        return back()->with('info','Usted no esta autorizado');
    }
    
    public function editSubcategory(Request $request, $id)
    {
        if($request->user()->autorize(1))
        {
            $subCategory = SubCategory::findOrFail($id);
            return view('admin.subCategory-edit',compact('subCategory'));
        }
        return back()->with('info','Usted no esta autorizado');
    }

    public function editedSubcategory(SaveSubCategoryRequest $request, $id)
    {
        if($request->user()->autorize(1))
        {
            $subCategory = SubCategory::findOrFail($id);
            $subCategory->description = $request->input('description');
            $subCategory->save();
            return redirect()->route('admin.categories.view')->with('info','Se ha actualizado una subcategoría');
        }
        return back()->with('info','Usted no esta autorizado');
    }

    public function deleteSubcategory(Request $request,$id)
    {
        if($request->user()->autorize(1))
        {
            $category = Category::where('id_SubCategory',$id)->first();
            if(is_null($category))
            {
                $subCategory = SubCategory::findOrFail($id);
                $subCategory->delete();
                return back()->with('info','Se ha eliminado una subcategoría.');     
            }
            return back()->with('info','No es posible eliminar este  registro, porque está en uso.');
        }
        return back()->with('info','Usted no esta autorizado');
    }

    public function unitsView(Request $request)
    {
        if($request->user()->autorize([1,3]))
        {
            $units = Unit::all();
            return view('admin.units',compact('units'));
        }
        return back()->with('info','Usted no esta autorizado');
    }

    public function addUnit(AddUnitRequest $request)
    {
        if($request->user()->autorize(1))
        {
            $unit = new Unit();
            $unit->fill($request->all());
            $unit->save();
            return back()->with('info','Unidad agregada con éxito.');
        }
        return back()->with('info','Usted no esta autorizado.');
    }

    public function editUnit(Request $request,$id)
    {
        if($request->user()->autorize([1,3]))
        {
            $unit = Unit::findOrFail($id);
            return view('admin.unit-edit',compact('unit'));
        }
        return back()->with('info','Usted no esta autorizado.');
    }

    public function editedUnit(AddUnitRequest $request,$id)
    {
        if($request->user()->autorize([1,3]))
        {
            $unit = Unit::findOrFail($id);
            $unit->description = $request->input('description');
            $unit->save();
            return redirect()->route('admin.units.view')->with('info','Unidad actualizada con éxito.');
        }
        return back()->with('info','Usted no esta autorizado.');
    }

    public function deleteUnit(Request $request,$id)
    {
        if($request->user()->autorize([1,3]))
        {
          $unit = Unit::findOrFail($id);
          $products = $unit->Products->where('id_units',$id)->first();
          if($products != null)
          {
            return back()->with('info','No puede eliminar este campo, ya que está en uso en los productos.');
          }
          $unit->delete();
           return back()->with('info','Unidad eliminada con éxito.');
        }
        return back()->with('info','Usted no esta autorizado.');
    }

    public function ordersView(Request $request)
    {
        if($request->user()->autorize([1,3]))
        {
            $orders = Order::where('status',Order::PENDING)->paginate(10);
            return view('admin.orders-view',compact('orders'));
        }
        return back()->with('info','Usted no esta autorizado.');
    }

    public function orderSended(Request $request,$id)
    {
        if($request->user()->autorize([1,3,4]))
        {
            $order = Order::findOrFail($id);
            if(($order->send_at == null) && ( $order->status ==Order::PENDING) )
            {
                $products = $order->Products;
                foreach ($products as $prod) {
                    $qty = $prod->pivot->quantity;
                    $prod->sold +=$qty;
                    $prod->save();
                }
                $order->status = Order::COMPLITED;
                $order->send_at = now();
                $order->save();
                return back()->with('info','Se ha realizado el registro de la entrega');
            }
            return back()->with('info','Este pedido ya ha sido enviado.');
        }
        return back()->with('info','Usted no esta autorizado.');
    }

    public function listOrder(Request $request,$id) //id order or number of order
    {
        if($request->user()->autorize([1,3,4]))
        {
            $order = Order::findOrFail($id);
            $products = $order->Products;
            return view('admin.list-order',compact(['products','order']));
        }
        return back()->with('info','Se ha realizado el registro de la entrega');
    }

    public function cancelOrder(Request $request, $id)
    {
        if($request->user()->autorize(1))
        {   $order = Order::findOrFail($id);
            if($order->canceled_at == null)
            {
                $products = $order->Products;
    
                //cancel order
                foreach ($products as $prod) {
                    $qty = $prod->pivot->quantity;
                    $prod->stock +=$qty;
                    $prod->save();
                }
                $order->status = Order::CANCELED;
                $order->canceled_at = now();
                $order->save();
                return back()->with('info','El pedido se ha cancelado con éxito.');
            }
           return back()->with('info','Este pedido ya ha sido cancelado.');
        }
        return back()->with('info','Usted no esta autorizado.');
    }
}
