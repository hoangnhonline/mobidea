<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\SmartLink;
use Helper, File, Session, Auth, DB;

class SmartLinkController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return Response
    */
    public function index(Request $request)
    {

        $query = SmartLink::whereRaw('1');

        $items = $query->orderBy('id', 'desc')->paginate(20);
        
      
        return view('smart-link.index', compact( 'items' ));
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return Response
    */
    public function create(Request $request)
    {          

        return view('smart-link.create');
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
            'smart_link' => 'required'            
        ],
        [                                    
            'smart_link.required' => 'Please enter smart link'
        ]);       
        
        unset($dataArr['_token']);
        
        DB::table('smart_link')->insert($dataArr);        
        
        Session::flash('message', 'Add new success');

        return redirect()->route('smart-link.index');
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

        $detail = SmartLink::find($id);

        return view('smart-link.edit', compact('detail'));
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
            'smart_link' => 'required'            
        ],
        [                                    
            'smart_link.required' => 'Please enter smart link'
        ]);       
        
        
        unset($dataArr['_token']);
        DB::table('smart_link')->where('id', $dataArr['id'])->update($dataArr);
       
        Session::flash('message', 'Update success');        

        return redirect()->route('smart-link.index');
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
        $model = SmartLink::find($id);
        $model->delete();

        // redirect
        Session::flash('message', 'Delete success');
        return redirect()->route('smart-link.index');
    }
}