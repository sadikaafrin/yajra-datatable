<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CategoryController extends Controller
{
public function index(Request $request)
{
    if ($request->ajax()) {
        $data = Category::latest()->get();

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $actionBtn = '<a href="javascript:void(0);" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0);" class="delete btn btn-danger btn-sm">Delete</a>';
                return $actionBtn;
            })
            ->addColumn('name', function ($row) {
                return $row->name;
            })
            ->addColumn('description', function ($row) {

                return $row->description;
            })
            ->addColumn('image', function ($row) {
                if($row->image != null){
                    $img = asset('uploads/category/'.$row->image);
                }
                else{
                    $img = asset('uploads/category/'.$row->image);
                }
                $html = '<div class="text-center" uk-lightbox><a href="'.$img.'">
                    <img style="width: 70px; border: 1px solid #ddd; border-radius: 4px; padding: 1px;" src="'. $img .'" alt="">
                </a></div>';
                return $html;
            })
            ->rawColumns(['action', 'name', 'description', 'image'])
            ->make(true);
    }
    return view('category');
}
}
