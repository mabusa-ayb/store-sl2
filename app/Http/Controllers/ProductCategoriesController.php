<?php

namespace App\Http\Controllers;

use App\Model\OnlineStore\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use TJGazel\Toastr\Facades\Toastr;
use Yajra\DataTables\DataTables;
use Illuminate\Http\JsonResponse;
Use Redirect;
use Validator;

class ProductCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = Category::all();
        return view('onlinestore.category.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('onlinestore.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if($validator->fails()){
            Toastr::warning('Category.', 'Warning');
            return Redirect::back()->withErrors($validator)->withInput();
        }else{

            $image = 'no-image.png';
            if ($files = $request->file('image')) {
                $categoryImage = time().'.'.$files->getClientOriginalExtension();
                $request->image->move(public_path('images/categories'), $categoryImage);

                $image = $categoryImage;
            }

            $data = new Category();
            $data->name = $request->name;
            $data->status = $request->status;
            $data->image = $image;
            $data->user_modified = Auth::user()->id;

            if($data->save()){
                Toastr::success('Category created successfully', 'Success');
                return redirect()->route('category.index');
            }else{
                Toastr::error ('Category creation failed', 'Error');
                return redirect()->back();
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Category::where('id', $id)->get();
        return view('onlinestore.category.update', compact('data'));
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
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if($validator->fails()){
            Toastr::warning('Category.', 'Warning');
            return Redirect::back()->withErrors($validator)->withInput();
        }else {
            $data = Category::find($id);

            if ($request->image != '') {
                //Delete old Image
                $path = public_path() . '/images/categories/';
                $file_old = $path . $data->image;
                unlink($file_old);

                //Save new image
                $files = $request->file('image');
                $categoryImage = time().'.'.$files->getClientOriginalExtension();
                $request->image->move(public_path('images/categories'), $categoryImage);

                //Save in database
                $data->name = $request->name;
                $data->status = 1;
                $data->image = $categoryImage;
                $data->user_modified = Auth::user()->id;

                if ($data->save()) {
                    Toastr::success('Category updated successfully', 'Success');
                    return redirect()->route('category.index');
                } else {
                    Toastr::error('Category update failed', 'Error');
                    return redirect()->back();
                }
            }else{
                $data->name = $request->name;
                $data->status = 1;
                $data->user_modified = Auth::user()->id;

                if ($data->save()) {
                    Toastr::success('Category updated successfully', 'Success');
                    return redirect()->route('category.index');
                } else {
                    Toastr::error('Category update failed', 'Error');
                    return redirect()->back();
                }
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Category::where('id',$id)->first();
        $data->status = '0';
        $data->user_modified = Auth::user()->id;
        if ($data->save()){
            Toastr::success('Category Deleted Successfully', 'Success');
            return new JsonResponse(["status"=>true]);
        }else{
            Toastr::error('Category Deletion Failed', 'Error');
            return new JsonResponse(["status"=>false]);
        }
    }

    public function datatable(){
        $data = Category::where('status','=','1');
        return DataTables::of($data)
            ->addColumn('action', function($data){
                $url_edit = url('onlinestore/product/category/'.$data->id.'/edit');
                $url = url('onlinestore/product/category/'.$data->id);
                $edit = "<a class='btn btn-action btn-warning' href='".$url_edit."' title='Edit'><i class='nav-icon fas fa-edit'></i></a>&nbsp;";
                $delete = "<button data-url='".$url."' onclick='deleteData(this)' class='btn btn-action btn-danger' title='Delete'><i class='nav-icon fas fa-trash-alt'></i></button>&nbsp;";

                return $edit.''.$delete;
            })
            ->editColumn('image', function ($data){
                $url = url('/images/categories/'.$data->image);
                return "<img src='".$url."' width='60' height='60'>";
            })
            ->escapeColumns([])
            ->make(true);
    }
}
