<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Yajra\Datatables\Datatables;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('admin::categories.index');
    }

    public function ajaxlisting(Request $request)
    {

        $sql = \App\Models\Categories::select("*");


        return Datatables::of($sql)

            ->editColumn('id', function ($data) {
                return $data->id;
            })


            ->editColumn('name', function ($data) {
                return $data->name;
            })

            ->editColumn('image', function ($data) {
              return '<img src="'.\asset('uploads/categories').'/'.$data->image.'">';
            })

            ->editColumn('status', function ($data) {

                if ($data->status == 1) {

                    return '<span class="btn btn-success btn-sm">'.trans('lang_data.active_lable').'</span>';
                } else {

                    return '<span class="btn btn-danger btn-sm">'.trans('lang_data.inactive_lable').'</span>';
                }
            })

            ->addColumn('action', function ($data) {

                $string = '<a href="'.route('categories.edit',$data->id).'" class="btn btn-primary btn-sm">'.trans('lang_data.edit_lable').'</a> <a href="'.route('categories.show',$data->id).'" class="btn btn-danger btn-sm">'.trans('lang_data.delete_lable').' </a> ';


                return $string;
            })
            ->filter(function ($query) use ($request) {
            })
            ->rawColumns(['id', 'name','image', 'status', 'action'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin::categories.addedit');
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
            'image' => 'required',
            'status' => 'required',

        ],
        [
            'image.required' => 'please choose image',

        ]);

        $obj = new \App\Models\Categories;
        $obj->name = $request->name;
        $obj->status = $request->status;

        $img = $request->file('image');

        if ($request->hasFile('image')) {

            // @unlink('uploads/categories/' . $be->intro_bg2);
            $filename = rand() .'.'. $img->getClientOriginalExtension();
            $img->move('uploads/categories/', $filename);

            $obj->image = $filename;


        }

        $obj->save();

        return redirect()->route('categories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $obj =  \App\Models\Categories::where('id', $id)->firstOrfail();
        @unlink('uploads/categories/' . $obj->image);

        $obj->delete();

        return redirect()->route('categories.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $editdata = \App\Models\Categories::where('id',$id)->firstOrfail();

        return view('admin::categories.addedit',compact('editdata'));
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
            'image' => 'required',
            'status' => 'required',

        ],
    [
        'image.required' => 'please choose image',

    ]);

        $obj =  \App\Models\Categories::where('id', $id)->firstOrfail();
        $obj->name = $request->name;
        $obj->status = $request->status;
        $img = $request->file('image');

        if ($request->hasFile('image')) {

            @unlink('uploads/categories/' . $obj->image);
            $filename = rand() .'.'. $img->getClientOriginalExtension();
            $img->move('uploads/categories/', $filename);

            $obj->image = $filename;


        }

        $obj->save();

        return redirect()->route('categories.index');
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
