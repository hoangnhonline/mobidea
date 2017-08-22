<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use Hash;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\SmartLink;

use Helper, File, Session, Auth;

class AccountController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return Response
    */
    public function index(Request $request)
    {          
        $items = Account::where('role', 3)->where('status', '>', 0)->orderBy('id')->get();        
        
        //$parentCate = Category::where('parent_id', 0)->where('type', 1)->orderBy('display_order')->get();
        
        return view('account.index', compact('items'));
    }
    public function create()
    {         
        //$parentCate = Category::where('parent_id', 0)->where('type', 1)->orderBy('display_order')->get();
        $smartLinkList = SmartLink::whereRaw('id NOT IN (SELECT smart_link_id FROM users where statuss = 1)')->get();
        
        dd($smartLinkList);
        return view('account.create', compact('smartLinkList'));
    }
    public function changePass(){
        return view('account.change-pass');   
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
       
        $dataArr = $request->all();
         
        $this->validate($request,[
            'full_name' => 'required',
            'username' => 'required|unique:users,username',
            'email' => 'required|unique:users,email',
        ],
        [
            'name.required' => 'Bạn chưa nhập họ tên',
            'username.required' => 'Bạn chưa nhập username',
            'email.required' => 'Bạn chưa nhập email',
            'email.unique' => 'Email đã được sử dụng.',
             'username.unique' => 'Username đã được sử dụng.'
        ]);       
        
        $tmpPassword = '123455@';

        $dataArr['password'] = Hash::make( $tmpPassword );
        
        $dataArr['created_user'] = Auth::user()->id;

        $dataArr['updated_user'] = Auth::user()->id;
        $dataArr['role'] = 2;
        $rs = Account::create($dataArr);
        

        Session::flash('message', 'Tạo mới tài khoản thành công. Mật khẩu mặc định là: 123455@ ');

        return redirect()->route('account.index');
    }
    public function destroy($id)
    {
        // delete
        $model = Account::find($id);
        $model->delete();

        // redirect
        Session::flash('message', 'Xóa tài khoản thành công');
        return redirect()->route('account.index');
    }
    public function edit($id)
    {
        $detail = Account::find($id);
        
        return view('account.edit', compact( 'detail'));
    }
    public function update(Request $request)
    {
        $dataArr = $request->all();
        
        $this->validate($request,[
            'full_name' => 'required',         
            'email' => 'required|unique:users,email',
        ],
        [
            'name.required' => 'Bạn chưa nhập họ tên',           
            'email.required' => 'Bạn chưa nhập email',
            'email.unique' => 'Email đã được sử dụng.',
            'username.unique' => 'Username đã được sử dụng.'
        ]);      

        $model = Account::find($dataArr['id']);

        $dataArr['updated_user'] = Auth::user()->id;

        $model->update($dataArr);

        Session::flash('message', 'Cập nhật tài khoản thành công');

        return redirect()->route('account.index');
    }
    public function updateStatus(Request $request)
    {       

        $model = Account::find( $request->id );

        
        $model->updated_user = Auth::user()->id;
        $model->status = $request->status;

        $model->save();
        $mess = $request->status == 1 ? "Mở khóa tài khoản thành công" : "Khóa tài khoản thành công";
        Session::flash('message', $mess);

        return redirect()->route('account.index');
    }
}
