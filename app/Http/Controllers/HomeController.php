<?php

namespace App\Http\Controllers;

use App\Model\Transaction\Sales\SalesH;
use App\User;
use Illuminate\Http\Request;
use App\OnlineSale;
use App\Model\Purchase\PurchaseH;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $onlineSales = OnlineSale::all();
        $sales = SalesH::all();
        $users = User::where('name','!=', 'admin')->get();
        $purchases = PurchaseH::all();
        return view('home', compact('onlineSales', 'sales', 'users', 'purchases'));

    }
}
