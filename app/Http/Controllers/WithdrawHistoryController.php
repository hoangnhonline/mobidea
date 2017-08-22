<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\WithdrawHistory;
use App\Models\UserBank;
use App\Models\Account;

use Helper, File, Session, Auth, DB;

class WithdrawHistoryController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return Response
    */
    public function index(Request $request)
    {
        if(Auth::user()->role == 3){
            $query = WithdrawHistory::whereRaw('1')->where('user_id', Auth::user()->id);
        }else{
            $query = WithdrawHistory::whereRaw('1');

        }
        $query->join('users', 'withdraw_history.user_id', '=', 'users.id');
        $items = $query->select('users.fullname', 'withdraw_history.*')->orderBy('id', 'desc')->paginate(20);
        
      
        return view('rut-tien.index', compact( 'items' ));
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return Response
    */
    public function create(Request $request)
    {          
    	$bankList = UserBank::where('user_id', Auth::user()->id)->get();        
        return view('rut-tien.create', compact('bankList'));
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  Request  $request
    * @return Response
    */
    public function store(Request $request)
    {
        $dataArr = $request->all();
        
        $this->validate($request,[                                    
            'money_request' => 'required|integer|min:1',
            'bank_id' => 'required'
        ]);       
        
        $dataArr['user_id'] = Auth::user()->id;
        
        WithdrawHistory::create($dataArr);
        
        Session::flash('message', 'Gửi yêu cầu rút tiền thành công.');

        return redirect()->route('rut-tien.index');
    }

    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return Response
    */
    public function show($id)
    {
    //
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return Response
    */
    public function edit($id)
    {        

        $detail = WithdrawHistory::find($id);
        if($detail->status == 2){
            return redirect()->route('rut-tien.index');
        }

        $bankList = UserBank::where('user_id', Auth::user()->id)->get();
        return view('rut-tien.edit', compact('detail', 'bankList'));
        
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  Request  $request
    * @param  int  $id
    * @return Response
    */
    public function update(Request $request)
    {
        $dataArr = $request->all();
       if($dataArr['xac_nhan'] == 1){        
            $model = WithdrawHistory::find($dataArr['id']); 
            $model->update(['status' => $dataArr['status']]);
            $user_id = $model->user_id;
            $modelAcc = Account::find($user_id);
            $total_money = $modelAcc->total_money - $model->money_request;
            $modelAcc->update(['total_money' => $total_money]);
       }else{
        $this->validate($request,[                                    
            'money_request' => 'required|integer|min:1',
            'bank_id' => 'required'
        ]);      
        $model = WithdrawHistory::find($dataArr['id']); 
        $model->update($dataArr); 
       }
       
       
        Session::flash('message', 'Update success');        

        return redirect()->route('rut-tien.index');
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return Response
    */
    public function destroy($id)
    {
        // delete
        $model = WithdrawHistory::find($id);
        if($model->status == 2){
            return redirect()->route('rut-tien.index');
        }
        $model->delete();

        // redirect
        Session::flash('message', 'Delete success');
        return redirect()->route('rut-tien.index');
    }
}