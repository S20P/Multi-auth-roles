<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
<style>
.btn-primary:hover, .btn-primary:focus, .btn-primary:active {
    background: transparent;
    color: #7ea1ea;
    border-color: #7ea1ea;
    box-shadow: none !important;
}
.btn-primary, .btn-inverse {
    cursor: pointer;
    display: inline-block;
    text-align: center;
    color: #fff;
    background-color: #7ea1ea;
    border: 1px solid #7ea1ea;
    padding: 10px 25px;
    text-transform: uppercase;
    box-sizing: border-box;
    border-radius: 100px;
    transition: all 0.2s ease-out;
    /* font-size: 12px; */
    font-size: 10px;
    font-weight: 600;
    letter-spacing: 0.3px;
    font-family: 'Raleway', sans-serif;
    min-width: 110px;
        text-decoration:none;
}
</style>
</head>
<body>
<header style="padding-bottom: 0px;padding-top: 5px;padding-bottom: 5px;position: fixed;top: 0;left: 0;width: 100%;background: #fff;z-index: 1;box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.1);">
    <div style="padding-right: 15px;padding-left: 15px;margin-right: auto;margin-left: auto;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">
        <div style="margin-right: -15px;margin-left: -15px;">
            <div style="width: 100%;padding-right: 15px;padding-left: 15px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;"">
            <div style="padding: 0px 15px;">
                <div><a href="#" style="display: inline-block;text-decoration: none;">
                        <h2 style="font-weight: bold;font-size: 58px;line-height: 1;color: #0EB0A3;margin-bottom: 5px;border-bottom: 6px solid #0EB0A3;padding-bottom: 0;width: intrinsic;width: -moz-max-content;width: -webkit-max-content;margin-top: 0;font-family: 'Roboto', sans-serif;">Party</h2>
                        <h3 style="font-weight: normal;font-size: 16px;color: #757575;margin-bottom: 0;margin-top: 0;font-family: 'Roboto', sans-serif;">Perfect</h3></a></div>
            </div>
        </div>
    </div>
    </div>
</header>   
<table cellpadding="0" cellspacing="0" border="0" style="border-collapse: collapse;" width="100%">
    <tr>
        <td width="5%">&nbsp;</td>
        <td style="border-bottom: 1px solid #7EA1EA;">
          
        </td>
        <td width="5%">&nbsp;</td>
    </tr>
    <tr><td style="padding-top: 5px;padding-bottom: 5px;"></td></tr>
    <tr>

        <td width="5%">&nbsp;</td>
        <td align="center" style="padding-top: 10px;padding-bottom: 10px;">
            <table bgcolor="#f8f8f8" width="60%" align="center" style="margin:0  auto;  border-collapse: collapse;">
                                        <tr>
                                        <td style="color: #242424; padding:10px; background :#f8f8f8; letter-spacing: 0.2px;font-size: 16px;font-family: sans-serif;"></td>
                                       </tr>
                                        <tr>
                                        <td style="color: #242424; padding:10px 20px; background :#f8f8f8; letter-spacing: 0.2px;font-size: 16px;font-family: sans-serif;">Hello, {{$user_name}}</td>
                                       </tr>
                                       <tr>
                                       <td style="color: #242424; padding:10px 20px; background:#f8f8f8; letter-spacing: 0.2px;font-size: 16px;font-family: sans-serif;">You are receiving this email because we have received a password reset request from your account.</td>
                                       </tr> 
                                       <tr>
                                       <td style="color: #242424; padding:10px 20px; background :#f8f8f8; letter-spacing: 0.2px;font-size: 16px;font-family: sans-serif; text-align:center;">
                                          <a href="{{url('/resetPassword')}}/{{$email}}/{{$actionUrl}}" class="button button-blue" target="_blank">Reset Password</a>
                                       <br>
                                       </td>
                                       </tr> 
                                        <tr>
                                       <td style="color: #242424; padding:10px; background :#f8f8f8; letter-spacing: 0.2px;font-size: 16px;font-family: sans-serif;"></td>
                                       </tr>
                                       <tr>
                                       </tr> 
                                       <tr> <td style="padding:10px 20px; letter-spacing: 0.2px;font-size: 16px;font-family: sans-serif; color:#242424;"> Thank you.</td></tr>
                                     
                                </table>
                            </td>
            <td width="5%">&nbsp;</td>

                
    </tr>
<tr><td style="padding-top: 10px;padding-bottom: 10px;"></td></tr>
    <tr>
        <td width="5%">&nbsp;</td>
        <td>
           
        </td>
        <td width="5%">&nbsp;</td>
    </tr>
</table>
</body>
</html>
 <br>
