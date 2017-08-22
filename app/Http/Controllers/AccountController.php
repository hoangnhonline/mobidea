<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use Hash;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\SmartLink;
use App\Models\MemberMoney;

use Helper, File, Session, Auth;
use Carbon\Carbon;

class AccountController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return Response
    */
    public function index(Request $request)
    {          
        $items = Account::where('role', 3)->where('status', '>', 0)->orderBy('id', 'desc')->get();        
        
        //$parentCate = Category::where('parent_id', 0)->where('type', 1)->orderBy('display_order')->get();
        
        return view('account.index', compact('items'));
    }
    public function create()
    {         
        if(Auth::user()->role != 1){
            return redirect()->route('home');
        }
        $tmp = Account::where('smart_link_id', '>', 0)->select('smart_link_id')->get();
        foreach($tmp as $t){
            $arrLinkSelected[] = $t->smart_link_id;
        }
        
        $smartLinkList = SmartLink::whereNotIn('id', $arrLinkSelected)->get();

        return view('account.create', compact('smartLinkList'));
    }
    public function changePass(){
        return view('account.change-pass');   
    }
    public function updateEndDay(Request $request){
        $id = $request->id;
        $detail = Account::find($id);
        return view('account.update-end-day', compact('detail'));      
    }
    public function storeNewPass(Request $request){
        $user_id = Auth::user()->id;
        $detail = Account::find($user_id);
        $old_pass = $request->old_pass;
        $new_pass = $request->new_pass;
        $new_pass_re = $request->new_pass_re;
        if( $old_pass == '' || $new_pass == "" || $new_pass_re == ""){
            return redirect()->back()->withErrors(["Chưa nhập đủ thông tin bắt buộc!"])->withInput();
        }
       
        if(!password_verify($old_pass, $detail->password)){
            return redirect()->back()->withErrors(["Nhập mật khẩu hiện tại không đúng!"])->withInput();
        }
        
        if($new_pass != $new_pass_re ){
            return redirect()->back()->withErrors("Xác nhận mật khẩu mới không đúng!")->withInput();   
        }

        $detail->password = Hash::make($new_pass);
        $detail->save();
        Session::flash('message', 'Đổi mật khẩu thành công');

        return redirect()->route('account.change-pass');

    }
    public function store(Request $request)
    {
        if(Auth::user()->role != 1){
            return redirect()->route('home');
        }
        $dataArr = $request->all();
         
        $this->validate($request,[
            'fullname' => 'required',
            'username' => 'required|unique:users,username',
            'email' => 'unique:users,email',
            'smart_link_id' => 'required',
        ],
        [
            'fullname.required' => 'Bạn chưa nhập họ tên',
            'username.required' => 'Bạn chưa nhập username',            
            'email.unique' => 'Email đã được sử dụng.',
            'username.unique' => 'Username đã được sử dụng.',
            'smart_link_id.required' => 'Bạn chưa chọn smart link',
        ]);       
        
        $tmpPassword = '123455@';

        $dataArr['password'] = Hash::make( $tmpPassword );
        
        $dataArr['created_user'] = Auth::user()->id;

        $dataArr['updated_user'] = Auth::user()->id;
        $dataArr['role'] = 3;
        $rs = Account::create($dataArr);
        

        Session::flash('message', 'Tạo mới member thành công. Mật khẩu mặc định là: 123455@ ');

        return redirect()->route('account.index');
    }
    public function storeEndDay(Request $request)
    {
        if(Auth::user()->role == 3){
            return redirect()->route('home');
        }
        $dataArr = $request->all();
         
        $this->validate($request,[
            'date_get' => 'required',
            'money' => 'required|integer|min:1'
        ]);       
        
        $dataArr['date_get'] = Carbon::parse($dataArr['date_get'])->format('Y-m-d');

        $rs = MemberMoney::create($dataArr);
        if($rs->id){
            $detail = Account::find($dataArr['user_id']);
            $total_money = $detail->total_money + $dataArr['money'];
            $detail->update(['total_money' => $total_money]);            
        }

        Session::flash('message', 'Cập nhật thành công');

        return redirect()->route('home');
    }
    public function destroy($id)
    {
        // delete
        if(Auth::user()->role != 1){
            return redirect()->route('home');
        }
        $model = Account::find($id);
        $model->delete();

        // redirect
        Session::flash('message', 'Xóa member thành công');
        return redirect()->route('account.index');
    }
    public function edit($id)
    {
        if(Auth::user()->role != 1){
            return redirect()->route('home');
        }
        $detail = Account::find($id);
        $tmp = Account::where('smart_link_id', '>', 0)->where('smart_link_id', '<>', $detail->smart_link_id)->select('smart_link_id')->get();
        foreach($tmp as $t){
            $arrLinkSelected[] = $t->smart_link_id;
        }
        
        $smartLinkList = SmartLink::whereNotIn('id', $arrLinkSelected)->get();   
        return view('account.edit', compact( 'detail', 'smartLinkList'));
    }
    public function update(Request $request)
    {
        if(Auth::user()->role != 1){
            return redirect()->route('home');
        }
        $dataArr = $request->all();
        
        $this->validate($request,[
            'fullname' => 'required',
            'smart_link_id' => 'required',
        ],
        [
            'fullname.required' => 'Bạn chưa nhập họ tên',
            'smart_link_id.required' => 'Bạn chưa chọn smart link',
        ]);         

        $model = Account::find($dataArr['id']);

        $dataArr['updated_user'] = Auth::user()->id;

        $model->update($dataArr);

        Session::flash('message', 'Cập nhật member thành công');

        return redirect()->route('account.index');
    }
    public function updateStatus(Request $request)
    {       
        if(Auth::user()->role != 1){
            return redirect()->route('home');
        }
        $model = Account::find( $request->id );

        
        $model->updated_user = Auth::user()->id;
        $model->status = $request->status;

        $model->save();
        $mess = $request->status == 1 ? "Mở khóa member thành công" : "Khóa member thành công";
        Session::flash('message', $mess);

        return redirect()->route('account.index');
    }
}
