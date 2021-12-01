<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;
use App\Model\Admin\Shop;
use App\Model\Master\Product;
use App\Model\Transaction\Sales\SalesD;
use App\Model\Transaction\Sales\SalesH;
use App\Model\Transaction\Stock;
use Illuminate\Http\Request;
use TJGazel\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
Use Redirect;
use Yajra\DataTables\DataTables;

class SaleController extends Controller
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
        return view('transaction.sales.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $detail_count = 0;
        return view('transaction.sales.create', compact('detail_count'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = new SalesH();
        $data->date = date('Y-m-d', strtotime($request->date));
        $data ->num_invoice = $request->invoice_number;
        $data ->shop_name = $request->shop_name;
        $data ->information = $request->information;
        $data ->active = 1;
        $data ->user_modified = Auth::user()->id;
        $total = 0;
        if($data->save()){
            $id_sales = $data->id;
            if(isset($_POST['id_raw_product'])){
                foreach ($_POST['id_raw_product'] as $key=>$id_raw_product):
                    $detail = new SalesD();
                    $detail->id_sales = $data->id;
                    $detail->id_product = $id_raw_product;
                    $detail->total = $_POST['total'][$key];
                    $detail->price = $_POST['price'][$key];
                    $total = $total + ($detail->total * $detail->price);
                    $detail->save();
                endforeach;
            }

            $data = SalesH::find($id_sales);
            $data->total = $total;
            $data->save();

            $dataH = SalesH::find($id_sales);
            $data = SalesD::where('id_sales', '=', $id_sales)->orderBy('id', 'ASC')->get();
            foreach ($data as $data){
                $detail = new Stock();
                $detail->id_product = $data->id_product;
                $detail->information = $dataH->num_invoice;
                $detail->total = $data->total*-1;
                $detail->type = 'sell';
                $detail->save();

                $detail = Product::find($data->id_product);
                $detail->selling_price = $data->price;
                $detail->stock_total = $detail->stock_total - $data->total;

                $detail->save();
            }

            Toastr::success('Data saved Successfully.', 'Success');
            return redirect()->route('sales.index');
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
        $data = SalesH::with(['user_modify'])->where('id', $id)->get();
        $business = Shop::all();

        if($data->count() > 0){
            $detail = SalesD::with('product')
                ->where('id_sales', '=', $data[0]->id)
                ->orderBy('id', 'ASC')->get();

            return view('transaction.sales.view', compact('data', 'detail', 'business'));
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
        //
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
        //
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

    public function popup_media_product($id_count = null){
        return view('transaction.sales.view_product')->with('id_count', $id_count);
    }

    public function datatable(){
        $data = SalesH::select('sales_h.*')->where('sales_h.active', '!=', 0);

        return DataTables::of($data)
            ->addColumn('action', function ($data){
                $url = url('transaction/sales/'.$data->id);
                $view = "<a class='btn btn-action btn-primary' href='".$url."' title='View'><i class='nav-icon fas fa-eye'></i></a>&nbsp;";

                return $view;
            })
            ->editColumn('date', function ($data){
                return date('d-m-Y', strtotime($data->date));
            })
            ->editColumn('total', function ($data){
                return number_format($data->total, 0, '.', ',');
            })
            ->make(true);
    }

    public function print($id){
        $data = SalesH::with(['user_modify'])->where('id', $id)->get();
        $business = Shop::all();

        if ($data->count() > 0){
            $details = SalesD::with('product')->where('id_sales', '=', $data[0]->id)
                ->orderBy('id', 'ASC')->get();

            return view('transaction.sales.print', compact('data', 'details', 'business'));
        }
    }
}
