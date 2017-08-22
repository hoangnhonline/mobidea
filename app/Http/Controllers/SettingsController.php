<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Settings;
use File, Session, DB, Auth;

class SettingsController  extends Controller
{
    public function index(Request $request)
    {              
        $settingList = Settings::whereRaw('1')->select('value', 'name')->get();
        foreach($settingList as $tmp){
            $settingArr[$tmp->name] = $tmp->value;
        }
        return view('settings.index', compact( 'settingArr'));
    }

    public function update(Request $request){

    	$dataArr = $request->all();    	    	     

        $dataArr['updated_user'] = Auth::user()->id;

        unset($dataArr['_token']);


    	foreach( $dataArr as $key => $value ){
    		$data['value'] = $value;
    		Settings::where( 'name' , $key)->update($data);
    	}

    	Session::flash('message', 'Cập nhật thành công.');

    	return redirect()->route('settings.index');
    }
}
