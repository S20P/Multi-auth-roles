<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
use DB;
use App\User;
use App\Models\Supplier;
use App\Models\Customer;
use Redirect;
use Session;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:customer')->except('logout');
        $this->middleware('guest:supplier')->except('logout');
        $this->middleware('guest:backpack')->except('logout');

    }

    //Supplier login -------------------------

    public function showSupplierLoginForm()
    {
        return view('auth.login', ['url' => 'supplier']);
    }

    public function SupplierLogin(Request $request)
    {
 
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:6'
        ]);

        //Checkk Profile Status
         $email = $request->email;
         $user = User::select('id')->where('email', $email)->first();
         if($user){
            $user_id = $user->id;
            $Supplier_profile = Supplier::select('status')->where('user_id', $user_id)->first();
            if($Supplier_profile){
                $profile_status =  $Supplier_profile->status;
                if($profile_status=="Disapproved"){
                        Session::flash('message', "Your Profile is under Review.");
                        return Redirect::back();
                }
            }
         }  
        if (Auth::guard('supplier')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {

            return redirect()->intended('/supplier/dashboard');
        }
       
        return back()->withInput($request->only('email', 'remember'));
    }
 
    //Supplier end---------------------------
    //customer login ------------------------

    public function showCustomerLoginForm()
    {
        return view('auth.login', ['url' => 'customer']);
    }


    public function CustomerLogin(Request $request)
    {
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:6'
        ]);

        //Checkk Profile Status
        $email = $request->email;
        $user = User::select('id')->where('email', $email)->first();
        if($user){
           $user_id = $user->id;
           $Supplier_profile = Customer::select('status')->where('user_id', $user_id)->first();
           if($Supplier_profile){
               $profile_status =  $Supplier_profile->status;
               if($profile_status=="Disapproved"){
                       Session::flash('message', "Your Profile is under Review.");
                       return Redirect::back();
               }
           }
        }
        if (Auth::guard('customer')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {

            return redirect()->intended('/customer/dashboard');
        }
        return back()->withInput($request->only('email', 'remember'));
    }    
    //customer end---------------------------
}
