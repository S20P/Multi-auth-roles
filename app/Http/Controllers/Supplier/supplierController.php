<?php

namespace App\Http\Controllers\Supplier;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Supplier;
use App\Models\SupplierCategory;
use Auth;
use Session;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
class supplierController extends Controller
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
        return Auth::guard('supplier')->user()->id;
     }

    public function account()
    {
        $user_id = $this->getUserID();
        $Supplier = Supplier::where('user_id',$user_id)->first();
        return view('supplier.account', ["Supplier_details" => $Supplier]);
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

        $supplier = Supplier::where('user_id',$user_id)
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
        $Supplier = Supplier::where('user_id',$user_id)->first();
        $Category =  SupplierCategory::orderBy('name', 'ASC')->get();
        $Category = $Category->pluck('name');
        return view('supplier.profile', ['Category'=>$Category,"Supplier_details" => $Supplier]);
    }

    public function profile_edit(Request $request)
    {

        $messages = [
            'name.required' => 'The Name field is required.',
            'email.required' => 'The Email field is required.',
            'phone.required' => 'The Phone field is required.',
            'service_name.required' => 'The Service Name field is required.',
            'business_name.required' => 'The Business Name field is required.',
            'category.required' => 'The  category field is required.',
            'service_description.required' => 'The  Service description field is required.',
            'location.required' => 'The  Location field is required.',
            'pricing_category.required' => 'The  Pricing Category field is required.',
            'event_type.required' => 'The  Event Type field is required.',
        ];

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' =>  ['required', 'string', 'email', 'max:255'],
            'phone' => ['required', 'numeric'],
            'service_name' => 'required',
            'business_name' => 'required',
            'category' => 'required',
            'event_type' => 'required',
            'service_description' => 'required',
            'location' => 'required',
            'pricing_category' => 'required',
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
            $destinationPath = public_path('/uploads/Supplier/');
            $image->move($destinationPath, $imagename);

            $supplier = Supplier::where('user_id',$user_id)
            ->update([
                'image' => "/uploads/Supplier/".$imagename,
              ]); 
            }

            $supplier = Supplier::where('user_id',$user_id)->update([
               'name' => $request['name'],
               'email' => $request['email'],
               'phone' => $request['phone'],
               'service_name' => $request['service_name'],
               'business_name' => $request['business_name'],
               'category' => $request['category'],
               'service_description' => $request['service_description'],
               'event_type' => $request['event_type'],
               'location' => $request['location'],
               'pricing_category' => $request['pricing_category'],
              ]);   

            Session::flash('success', "Your Profile is Successfully Updated.");
            return redirect()->back();
    }
    

}




