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

Use Hash;
class ToolsController extends Controller
{
    
    public function index(Request $request)
    { 
        $traffic = $this->checkbot();        
        
        $url = $_SERVER['HTTP_HOST'];
        
        $meta_table = Meta::where('url', $url)->first();
        
        $ip = $this->getClientIp();

        $u_agent = $_SERVER['HTTP_USER_AGENT'];

        Ug::create([
            'ug' => $u_agent,
            'ipp' => $ip
        ]);

        return view('tools.index', compact('meta_table', 'traffic'));
    }
    public function getClientIp() {
        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP'))
            $ipaddress = getenv('HTTP_CLIENT_IP');
        else if(getenv('HTTP_X_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        else if(getenv('HTTP_X_FORWARDED'))
            $ipaddress = getenv('HTTP_X_FORWARDED');
        else if(getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        else if(getenv('HTTP_FORWARDED'))
           $ipaddress = getenv('HTTP_FORWARDED');
        else if(getenv('REMOTE_ADDR'))
            $ipaddress = getenv('REMOTE_ADDR');
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }
    public function meta(Request $request)
    {                   
        $url = $request->url;
        $meta = $request->meta;
        $username = $request->direct;
        $key = $request->keycode;

        $accDetail = Account::where('username', $username)->first();
        if($accDetail){
            $smart_link_id = $accDetail->smart_link_id;
            $direct = SmartLink::find($smart_link_id)->smart_link;

            //update visits
            $this->counter($smart_link_id);

        }

        if($key == env('KEY_CODE') ){            
            Meta::create([
                'url' => $url,
                'meta' => $meta,
                'direct' => $direct
            ]);
            echo "Done!";
        }
    }
    public static function counter( $smart_link_id ){
        // ip-protection in seconds
        $counter_expire = Settings::where('name', 'time_expires')->first()->value;
        $ignoreIpTmp = Settings::where('name', 'ignore_ips')->first()->value;
        // ignore agent list
        $counter_ignore_agents = array('bot', 'bot1', 'bot3');

        // ignore ip list
        $counter_ignore_ips = explode(',', $ignoreIpTmp);

        // get basic information
        $counter_agent = $_SERVER['HTTP_USER_AGENT'];
        $counter_ip = $_SERVER['REMOTE_ADDR']; 
        $counter_time = time();

        $ignore = false; 
        
        // get counter information        
        $rs1 = CounterValues::where('smart_link_id', $smart_link_id)->first();   
        
        if (!$rs1)
        {   

            $tmpArr = [
                'smart_link_id' => $smart_link_id,
                'day_id' => date("z"),
                'day_value' => 1,
                'all_value' => 1
            ];
            
          CounterValues::create($tmpArr);
          $rs1 = CounterValues::where('smart_link_id', $smart_link_id)->first();
          
          $ignore = true;
        }   
       
        $day_id = $rs1->day_id;
        $day_value = $rs1->day_value;
        $all_value = $rs1->all_value;
        // check ignore lists
        $length = sizeof($counter_ignore_agents);
        for ($i = 0; $i < $length; $i++)
        {
          if (substr_count($counter_agent, strtolower($counter_ignore_agents[$i])))
          {
             $ignore = true;
             break;
          }
        }

        $length = sizeof($counter_ignore_ips);
        for ($i = 0; $i < $length; $i++)
        {
          if ($counter_ip == $counter_ignore_ips[$i])
          {
             $ignore = true;
             break;
          }
        }

        
        // delete free ips
        if ($ignore == false)
        {           
            $time = time();
            CounterIps::where(['smart_link_id' =>$smart_link_id, 'ip' => $counter_ip])->whereRaw("$time-visit >= $counter_expire")->delete();
        }
 
        // check for entry
        if ($ignore == false)
        {
            $rs2 = CounterIps::where(['ip' => $counter_ip, 'smart_link_id' => $smart_link_id])->get();
          
          if ( $rs2->count() > 0)
          {
            $modelCouterIps = CounterIps::where('ip', $counter_ip)->where('smart_link_id', $smart_link_id);
            $modelCouterIps->update(['visit' => time()]);   
            $ignore = true;          
          }
          else
          {
             // insert ip
             CounterIps::create(['ip' => $counter_ip, 'visit' => time(), 'smart_link_id' => $smart_link_id]);
          }       
        }
        // add counter
        if ($ignore == false)
        {
          // day
          if ($day_id == date("z")) 
          {
             $day_value++; 
          }
          else 
          {
             $day_value = 1;
             $day_id = date("z");
          }
          // all
          $all_value++; 

        $modelCouterValues = CounterValues::where('smart_link_id', $smart_link_id);
        $modelCouterValues->update([
                'day_id' => $day_id,
                'day_value' => $day_value,
                'all_value' => $all_value
        ]);
         
        }
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

    public function checkbot()
    {
        $tf = "nobot";
        $ua = $_SERVER['HTTP_USER_AGENT'];

        if($ua=="Mozilla/5.0 (compatible; Google-Site-Verification/1.0)"){ $tf= "google bot";}
        if($ua=="Mozilla/5.0 (Windows NT 6.1; WOW64; Trident/7.0; rv:11.0) like Gecko"){ $tf= "google bot";}
        return $tf;

    }
}
