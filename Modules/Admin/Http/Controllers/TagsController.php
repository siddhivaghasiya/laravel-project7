<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Yajra\Datatables\Datatables;

class TagsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('admin::tags.index');
    }

    public function ajaxlisting(Request $request)
    {

        $sql = \App\Models\Tags::select("*");


        return Datatables::of($sql)

            ->editColumn('id', function ($data) {
                return $data->id;
            })


            ->editColumn('name', function ($data) {
                return $data->name;
            })

            ->editColumn('status', function ($data) {

                if ($data->status == 1) {

                    return '<span class="btn btn-success btn-sm">'.trans('lang_data.active_lable').'</span>';
                } else {

                    return '<span class="btn btn-danger btn-sm">'.trans('lang_data.inactive_lable').'</span>';
                }
            })

            ->addColumn('action', function ($data) {

                $string = '<a href="'.route('tags.edit',$data->id).'" class="btn btn-primary btn-sm">'.trans('lang_data.edit_lable').'</a> <a href="'.route('tags.show',$data->id).'" class="btn btn-danger btn-sm">'.trans('lang_data.delete_lable').' </a> ';


                return $string;
            })
            ->filter(function ($query) use ($request) {
            })
            ->rawColumns(['id', 'name', 'status', 'action'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin::tags.addedit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'status' => 'required',

        ]);

        $obj = new \App\Models\Tags;
        $obj->name = $request->name;
        $obj->status = $request->status;



        $obj->save();

        return redirect()->route('tags.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $obj =  \App\Models\Tags::where('id', $id)->firstOrfail();


        $obj->delete();

        return redirect()->route('tags.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $editdata = \App\Models\Tags::where('id',$id)->firstOrfail();

        return view('admin::tags.addedit',compact('editdata'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'status' => 'required',

        ]);

        $obj =  \App\Models\Tags::where('id', $id)->firstOrfail();
        $obj->name = $request->name;
        $obj->status = $request->status;


        $obj->save();

        return redirect()->route('tags.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
