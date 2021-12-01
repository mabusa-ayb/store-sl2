<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;
use App\Model\Master\Product;
use App\Model\Transaction\Stock;
use Illuminate\Http\Request;
use TJGazel\Toastr\Facades\Toastr;
use Validator;
use Illuminate\Http\JsonResponse;

class StockController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        return view('transaction.stock.index');
    }

    public function popup_media_product(){
        return view('transaction.stock.view_product');
    }

    public function update(Request $request){
        $validator = Validator::make($request->all(), [
            'name_raw_product' => 'required',
        ]);

        if($validator->fails()){
            Toastr::warning('Product selection required.', 'Warning');
            return redirect()->route('transaction/stock')->withErrors($validator)->withInput();
        }else {
            $detail = new Stock();
            $detail->id_product = $request->id_raw_product;
            $detail->total = $request->total / 1;
            $detail->information = "Stock Correction";
            $detail->type = "correction";
            $detail->save();

            $id = $request->id_raw_product;

            $data = Product::find($id);
            $data->stock_total = ($data->stock_total / 1) + ($request->total / 1);

            if ($data->save()) {
                Toastr::success('Data saved successfully', 'Success');
                return redirect()->route('transaction/stock');
            } else {
                Toastr::error('Data failed to save', 'Error');
                return redirect()->route('transaction/stock');
            }
        }
    }

    public function report(){
        return view('transaction.stock.report');
    }
}
