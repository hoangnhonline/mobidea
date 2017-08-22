<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\UserBank;
use Helper, File, Session, Auth, DB;

class UserBankController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return Response
    */
    public function index(Request $request)
    {

        $query = UserBank::whereRaw('1')->where('user_id', Auth::user()->id);

        $items = $query->orderBy('id', 'desc')->paginate(20);
        
      
        return view('user-bank.index', compact( 'items' ));
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return Response
    */
    public function create(Request $request)
    {          

        return view('user-bank.create');
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
            'fullname' => 'required',
            'account_no' => 'required',
            'bank_name' => 'required',
            'branch' => 'required',
            'phone' => 'required',
        ]);       
        
        $dataArr['user_id'] = Auth::user()->id;
        UserBank::create($dataArr);
        
        Session::flash('message', 'Add new success');

        return redirect()->route('user-bank.index');
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

        $detail = UserBank::find($id);

        return view('user-bank.edit', compact('detail'));
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
        
        $this->validate($request,[                                    
            'fullname' => 'required',
            'account_no' => 'required',
            'bank_name' => 'required',
            'branch' => 'required',
            'phone' => 'required',
        ]);       
        
       $model = UserBank::find($dataArr['id']); 
       $model->update($dataArr);
       
        Session::flash('message', 'Update success');        

        return redirect()->route('user-bank.index');
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
        $model = UserBank::find($id);
        $model->delete();

        // redirect
        Session::flash('message', 'Delete success');
        return redirect()->route('user-bank.index');
    }
}