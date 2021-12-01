<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Model\Master\Product;
use App\Model\Purchase\PurchaseD;
use Illuminate\Http\JsonResponse;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use TJGazel\Toastr\Facades\Toastr;
Use Redirect;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;

class ProductController extends Controller
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
        return view('product.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('product.create');
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
            'code' => 'required|unique:products|max:255',
            'name' => 'required|unique:products|max:255',
        ]);

        if($validator->fails()){
            Toastr::warning('Product Code or Name can not be repeated.', 'Warning');
            return Redirect::back()->withErrors($validator)->withInput();
        }else{
            $data = new Product();
            $data->code = $request->code;
            $data->name = $request->name;
            $data->selling_price = $request->selling_price/1;
            $data->purchase_price = $request->purchase_price/1;
            $data->stock_available = $request->stock_available/1;
            $data->stock_total = $request->stock_available/1;
            $data->information = $request->information;
            $data->status = $request->status;
            $data->user_modified = Auth::user()->id;

            if($data->save()){
                Toastr::success('Product created successfully', 'Success');
                return redirect()->route('product.index');
            }else{
                Toastr::error ('Product creation failed', 'Error');
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
        $data = Product::with(['user_modify'])->where('id', $id)->get();
        if($data->count() > 0){
            return view('product.view', compact('data'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Product::where('id', $id)->where('status', '!=', 2)->get();
        if($data->count() > 0){
            return view('product.update', compact('data'));
        }
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
        $data = Product::find($id);
        $data->code = $request->code;
        $data->name = $request->name;
        $data->selling_price = $request->selling_price/1;
        $data->purchase_price = $request->purchase_price/1;
        $data->stock_available = $request->stock_available/1;
        $data->stock_total = $request->stock_available/1;
        $data->information = $request->information;
        $data->status = $request->status;
        $data->user_modified = Auth::user()->id;

        if($data->save()){
            Toastr::success('Product updated successfully', 'Success');
            return redirect()->route('product.index');
        }else{
            Toastr::error ('Product failed failed', 'Error');
            return redirect()->back();
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
        $data = Product::find($id);
        $data->status = 2;
        $data->user_modified = Auth::user()->id;
        if ($data->save()){
            Toastr::success('Product Deleted Successfully', 'Success');
            return new JsonResponse(["status"=>true]);
        }else{
            Toastr::error('Product Deletion Failed', 'Error');
            return new JsonResponse(["status"=>false]);
        }
    }

    public function datatable(){
        $data = Product::where('status','!=',2);
        return DataTables::of($data)
            ->addColumn('action', function($data){
                $url_edit = url('master/product/'.$data->id.'/edit');
                $url = url('master/product/'.$data->id);
                $url_history = url('master/product/history/'.$data->id);
                $view = "<a class='btn btn-action btn-primary' href='".$url."' title='View'><i class='nav-icon fas fa-eye'></i></a>&nbsp;";
                $edit = "<a class='btn btn-action btn-warning' href='".$url_edit."' title='Edit'><i class='nav-icon fas fa-edit'></i></a>&nbsp;";
                $delete = "<button data-url='".$url."' onclick='deleteData(this)' class='btn btn-action btn-danger' title='Delete'><i class='nav-icon fas fa-trash-alt'></i></button>&nbsp;";
                $history = "<a class='btn btn-action btn-default' href='".$url_history."' title='View' data-toggle='modal' data-target='#modal-default'>Purchase Details</i></a>&nbsp;";

                return $view."".$edit."".$delete."".$history;
            })
            /*->editColumn('purchase_price', function ($data){
                return number_format($data->purchase_price, 0, '.', ',');
            })
            ->editColumn('selling_price', function ($data){
                return number_format($data->selling_price, 0, '.', ',');
            })*/
            ->editColumn('information', function ($data){
                $string_replace = str_ireplace( "\r\n", ', ', $data->information);
                return str::limit($string_replace, 30, '...');
            })
            ->rawColumns(['action'])
            ->editColumn('id', 'ID:{{$id}}')
            ->make(true);
    }

    public function datatableTrash(){
        $data = Product::where('status','=',2);
        return DataTables::of($data)
            ->addColumn('action', function($data){
                $url = url('master/product/'.$data->id);
                $undoTrash = url('product/undoTrash/'.$data->id);
                $view = "<a class='btn btn-action btn-primary' href='".$url."' title='View'><i class='nav-icon fas fa-eye'></i></a>&nbsp;";
                $undo = "<button data-url='".$undoTrash."' onclick='undoTrash(this)' class='btn btn-action btn-success' title='Undo Trash'><i class='nav-icon fas fa-undo'></i></button>&nbsp;";

                return $view."".$undo;
            })
            /*->editColumn('purchase_price', function ($data){
                return number_format($data->purchase_price, 0, '.', ',');
            })
            ->editColumn('selling_price', function ($data){
                return number_format($data->selling_price, 0, '.', ',');
            })*/
            ->editColumn('information', function ($data){
                $string_replace = str_ireplace( "\r\n", ', ', $data->information);
                return str::limit($string_replace, 30, '...');
            })
            ->rawColumns(['action'])
            ->editColumn('id', 'ID:{{$id}}')
            ->make(true);
    }

    public function undoTrash(Request $request, $id){
        $data = Product::find($id);

        $data->status = 1;

        $data->user_modified = Auth::user()->id;

        if ($data->save()){
            Toastr::success('Product Restored Successfully', 'Success');
            return new JsonResponse(["status"=>true]);
        }else{
            Toastr::error('Product Restoration Failed', 'Error');
            return new JsonResponse(["status"=>false]);
        }
    }

    public function datatable_product(){
        $data = Product::select('products.*')->where('products.status', '=', 1);

        return DataTables::of($data)->make(true);
    }

    public function history($id){
        $datas = PurchaseD::with(['purchase'])
            ->where('id_product', $id)
            ->orderBy('id', 'DESC')->limit(5)->get();

        return view('product.history',['datas'=>$datas]);
    }
}
