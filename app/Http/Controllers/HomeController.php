<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
Use App\Models\Ug;
Use App\Models\Meta;
Use App\Models\Account;
Use App\Models\SmartLink;
Use App\Models\CounterIps;
Use App\Models\CounterValues;
Use App\Models\Settings;

use Illuminate\Http\Request;
use App\Http\Requests;

Use Hash, Auth, Session;

class HomeController extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return Response
     */
    public function index()
    {
        if(Auth::user()->role == 3){
             $dataList = Account::where('status', 1)->where('users.id', Auth::user()->id)
                ->join('smart_link', 'smart_link.id', '=', 'users.smart_link_id')
                ->leftJoin('counter_values', 'users.smart_link_id', '=', 'counter_values.smart_link_id')
                ->orderBy('counter_values.day_value', 'desc')
                ->orderBy('counter_values.all_value', 'desc')
                ->select('users.fullname', 'smart_link', 'day_value as traffic', 'users.id as user_id')
                ->first();
        }else{
            $dataList = Account::where('status', 1)->where('role', 3)
            ->join('smart_link', 'smart_link.id', '=', 'users.smart_link_id')
            ->leftJoin('counter_values', 'users.smart_link_id', '=', 'counter_values.smart_link_id')
            ->orderBy('counter_values.day_value', 'desc')
            ->orderBy('counter_values.all_value', 'desc')
            ->select('users.fullname', 'smart_link', 'day_value as traffic', 'users.id as user_id')
            ->get();    
        }
             
        $cpa_traffic = Settings::where('name', 'cpa_traffic')->first()->value;
        return view('dashboard.index', compact('dataList', 'cpa_traffic'));
    }
    public function loginForm()
    {   
        return view('login');
    }

    public function doLogin(Request $request)
    {
        $dataArr = $request->all();
        // if any error send back with message.
        if($request->username == '' || $request->password == ''){
            Session::flash('error', 'Vui lòng nhập đầy đủ Username và Mật khẩu'); 
            return redirect()->route('login-form');
        }
        
        $dataArr = [
            'username' => $request->username,
            'password' => $request->password,
        ];
        if (Auth::validate($dataArr)) {

            if (Auth::attempt($dataArr)) {
              
                return redirect()->route('home');
              
            }

        }else {
            // if any error send back with message.
            Session::flash('error', 'Email hoặc mật khẩu không đúng.'); 
            return redirect()->route('login-form');
        }

        return redirect()->route('home');
    }
    public function doLogout() {
        Auth::logout();
        return redirect()->route('login-form');
    } 
}
