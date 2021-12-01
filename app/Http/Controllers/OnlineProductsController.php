<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use TJGazel\Toastr\Facades\Toastr;
use Yajra\DataTables\DataTables;
use App\OnlineProduct;
Use Redirect;
use Validator;

class OnlineProductsController extends Controller
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
        $data = OnlineProduct::all();
        return view('onlinestore.product.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::where('status','1')->orderBy('name', 'asc')->get();
        return view('onlinestore.product.create', compact('categories'));
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
            'category' => 'required|max:255',
            'details' => 'required|max:255',
            'price' => 'required|max:255',
            'description' => 'required|max:10000',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if($validator->fails()){
            Toastr::warning('Category.', 'Warning');
            return Redirect::back()->withErrors($validator)->withInput();
        }else{

            $image = 'no-image.png';
            if ($files = $request->file('image')) {
                $categoryImage = time().'.'.$files->getClientOriginalExtension();
                $request->image->move(public_path('images/onlineproducts'), $categoryImage);

                $image = $categoryImage;
            }

            $data = new OnlineProduct();
            $data->slug = time();
            $data->name = $request->name;
            $data->product_id = $request->productid;
            $data->category_id = $request->category;
            $data->details = $request->details;
            $data->price = $request->price;
            $data->shipping_cost = $request->shipping;
            $data->description = $request->description;
            $data->image_path = $image;
            $data->user_modified = Auth::user()->id;

            if($data->save()){
                Toastr::success('Product saved successfully', 'Success');
                return redirect()->route('onlineproduct.index');
            }else{
                Toastr::error ('Product save failed', 'Error');
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
        $data = OnlineProduct::where('id', $id)->get();
        $categories = Category::where('status','1')->orderBy('name', 'asc')->get();
        return view('onlinestore.product.update', compact('data','categories'));
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
            'category' => 'required|max:255',
            'details' => 'required|max:255',
            'price' => 'required|max:255',
            'description' => 'required|max:10000',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        //dd($request->price);

        if($validator->fails()){
            Toastr::warning('Category.', 'Warning');
            return Redirect::back()->withErrors($validator)->withInput();
        }else{
            $data = OnlineProduct::find($id);

            if ($request->image != '') {
                //Delete old Image
                $path = public_path() . '/images/onlineproducts/';
                $file_old = $path . $data->image_path;
                unlink($file_old);

                //Save new image
                $files = $request->file('image');
                $categoryImage = time().'.'.$files->getClientOriginalExtension();
                $request->image->move(public_path('images/onlineproducts'), $categoryImage);

                //Save in database
                $data->name = $request->name;
                $data->product_id = $request->productid;
                $data->category_id = $request->category;
                $data->details = $request->details;
                $data->price = $request->price;
                $data->shipping_cost = $request->shipping;
                $data->description = $request->description;
                $data->image_path = $categoryImage;
                $data->user_modified = Auth::user()->id;

            }else {
                $data->name = $request->name;
                $data->product_id = $request->productid;
                $data->category_id = $request->category;
                $data->details = $request->details;
                $data->price = $request->price;
                $data->shipping_cost = $request->shipping;
                $data->description = $request->description;
                $data->user_modified = Auth::user()->id;
            }

            if($data->save()){
                Toastr::success('Product saved successfully', 'Success');
                return redirect()->route('onlineproduct.index');
            }else{
                Toastr::error ('Product save failed', 'Error');
                return redirect()->back();
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
        $data = OnlineProduct::where('id',$id)->first();

        //Delete Image from Storage
        $path = public_path() . '/images/onlineproducts/';
        $file_old = $path . $data->image_path;
        unlink($file_old);

        if ($data->delete()){
            Toastr::success('Product Deleted Successfully', 'Success');
            return new JsonResponse(["status"=>true]);
        }else{
            Toastr::error('Product Deletion Failed', 'Error');
            return new JsonResponse(["status"=>false]);
        }
    }

    public function datatable(){
        $data = OnlineProduct::all();
        return DataTables::of($data)
            ->addColumn('action', function($data){
                $url_edit = url('onlinestore/product/onlineproduct/'.$data->id.'/edit');
                $url = url('onlinestore/product/onlineproduct/'.$data->id);
                //$view = "<a class='btn btn-action btn-primary' href='".$url."' title='Edit'><i class='nav-icon fas fa-eye'></i></a>&nbsp;";
                $edit = "<a class='btn btn-action btn-warning' href='".$url_edit."' title='Edit'><i class='nav-icon fas fa-edit'></i></a>&nbsp;";
                $delete = "<button data-url='".$url."' onclick='deleteData(this)' class='btn btn-action btn-danger' title='Delete'><i class='nav-icon fas fa-trash-alt'></i></button>&nbsp;";

                return $edit.''.$delete;
            })
            ->editColumn('image', function ($data){
                $url = url('/images/onlineproducts/'.$data->image_path);

                return "<img src='".$url."' width='60' height='60'>";
            })
            ->escapeColumns([])
            ->make(true);
    }
}
