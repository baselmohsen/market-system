<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Storage;
class ProductController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();

        $products = Product::when($request->search, function ($q) use ($request) {

            return $q->whereTranslationLike('name', '%' . $request->search . '%');

        })->when($request->category_id, function ($q) use ($request) {

            return $q->where('category_id', $request->category_id);

        })->latest()->paginate(5);

        return view('dashboard.products.index', compact('categories', 'products'));

    }

   
    public function create()
    {
        $categories=Category::all();

        return view('dashboard.products.create',compact('categories'));

    }

    public function store(Request $request)
    {
        $request->validate([
            'ar.*'=>'required|unique:product_translations,name',
            'en.*'=>'required|unique:product_translations,name',
            'purchase_price'=>'required|integer',
            'sale_price'=>'required|integer',
            'stock'=>'required|integer',
            'category_id'=>'required|exists:categories,id',
            'image'=>'image',
         
        ]);

        $request_data=$request->except('image');
     
        if ($request->image) {

            Image::make($request->image)
                ->resize(50,50)
                ->save(public_path('uploads/products/' . $request->image->hashName()));

            $request_data['image'] = $request->image->hashName();

        }

        Product::create($request_data);
        
        session()->flash('success',__('site.added_successfully'));

        return redirect()->route('dashboard.products.index');




    }

   
    public function edit(Product $product)
    {
        $categories=Category::all();

        return view('dashboard.products.edit',compact('product','categories'));
    }

 
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'ar.*'=>['required', Rule::unique('product_translations')->ignore($product->id,'product_id'),],
            'en.*'=>['required', Rule::unique('product_translations')->ignore($product->id,'product_id'),],
            'purchase_price'=>'required|integer',
            'sale_price'=>'required|integer',
            'stock'=>'required|integer',
            'category_id'=>'required|exists:categories,id',
            'image'=>'image',
         
        ]);

        $request_data=$request->except('image');

     
        if ($request->image) {

            if ($product->image != 'default.png') {

                Storage::disk('uploads')->delete('products/' . $product->image);

            }

            Image::make($request->image)
                ->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save(public_path('uploads/products/' . $request->image->hashName()));

            $request_data['image'] = $request->image->hashName();

        }

        $product->update($request_data);

        session()->flash('success', __('site.updated_successfully'));
        
        return redirect()->route('dashboard.products.index');
    }

    public function destroy(Product $product)
    {
        
        if ($product->image != 'default.png') {

            Storage::disk('uploads')->delete('products/' . $product->image);

        }

        $product->delete();

        session()->flash('success', __('site.deleted_successfully'));

        return redirect()->route('dashboard.products.index');

    }
}
