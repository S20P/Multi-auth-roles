<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator; 
use App\Models\Supplier;
use App\Models\Customer;
use Illuminate\Http\Request;
use Mail;
use Session;
use App\Models\SupplierCategory;
use DB;
class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
        $this->middleware('guest:customer');
        $this->middleware('guest:supplier');
        $this->middleware('guest:backpack');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

        //Make a Role -------------------------

        public function Role_has_User($user_id,$roleType)
        {
            $roles =  DB::table('roles')->where('name',$roleType)->first();
            if($roles){
               $role_id = $roles->id;
             $role_has_users =  DB::table('role_has_users')->insert([
                    "user_id"=>$user_id,
                    "role_id"=>$role_id,
               ]);
            }
        }


    //Supplier Register -------------------------

    public function showSupplierRegisterForm()
    {
        $Category =  SupplierCategory::orderBy('name', 'ASC')->get();
        $Category = $Category->pluck('name');
        return view('auth.supplierRegister', ['url' => 'supplier','Category'=>$Category]);
    }

    protected function createSupplier(Request $request)
    {
       // $this->validator($request->all())->validate();

        $messages = [
            'name.required' => 'The Name field is required.',
            'email.required' => 'The Email field is required.',
            'phone.required' => 'The Phone field is required.',
            'image.required' => 'The Image field is required.',
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
            'email' =>  ['required', 'string', 'email', 'max:255','unique:users'],
            'phone' => ['required', 'numeric'],
            'image' => 'required',
            'password' => ['required', 'string', 'min:6', 'confirmed'],
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

        $admin = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);

       $insertedUserID = $admin->id;

       $supplier = Supplier::create([
        'user_id' => $insertedUserID,
        'name' => $request['name'],
        'email' => $request['email'],
        'phone' => $request['phone'],
        'image' => '',      
        'service_name' => $request['service_name'],
        'business_name' => $request['business_name'],
        'category' => $request['category'],
        'service_description' => $request['service_description'],
        'event_type' => $request['event_type'],
        'location' => $request['location'],
        'pricing_category' => $request['pricing_category'],
       ]);

       $image = $request->file('image');
       $imagename = time().'.'.$image->getClientOriginalExtension();
       $destinationPath = public_path('/uploads/Supplier/');
       $image->move($destinationPath, $imagename);

       $supplier = Supplier::where('user_id',$insertedUserID)
        ->update([
            'image' => "/uploads/Supplier/".$imagename,
          ]);   
        
       $name = $request['name'];
       $email = $request['email'];
       $data = array(
        'name'=>$name,
       );

        //Make Supplier role in 'role_has_users' table.

     $this->Role_has_User($insertedUserID,"supplier");

     
    if($supplier){
        Mail::send("emails.Profile_Register_Welcome",$data, function($message) use ($email, $name)
        {
            $message->to($email, $name)->subject('Welcome!');
        });
        }
        
        Session::flash('success', "Your Profile is Successfully Register.");
        return redirect('supplier/login');
       // return redirect()->intended('supplier/login');
    }

    //customer Register ------------------------

    public function showCustomerRegisterForm()
    {
        return view('auth.customerRegister', ['url' => 'customer']);
    }
    
    protected function createCustomer(Request $request)
    {
     //   $this->validator($request->all())->validate();
     $messages = [
        'name.required' => 'The Name field is required.',
        'email.required' => 'The Email field is required.',
        'phone.required' => 'The Phone field is required.',
        'image.required' => 'The Image field is required.',
      ];

        $validator = Validator::make($request->all(), [
            'email' =>  ['required', 'string', 'email', 'max:255','unique:users'],
            'phone' => ['required', 'numeric'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'image' => 'required',
        ], $messages);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $admin = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);

        $insertedUserID = $admin->id;
       
        $Customer = Customer::create([
            'user_id' => $insertedUserID,
            'name' => $request['name'],
            'email' => $request['email'],
            'phone' => $request['phone'],
            'image' => '', 
           ]);

           $image = $request->file('image');
           $imagename = time().'.'.$image->getClientOriginalExtension();
           $destinationPath = public_path('/uploads/Customer/');
           $image->move($destinationPath, $imagename);
    
           $supplier = Customer::where('user_id',$insertedUserID)
            ->update([
                'image' => "/uploads/Customer/".$imagename,
              ]);  

           $name = $request['name'];
           $email = $request['email'];
           $data = array(
            'name'=>$name,
           );
    
           $this->Role_has_User($insertedUserID,"customer");

        if($Customer){
            Mail::send("emails.Profile_Register_Welcome",$data, function($message) use ($email, $name)
            {
                $message->to($email, $name)->subject('Welcome!');
            });
            }

            Session::flash('success', "Your Profile is Successfully Register.");
            return redirect('customer/login');

       // return redirect()->intended('customer/login');
    }

}
