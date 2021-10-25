<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Requests\CategoryRequest;

class CategoryController extends Controller
{
    //
    public function index(){
        $this->data['categories'] = Category::all();
        return view('admin.categories.index',$this->data);
    }

    public function store(Category $category, CategoryRequest $request){
        
        try{
            \DB::beginTransaction();
            $category = new Category;

            $category->name = $request->name;
            
            $category->save();
            \DB::commit();
            $request->session()->flash('messageCreated','Category was crated');
            return redirect()->route('categories.index');
        }
        catch(Exception $e){
            \DB::rollBack();
            $request->session()->flash('errorMessage', 'An error occurred please try again later');
            return redirect()->route('category.store');
        }
      
    }

    
    public function edit(Category $category){
        $this->data['category'] = $category;
        return view('admin.categories.edit',$this->data);
    }

    public function update(Category $category, CategoryRequest $request){
        try{
            \DB::beginTransaction();
            $category->name = $request->name;
            $category->update();
            \DB::commit();
            $request->session()->flash('messageUpdated','Category was updated');
            return redirect()->route('categories.index');
        }
        catch(Exception $e){
            \DB::rollBack();
            $request->session()->flash('errorMessage', 'An error occurred please try again later');
            return redirect()->route('category.edit');
        }
        

    }

    public function destroy(Category $category, Request $request){
        try{
            \DB::beginTransaction();
            $category->delete();
            \DB::commit();
            $request->session()->flash('messageDeleted','Category was deleted');
            return redirect()->route('categories.index');
        }
        catch(Exception $e){
            \DB::rollBack();
            $request->session()->flash('errorMessage', 'An error occurred please try again later');
            return redirect()->route('categories.index');
        }
 
    }

}
