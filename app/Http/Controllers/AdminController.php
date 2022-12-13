<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Storage;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    //direct to change password page
    public function changePasswordPage()
    {
        return view('admin.account.changePassword');
    }

    //get data from change password page
    public function changePassword(Request $request)
    {
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

    //direct admin detail page
    public function details()
    {
       return view('admin.account.details');
    }

    //direct profile edit page
    public function edit()
    {
        return view('admin.account.edit');
    }

    //update profile
    public function update($id,Request $request){
       
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
        return redirect()->route('admin#details')->with(['updateSuccess'=>'Admin account updated..']);
    }


    //admin list
    public function list(){
        $admins=User::when(request('key'),function($query){
            $query->orWhere('name','like','%'. request('key').'%')
            ->orWhere('email','like','%'. request('key').'%')
            ->orWhere('gender','like','%'. request('key').'%')
            ->orWhere('phone','like','%'. request('key').'%')
            ->orWhere('address','like','%'. request('key').'%');
        })
        ->where('role','admin')->paginate(3);
        $admins->appends(request()->all());
        return view('admin.account.list',compact('admins'));
    }

    //admin account delete 
    public function delete($id){
       User::where('id',$id)->delete();
       return back()->with(['deleteSuccess'=>'Admin account deleted..']);
    }

    //direct page to change admin role
    public function changeRole($id){
        $account=User::where('id',$id)->First();
        return view('admin.account.changeRole',compact('account'));
    }

    //post change user role
    public function change($id,Request $request){
        $data=$this->requestUserData($request);
        User::where('id',$id)->update($data);
        return redirect()->route('admin#list');
    }
     
    private function requestUserData($request){
        return [
            'role'=>$request->role
        ];
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



    //validation for changepassword page
    private function passwordValidateionCheck($request)
    {
        Validator::make($request->all(),[
            'oldPassword'=>'required|min:6|max:10',
            'newPassword'=>'required|min:6|max:10',
            'confirmPassword'=>'required|min:6|max:10|same:newPassword'
        ])->validate();
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
