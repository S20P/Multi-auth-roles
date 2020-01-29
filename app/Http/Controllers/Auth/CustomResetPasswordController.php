<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Mail;
use Validator;
use Session;
use DB;
use Illuminate\Support\Facades\Hash;

class CustomResetPasswordController extends Controller
{
    public function getResetPasswordForm()
    {
        return view('auth.ResetPasswod.reset_password');
    }

    public function postResetPasswordEmail(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);

        if (!$validator->fails()) {

            $email = request()->input('email');
            $user = User::where('email', $email)->first();

            if ($user) {
                $token = str_random(10);
                $user_name = $user->name;
                // $mail = Mail::send('auth.ResetPasswod.emails.SendReserPasswordLink', ['actionUrl' => $token, 'email' => $email,"user_name"=>$user_name], function (Message $message) use ($user) {
                //     $message->subject(config('app.name') . ' Password Reset Link');
                //     $message->to($user->email);
                // });

                $data = array(
                    'actionUrl'=>$token, 
                    'email'=>$email, 
                    "user_name"=>$user_name
                   );
                   
                    Mail::send("auth.ResetPasswod.emails.SendReserPasswordLink",$data, function($message) use ($user)
                    {
                        $message->subject(config('app.name') . ' Password Reset Link');
                        $message->to($user->email);
                    });

                User::where('email', $email)->update([
                    "remember_token" => $token,
                ]);

                Session::flash('success', "Mail sent successfully.");
                return back();

            } else {

                Session::flash('error', "User not Found for this Email Address.");
                return back();

            }

        }else{
            return redirect()->back()->withInput()->withErrors($validator);
        }

    }

    public function resetPassword(Request $request, $email, $verificationLink)
    {
        $user = User::where('email', $email)->where('remember_token', "=", $verificationLink)->first();
        $userid = $user->id;
        $data["userid"] = $userid;
        return view('auth.ResetPasswod.new_password', $data);
    }

    public function newPassword(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'new_password' => 'required|min:6',
            'confirm_password' => 'required|same:new_password',
        ]);

        if (!$validator->fails()) {
            $param = $request->all();
            $userid = $param['userid'];
            $new_password = $param['new_password'];
            $data["password"] = Hash::make($new_password);
            $updated_status = User::where("id", $userid)->update($data);

          if ($updated_status) {
                $role_has_users =  DB::table('role_has_users')->where('user_id',$userid)->first();
           
                if($role_has_users){
                   $role_id = $role_has_users->role_id;
                   $roles =  DB::table('roles')->where('id',$role_id)->value('name');
                   if($roles){
                    return redirect()->route($roles.".login")->with("success", 'Password Reset successfully.');
                   }
                }
                return redirect('/login')->with("success", 'Password Reset successfully.');
            }

        } else {

            return redirect()->back()->withInput()->withErrors($validator);
        }
    }
}
