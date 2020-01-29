<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use Auth;
use Session;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
class customerController extends Controller
{
    public function __construct()
    {
        
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    public function getUserID(){
        return Auth::guard('customer')->user()->id;
     }

    public function account()
    {
        $user_id = $this->getUserID();
        $Customer = Customer::where('user_id',$user_id)->first();
        return view('customer.account', ["Customer_details" => $Customer]);
    }

    public function account_edit(Request $request)
    {   
        $user_id = $this->getUserID();
        $this->validator($request->all())->validate();
        $admin = User::where('id',$user_id)
        ->update([
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);

        $Customer = Customer::where('user_id',$user_id)
        ->update([
            'email' => $request['email'],
            'phone' => $request['phone'],
          ]);   
          
            Session::flash('success', "Your Account is Successfully Updated.");
            return redirect()->back();
    }

    public function profile()
    {
        $user_id = $this->getUserID();     
        $Customer = Customer::where('user_id',$user_id)->first();
        return view('customer.profile', ["Customer_details" => $Customer]);
    }

    public function profile_edit(Request $request)
    {

        $messages = [
            'name.required' => 'The Name field is required.',
            'email.required' => 'The Email field is required.',
            'phone.required' => 'The Phone field is required.',
        ];

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' =>  ['required', 'string', 'email', 'max:255'],
            'phone' => ['required', 'numeric'],
        ], $messages);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $user_id = $this->getUserID();
                 
            if($request->file('image')){
            $image = $request->file('image');
            $imagename = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/Customer/');
            $image->move($destinationPath, $imagename);

            $Customer = Customer::where('user_id',$user_id)
            ->update([
                'image' => "/uploads/Customer/".$imagename,
              ]); 
            }

            $Customer = Customer::where('user_id',$user_id)->update([
               'name' => $request['name'],
               'email' => $request['email'],
               'phone' => $request['phone'],
              ]);   

            Session::flash('success', "Your Profile is Successfully Updated.");
            return redirect()->back();
    }
    

}
