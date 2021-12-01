<?php

namespace App\Http\Controllers;

use App\User;
use App\UserDetail;
use Illuminate\Http\Request;
use App\OnlineSale;
use App\Model\OnlineStore\Category;
use App\OnlineTransaction;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use App\OnlineProduct;

class CustomersController extends Controller
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
        //$sales = OnlineSale::where('email','=', Auth::user()->email )->get();
        $categories = Category::where('status','=',1)->orderBy('name','asc')->get();
        $data = User::where('id','=', Auth::user()->id)->get();
        $purchases = OnlineSale::where('email','=', $data[0]->email)->get();
        return view('ogani.profile', compact('data', 'purchases', 'categories'));
    }

    public function show($id)
    {
        $data = OnlineSale::find($id);
        $categories = Category::where('status','=',1)->orderBy('name','asc')->get();
        return view('ogani.order', compact('data', 'categories'));
    }

    public function edit()
    {
        $data = UserDetail::where('user_id','=', Auth::user()->id)->get();
        //dd($data);
        $categories = Category::where('status','=',1)->orderBy('name','asc')->get();
        if($data->isEmpty()){
            return view('ogani.userDetailsEmpty', compact('categories'));
        }else{
            return view('ogani.userDetails', compact( 'data', 'categories'));
        }

    }

    public function store(Request $request)
    {
        $data = new UserDetail();
        $data->fname = $request->fname;
        $data->sname = $request->sname;
        $data->phoneNumber = $request->phoneNumber;
        $data->address1 = $request->address1;
        $data->address2 = $request->address2;
        $data->province = $request->province;
        $data->email = $request->email;
        $data->city = $request->city;
        $data->country = $request->country;
        $data->user_id = Auth::user()->id;

        if($data->save()){
            $categories = Category::where('status','=',1)->orderBy('name','asc')->get();
            $data = User::where('id','=', Auth::user()->id)->get();
            $purchases = OnlineSale::where('email','=', $data[0]->email)->get();
            return redirect()->route('profile', compact('categories','purchases'))->with('success', 'User Details saved successfully!');
            //return view('ogani.profile', compact('categories','purchases'))->with('success', 'User Details saved successfully!');
        }else{
            return redirect()->back()->with('error', 'There was a problem in saving your details!');
        }
    }

    public function update(Request $request, $id)
    {
        $data = UserDetail::find($id);
        $data->fname = $request->fname;
        $data->sname = $request->sname;
        $data->phoneNumber = $request->phoneNumber;
        $data->address1 = $request->address1;
        $data->address2 = $request->address2;
        $data->province = $request->province;
        $data->email = $request->email;
        $data->city = $request->city;
        $data->country = $request->country;

        if($data->save()){
            $categories = Category::where('status','=',1)->orderBy('name','asc')->get();
            $data = User::where('id','=', Auth::user()->id)->get();
            $purchases = OnlineSale::where('email','=', $data[0]->email)->get();
            return redirect()->route('profile', compact('categories','purchases'))->with('success', 'User Details updated successfully!');
        }else{
            return redirect()->back()->with('error', 'There was a problem in updating your details!');
        }
    }

    public function datatable($email){
        //$data = OnlineSales::where('email','=', Auth::user()->email)->get();
        $data = OnlineSale::where('email','=', $email)->where('status', '!=', '2')->get();
        //dd($data);
        return DataTables::of($data)
            ->addColumn('action', function($data){
                //$url_edit = url('onlinestore/product/onlineproduct/'.$data->id.'/edit');
                $url = url('profile');
                $view = "<a class='btn btn-action btn-outline-primary btn-sm' href='".$url.'/order/'.$data->id."' title='Edit'><i class='nav-icon fas fa-eye'></i></a>&nbsp;";
                $cancel = "<a class='btn btn-action btn-outline-danger btn-sm' href='".$url."' title='Cancel'><i class='nav-icon fas fa-close'></i></a>&nbsp;";
                //$edit = "<a class='btn btn-action btn-warning' href='".$url_edit."' title='Edit'><i class='nav-icon fas fa-edit'></i></a>&nbsp;";
                //$delete = "<button data-url='".$url."' onclick='deleteData(this)' class='btn btn-action btn-danger' title='Delete'><i class='nav-icon fas fa-trash-alt'></i></button>&nbsp;";
                if($data->status == '0'){
                    return $view.''.$cancel;
                }elseif($data->status == '1'){
                    return $view;
                }

            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function datatableOrder($id){
        $data = OnlineTransaction::where('sale_id','=', $id)->get();

        //$name = OnlineProduct::where('product_id','=', $data[0]->product_id)->get();
        //dd($data[0]->product_id);
        return DataTables::of($data)
            ->addColumn('name', function($data){
                $name = OnlineProduct::where('id','=', $data->product_id)->get();
                //dd($data->product_id);
                return $name[0]->name;
            })
            ->addColumn('price', function($data){
                $price = OnlineProduct::where('id','=', $data->product_id)->get();
                return $price[0]->price;
            })
            ->addColumn('image', function($data){
                $image = OnlineProduct::where('id','=', $data->product_id)->get();
                //$imagePath = "images/onlineproducts/'.$image[0]->image.";
                $url = url('/images/onlineproducts/'.$image[0]->image_path);
                //dd($url);
                return "<img src='".$url."' width='60' height='60'>";

            })
            /*->rawColumns(['name', 'price', 'image'])*/
            ->escapeColumns([])
            ->make(true);
    }

}
