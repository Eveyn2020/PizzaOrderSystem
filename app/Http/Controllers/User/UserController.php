<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Models\Order;

class UserController extends Controller
{
    //direct to user home page
    public function home(){
        $pizzas=Product::orderBy('id','desc')->get();
        $categories=Category::get();
        $cart=Cart::where('user_id',Auth::user()->id)->get();
        $history=Order::where('user_id',Auth::user()->id)->get();
        return view('user.main.home',compact('pizzas','categories','cart','history'));
    }

    //direct user lsit page
    public function userList(){
        $users=User::where('role','user')->paginate(3);
        return view('admin.user.list',compact('users'));

    }

    //ajax change role for users
    public function changeRole(Request $request){
        User::where('id',$request->userId)->update([
            'role' => $request->role
           ]);  
     
    }

    //direct to change password page
    public function changePasswordPage(){
        return view('user.password.change');
    }
    
    //post for change password
    public function changePassword(Request $request){
        $this->passwordValidateionCheck($request);
      
        $user=User::select('password')->where('id',Auth::user()->id)->first();
        $dbPassword=$user->password;
        if(Hash::check($request->oldPassword,$dbPassword))
        {
            User::where('id',Auth::user()->id)->update([
                'password'=>Hash::make($request->newPassword)
            ]);
            // Auth::logout();
            // return redirect()->route('auth#loginPage');
            return back()->with(['changeSucess'=>'Password Change Success !']);
        }
        return back()->with(['notMatch'=>'The old password not match. Try Again !']);
    }

    //user account change page
    public function accountChangePage(){
        return view('user.profile.account');
    }

    public function accountChange($id,Request $request){
        $this->accountValidatonCheck($request);
        $data=$this->getUserData($request);
       
        //for image

        if($request->hasFile('image')){
           
            //get old image name //check delete // store
            $dbImage=User::where('id',$id)->first();
            $dbImage=$dbImage->image;
           
            if($dbImage!=null){
                Storage::delete('public/'.$dbImage);
            }
            
            $fileName = uniqid().$request->file('image')->getClientOriginalName();
            
            $request->file('image')->storeAs('public',$fileName);
            $data['image']=$fileName;
            
        }


        User::where('id',$id)->update($data);
        return back()->with(['updateSuccess'=>'Your account updated..']);
    }


    //filter by category for pizza
    public function filter($categoryId){
        $pizzas=Product::where('category_id',$categoryId)->orderBy('id','desc')->get();
        $categories=Category::get();
        $cart=Cart::where('user_id',Auth::user()->id)->get();
        $history=Order::where('user_id',Auth::user()->id)->get();
        return view('user.main.home',compact('pizzas','categories','cart','history'));
        
    }

    //pizza details
    public function pizzaDetails($id){
        $pizza=Product::where('id',$id)->First();
        $pizzaList=Product::get();
        return view('user.main.detail',compact('pizza','pizzaList'));
    }

    //cart list page
    public function cartList(){
        $cartList=Cart::select('carts.*','products.name as pizza_name','products.price as pizza_price','products.image as product_image')
        ->leftJoin('products','products.id','carts.product_id')
        ->where('user_id',Auth::user()->id)
        ->get();
        $totalprice=0;
        foreach($cartList as $list){
            $totalprice += $list->pizza_price * $list->qty;
        }
       
        return view('user.main.cart',compact('cartList','totalprice'));
    }

    //direct to history
    public function history(){
        $orders=Order::where('user_id',Auth::user()->id)->orderBy('created_at','desc')->paginate(5);
        return view('user.main.history',compact('orders'));
    }

    //direct to user  edit page
    public function editPage($id){
        $user=User::where('id',$id)->first();
        return view('admin.user.editPage',compact('user'));
    }

    //edit user data
     //update profile
    public function editUser($id,Request $request){
       
        $this->accountValidatonCheck($request);
        $data=$this->getUserData($request);
       
        //for image

        if($request->hasFile('image')){
           
            //get old image name //check delete // store
            $dbImage=User::where('id',$id)->first();
            $dbImage=$dbImage->image;
           
            if($dbImage!=null){
                Storage::delete('public/'.$dbImage);
            }
            
            $fileName = uniqid().$request->file('image')->getClientOriginalName();
            
            $request->file('image')->storeAs('public',$fileName);
            $data['image']=$fileName;
            
        }


        User::where('id',$id)->update($data);
        return redirect()->route('user#userList')->with(['updateSuccess'=>'User account updated..']);
    }


    //delete user 
    public function delete($id){
        User::where('id',$id)->delete();
        return back()->with(['deleteSuccess'=>'user account deleted..']);
     }

       //validation for changepassword page
     private function passwordValidateionCheck($request)
    {
        Validator::make($request->all(),[
            'oldPassword'=>'required|min:6|max:10',
            'newPassword'=>'required|min:6|max:10',
            'confirmPassword'=>'required|min:6|max:10|same:newPassword'
        ])->validate();
    }
    
       //change data to array
    private function getUserData($request){
        return [
            'name'=>$request->name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'gender'=>$request->gender,
            'address'=>$request->address,
            // 'image'=>$request->image,
            'updated_at'=>Carbon::now()
        ];
    }

     //validaton for profile change
    private function accountValidatonCheck($request){
        Validator::make($request->all(),[
            'name'=>'required',
            'email'=>'required',
            'phone'=>'required',
            'gender'=>'required',
            'address'=>'required',
            'image'=>'mimes:jpg,jpeg,png,webp|file'
        ])->validate();
    }
   
}
