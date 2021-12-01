<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use Redirect;
use Validator;
use Illuminate\Support\Facades\Auth;
use TJGazel\Toastr\Facades\Toastr;
use App\Comment;

class CommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'comment' => 'required|max:255',
        ]);

        if($validator->fails()){
            Toastr::warning('Failed to save comment.', 'Warning');
            return Redirect::back()->withErrors($validator)->withInput();
        }else {
            $data = new Comment();
            $data->comment = $request->comment;
            $data->product_id = $request->product_id;
            $data->commenter_id = Auth::user()->id;

            if($data->save()){
                Toastr::success('Comment saved successfully', 'Warning');
                return redirect()->back();
            }else{
                Toastr::error ('Comment save failed', 'Error');
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
}
