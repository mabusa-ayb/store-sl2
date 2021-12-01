<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Admin\User;
use App\Model\Admin\UserType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Validator;
use Illuminate\Support\Facades\Auth;
use TJGazel\Toastr\Facades\Toastr;
Use Redirect;
use Yajra\DataTables\DataTables;
use Illuminate\Http\JsonResponse;

class UsersController extends Controller
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
        $data = UserType::all();
        return view('admin.users.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
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
            'email' => 'required|max:255',
            'password' => 'required',
        ]);

        if($validator->fails()){
            Toastr::warning('User must be unique.', 'Warning');
            return Redirect::back()->withErrors($validator)->withInput();
        }else{
            $data = new User();
            $data->name = $request->name;
            $data->email = $request->email;
            $data->password = Hash::make($request->password);

            $data->save();

            $dataT = new UserType();
            $dataT->user_id = $data->id;
            $dataT->active = 1;
            $dataT->account_type = $request->user_type;
            $dataT->user_modified = Auth::user()->id;

            if($dataT->save()){
                Toastr::success('User Account created successfully', 'Success');
                return redirect()->route('users.index');
            }else{
                Toastr::error ('User Account creation failed', 'Error');
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
        $data = User::where('id', $id)->get();
        return view('admin.users.update', compact('data'));
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
            'email' => 'required|max:255',
        ]);

        if($validator->fails()){
            Toastr::warning('User must be unique.', 'Warning');
            return Redirect::back()->withErrors($validator)->withInput();
        }else {
            $data = User::find($id);
            $data->name = $request->name;
            $data->email = $request->email;
            if ($request->password != '') {
                $data->password = Hash::make($request->password);
            }
            $data->save();

            $dataT = UserType::where('user_id',$id)->first();
            $dataT->account_type = $request->account_type;
            $dataT->user_modified = Auth::user()->id;

            if ($dataT->save()) {
                Toastr::success('User Account updated successfully', 'Success');
                return redirect()->route('users.index');
            } else {
                Toastr::error('User Account update failed', 'Error');
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
        $data = UserType::where('user_id',$id)->first();
        $data->active = 0;
        $data->user_modified = Auth::user()->id;
        if ($data->save()){
            Toastr::success('User Account Deleted Successfully', 'Success');
            return new JsonResponse(["status"=>true]);
        }else{
            Toastr::error('User Account Deletion Failed', 'Error');
            return new JsonResponse(["status"=>false]);
        }
    }

    public function datatable(){
        //$data = UserType::where('active','!=',0)->where('user_id','!=', Auth::user()->id);
        //$data = UserType::where('user_id','!=', Auth::user()->id);
        $data = User::all();
        return DataTables::of($data)
            ->addColumn('action', function($data){
                $url_edit = url('admin/users/'.$data->id.'/edit');
                $url = url('admin/users/'.$data->id);
                $edit = "<a class='btn btn-action btn-warning' href='".$url_edit."' title='Edit'><i class='nav-icon fas fa-edit'></i></a>&nbsp;";
                $delete = "<button data-url='".$url."' onclick='deleteData(this)' class='btn btn-action btn-danger' title='Delete'><i class='nav-icon fas fa-trash-alt'></i></button>&nbsp;";

                return $edit.''.$delete;
            })
            /*
            ->addColumn('name', function ($data){
                return $data->user->name;
            })
            ->addColumn('email', function ($data){
                return $data->user->email;
            })
            ->rawColumns(['action', 'name', 'email'])
            */
            ->rawColumns(['action'])
            ->make(true);
    }
}
