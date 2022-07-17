<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
   
    public function index(Request $request)
    {
        $categories = Category::when($request->search, function ($q) use ($request) {

            return $q->whereTranslationLike('name', '%' . $request->search . '%');

        })->latest()->paginate(5);

     return view('dashboard.categories.index',compact('categories'));

    }

   
    public function create()
    {
        return view('dashboard.categories.create');
    }

    
    public function store(Request $request)
    {
      $data=$request->validate([
            'ar.*'=>'required|unique:category_translations,name',
            'en.*'=>'required|unique:category_translations,name',
        ]);


        category::create($data);

        session()->flash('success',__('site.added_successfully'));

        return redirect()->route('dashboard.categories.index');


    }

    
    public function edit(category $category)
    {
        return view('dashboard.categories.edit',compact('category'));
    }

    public function update(Request $request, category $category)
    {

        // $request->validate([
        //     'ar.*'=>'required|unique:category_translations,name',
        //     'en.*'=>'required|unique:category_translations,name',
        // ]);
        $request->validate([
            'ar.*'=>['required', Rule::unique('category_translations')->ignore($category->id,'category_id'),],
            'en.*'=>['required', Rule::unique('category_translations')->ignore($category->id,'category_id'),],
        
        ]);


        $category->update($request->all());

        session()->flash('success',__('site.updated_successfully'));

        return redirect()->route('dashboard.categories.index');
    }

    public function destroy(category $category)
    {
        $category->delete();
        session()->flash('success',__('site.deleted_successfully'));

        return redirect()->route('dashboard.categories.index');

    }
}
