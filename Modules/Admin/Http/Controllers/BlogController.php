<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Yajra\Datatables\Datatables;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('admin::blog.index');
    }
    public function ajaxlisting()
    {
        $sql = \App\Models\Blog::select("*");


        return Datatables::of($sql)

            ->editColumn('id', function ($data) {
                return $data->id;
            })


            ->editColumn('title', function ($data) {
                return $data->title;
            })

            ->editColumn('categories', function ($data) {
                return $data->categories;
            })

            ->editColumn('tags', function ($data) {
                return $data->tags;
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
     * @return Renderable
     */
    public function create()
    {
        return view('admin::blog.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
