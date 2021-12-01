<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Controllers\Transaction\StockController;
use App\Model\Master\Product;
use App\Model\Transaction\Stock;
use App\OnlineProduct;
use Illuminate\Http\Request;
use App\OnlineCustomer;
use App\OnlineSale;
use App\OnlineTransaction;
use TJGazel\Toastr\Facades\Toastr;
use Yajra\DataTables\DataTables;

class OnlineTransactionsController extends Controller
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
        $data = OnlineSale::all();
        return view('onlinestore.sales.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = OnlineSale::where('id', $id)->get();
        //dd($data);
        $customer = OnlineCustomer::where('email','=', $data[0]->email)->get();
        $transactions = OnlineTransaction::where('sale_id','=', $data[0]->id)->get();
        //dd($transactions);
        //$product = Product::where('id','=', $transaction[0]->product_id)->get();
        $categories = Category::where('status','1')->orderBy('name', 'asc')->get();
        return view('onlinestore.sales.update', compact('data','categories', 'transactions', 'customer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //dd($id);
        //update stock records
        $transactions = OnlineTransaction::where('sale_id','=', $id)->get();
        //dd($transaction);
        //Stock::find($id);

        foreach ($transactions as $transaction){

            $onlineSale = new Stock();

            $onlineSale->id_product  = $transaction->product_id;
            $onlineSale->total  = $transaction->quantity * -1;
            $onlineSale->information = $transaction->sale_id;
            $onlineSale->type = "onlineSale";

            //dd($onlineSale);

            $onlineSale->save();

            $id = $request->product_id;

            $product = Product::find($id);
            $product->stock_total = ($product->stock_total / 1) + ($onlineSale->total / 1);

            $product->save();

        }

        $data = OnlineSale::find($id);

        $data->status = '1';

        if($data->save()){
            Toastr::success('Sale completed successfully', 'Success');
            return redirect()->route('onlinesales.index');
        }else{
            Toastr::error ('Sale completion Failed failed', 'Error');
            return redirect()->back();
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function datatable()
    {
        $data = OnlineSale::all();
        return DataTables::of($data)
            ->addColumn('action', function ($data) {
                $url = url('onlinestore/onlinetransactions/onlinesales/'.$data->id.'/edit');
                $view = "<a class='btn btn-action btn-primary' href='" . $url . "' title='Edit'><i class='nav-icon fas fa-eye'></i></a>&nbsp;";

                return $view;
            })
            ->escapeColumns([])
            ->make(true);
    }
}
