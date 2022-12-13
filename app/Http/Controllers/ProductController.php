<?php

namespace App\Http\Controllers;

use Storage;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class ProductController extends Controller
{
    //direct to product list
    public function list(){
        $pizzas=Product::select('products.*','categories.name as category_name')
        ->when(request('key'),function($query){
            $query->where('products.name','like','%'.request('key').'%');
        })
        ->leftJoin('categories','products.category_id','categories.id')
        ->orderBy('products.created_at','desc')->paginate(4);
        $pizzas->appends(request()->all());
        return view('admin.product.pizzaList',compact('pizzas'));
    }

    //direct to create pizza page
    public function createPage(){
        $categories=Category::select('id','name')->get();
        return view('admin.product.create',compact('categories'));
    }

    //create pizza
    public function create(Request $request){
        $this->productValidationCheck($request,'create');
        $data=$this->getProductData($request);

        $fileName=uniqid().$request->file('pizzaImage')->getClientOriginalName();
        $request->file('pizzaImage')->storeAs('public',$fileName);
        $data['image']=$fileName;

        Product::create($data);
        return redirect()->route('product#list');
    }

    //delete poducts
    public function delete($id){
        Product::where('id',$id)->delete();
        return redirect()->route('product#list')->with(['deleteSuccess'=>'Product Delete Success..']);

    }

    //edit for procduct
    public function edit($id){
        $pizza=Product::select('products.*','categories.name as category_name')
               ->leftJoin('categories','products.category_id','categories.id')
               ->where('products.id',$id)->first();
        return view('admin.product.edit',compact('pizza'));

    }
    
    //update product
    public function updatePage($id)
    {
        $pizza=Product::where('id',$id)->first();
        $category=Category::get();
        return view('admin.product.update',compact('pizza','category'));
    }

    //post for updte product

    public function update(Request $request){
        $this->productValidationCheck($request,'update');
        $data=$this->getProductData($request);

        if($request->hasFile('pizzaImage')){
        $oldImageName=Product::where('id',$request->pizzaId)->First();
        $oldImageName=$oldImageName->image;
        if($oldImageName!=null){
            Storage::delete('public/'.$oldImageName);
        }
        $fileName=uniqid().$request->file('pizzaImage')->getClientOriginalName();
        $request->file('pizzaImage')->storeAs('public',$fileName);
        $data['image']=$fileName;
        }
        Product::where('id',$request->pizzaId)->update($data);
        return redirect()->route('product#list')->with(['updateSuccess'=>'Product Update Success..']);
    }

    //validation for products create
    private function productValidationCheck($request,$action){
        $validationRule=[
            'pizzaName'=>'required|unique:products,name,'.$request->pizzaId,
            'pizzaCategory'=>'required',
            'pizzaDescription'=>'required|min:10',
            'pizzaWaitingTime'=>'required',
            'pizzaPrice'=>'required'
        ];
        $validationRule['pizzaImage']= $action == "create" ? 'required|mimes:jpg,jpeg,png,webp|file' : 'mimes:jpg,jpeg,png,webp|file';
        Validator::make($request->all(),$validationRule)->validate();
    }

    //get create product data
    private function getProductData($request){
       return [
        'name'=>$request->pizzaName,
        'category_id'=>$request->pizzaCategory,
        'description'=>$request->pizzaDescription,
        'waiting_time'=>$request->pizzaWaitingTime,
        'price'=>$request->pizzaPrice
       ];
    }

}
